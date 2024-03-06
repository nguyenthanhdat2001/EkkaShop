   <!-- Sart Single product -->
   <?php
    // echo '<pre>';
    // print_r($dataProd);
    // echo '</pre>';
    ?>
   <section class="ec-page-content section-space-p">
       <div class="container">
           <div class="row">
               <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                   <!-- Single product content Start -->
                   <div class="single-pro-block">
                       <div class="single-pro-inner">
                           <div class="row">
                               <div class="single-pro-img single-pro-img-no-sidebar">
                                   <div class="single-product-scroll">
                                       <div class="single-product-cover">
                                           <?php foreach ($dataImageProd as $thumbItem) {
                                            ?>
                                               <div class="single-slide zoom-image-hover">
                                                   <img class="img-responsive" src="<?= $thumbItem['image'] ?>" alt="<?= $dataProd['title'] ?>">
                                               </div>
                                           <?php } ?>

                                       </div>
                                       <div class="single-nav-thumb">
                                           <?php foreach ($dataImageProd as $imageItem) {
                                            ?>
                                               <div class="single-slide">
                                                   <img class="img-responsive" src="<?= $imageItem['image'] ?>" alt="<?= $dataProd['title'] ?>">
                                               </div>
                                           <?php } ?>

                                       </div>
                                   </div>
                               </div>
                               <div class="single-pro-desc single-pro-desc-no-sidebar">
                                   <div class="single-pro-content">
                                       <h5 class="ec-single-title"><?= $dataProd['title'] ?></h5>
                                       <div class="ec-single-rating-wrap">
                                           <div class="ec-single-rating">
                                               <?= Format::renderStars($dataProd['totalRatings']) ?>
                                           </div>
                                           <span class="ec-read-review"><a href="#ec-spt-nav-review">(<?= $dataProd['totalUserRatings'] ?> Đánh giá)</a></span>
                                       </div>
                                       <div class="ec-single-desc mb-4 "><?= $dataProd['short_description'] ?></div>



                                       <div class="ec-single-price-stoke">
                                           <div class="ec-single-price">
                                               <span class="ec-single-ps-title">Đơn giá</span>
                                               <div id="product-price">

                                                   <span class="new-price">
                                                       <?php
                                                        echo ($dataProd['isVariant'] == 1) ?
                                                            Format::formatCurrency($productPrice[0]['min_price']) . ' - ' . Format::formatCurrency($productPrice[0]['max_price']) :
                                                            Format::formatCurrency($dataProd['price']);
                                                        ?>
                                                   </span>
                                                   <?php if ($dataProd['isVariant'] != 1 && $dataProd['discount'] != 0) : ?>
                                                       <span class="fs-4 fw-bold  ms-3 me-1 text-decoration-line-through "><?= Format::calculateOriginalPrice($dataProd['price'], $dataProd['discount']) ?></span>
                                                       <span class="text-danger fs-4"><?= ($dataProd['discount'] . '%') ?> </span>
                                                   <?php endif ?>


                                               </div>
                                           </div>
                                           <div class="ec-single-stoke">
                                               <span class="ec-single-ps-title">Số lượng</span>
                                               <span id="product-stock" class="ec-single-sku "><?= $dataProd['isVariant'] == 1 ? $dataVariant[0]['quantity'] : $dataProd['quantity'] ?></span>
                                           </div>
                                       </div>
                                       <form id="formProduct" action="cart/addCartApi" method="post">
                                           <div class="ec-pro-variation">
                                               <div class="ec-pro-variation-inner ec-pro-variation-size">
                                                   <span>Phân loại</span>
                                                   <div class="ec-pro-variation-content">
                                                       <input id="product_variant_id" type="hidden" name="product_variant_id">
                                                       <ul>
                                                           <?php
                                                            foreach ($dataVariant as $dataVariantItem) {
                                                            ?>
                                                               <li id="<?= $dataVariantItem['id'] ?>" onclick="getVariant(<?= $dataVariantItem['id'] ?>)"><span><?= $dataVariantItem['attribute_values'] ?></span></li>
                                                           <?php } ?>

                                                       </ul>
                                                   </div>
                                               </div>

                                           </div>
                                           <div class="ec-single-qty">
                                               <div class="qty-plus-minus">
                                                   <input class="qty-input" type="text" name="quantity" value="1" />
                                               </div>
                                               <div class="ec-single-cart ">
                                                   <?php
                                                    $quantity = $dataProd['quantity'];
                                                    $isProductAvailable = ($quantity != 0);
                                                    $buttonText = $isProductAvailable ? 'Thêm vào giỏ hàng' : 'Sản phẩm tạm hết';
                                                    $buttonClass = $isProductAvailable ? 'btn btn-primary' : 'btn btn-primary disabled';
                                                    ?>

                                                   <button id="add-Product-To-Cart" type="button" onclick="addCart()" class="<?= $buttonClass; ?>"><?= $buttonText; ?></button>
                                               </div>
                                               <div class="ec-single-wishlist">
                                                   <button class="ec-btn-group wishlist" onclick="addWishList()" type="button" title="Wishlist"><i class="fi-rr-heart"></i></button>
                                               </div>

                                           </div>
                                       </form>
                                       <div class="ec-single-social">
                                           <ul class="mb-0">
                                               <li class="list-inline-item facebook"><a href="#"><i class="ecicon eci-facebook"></i></a></li>
                                               <li class="list-inline-item twitter"><a href="#"><i class="ecicon eci-twitter"></i></a></li>
                                               <li class="list-inline-item instagram"><a href="#"><i class="ecicon eci-instagram"></i></a></li>
                                               <li class="list-inline-item youtube-play"><a href="#"><i class="ecicon eci-youtube-play"></i></a></li>
                                               <li class="list-inline-item behance"><a href="#"><i class="ecicon eci-behance"></i></a></li>
                                               <li class="list-inline-item whatsapp"><a href="#"><i class="ecicon eci-whatsapp"></i></a></li>
                                               <li class="list-inline-item plus"><a href="#"><i class="ecicon eci-plus"></i></a></li>
                                           </ul>
                                       </div>

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!--Single product content End -->
                   <!-- Single product tab start -->
                   <div class="ec-single-pro-tab">
                       <div class="ec-single-pro-tab-wrapper">
                           <div class="ec-single-pro-tab-nav">
                               <ul class="nav nav-tabs">
                                   <li class="nav-item">
                                       <a class="nav-link active" data-bs-toggle="tab" href="#ec-spt-nav-details">Mô tả</a>
                                   </li>
                                   <li class="nav-item">
                                       <a class="nav-link" data-bs-toggle="tab" href="#ec-spt-nav-info">Xem thêm thông tin</a>
                                   </li>
                                   <li class="nav-item">
                                       <a class="nav-link" data-bs-toggle="tab" href="#ec-spt-nav-review">Đánh giá</a>
                                   </li>
                               </ul>
                           </div>
                           <div class="tab-content ec-single-pro-tab-content">
                               <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                   <div class="ec-single-pro-tab-desc">
                                       <?= $dataProd['description'] ?>
                                   </div>
                               </div>
                               <div id="ec-spt-nav-info" class="tab-pane fade">
                                   <div class="ec-single-pro-tab-moreinfo">
                                       <?= $dataProd['short_description'] ?>
                                   </div>
                               </div>

                               <div id="ec-spt-nav-review" class="tab-pane fade">
                                   <div class="row">
                                       <div id="comment-list" class="ec-t-review-wrapper">
                                           <!-- <div class="ec-t-review-item">
                                               <div class="ec-t-review-avtar">
                                                   <img src="public/client/images/review-image/1.jpg" alt="" />
                                               </div>
                                               <div class="ec-t-review-content">
                                                   <div class="ec-t-review-top">
                                                       <div class="ec-t-review-name">Jeny Doe</div>
                                                       <div class="ec-t-review-rating">
                                                           <i class="ecicon eci-star fill"></i>
                                                           <i class="ecicon eci-star fill"></i>
                                                           <i class="ecicon eci-star fill"></i>
                                                           <i class="ecicon eci-star fill"></i>
                                                           <i class="ecicon eci-star-o"></i>
                                                       </div>
                                                   </div>
                                                   <div class="ec-t-review-bottom">
                                                       <p>Lorem Ipsum is simply dummy text of the printing and
                                                           typesetting industry. Lorem Ipsum has been the industry's
                                                           standard dummy text ever since the 1500s, when an unknown
                                                           printer took a galley of type and scrambled it to make a
                                                           type specimen.
                                                       </p>
                                                   </div>
                                               </div>
                                           </div> -->


                                       </div>
                                       <div class="ec-ratting-content">
                                           <h3>Thêm cảm nghĩ của bạn</h3>
                                           <div class="ec-ratting-form">
                                               <form method="POST" id="formRatings">
                                                   <div class="rating-wrapper d-flex align-items-center  mb-4">
                                                       Số sao <span class="text-danger ">*</span>
                                                       <div class="reating-inner ms-3  ">
                                                           <input type="hidden" name="star" id="currentRating">
                                                           <input type="hidden" name="prod_id" value="<?= $dataProd['id'] ?>">
                                                           <span data-rating="1" class="star"><i class="fas fa-star"></i></span>
                                                           <span data-rating="2" class="star"><i class="fas fa-star"></i></span>
                                                           <span data-rating="3" class="star"><i class="fas fa-star"></i></span>
                                                           <span data-rating="4" class="star"><i class="fas fa-star"></i></span>
                                                           <span data-rating="5" class="star"><i class="fas fa-star"></i></span>
                                                       </div>
                                                   </div>

                                                   <div class="ec-ratting-input form-submit">
                                                       <textarea name="comment" placeholder="Cảm nghĩ của bạn"></textarea>
                                                       <button class="btn btn-primary" onclick="addRatingProd()" type="button" value="Submit">Nhận xét</button>
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- product details description area end -->
               </div>

           </div>
       </div>
   </section>
   <!-- End Single product -->

   <!-- Related Product Start -->
   <section class="section ec-releted-product section-space-p">
       <div class="container">
           <div class="row">
               <div class="col-md-12 text-center">
                   <div class="section-title">
                       <h2 class="ec-bg-title">Sản phẩm liên quan</h2>
                       <h2 class="ec-title">Sản phẩm liên quan</h2>
                       <p class="sub-title">Duyệt qua Bộ sưu tập các sản phẩm hàng đầu</p>
                   </div>
               </div>
           </div>
           <div class="row margin-minus-b-30">
               <!-- Related Product Content -->
               <?php
                foreach ($dataProdCategory as $itemDataProd) {
                    $linkProduct = 'product/' . $itemDataProd['slug'] . '-' . $itemDataProd['id'];
                ?>
                   <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                       <div class="ec-product-inner">
                           <div class="ec-pro-image-outer">
                               <div class="ec-pro-image">
                                   <a href="<?= $linkProduct ?>" class="image">
                                       <img class="main-image" src="<?= $itemDataProd['thumb'] ?>" title="<?= $itemDataProd['title'] ?>" alt="<?= $itemDataProd['title'] ?>" />

                                   </a>
                                   <span class="flags">
                                       <?php
                                        if ($itemDataProd['discount'] != 0) :
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
                                   <a href="<?= $linkProduct ?>"><?= $itemDataProd['title'] ?>
                                   </a>
                               </h5>
                               <div class="ec-pro-rating">
                                   <?= Format::renderStars($itemDataProd['totalRatings']) ?>

                               </div>
                               <span class="ec-price">

                                   <?php
                                    if ($itemDataProd['discount'] != 0) :
                                    ?>
                                       <span class="old-price"><?= Format::calculateOriginalPrice($itemDataProd['price'], $itemDataProd['discount']) ?></span>
                                   <?php endif; ?>
                                   <span class="new-price"><?= Format::formatCurrency($itemDataProd['price']) ?></span>
                               </span>

                           </div>
                       </div>
                   </div>
               <?php } ?>

           </div>
       </div>
   </section>
   <!-- Related Product end -->