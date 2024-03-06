<?php
// echo '<pre>';
// print_r($dataBrand);
// echo '</pre>';

?>



<!-- Ec Shop page -->
<section class="ec-page-content section-space-p">
    <form id="form-prod-category" method="post">
        <div class="container">
            <div class="row">
                <div class="ec-shop-rightside col-lg-9 col-md-12 order-lg-last order-md-first margin-b-30">
                    <!-- Shop Top Start -->
                    <div class="ec-pro-list-top d-flex">
                        <div class="col-md-6 ec-grid-list">
                            <div class="ec-gl-btn">
                                <button class="btn btn-grid active"><i class="fi-rr-apps"></i></button>
                                <button class="btn btn-list"><i class="fi-rr-list"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6 ec-sort-select">
                            <span class="sort-by">Xắp xếp theo</span>
                            <div class="ec-select-inner">
                                <select name="sort" id="ec-select" class="product-filter-select">
                                    <option selected disabled>Sắp xếp</option>
                                    <option value="-create_at">Mới nhất</option>
                                    <option value="-sold">Bán chạy nhất</option>
                                    <option value="price">Giá: Thấp đến cao</option>
                                    <option value="-price">Giá: Cao đến thấp</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->

                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div id="main-product-filter" class="row">
                                <?php
                                foreach ($dataProd as $dataProdItem) {
                                    $linkProduct =  'product/' . $dataProdItem['slug'] . '-' . $dataProdItem['id'];
                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="<?= $linkProduct ?>" class="image">
                                                        <img class="main-image" src="<?= $dataProdItem['thumb'] ?>" title="<?= $dataProdItem['title'] ?>" alt="<?= $dataProdItem['title'] ?>" />

                                                    </a>
                                                    <span class="flags">
                                                        <?php
                                                        if ($dataProdItem['discount'] != 0) :
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
                                                    <a href="<?= $linkProduct ?>"><?= $dataProdItem['title'] ?>
                                                    </a>
                                                </h5>
                                                <div class="ec-pro-rating">
                                                    <?= Format::renderStars($dataProdItem['totalRatings']) ?>

                                                </div>
                                                <div class="ec-pro-list-desc"><?= $dataProdItem['short_description'] ?></div>
                                                <span class="ec-price">

                                                    <?php
                                                    if ($dataProdItem['discount'] != 0) :
                                                    ?>
                                                        <span class="old-price"><?= Format::calculateOriginalPrice($dataProdItem['price'], $dataProdItem['discount']) ?></span>
                                                    <?php endif; ?>
                                                    <span class="new-price"><?= Format::formatCurrency($dataProdItem['price']) ?></span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <!-- Ec Pagination Start -->
                        <div class="ec-pro-pagination justify-content-center ">

                            <button onclick="learnMoreProductFilter()" type="button" class="btn btn-primary mt-2">Xem thêm</button>
                        </div>
                        <!-- Ec Pagination End -->
                    </div>
                    <!--Shop content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside col-lg-3 col-md-12 order-lg-first order-md-last">
                    <div id="shop_sidebar">
                        <div class="ec-sidebar-heading">
                            <h1>Lọc sản phẩm theo</h1>
                        </div>
                        <div class="ec-sidebar-wrap">
                            <!-- Sidebar Category Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Danh mục</h3>
                                </div>
                                <div class="ec-sb-block-content">

                                    <div class="ec-select-inner w-100 ">
                                        <select name="category" id="ec-select" class="w-100 product-filter-select">
                                            <option selected disabled>Chọn danh mục</option>
                                            <?php foreach ($dataCateList as $cateItem) : ?>
                                                <option value="<?= $cateItem['id'] ?>"><?= $cateItem['name'] ?></option>
                                            <?php endforeach ?>

                                        </select>
                                    </div>


                                </div>
                            </div>
                            <!-- Sidebar Size Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Thương hiệu</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <div class="ec-select-inner w-100 ">
                                        <select name="brand" id="ec-select " class="w-100 product-filter-select">
                                            <option selected disabled>Chọn thương hiệu</option>
                                            <?php foreach ($dataBrand as $brandItem) : ?>
                                                <option value="<?= $brandItem['id'] ?>"><?= $brandItem['name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $priceSelect = array(
                                ['title' => 'Dưới 2 triệu', 'value' => '0 - 2000000'],
                                ['title' => 'Từ 2 - 4 triệu', 'value' => '2000000 - 4000000'],
                                ['title' => 'Từ 4 - 7 triệu', 'value' => '4000000 - 7000000'],
                                ['title' => 'Từ 7 - 13 triệu', 'value' => '7000000 - 13000000'],
                                ['title' => 'Từ 13 - 20 triệu', 'value' => '13000000 - 20000000'],
                                ['title' => 'Từ 20 - 32 triệu', 'value' => '20000000 - 32000000'],
                                ['title' => 'Trên 32 triệu', 'value' => '32000000 - 8000000000'],
                            )
                            ?>
                            <!-- Sidebar Price Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Giá cả</h3>
                                </div>
                                <div class="ec-sb-block-content ">
                                    <div class="ec-select-inner w-100 ">
                                        <select name="price" id="ec-select " class="w-100 product-filter-select">
                                            <option selected disabled>Chọn khoảng giá</option>
                                            <?php foreach ($priceSelect as $priceSelectItem) : ?>
                                                <option value="<?= $priceSelectItem['value'] ?>"><?= $priceSelectItem['title'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input id="limit-product-filter" type="hidden" name="limit" value="12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- End Shop page -->