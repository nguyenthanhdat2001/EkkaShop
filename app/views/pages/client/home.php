    <!-- Category Sidebar start -->
    <div class="ec-side-cat-overlay"></div>
    <div class="col-lg-3 category-sidebar" data-animation="fadeIn">
        <div class="cat-sidebar">
            <div class="cat-sidebar-box">
                <div class="ec-sidebar-wrap">
                    <!-- Sidebar Category Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Danh mục<button class="ec-close">×</button></h3>
                        </div>
                        <?php
                        foreach ($dataCate as $cate) {

                        ?>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <a href="product-category?category=<?= $cate['id'] ?>" class="ms-0 ec-sidebar-block-item"><img src="<?= $cate['image'] ?>" class="svg_img " style="object-fit: contain; alt=" drink" /><?= $cate['name'] ?></a>

                                    </li>
                                </ul>
                            </div>
                        <?php } ?>

                    </div>
                    <!-- Sidebar Category Block -->
                </div>
            </div>
            <div class="ec-sidebar-slider-cat">
                <div class="ec-sb-slider-title">Sản phẩm bán chạy nhất</div>
                <div class="ec-sb-pro-sl">
                    <?php
                    foreach ($dataProdMostSold as $prodSold) {
                        $urlLink = "product/{$prodSold['slug']}-{$prodSold['id']}";
                    ?>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="<?= $urlLink ?>" style="width: 80px; height: 80px; background-color: #f7f7f7;" class="sidekka_pro_img d-flex rounded-2 "><img style="mix-blend-mode: darken; object-fit: contain; padding: 5px;" src="<?= $prodSold['thumb'] ?>" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="<?= $urlLink ?>"><?= $prodSold['title'] ?></a></h5>
                                    <div class="ec-pro-rating">
                                        <?= Format::renderStars($prodSold['totalRatings']) ?>
                                    </div>
                                    <span class="ec-price">
                                        <?php if ($prodSold['discount'] != 0) : ?>
                                            <span class="old-price"><?= Format::calculateOriginalPrice($prodSold['price'], $prodSold['discount']) ?></span>
                                        <?php endif ?>
                                        <span class="new-price"><?= Format::formatCurrency($prodSold['price']) ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Main Slider Start -->
    <div class="sticky-header-next-sec ec-main-slider section section-space-pb">
        <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
            <!-- Main slider -->
            <div class="swiper-wrapper">
                <?php
                foreach ($dataBanner as $dataBannerItem) {
                ?>
                    <div style="background-image: url('<?= $dataBannerItem['thumb'] ?>')" class="ec-slide-item swiper-slide d-flex ec-slide">
                        <div class="container align-self-center">
                            <div class="row">
                                <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                    <div class="ec-slide-content slider-animation">
                                        <h1 class="ec-slide-title"><?= $dataBannerItem['title'] ?></h1>
                                        <h4 class="ec-slide-stitle"><?= $dataBannerItem['name'] ?></h4>
                                        <p><?= $dataBannerItem['description'] ?></p>
                                        <a href="product-category" class="btn btn-lg btn-secondary">Xem ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p" id="collection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Bộ sưu tập hàng đầu của chúng tôi</h2>
                        <h2 class="ec-title">Bộ sưu tập hàng đầu của chúng tôi</h2>
                        <p class="sub-title">Duyệt qua Bộ sưu tập các sản phẩm hàng đầu</p>
                    </div>
                </div>

                <!-- Tab Start -->
                <div class="col-md-12 text-center">
                    <ul class="ec-pro-tab-nav nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-pro-for-all">Tất cả</a>
                        </li>
                        <!-- <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-for-men">Quần áo</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-for-women">Giày dép</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-for-child">Mũ nón</a></li> -->
                    </ul>
                </div>
                <!-- Tab End -->
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <!-- 1st Product tab start -->
                        <div class="tab-pane fade show active" id="tab-pro-for-all">
                            <div class="row">
                                <!-- New Product Content -->
                                <?php
                                foreach ($dataProdMostView as $dataProdMostViewItem) {
                                    $linkProduct = 'product/' . $dataProdMostViewItem['slug'] . '-' . $dataProdMostViewItem['id'];
                                ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="<?= $linkProduct ?>" class="image">
                                                        <img class="main-image" src="<?= $dataProdMostViewItem['thumb'] ?>" title="<?= $dataProdMostViewItem['title'] ?>" alt="<?= $dataProdMostViewItem['title'] ?>" />

                                                    </a>
                                                    <span class="flags">
                                                        <?php
                                                        if ($dataProdMostViewItem['discount'] != 0) :
                                                        ?>
                                                            <span class="sale">Sale</span>
                                                        <?php endif; ?>
                                                    </span>
                                                    <a href="<?= $linkProduct ?>" class="quickview">
                                                        <i class="fi-rr-eye"></i>
                                                    </a>
                                                    <div class="ec-pro-actions">
                                                        <!-- <a href="coming-soon" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                                                        <a href="<?= $linkProduct ?>" title="Add To Cart" class="add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                        <a href="<?= $linkProduct ?>" class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title">
                                                    <a href="<?= $linkProduct ?>"><?= $dataProdMostViewItem['title'] ?>
                                                    </a>
                                                </h5>
                                                <div class="ec-pro-rating">
                                                    <?= Format::renderStars($dataProdMostViewItem['totalRatings']) ?>

                                                </div>
                                                <span class="ec-price">

                                                    <?php
                                                    if ($dataProdMostViewItem['discount'] != 0) :
                                                    ?>
                                                        <span class="old-price"><?= Format::calculateOriginalPrice($dataProdMostViewItem['price'], $dataProdMostViewItem['discount']) ?></span>
                                                    <?php endif; ?>
                                                    <span class="new-price"><?= Format::formatCurrency($dataProdMostViewItem['price']) ?></span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-sm-12 shop-all-btn"><a href="product-category">Xem tất cả</a></div>
                            </div>
                        </div>
                        <!-- ec 1st Product tab end -->
                        <!-- ec 2nd Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-for-men">
                            <div class="row">
                                <!-- New Product Content -->
                                <?php
                                foreach ($dataProdClothes as $dataProdClothesItem) {
                                    $linkProduct = 'product/' . $dataProdClothesItem['slug'] . '-' . $dataProdClothesItem['id'];
                                ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="<?= $linkProduct ?>" class="image">
                                                        <img class="main-image" src="<?= $dataProdClothesItem['thumb'] ?>" title="<?= $dataProdClothesItem['title'] ?>" alt="<?= $dataProdClothesItem['title'] ?>" />

                                                    </a>
                                                    <span class="flags">
                                                        <?php
                                                        if ($dataProdClothesItem['discount'] != 0) :
                                                        ?>
                                                            <span class="sale">Sale</span>
                                                        <?php endif; ?>
                                                    </span>
                                                    <a href="<?= $linkProduct ?>" class="quickview">
                                                        <i class="fi-rr-eye"></i>
                                                    </a>
                                                    <div class="ec-pro-actions">
                                                        <a href="coming-soon" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                        <a href="<?= $linkProduct ?>" title="Add To Cart" class="add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                        <a href="<?= $linkProduct ?>" class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title">
                                                    <a href="<?= $linkProduct ?>"><?= $dataProdClothesItem['title'] ?>
                                                    </a>
                                                </h5>
                                                <div class="ec-pro-rating">
                                                    <?= Format::renderStars($dataProdClothesItem['totalRatings']) ?>

                                                </div>
                                                <span class="ec-price">

                                                    <?php
                                                    if ($dataProdClothesItem['discount'] != 0) :
                                                    ?>
                                                        <span class="old-price"><?= Format::calculateOriginalPrice($dataProdClothesItem['price'], $dataProdClothesItem['discount']) ?></span>
                                                    <?php endif; ?>
                                                    <span class="new-price"><?= Format::formatCurrency($dataProdClothesItem['price']) ?></span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <!-- ec 2nd Product tab end -->
                        <!-- ec 3rd Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-for-women">
                            <div class="row">
                                <!-- New Product Content -->
                                <?php
                                foreach ($dataProdShoe as $dataProdShoeItem) {
                                    $linkProduct = 'product/' . $dataProdShoeItem['slug'] . '-' . $dataProdShoeItem['id'];
                                ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="<?= $linkProduct ?>" class="image">
                                                        <img class="main-image" src="<?= $dataProdShoeItem['thumb'] ?>" title="<?= $dataProdShoeItem['title'] ?>" alt="<?= $dataProdShoeItem['title'] ?>" />

                                                    </a>
                                                    <span class="flags">
                                                        <?php
                                                        if ($dataProdShoeItem['discount'] != 0) :
                                                        ?>
                                                            <span class="sale">Sale</span>
                                                        <?php endif; ?>
                                                    </span>
                                                    <a href="<?= $linkProduct ?>" class="quickview">
                                                        <i class="fi-rr-eye"></i>
                                                    </a>
                                                    <div class="ec-pro-actions">
                                                        <a href="coming-soon" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                        <a href="<?= $linkProduct ?>" title="Add To Cart" class="add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                        <a href="<?= $linkProduct ?>" class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title">
                                                    <a href="<?= $linkProduct ?>"><?= $dataProdShoeItem['title'] ?>
                                                    </a>
                                                </h5>
                                                <div class="ec-pro-rating">
                                                    <?= Format::renderStars($dataProdShoeItem['totalRatings']) ?>

                                                </div>
                                                <span class="ec-price">

                                                    <?php
                                                    if ($dataProdShoeItem['discount'] != 0) :
                                                    ?>
                                                        <span class="old-price"><?= Format::calculateOriginalPrice($dataProdShoeItem['price'], $dataProdShoeItem['discount']) ?></span>
                                                    <?php endif; ?>
                                                    <span class="new-price"><?= Format::formatCurrency($dataProdShoeItem['price']) ?></span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <!-- ec 3rd Product tab end -->
                        <!-- ec 4th Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-for-child">
                            <div class="row">
                                <!-- New Product Content -->
                                <?php
                                foreach ($dataProdHat as $dataProdHatItem) {
                                    $linkProduct = 'product/' . $dataProdHatItem['slug'] . '-' . $dataProdHatItem['id'];
                                ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="<?= $linkProduct ?>" class="image">
                                                        <img class="main-image" src="<?= $dataProdHatItem['thumb'] ?>" title="<?= $dataProdHatItem['title'] ?>" alt="<?= $dataProdHatItem['title'] ?>" />

                                                    </a>
                                                    <span class="flags">
                                                        <?php
                                                        if ($dataProdHatItem['discount'] != 0) :
                                                        ?>
                                                            <span class="sale">Sale</span>
                                                        <?php endif; ?>
                                                    </span>
                                                    <a href="<?= $linkProduct ?>" class="quickview">
                                                        <i class="fi-rr-eye"></i>
                                                    </a>
                                                    <div class="ec-pro-actions">
                                                        <a href="coming-soon" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                        <a href="<?= $linkProduct ?>" title="Add To Cart" class="add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                        <a href="<?= $linkProduct ?>" class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title">
                                                    <a href="<?= $linkProduct ?>"><?= $dataProdHatItem['title'] ?>
                                                    </a>
                                                </h5>
                                                <div class="ec-pro-rating">
                                                    <?= Format::renderStars($dataProdHatItem['totalRatings']) ?>

                                                </div>
                                                <span class="ec-price">

                                                    <?php
                                                    if ($dataProdHatItem['discount'] != 0) :
                                                    ?>
                                                        <span class="old-price"><?= Format::calculateOriginalPrice($dataProdHatItem['price'], $dataProdHatItem['discount']) ?></span>
                                                    <?php endif; ?>
                                                    <span class="new-price"><?= Format::formatCurrency($dataProdHatItem['price']) ?></span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <!-- ec 4th Product tab end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->

    <!-- ec Banner Section Start -->
    <section class="ec-banner section section-space-p">
        <h2 class="d-none">Banner</h2>
        <div class="container">
            <!-- ec Banners Start -->
            <div class="ec-banner-inner">
                <!--ec Banner Start -->
                <div class="ec-banner-block ec-banner-block-2">
                    <div class="row">
                        <div class="banner-block col-lg-6 col-md-12 margin-b-30" data-animation="slideInRight">
                            <div class="bnr-overlay">
                                <img src="https://res.cloudinary.com/dvysn6zdt/image/upload/v1705501373/upload_ecommerce/e2ng2yxj2svihotaguo5.webp" alt="" />
                                <div class="banner-text">
                                   <!-- <span class="ec-banner-stitle">Hàng mới đến</span>
                                    <span class="ec-banner-title">nam<br> Giày thể thao</span>
                                    <span class="ec-banner-discount">Giảm giá 30%</span> -->
                                </div>
                                <div class="banner-content">
                                    <span class="ec-banner-btn"><a href="product-category">Xem ngay</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="banner-block col-lg-6 col-md-12" data-animation="slideInLeft">
                            <div class="bnr-overlay">
                                <img src="https://res.cloudinary.com/dvysn6zdt/image/upload/v1705501625/upload_ecommerce/tbyfyfflkdzcfz8s8jjo.jpg" alt="" />
                                <div class="banner-text">
                                    <!-- <span class="ec-banner-stitle">Xu hướng mới</span>
                                    <span class="ec-banner-title">Đồng hồ thông minh<br></span>
                                    <span class="ec-banner-discount">Mua 3 mặt hàng bất kỳ và được <br>Giảm giá 20%</span> -->
                                </div>
                                <div class="banner-content">
                                    <span class="ec-banner-btn"><a href="product-category">Xem ngay</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ec Banner End -->
                </div>
                <!-- ec Banners End -->
            </div>
        </div>
    </section>
    <!-- ec Banner Section End -->

    <!--  Category Section Start -->
    <section class="section ec-category-section section-space-p" id="categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Bộ sưu tập hàng đầu của chúng tôi</h2>
                        <h2 class="ec-title">Danh mục hàng đầu</h2>
                        <p class="sub-title">Duyệt qua Bộ sưu tập các danh mục hàng đầu</p>
                    </div>
                </div>
            </div>


            <div class="row">
                <?php
                foreach ($dataCateCount as $dataCateCountItem) {
                ?>
                    <div class="col-lg-3 mb-3 ">
                        <div class="ec-cat-tab-nav nav">
                            <li class="cat-item">
                                <a class="cat-link" href="product-category?category=<?= $dataCateCountItem['id'] ?>">
                                    <div class="cat-icons">
                                        <img class="cat-icon" style="width: 50px; object-fit: contain; mix-blend-mode: darken;" src="<?= $dataCateCountItem['image'] ?>" alt="<?= $dataCateCountItem['name'] ?>">
                                    </div>
                                    <div class="cat-desc"><span><?= $dataCateCountItem['name'] ?></span><span><?= $dataCateCountItem['product_count'] ?> Sản phẩm</span></div>
                                </a>
                            </li>
                        </div>
                    </div>
                <?php } ?>


                <!-- <div class="col-lg-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-cat-1">
                            <div class="row">
                                <img src="public/client/images/cat-banner/1.jpg" alt="" />
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">Xem tất cả</a>
                            </span>
                        </div>
                        <div class="tab-pane fade" id="tab-cat-2">
                            <div class="row">
                                <img src="public/client/images/cat-banner/2.jpg" alt="" />
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">Xem tất cả</a>
                            </span>
                        </div>

                        <div class="tab-pane fade" id="tab-cat-3">
                            <div class="row">
                                <img src="public/client/images/cat-banner/3.jpg" alt="" />
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">Xem tất cả</a>
                            </span>
                        </div>

                        <div class="tab-pane fade" id="tab-cat-4">
                            <div class="row">
                                <img src="public/client/images/cat-banner/4.jpg" alt="" />
                            </div>
                            <span class="panel-overlay">
                                <a href="shop-left-sidebar-col-3.html" class="btn btn-primary">Xem tất cả</a>
                            </span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- Category Section End -->

    <!--  services Section Start -->
    <section class="section ec-services-section section-space-p" id="services">
        <h2 class="d-none">Dịch vụ</h2>
        <div class="container">
            <div class="row">
                <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-truck-moving"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Giao hàng miễn phí</h2>
                            <p>Miễn phí vận chuyển cho tất cả đơn hàng trên toàn quốc</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-hand-holding-seeding"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Hỗ trợ 24X7</h2>
                            <p>Liên hệ với chúng tôi 24 giờ một ngày, 7 ngày một tuần</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-badge-percent"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Trả lại 30 ngày</h2>
                            <p>Chỉ cần trả lại trong vòng 30 ngày để đổi hàng</p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_4 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-ts-donate"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Thanh toán an toàn</h2>
                            <p>Liên hệ với chúng tôi 24 giờ một ngày, 7 ngày một tuần</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--services Section End -->

    <!--  offer Section Start -->
    <section class="section ec-offer-section section-space-p section-space-m">
        <h2 class="d-none">Ưu đãi</h2>
       <!-- <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center ec-offer-content">
                    <h2 class="ec-offer-title">Kính râm</h2>
                    <h3 class="ec-offer-stitle" data-animation="slideInDown">Siêu ưu đãi</h3>
                    <span class="ec-offer-img" data-animation="zoomIn"><img src="public/client/images/offer-image/1.png" alt="offer image" /></span>
                    <span class="ec-offer-desc">Kính râm gọng Acetate</span>
                    <span class="ec-offer-price">Chỉ $40,00</span>
                    <a class="btn btn-primary" href="product-category" data-animation="zoomIn">Mua ngay</a>
                </div>
            </div>
        </div> -->
    </section>
    <!-- offer Section End -->

    <!-- New Product Start -->
    <section class="section ec-new-product section-space-p" id="arrivals">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Hàng mới đến</h2>
                        <h2 class="ec-title">Hàng mới đến</h2>
                        <p class="sub-title">Duyệt qua Bộ sưu tập các sản phẩm hàng đầu</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- New Product Content -->
                <?php
                foreach ($dataProdNewDate as $dataProdNewDateItem) {
                    $linkProduct = 'product/' . $dataProdNewDateItem['slug'] . '-' . $dataProdNewDateItem['id'];
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                        <div class="ec-product-inner">
                            <div class="ec-pro-image-outer">
                                <div class="ec-pro-image">
                                    <a href="<?= $linkProduct ?>" class="image">
                                        <img class="main-image" src="<?= $dataProdNewDateItem['thumb'] ?>" title="<?= $dataProdNewDateItem['title'] ?>" alt="<?= $dataProdNewDateItem['title'] ?>" />

                                    </a>
                                    <span class="flags">
                                        <?php
                                        if ($dataProdNewDateItem['discount'] != 0) :
                                        ?>
                                            <span class="sale">Sale</span>
                                        <?php endif; ?>
                                    </span>
                                    <a href="<?= $linkProduct ?>" class="quickview">
                                        <i class="fi-rr-eye"></i>
                                    </a>
                                    <div class="ec-pro-actions">
                                        <a href="coming-soon" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                        <a href="<?= $linkProduct ?>" title="Add To Cart" class="add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                        <a href="<?= $linkProduct ?>" class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="ec-pro-content">
                                <h5 class="ec-pro-title">
                                    <a href="<?= $linkProduct ?>"><?= $dataProdNewDateItem['title'] ?>
                                    </a>
                                </h5>
                                <div class="ec-pro-rating">
                                    <?= Format::renderStars($dataProdNewDateItem['totalRatings']) ?>

                                </div>
                                <span class="ec-price">

                                    <?php
                                    if ($dataProdNewDateItem['discount'] != 0) :
                                    ?>
                                        <span class="old-price"><?= Format::calculateOriginalPrice($dataProdNewDateItem['price'], $dataProdNewDateItem['discount']) ?></span>
                                    <?php endif; ?>
                                    <span class="new-price"><?= Format::formatCurrency($dataProdNewDateItem['price']) ?></span>
                                </span>

                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- New Product end -->



    <!-- Ec Brand Section Start -->
    <section class="section ec-brand-area section-space-p">
        <h2 class="d-none">Thương hiệu</h2>
        <div class="container">
            <div class="row">
                <div class="ec-brand-outer">
                    <ul id="ec-brand-slider">
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/1.png" /></a></div>
                        </li>
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/2.png" /></a></div>
                        </li>
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/3.png" /></a></div>
                        </li>
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/4.png" /></a></div>
                        </li>
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/5.png" /></a></div>
                        </li>
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/6.png" /></a></div>
                        </li>
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/7.png" /></a></div>
                        </li>
                        <li class="ec-brand-item" data-animation="zoomIn">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="brand" src="public/client/images/brand-image/8.png" /></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Ec Brand Section End -->

    <!-- Ec Instagram Start -->
    <section class="section ec-instagram-section module section-space-p" id="insta">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Nguồn cấp dữ liệu Instagram</h2>
                        <h2 class="ec-title">Nguồn cấp dữ liệu Instagram</h2>
                        <p class="sub-title">Chia sẻ cửa hàng của bạn với chúng tôi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ec-insta-wrapper">
            <div class="ec-insta-outer">
                <div class="container" data-animation="fadeIn">
                    <div class="insta-auto">
                        <!-- instagram item -->
                        <div class="ec-insta-item">
                            <div class="ec-insta-inner">
                                <a href="#" target="_blank"><img src="public/client/images/instragram-image/1.jpg" alt="insta"></a>
                            </div>
                        </div>
                        <!-- instagram item -->
                        <div class="ec-insta-item">
                            <div class="ec-insta-inner">
                                <a href="#" target="_blank"><img src="public/client/images/instragram-image/2.jpg" alt="insta"></a>
                            </div>
                        </div>
                        <!-- instagram item -->
                        <div class="ec-insta-item">
                            <div class="ec-insta-inner">
                                <a href="#" target="_blank"><img src="public/client/images/instragram-image/3.jpg" alt="insta"></a>
                            </div>
                        </div>
                        <!-- instagram item -->
                        <div class="ec-insta-item">
                            <div class="ec-insta-inner">
                                <a href="#" target="_blank"><img src="public/client/images/instragram-image/4.jpg" alt="insta"></a>
                            </div>
                        </div>
                        <!-- instagram item -->
                        <!-- instagram item -->
                        <div class="ec-insta-item">
                            <div class="ec-insta-inner">
                                <a href="#" target="_blank"><img src="public/client/images/instragram-image/5.jpg" alt="insta"></a>
                            </div>
                        </div>
                        <!-- instagram item -->
                        <!-- instagram item -->
                        <div class="ec-insta-item">
                            <div class="ec-insta-inner">
                                <a href="#" target="_blank"><img src="public/client/images/instragram-image/6.jpg" alt="insta"></a>
                            </div>
                        </div>
                        <!-- instagram item -->
                        <!-- instagram item -->
                        <div class="ec-insta-item">
                            <div class="ec-insta-inner">
                                <a href="#" target="_blank"><img src="public/client/images/instragram-image/7.jpg" alt="insta"></a>
                            </div>
                        </div>
                        <!-- instagram item -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ec Instagram End -->



    <!-- Modal -->
    <!-- <div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_3.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_4.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_5.jpg" alt="">
                                </div>
                            </div>
                            <div class="qty-nav-thumb">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_3.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_4.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="public/client/images/product-image/3_5.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product-left-sidebar.html">Handbag leather purse for
                                        women</a>
                                </h5>
                                <div class="ec-quickview-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>

                                <div class="ec-quickview-desc">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s,</div>
                                <div class="ec-quickview-price">
                                    <span class="old-price">$100.00</span>
                                    <span class="new-price">$80.00</span>
                                </div>

                                <div class="ec-pro-variation">
                                    <div class="ec-pro-variation-inner ec-pro-variation-color">
                                        <span>Color</span>
                                        <div class="ec-pro-color">
                                            <ul class="ec-opt-swatch">
                                                <li><span style="background-color:#ebbf60;"></span></li>
                                                <li><span style="background-color:#75e3ff;"></span></li>
                                                <li><span style="background-color:#11f7d8;"></span></li>
                                                <li><span style="background-color:#acff7c;"></span></li>
                                                <li><span style="background-color:#e996fa;"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ec-pro-variation-inner ec-pro-variation-size ec-pro-size">
                                        <span>Size</span>
                                        <div class="ec-pro-variation-content">
                                            <ul class="ec-opt-size">
                                                <li class="active"><a href="#" class="ec-opt-sz" data-tooltip="Small">S</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Medium">M</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Large">X</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Extra Large">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                        <button class="btn btn-primary"><i class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Modal end -->