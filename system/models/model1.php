<?php

class model extends CI_Model {

    public function cek_login($username, $password) {
        $query = $this->db->query("SELECT *
            FROM `user` u
            WHERE u.`name`='" . $username . "' 
            and u.`password`= '" . md5($password) . "'");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($row['level'] == 1) {
                    $this->session->set_userdata('bos', TRUE);
                    $this->session->set_userdata('user_level', 'bos');
                } else {
                    $this->session->set_userdata('operator', TRUE);
                    $this->session->set_userdata('user_level', 'owner');
                }
                $this->session->set_userdata('login', TRUE);
                $this->session->set_userdata('user_id', $row['id_user']);
                $this->session->set_userdata('user_name', $row['username']);
                $this->session->set_userdata('user_pass', $row['password']);
            }
            $this->get_potongan();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function search_nopol($param) {
        $pembelian = $this->db->query("SELECT nopol
            FROM `pembelian` 
            WHERE nopol like '%" . $param . "%' 
            GROUP BY nopol");
        foreach ($pembelian->result_array() as $row) {
            $results[] = $row['nopol'];
        }
        $penjualan = $this->db->query("SELECT nopol
            FROM `penjualan`
            WHERE nopol like '%" . $param . "%' 
            GROUP BY nopol");
        foreach ($penjualan->result_array() as $row) {
            if (!in_array($row['nopol'], $results)) {
                $results[] = $row['nopol'];
            }
        }
        foreach ($results as $value) {
            $suggest[] = array("label" => $value);
        }
        return json_encode($suggest);
    }

    public function get_potongan() {
        $this->db->where(array("id_pengaturan" => 2));
        $query = $this->db->get("pengaturan");
        foreach ($query->result_array() as $r)
            ;
        $this->session->set_userdata('potongan', $r['value']);
    }

    public function get_total($table, $cond, $groupby) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        if (isset($groupby)) {
            $this->db->group_by($groupby);
        }
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function get_detail_sum($table, $col, $cond) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        foreach ($col as $c) {
            $this->db->select_sum($c);
        }
        $query = $this->db->get($table);
        foreach ($query->result_array() as $r)
            ;
        return $r;
    }

    public function get_detail($table, $cond) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        $query = $this->db->get($table);
        foreach ($query->result_array() as $r)
            ;
        return $r;
    }

    public function get_data_like($table, $cond, $opt) {
        for ($x = 0; $x < count($cond['column']); $x++) {
            for ($y = 0; $y < count($cond['key']); $y++) {
                $this->db->or_like($cond['column'][$x], $cond['key'][$y]);
            }
        }
        if (is_array($opt)) {
            if (isset($opt['order_by'])) {
                $this->db->order_by($opt['order_by'][0], $opt['order_by'][1]);
            }
        }
        $query = $this->db->get($table, $opt['limit'][1], $opt['limit'][0]);
        return $query;
    }

    public function get_data_sum($col, $table, $cond, $no, $perpage) {
        foreach ($col['sum'] as $c) {
            $this->db->select_sum($c);
        }
        if (is_array($col['select'])) {
            foreach ($col['select'] as $c) {
                $this->db->select($c);
            }
        }
        return $this->get_data($table, $cond, $no, $perpage);
    }

