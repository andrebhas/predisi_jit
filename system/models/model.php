<?php

class model extends CI_Model {

    public function cek_login($username, $password) {
        $query = $this->db->query("SELECT *
            FROM `user` u
            WHERE u.`name`='" . $username . "'
            and u.`password`= '" . ($password) . "'");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($row['level'] == 1) {
                    $this->session->set_userdata('bos', TRUE);
                    $this->session->set_userdata('user_level', 'bos');
                } elseif($row['level'] == 2)  {
                    $this->session->set_userdata('owner', TRUE);
                    $this->session->set_userdata('user_level', 'owner');
                } else {
                  $this->session->set_userdata('gudang', TRUE);
                  $this->session->set_userdata('user_level', 'gudang');
                }
                // if ($row['level'] == 2){
                //    $this->session->set_userdata('operator', TRUE);
                //    $this->session->set_userdata('user_level', 'owner');
                // } else {
                //    $this->session->set_userdata('gudang', TRUE);
                //    $this->session->set_userdata('user_level', 'gudang');
                // }

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
        $input['nota']=date('ymdHis');
        $this->db->trans_start();
        $this->db->insert("penjualan", array(
            'nota'=>$input['nota'],
            'tgl'=>$input['tgl'],
            'id_customer'=>$input['id_customer'],
            'ket'=>$input['ket']
        ));
        foreach($input['id_barang'] as $i=>$b){
            $nilai+=$input['harga'][$i]*$input['qty'][$i];
            $detail=array(
                'nota'           =>$input['nota'],
                'id_beras'       =>$b,
                'id_kemasan'     =>1,
                'jml_kemasan'    =>$input['qty'][$i],
                'satuan_kemasan' =>1,
                'volume'         =>1,
                'harga'          =>$input['harga'][$i],
                'nilai'          =>$input['qty'][$i]*$input['harga'][$i]
            );
            $this->db->insert('detail_penjualan', $detail);
            $this->db->query("UPDATE barang set stok = stok-".$input['qty'][$i]." WHERE id_barang='$b'");
        }
        $this->db->insert("kas", array("nota" => $input['nota'], "debit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        // $this->db->insert("penjualan", $input);
        // for ($i = 0; $i < count($_POST['nilai']); $i++) {
        //     $nilai+=$_POST['nilai'][$i];
        //     $this->db->query("UPDATE PRODUK set stok=stok-" . $_POST[volume][$i] . " WHERE id_produk='" . $_POST[id_beras][$i] . "'");
        //     $this->db->query("insert into `history_produk` (id_produk, keluar, ket, tgl) VALUES ('" . $_POST[id_beras][$i] . "','" . $_POST[volume][$i] . "','$input[ket]','$input[tgl]')");
        //     $this->db->query("UPDATE kemasan set stok=stok-" . $_POST[jml_kemasan][$i] . " WHERE id_kemasan='" . $_POST[id_kemasan][$i] . "'");
        //     $this->db->query("insert into `history_kemasan` (id_kemasan, masuk, ket, tgl) VALUES ('" . $_POST[id_kemasan][$i] . "','" . $_POST[jml_kemasan][$i] . "','$input[ket]', '$input[tgl]')");
        //     $this->db->query("INSERT INTO `detail_penjualan`(`nota`, `id_beras`, `id_kemasan`, `jml_kemasan`, `satuan_kemasan`, `volume`, `harga`, `nilai`) "
        //             . "VALUES ('$input[nota]','" . $_POST[id_beras][$i] . "','" . $_POST[id_kemasan][$i] . "','" . $_POST[jml_kemasan][$i] . "','" . $_POST[satuan_kemasan][$i] . "','" . $_POST[volume][$i] . "','" . $_POST[harga][$i] . "','" . $_POST[nilai][$i] . "')");
        // }
        // if ($nilai > $input['tunai']) {
        //     $saldo = $nilai - $input['tunai'];
        //     $this->db->query("UPDATE `konsumen` SET `saldo`=saldo-$saldo  WHERE id_konsumen='$input[id_konsumen]'");
        //     $this->db->insert("history_konsumen", array("id_konsumen" => $input['id_konsumen'], "debit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        // } elseif ($nilai < $input['tunai']) {
        //     $saldo = $input['tunai'] - $nilai;
        //     $this->db->query("UPDATE `konsumen` SET `saldo`=saldo+$saldo  WHERE id_konsumen='$input[id_konsumen]'");
        //     $this->db->insert("history_konsumen", array("id_konsumen" => $input['id_konsumen'], "kredit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        // }
        // $this->db->insert("kas", array("nota" => $input['nota'], "debit" => $input['tunai'], "tgl" => $input['tgl'], "ket" => $input['ket']));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function pembelian($input) {
        $input['nota']=date('ymdHis');
        $this->db->trans_start();
        $this->db->insert("pembelian", array(
            'tgl'=>$input['tgl'],
            'id_karyawan'=>$input['id_karyawan'],
            'ket'=>$input['ket'],
            'nota'=>$input['nota'],
        ));
        foreach($input['id_barang'] as $i=>$b){
            $nilai+=$input['harga'][$i]*$input['qty'][$i];
            $detail=array(
                'nota'=>$input['nota'],
                'id_barang'=>$b,
                'harga'=>$input['harga'][$i],
                'qty'=>$input['qty'][$i],
                'nilai'=>$input['qty'][$i]*$input['harga'][$i],
            );
            $this->db->insert('detail_pembelian',$detail);
            $this->db->query("UPDATE barang set stok = stok+".$input['qty'][$i]." WHERE id_barang='$b'");
        }
        $this->db->insert("kas", array("nota" => $input['nota'], "kredit" => $nilai, "tgl" => $input['tgl'], "ket" => $input['ket']));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function retur($input) {
        $input['nota']=date('ymdHis');
        $this->db->trans_start();
        $this->db->insert("retur", array(
            'tgl'=>$input['tgl'],
            'nota'=>$input['nota']
        ));
        foreach($input['id_barang'] as $i=>$b){
            $nilai+=$input['harga'][$i]*$input['qty'][$i];
            $detail=array(
                'nota'=>$input['nota'],
                'id_barang'=>$b,
                'id_customer'=>$input['id_customer'],
                'jml_retur'=>$input['qty'][$i],
				'harga' => $input['harga'][$i],
                'nilai'=>$input['qty'][$i]*$input['harga'][$i],
                'keterangan'=>$input['ket'][$i]
            );
            $this->db->insert('detail_retur',$detail);
            $this->db->query("UPDATE barang set stok = stok+".$input['qty'][$i]." WHERE id_barang='$b'");
        }
         $this->db->insert("kas", array("nota" => $input['nota'], "debit" => $nilai, "tgl" => $input['tgl'], "ket" => 'Lunas'));
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
        $this->db->query("UPDATE `pengaturan` SET `value`=ROUND(value+$hasil,2) WHERE id_pengaturan='1'");
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

    public function get_datapembelian($bulan, $tahun) {
       $query = $this->db->query("SELECT a.*, b.nilai as total, c.nama FROM pembelian a
                        JOIN detail_pembelian b
                        ON a.nota = b.nota
                        JOIN karyawan c
                        ON a.id_karyawan = c.id_karyawan
                        WHERE MONTH(a.tgl) = '".$bulan."' AND YEAR(a.tgl) = '".$tahun."'
                        GROUP BY a.nota DESC
                        ORDER BY a.nota DESC
                      ");
        return $query;
    }

    public function get_detailpembelian($nota) {

          $query = $this->db->query("SELECT a.*, b.nama, b.id FROM detail_pembelian a
                                 JOIN barang b
                                 ON a.id_barang = b.id_barang
                                 WHERE a.nota = '".$nota."'
                                 ORDER BY a.nota DESC
                               ");
            return $query;
    }

    public function get_datapenjualan($bulan, $tahun) {
       $query = $this->db->query("SELECT a.*, b.nilai as total, c.nama FROM penjualan a
                        JOIN detail_penjualan b
                        ON a.nota = b.nota
                        JOIN customer c
                        ON a.id_customer = c.id_customer
                        WHERE MONTH(a.tgl) = '".$bulan."' AND YEAR(a.tgl) = '".$tahun."'
                        GROUP BY a.nota DESC
                        ORDER BY a.nota DESC
                      ");
        return $query;
    }

    public function get_detailpenjualan($nota) {

          $query = $this->db->query("SELECT a.*, b.nama, b.id FROM detail_penjualan a
                                 JOIN barang b
                                 ON a.id_beras = b.id_barang
                                 WHERE a.nota = '".$nota."'
                                 ORDER BY a.nota DESC
                               ");
            return $query;
    }

    public function get_dataretur($bulan, $tahun) {
       $query = $this->db->query("SELECT a.*, b.nilai as total FROM retur a
                        JOIN detail_retur b
                        ON a.nota = b.nota
                        WHERE MONTH(tgl) = '".$bulan."' AND YEAR(tgl) = '".$tahun."'
                        GROUP BY a.nota DESC
                        ORDER BY a.id_retur DESC
                      ");
        return $query;
    }

    public function get_detailretur($nota) {

          $query = $this->db->query("SELECT a.*, b.nama, b.id, c.nama as nama_customer FROM detail_retur a
                                 JOIN barang b
                                 ON a.id_barang = b.id_barang
                                 JOIN customer c
                                 ON a.id_customer = c.id_customer
                                 WHERE a.nota = '".$nota."'
                                 ORDER BY a.nota DESC
                               ");
            return $query;
    }

    public function get_goodstok() {
        $query = $this->db->query("SELECT id_barang, nama as nama_barang, id, stok FROM barang");
        return $query->result_array();
    }

    public function get_badstok($kon, $id) {
        $query = $this->db->query("SELECT jml_retur, keterangan FROM detail_retur
                                   WHERE keterangan = '".$kon."' AND id_barang = '".$id."'
                                ");
        return $query->result_array();
    }

    // public function get_dataRincian() {
    //     $query = $this->db->query("SELECT nam FROM lala");
    //     return json_encode($query->result_array());
    //     // return $query->result_array();
    // }
    public function get_dataRincian($id, $bln) {
        // $query = $this->db->query("SELECT id_pembelian FROM pembelian");
        $query1 = $this->db->query("SELECT SUM(b.qty) as jml_brgmsk FROM pembelian a
                                   JOIN detail_pembelian b
                                   ON a.nota =  b.nota
                                   WHERE b.id_barang = '".$id."' AND MONTH(a.tgl) = '".$bln."'
                                ");

        $query2 = $this->db->query("SELECT SUM(b.jml_kemasan) as jml_brgklr FROM penjualan a
                                   JOIN detail_penjualan b
                                   ON a.nota =  b.nota
                                   WHERE b.id_beras = '".$id."' AND MONTH(a.tgl) = '".$bln."'
                                ");

        $query3 = $this->db->query("SELECT SUM(b.jml_retur) as jml_brgretur FROM retur a
                                   JOIN detail_retur b
                                   ON a.nota =  b.nota
                                   WHERE b.id_barang = '".$id."' AND MONTH(a.tgl) = '".$bln."'
                                ");

        // return $query->result_array();
        foreach ($query1->result_array() as $r1){
              $r1 = $r1['jml_brgmsk'];
        }
        foreach ($query2->result_array() as $r2){
              $r2 = $r2['jml_brgklr'];
        }
        foreach ($query3->result_array() as $r3){
              $r3 = $r3['jml_brgretur'];
        }
        $result = array('jml_brgmsk' => $r1 , 'jml_brgklr' => $r2, 'jml_brgretur' => $r3);
        return $result;
    }


    //codingan andre bhaskoro +6282333817317 =========================================================
    public function get_barang_by_id($id){
        $sql = "SELECT * FROM `barang` WHERE id_barang =".$id;
        $query = $this->db->query($sql);
        return $query->row();
    } 

    public function get_total_penjualan(){
        $sql = "SELECT SUM(detail_penjualan.nilai) as total FROM detail_penjualan 
                JOIN penjualan ON penjualan.nota = detail_penjualan.nota";
        $query = $this->db->query($sql);
        return $query->row();
    }  

    public function get_total_penjualan_bulan($bulan){
        $sql = "SELECT SUM(detail_penjualan.nilai) as total FROM detail_penjualan 
                JOIN penjualan ON penjualan.nota = detail_penjualan.nota
                WHERE MONTH(penjualan.tgl) = '".$bulan."'";
        $query = $this->db->query($sql);
        return $query->row();
    } 

    public function get_total_penjualan_tahun($tahun){
        $sql = "SELECT SUM(detail_penjualan.nilai) as total FROM detail_penjualan 
                JOIN penjualan ON penjualan.nota = detail_penjualan.nota
                WHERE YEAR(penjualan.tgl) = '".$tahun."'";
        $query = $this->db->query($sql);
        return $query->row();
    } 

    public function get_tahun_penjualan(){
        $sql = "SELECT DISTINCT YEAR(penjualan.tgl) as tahun FROM detail_penjualan 
                JOIN penjualan ON penjualan.nota = detail_penjualan.nota";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    //tutup codingan andre bhaskoro +6282333817317 ===================================================


}

?>
