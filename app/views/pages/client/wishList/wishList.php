   <!-- Ec Wishlist page -->
   <section class="ec-page-content section-space-p">
       <div class="container">
           <div class="row">
               <!-- Compare Content Start -->
               <div class="ec-wish-rightside col-lg-12 col-md-12">
                   <!-- Compare content Start -->
                   <div class="ec-compare-content">
                       <div class="ec-compare-inner">
                           <div id="wishlist-products" class="row margin-minus-b-30">

                               <?php
                                if (!empty($dataWishlist)) {

                                    foreach ($dataWishlist as $dataWishlistItem) {
                                        $linkProduct = 'product/' . $dataWishlistItem['slug'] . '-' . $dataWishlistItem['product_id'];
                                ?>
                                       <div id="wishlist-item-<?= $dataWishlistItem['wishlist_item_id'] ?>" class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="flipInY">
                                           <div class="ec-product-inner">
                                               <div class="ec-pro-image-outer">
                                                   <div class="ec-pro-image">
                                                       <a href="<?= $linkProduct ?>" class="image">
                                                           <img class="main-image" src="<?= $dataWishlistItem['thumb'] ?>" title="<?= $dataWishlistItem['title'] ?>" alt="<?= $dataWishlistItem['title'] ?>" />
                                                       </a>
                                                       <span class="ec-com-remove ec-remove-wish text-white">
                                                           <button onclick="deleteWishlist(<?= $dataWishlistItem['wishlist_item_id'] ?>)" class="text-white" type="button">×</button>
                                                       </span>
                                                       <?php
                                                        if ($dataWishlistItem['discount'] != 0) :
                                                        ?>
                                                           <span class="percentage"><?= $dataWishlistItem['discount'] . '%' ?></span>
                                                       <?php endif; ?>
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
                                                       <a href="<?= $linkProduct ?>"><?= $dataWishlistItem['title'] ?>
                                                       </a>
                                                       <small class="link-info opacity-50 " style="font-size: 12px; ">(<?= $dataWishlistItem['attribute_values'] ?>)</small>
                                                   </h5>
                                                   <div class="ec-pro-rating">
                                                       <?= Format::renderStars($dataWishlistItem['totalRatings']) ?>

                                                   </div>
                                                   <span class="ec-price">

                                                       <?php
                                                        if ($dataWishlistItem['discount'] != 0) :
                                                        ?>
                                                           <span class="old-price"><?= Format::calculateOriginalPrice($dataWishlistItem['price'], $dataWishlistItem['discount']) ?></span>
                                                       <?php endif; ?>
                                                       <span class="new-price"><?= Format::formatCurrency($dataWishlistItem['price']) ?></span>
                                                   </span>

                                               </div>
                                           </div>
                                       </div>
                               <?php }
                                } ?>

                           </div>
                       </div>
                   </div>
                   <!--compare content End -->
               </div>
               <!-- Compare Content end -->
           </div>
       </div>
   </section>