<aside class="menu-sidebar2">
    <div class="logo">
        <a href="?page">
            <img src="assets/img/icon/logo.png" alt="logo" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="img/<?= $auth['foto_user'] ?>" alt="user-image" class="image-sid" />
            </div>
            <h4 class="name"><?= $auth['nama_user']; ?></h4>
            <span><?= $auth['level']; ?></span>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li><a href="?page"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                <?php if ($_SESSION['level'] == "Admin") : ?>
                    <li><a href="?page=data-supplier"><i class="fas fa-list"></i>Kelola Data Supplier</a></li>
                    <li><a href="?page=data-layout"><i class="fas fa-sliders"></i>Kelola Data Layout</a></li>
                    <li><a href="?page=data-satuan"><i class="fas fa-barcode"></i>Kelola Data Satuan</a></li>
                    <li><a href="?page=data-barang-masuk"><i class="fas fa-arrow-left"></i>Kelola Barang Masuk</a></li>
                    <li><a href="?page=data-barang-rijek"><i class="fas fa-trash"></i>Kelola Barang Rijek</a></li>
                    <li><a href="?page=data-barang-keluar"><i class="fas fa-arrow-right"></i>Kelola Barang Keluar</a></li>i>
                <?php elseif ($_SESSION['level'] == "Checker") : ?>
                    <li><a href="?page=data-barang-masuk"><i class="fas fa-arrow-left"></i>Data Barang Masuk</a></li>
                    <li><a href="?page=data-barang-rijek"><i class="fas fa-arrow-right"></i>Data Barang Rijek</a></li>
                <?php elseif ($_SESSION['level'] == "Manager") : ?>
                    <li><a href="?page=data-user"><i class="fas fa-users"></i>Kelola Data User</a></li>
                    <li><a href="?page=data-barang-masuk"><i class="fas fa-arrow-left"></i>Laporan Barang Masuk</a></li>
                    <li><a href="?page=data-barang-rijek"><i class="fa fa-trash"></i>Laporan Barang Rijek</a></li>
                    <li><a href="?page=data-barang-periode"><i class="fas fa-calendar"></i>Laporan Barang Periode</a></li>
                    <li><a href="?page=data-barang-habis"><i class="fas fa-code"></i>Laporan Barang Habis</a></li>
                    <li><a href="?page=data-barang-keluar"><i class="fas fa-arrow-right"></i>Laporan Barang Keluar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>