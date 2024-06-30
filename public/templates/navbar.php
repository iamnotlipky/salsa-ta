<header class="header-desktop2 print-sid">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <span class="span-sid">PT SID Cab. Tegal</span>
                </div>
                <div class="header-button2">
                    <!-- <div class="header-button-item has-noti js-item-menu">
                        <i class="zmdi zmdi-notifications"></i>
                        <div class="notifi-dropdown js-dropdown">
                            <div class="notifi__title">
                                <p>You have 3 Notifications</p>
                            </div>
                            <div class="notifi__item">
                                <div class="bg-c1 img-cir img-40">
                                    <i class="zmdi zmdi-email-open"></i>
                                </div>
                                <div class="content">
                                    <p>You got a email notification</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div>
                            <div class="notifi__item">
                                <div class="bg-c2 img-cir img-40">
                                    <i class="zmdi zmdi-account-box"></i>
                                </div>
                                <div class="content">
                                    <p>Your account has been blocked</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div>
                            <div class="notifi__item">
                                <div class="bg-c3 img-cir img-40">
                                    <i class="zmdi zmdi-file-text"></i>
                                </div>
                                <div class="content">
                                    <p>You got a new file</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div>
                            <div class="notifi__footer">
                                <a href="#">All notifications</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="header-button-item mr-0 js-sidebar-btn">
                        <i class="zmdi zmdi-menu"></i>
                    </div>
                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="?page=profile-setting">
                                    <i class="zmdi zmdi-account"></i>Profil</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="?logout" id="forLogout">
                                    <i class="zmdi zmdi-power"></i>Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
    <div class="logo">
        <a href="?page">
            <img src="assets/img/icon/logo.png" alt="logo" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar2">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="img/<?= $auth['foto_user'] ?>" alt="user-image" class="image-sid" />
            </div>
            <h4 class="name"><?= $auth['nama_user'] ?></h4>
            <span><?= $auth['level'] ?></span>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li><a href="?page"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                <?php if ($_SESSION['level'] == "Admin") : ?>
                    <li><a href="?page=data-supplier"><i class="fas fa-list"></i>Kelola Data Supplier</a></li>
                    <li><a href="?page=data-layout"><i class="fas fa-barcode"></i>Kelola Data Layout</a></li>
                    <li><a href="?page=data-satuan"><i class="fas fa-barcode"></i>Kelola Data Satuan</a></li>
                    <li><a href="?page=data-barang-masuk"><i class="fas fa-arrow-left"></i>Kelola Barang Masuk</a></li>
                    <li><a href="?page=data-barang-keluar"><i class="fas fa-arrow-right"></i>Kelola Barang Keluar</a></li>
                <?php elseif ($_SESSION['level'] == "Checker") : ?>
                    <li><a href="?page=data-barang-masuk"><i class="fas fa-arrow-left"></i>Data Barang Masuk</a></li>
                    <li><a href="?page=data-barang-rijek"><i class="fas fa-arrow-right"></i>Data Barang Rijek</a></li>
                <?php elseif ($_SESSION['level'] == "Manager") : ?>
                    <li><a href="?page=data-user"><i class="fas fa-users"></i>Kelola Data User</a></li>
                    <li><a href="?page=data-barang-masuk"><i class="fas fa-arrow-left"></i>Laporan Barang Masuk</a></li>
                    <li><a href="?page=data-barang-keluar"><i class="fas fa-arrow-right"></i>Laporan Barang Keluar</a></li>
                <?php endif; ?>
                <li><a href="?page=profile-setting"><i class="fas fa-user"></i>Profil</a></li>
                <li><a href="?logout" id="forLogout"><i class="fas fa-power-off"></i>Keluar</a></li>
            </ul>
        </nav>
    </div>
</aside>