<?php
$icons = [['Dashboard' => ['/img/admin/icons/dashboard.svg', 'admin']]];
$data_ctm = [
    ["Semua Customer" => "admin/customer"],
    ["Customer Aktif" => "admin/customer/aktif"],
    ["Customer Tidak Aktif" => "admin/customer/tidak-aktif"],
];
$pembayaran = [
    ['Belum Bayar' => 'admin/belum-bayar'],
    ['Sudah Bayar' => 'admin/sudah-bayar']
];

$kategories = [
    ['Semua Kategori' => 'admin/all-kategori'],
    ['Kategori Kiloan' => 'admin/kategori/kiloan'],
    ['Kategori Satuan' => 'admin/kategori/satuan'],
    ['Kategori Express' => 'admin/kategori/express']
]
?>
<div class="sidebar-admin" id="sidebar-admin">
    <div class="list-items-admin">
        <?php foreach ($icons as $icon) : ?>
            <?php foreach ($icon as $k => $v) : ?>
                <?php
                $requestUri = $_SERVER['REQUEST_URI'];
                $url = rtrim(ltrim($requestUri, '/'), '/');
                // $url = rtrim($_SERVER['QUERY_STRING'], "/");
                ?>
                <div class="icons">
                    <a href="<?= BASEURL . "/" . $v[1] ?>" class="<?= $url === $v[1] ? 'active' : "" ?>">
                        <img src="<?= BASEURL . $v[0] ?>" alt="icon" width="25">
                        <?= $k ?>
                    </a>
                </div>
            <?php endforeach ?>
        <?php endforeach ?>

        <!-- Data Customer -->
        <div class="dropdown" id="dropdown-sidebar">
            <a class="button-dropdown-item" type="button" style="font-size: 14.5px;">
                <!-- ['Data Customer' => ['/img/admin/icons/customer.svg', 'admin/customer'] -->
                <img src="<?= BASEURL ?>/img/admin/icons/customer.svg" alt="" width="25">
                Data Customer
                <i class="fas fa-chevron-right"></i>
            </a>
            <div class="item-dropdown-menu">
                <?php foreach ($data_ctm as $ctm) : ?>
                    <?php foreach ($ctm as $k => $v) : ?>
                        <?php
                        $requestUri = $_SERVER['REQUEST_URI'];
                        $url = rtrim(ltrim($requestUri, '/'), '/');
                        ?>
                        <a class="<?= $url === $v ? 'active' : "" ?>" href="<?= BASEURL . "/" . $v ?>"><?= $k ?></a>
                    <?php endforeach ?>
                <?php endforeach ?>
            </div>
        </div>
        <!-- Data Pesanan -->
        <div class="icons">
            <?php
            $requestUri = $_SERVER['REQUEST_URI'];
            $url = rtrim(ltrim($requestUri, '/'), '/');
            ?>
            <a href="<?= BASEURL . "/" . "admin/pemesanan" ?>" class="<?= $url === "admin/pemesanan" ? 'active' : "" ?>">
                <img src="<?= BASEURL ?>/img/admin/icons/troli.svg" alt="" width="25">
                Data Pesanan
            </a>
        </div>
        <!-- Kategori -->
        <div class="dropdown" id="dropdown-sidebar">
            <a class="button-dropdown-item-kategori" type="button" style="font-size: 14.5px;">
                <!-- ['Data Customer' => ['/img/admin/icons/customer.svg', 'admin/customer'] -->
                <img src="<?= BASEURL ?>/img/admin/icons/kategori.svg" alt="" width="25">
                Kategori Pesan
                <i class="fas fa-chevron-right"></i>
            </a>
            <div class="item-dropdown-menu-kategori">
                <?php foreach ($kategories as $kategori) { ?>
                    <?php foreach ($kategori as $k => $v) { ?>
                        <?php
                        $requestUri = $_SERVER['REQUEST_URI'];
                        $url = rtrim(ltrim($requestUri, '/'), '/');
                        ?>
                        <a class="<?= $url === $v ? 'active' : "" ?>" href="<?= BASEURL . "/" . $v ?>"><?= $k ?></a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <!-- Pembayaran -->
        <div class="dropdown" id="dropdown-sidebar">
            <a class="button-dropdown-item-pembayaran" type="button" style="font-size: 14.5px;">
                <!-- ['Data Customer' => ['/img/admin/icons/customer.svg', 'admin/customer'] -->
                <img src="<?= BASEURL ?>/img/admin/icons/pembayaran.svg" alt="" width="25">
                Pembayaran
                <i class="fas fa-chevron-right"></i>
            </a>
            <div class="item-dropdown-menu-pembayaran">
                <?php foreach ($pembayaran as $bayar) { ?>
                    <?php foreach ($bayar as $k => $v) { ?>
                        <?php
                        $requestUri = $_SERVER['REQUEST_URI'];
                        $url = rtrim(ltrim($requestUri, '/'), '/');
                        ?>
                        <a class="<?= $url === $v ? 'active' : "" ?>" href="<?= BASEURL . "/" . $v ?>"><?= $k ?></a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>