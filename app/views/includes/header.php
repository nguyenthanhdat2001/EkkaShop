<?php

$menus = array(
    [
        'name' => 'Trang chủ',
        'path' => 'home'
    ],
    [
        'name' => 'Sản phẩm',
        'path' => 'product'
    ],
    [
        'name' => 'Tin Tức',
        'path' => 'news'
    ],
    [
        'name' => 'Liên hệ',
        'path' => 'contact'
    ],
    [
        'name' => 'Ưu đãi',
        'path' => 'coupon'
    ],
);

?>

<!-- Header start  -->
<header class="ec-header">
    <!--Ec Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top social Start -->
                <div class="col text-left header-top-left d-none d-lg-block">
                    <div class="header-top-social">
                        <span class="social-text text-upper">Theo dõi chúng tôi trên:</span>
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="#"><i class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="#"><i class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="#"><i class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top social End -->

                <!-- Header Top Message Start -->
                <div class="col text-center header-top-center">
                    <div class="header-top-message text-upper">
                        <span>Giao hàng miễn phí đơn hàng trên toàn quốc</span>
                    </div>
                </div>


                <!-- responsive -->
                <div class="col d-lg-none ">
                    <div class="ec-header-bottons">
                        <!-- Header User Start -->
                        <div class="ec-header-user dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <?php
                                if (isset($userData) && !empty($userData)) :
                                ?>
                                    <li><a class="dropdown-item" href="my-account">Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="contact">Hỗ trợ</a></li>
                                    <li><a class="dropdown-item" href="logout">Đăng xuất</a></li>
                                <?php else : ?>
                                    <li><a class="dropdown-item" href="contact">Hỗ trợ</a></li>
                                    <li><a class="dropdown-item" href="signup">Đăng ký</a></li>
                                    <li><a class="dropdown-item" href="login">Đăng nhập</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <!-- Header User End -->
                        <!-- Header Cart Start -->
                        <a href="wishlist" class="ec-header-btn ec-header-wishlist">
                            <div class="header-icon"><i class="fi-rr-heart"></i></div>
                            <span class="ec-header-count">0</span>
                        </a>
                        <!-- Header Cart End -->
                        <!-- Header Cart Start -->
                        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                            <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
                            <span class="ec-header-count cart-count-lable">0</span>
                        </a>
                        <!-- Header Cart End -->
                        <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                            <i class="fi fi-rr-apps"></i>
                        </a>
                        <!-- Header menu Start -->
                        <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                            <i class="fi fi-rr-menu-burger"></i>
                        </a>
                        <!-- Header menu End -->
                    </div>
                </div>
                <!-- Header Top responsive Action -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center">
                        <div class="header-logo">
                            <a href="home"><img style="height: 70px; object-fit: contain;" src="<?= $dataStoreCustom['logo'] ?>" alt="Site Logo" /><img class="dark-logo" src="<?= $dataStoreCustom['logo'] ?>" alt="Site Logo" style="display: none;" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center">
                        <div class="header-search">
                            <form class="ec-btn-group-form" action="product-category" method="get">
                                <input name="search" class="form-control ec-search-bar" placeholder="Tìm kiếm sản phẩm" type="text">
                                <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center">
                        <div class="ec-header-bottons">

                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <?php
                                    if (isset($userData) && !empty($userData)) :
                                    ?>
                                        <li><a class="dropdown-item" href="account">Tài khoản</a></li>
                                        <li><a class="dropdown-item" href="contact">Hỗ trợ</a></li>
                                        <li><a class="dropdown-item" href="logout">Đăng xuất</a></li>
                                    <?php else : ?>
                                        <li><a class="dropdown-item" href="contact">Hỗ trợ</a></li>
                                        <li><a class="dropdown-item" href="signup">Đăng ký</a></li>
                                        <li><a class="dropdown-item" href="login">Đăng nhập</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header wishlist Start -->
                            <a href="wishlist" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon"><i class="fi-rr-heart"></i></div>
                                <span id="wishlist-quantity" class="ec-header-count">0</span>
                            </a>
                            <!-- Header wishlist End -->
                            <!-- Header Cart Start -->
                            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
                                <span id="shopping-cart-quantity" class="ec-header-count cart-count-lable">0</span>
                            </a>
                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">

                <!-- Ec Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="index.html"><img src="<?= $dataStoreCustom['logo'] ?>" alt="Site Logo" /><img class="dark-logo" src="<?= $dataStoreCustom['logo'] ?>" alt="Site Logo" style="display: none;" /></a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->
                <!-- Ec Header Search Start -->
                <div class="col">
                    <div class="header-search">
                        <form class="ec-btn-group-form" action="#">
                            <input class="form-control ec-search-bar" placeholder="Tìm kiếm sản phẩm" type="text">
                            <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="ec-main-menu">
                        <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                            <i class="fi fi-rr-apps"></i>
                        </a>
                        <ul>
                            <?php
                            foreach ($menus as $menu) {
                                $activeNav = $currentPath == $menu['path'] ? 'active' : '';
                            ?>
                                <li class="<?= $activeNav ?>"><a href="<?= $menu['path'] ?>"><?= $menu['name'] ?></a></li>
                            <?php } ?>


                            <li class="dropdown scroll-to"><a href="javascript:void(0)"><i class="fi fi-rr-sort-amount-down-alt"></i></a>
                                <ul class="sub-menu">
                                    <li class="menu_title">Cuộn nhanh đến phần</li>
                                    <li><a href="javascript:void(0)" data-scroll="collection" class="nav-scroll">Bộ sưu tập</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="categories" class="nav-scroll">Danh mục</a></li>

                                    <li><a href="javascript:void(0)" data-scroll="services" class="nav-scroll">Dịch vụ</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="arrivals" class="nav-scroll">Sản phẩm mới</a></li>

                                    <li><a href="javascript:void(0)" data-scroll="insta" class="nav-scroll">Instagram Feed</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- ekka Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">Thực đơn của tôi</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <?php
                    foreach ($menus as $menu) {
                        $activeNav = $currentPath == $menu['path'] ? 'active' : '';
                    ?>
                        <li class="<?= $activeNav ?>"><a href="index.html"><?= $menu['name'] ?></a></li>
                    <?php } ?>


                </ul>
            </div>
            <div class="header-res-lan-curr">
                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="#"><i class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="#"><i class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="#"><i class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
    <!-- ekka mobile Menu End -->
</header>
<!-- Header End  -->

<?php include 'cart.php' ?>