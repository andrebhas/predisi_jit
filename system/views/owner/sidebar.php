<ul class="nav nav-list">
    <li class="<?= $home ?>">
        <a href="<?= base_url() . $level ?>">
            <i class="icon-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="<?= $master ?>">
        <a href="#" class="dropdown-toggle">
            <i class="icon-file"></i>
            <span>Data Master</span>
            <b class="arrow icon-angle-right"></b>
        </a>
        <ul class="submenu">
            <li class="<?= $csr ?>"><a href="<?= base_url() . $level ?>/customer">Customer</a></li>
            <li class="<?= $kry ?>"><a href="<?= base_url() . $level ?>/karyawan">Karyawan</a></li>
        </ul>
    </li>
    <li class="<?= $barang ?>">
        <a href="<?= base_url() . $level ?>/barang">
            <i class="icon-wrench"></i>
            <span>Data Barang</span>
        </a>
    </li>
    <li class="<?= $barang_masuk ?>">
        <a href="#" class="dropdown-toggle">
            <i class="icon-cogs"></i>
            <span>Barang Masuk</span>
            <b class="arrow icon-angle-right"></b>
        </a>
        <ul class="submenu">
            <li class="<?= $rbrg_masuk ?>"><a href="<?= base_url() . $level ?>/rbrg_masuk">Data Barang Masuk</a></li>
        </ul>
    </li>
    <li class="<?= $barang_keluar ?>">
        <a href="#" class="dropdown-toggle">
            <i class="icon-exchange"></i>
            <span>Barang Keluar</span>
            <b class="arrow icon-angle-right"></b>
        </a>
        <ul class="submenu">
            <li class="<?= $rbrg_keluar ?>"><a href="<?= base_url() . $level ?>/rbrg_keluar">Data Barang Keluar</a></li>
        </ul>
    </li>

    <li class="<?= $retur ?>">
        <a href="#" class="dropdown-toggle">
            <i class="icon-truck"></i>
            <span>Retur</span>
            <b class="arrow icon-angle-right"></b>
        </a>
        <ul class="submenu">
            <li class="<?= $rbrg_retur ?>"><a href="<?= base_url() . $level ?>/list_brgretur">Data Retur</a></li>
            <li class="<?= $kondisi_stokbrg ?>"><a href="<?= base_url() . $level ?>/kondisi_stokbrg">Kondisi Stok Barang</a></li>
        </ul>
    </li>
        
    </li>
</ul>