    public function get_data($table, $cond, $no, $perpage) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        if (is_array($no)) {
            if (isset($no['order_by'])) {
                $this->db->order_by($no['order_by'][0], $no['order_by'][1]);
            }
            if (isset($no['group_by'])) {
                $this->db->group_by($no['group_by']);
            }
            if (isset($no['limit'])) {
                $query = $this->db->get($table, $no['limit'][1], $no['limit'][0]);
            } else {
                $query = $this->db->get($table);
            }
        } else {
            $this->db->order_by("id_" . $table, "desc");
            if (isset($no) && isset($perpage)) {
                $query = $this->db->get($table, $perpage, $no);
            } else {
                $query = $this->db->get($table);
            }
        }
        return $query;
    }

    public function hapus($table, $cond) {
        if (isset($cond)) {
            $this->db->where($cond);
        }
        $query = $this->db->delete($table);
        return $query;
    }

    public function update($table, $insert) {
        if (trim($insert["id_$table"]) == "") {
            $query = $this->db->insert($table, $insert);
        } else {
            $this->db->where(array("id_$table" => $insert["id_$table"]));
            $query = $this->db->update($table, $insert);
        }
        return $query;
    }

    public function penjualan($input) {
        $this->db->trans_start();
        $this->db->insert("penjualan", $input);
        for ($i = 0; $i < count($_POST['nilai']); $i++) {
            $nilai+=$_POST['nilai'][$i];
            $this->db->query("UPDATE PRODUK set stok=stok-" . $_POST[volume][$i] . " WHERE id_produk='" . $_POST[id_beras][$i] . "'");
            $this->db->query("insert into `history_produk` (id_produk, keluar, ket, tgl) VALUES ('" . $_POST[id_beras][$i] . "','" . $_POST[volume][$i] . "','$input[ket]','$input[tgl]')");
            $this->db->query("UPDATE kemasan set stok=stok-" . $_POST[jml_kemasan][$i] . " WHERE id_kemasan='" . $_POST[id_kemasan][$i] . "'");
            $this->db->query("insert into `history_kemasan` (id_kemasan, masuk, ket, tgl) VALUES ('" . $_POST[id_kemasan][$i] . "','" . $_POST[jml_kemasan][$i] . "','$input[ket]', '$input[tgl]')");
            $this->db->query("INSERT INTO `detail_penjualan`(`nota`, `id_beras`, `id_kemasan`, `jml_kemasan`, `satuan_kemasan`, `volume`, `harga`, `nilai`) "
                    . "VALUES ('$input[nota]','" . $_POST[id_beras][$i] . "','" . $_POST[id_kemasan][$i] . "','" . $_POST[jml_kemasan][$i] . "','" . $_POST[satuan_kemasan][$i] . "','" . $_POST[volume][$i] . "','" . $_POST[harga][$i] . "','" . $_POST[nilai][$i] . "')");
        }
        if ($nilai > $input['tunai']) {
            $saldo = $nilai - $input['tunai'];
            $this->db->query("UPDATE `konsumen` SET `saldo`=saldo-$saldo  WHERE id_konsumen='$input[id_konsumen]'");
            $this->db->insert("history_konsumen", array("id_konsumen" => $input['id_konsumen'], "debit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        } elseif ($nilai < $input['tunai']) {
            $saldo = $input['tunai'] - $nilai;
            $this->db->query("UPDATE `konsumen` SET `saldo`=saldo+$saldo  WHERE id_konsumen='$input[id_konsumen]'");
            $this->db->insert("history_konsumen", array("id_konsumen" => $input['id_konsumen'], "kredit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        }
        $this->db->insert("kas", array("nota" => $input['nota'], "debit" => $input['tunai'], "tgl" => $input['tgl'], "ket" => $input['ket']));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function pembelian($input) {
        $this->db->trans_start();
        $this->db->insert("pembelian", $input);
        for ($i = 0; $i < count($_POST['nilai']); $i++) {
            $nilai+=$_POST['nilai'][$i];
            $this->db->query("INSERT INTO `detail_pembelian`(`nota`, `id_beras`, `volume`,`kg`, `air`, `hampa`, `broken`, `netto`, `harga`, `nilai`) "
                    . "VALUES ('$input[nota]','" . $_POST[id_beras][$i] . "','" . $_POST[volume][$i] . "','" . $_POST[kg][$i] . "','" . $_POST[air][$i] . "','" . $_POST[hampa][$i] . "','" . $_POST[broken][$i] . "','" . $_POST[netto][$i] . "','" . $_POST[harga][$i] . "','" . $_POST[nilai][$i] . "')");
            if ($_POST['type'][$i] == 1) {
                $this->db->query("UPDATE `pengaturan` SET `value`=value+" . $_POST['netto'][$i] . "  WHERE id_pengaturan='1'");
            }
        }
        $this->db->query("UPDATE `pemasok` SET `saldo`=saldo+$nilai  WHERE id_pemasok='$input[id_pemasok]'");
        $this->db->insert("history_pemasok", array("id_pemasok" => $input['id_pemasok'], "kredit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        $this->db->insert("kas", array("nota" => $input['nota'], "debit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function giling($input, $hasil, $mglb) {
        $this->db->trans_start();
        $this->db->insert("giling", $input);
        $this->db->query("UPDATE `pengaturan` SET `value`=value+$hasil WHERE id_pengaturan='1'");
        $this->db->query("UPDATE `produk` SET `stok`=stok+$mglb WHERE id_produk='0'");
        $this->db->query("insert into `history_produk` (id_produk, masuk, ket, tgl) VALUES ('0','$mglb','$input[ket]','$input[tgl]')");
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function stok($id, $stok, $ket) {
        $this->db->trans_start();
        $this->db->query("UPDATE `pengaturan` SET `value`=value-$stok WHERE id_pengaturan='1'");
        $this->db->query("UPDATE `produk` SET `stok`=stok+$stok WHERE id_produk='$id'");
        $this->db->query("insert into `history_produk` (id_produk, masuk, ket, tgl) VALUES ('$id','$stok','$ket', NOW())");
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function stokkemasan($id, $stok, $ket) {
        $this->db->trans_start();
        $this->db->query("UPDATE `kemasan` SET `stok`=stok+$stok WHERE id_kemasan='$id'");
        $this->db->query("insert into `history_kemasan` (id_kemasan, masuk, ket, tgl) VALUES ('$id','$stok','$ket', NOW())");
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function saldo($table, $input, $status) {
        $this->db->trans_start();
        if ($table == "pemasok") {
            if (isset($status) && $status == "debit") {
                $kolom1 = "kredit";
                $kolom2 = "debit";
                $this->db->query("UPDATE `$table` SET `saldo`=saldo+$input[saldo]  WHERE id_$table='$input[id]'");
            } else {
                $kolom1 = "debit";
                $kolom2 = "kredit";
                $this->db->query("UPDATE `$table` SET `saldo`=saldo-$input[saldo]  WHERE id_$table='$input[id]'");
            }
        } else {
            $kolom1 = "kredit";
            $kolom2 = "debit";
            $this->db->query("UPDATE `$table` SET `saldo`=saldo+$input[saldo]  WHERE id_$table='$input[id]'");
        }
        $nota = "SL" . date('YmdHis');
        $this->db->insert("history_$table", array("id_$table" => $input['id'], "$kolom1" => $input['saldo'], "tgl" => $input['tgl'], "ket" => $input['ket']));
        $this->db->insert("kas", array("nota" => $nota, "$kolom2" => $input['saldo'], "tgl" => $input['tgl'], "ket" => $input['ket']));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}

?>