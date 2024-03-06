<section class="coupon-area">
    <div class="container">
        <div class="row">
            <?php
            foreach ($dataCoupon as $dataCouponItem) {
                extract($dataCouponItem);
                // Xu ly ma giam gia
                preg_match('/(\d+)(%)/', $value, $couponValue);
                $value = end($couponValue) == '%' ?  $value : Format::formatCurrency($value)

            ?>
                <div class="col-lg-6">
                    <div class="coupon-area-wrap">
                        <div class="coupon">
                            <div class="coupon-left">
                                <figure class="thumb">
                                    <img src="<?= $thumb ?>" alt="">
                                </figure>
                                <div class="content">
                                    <div class="expired">
                                        Thời hạn: <span>
                                            <?= date('d-m-Y', strtotime($expired)) ?>
                                        </span>
                                    </div>
                                    <h4 class="title-coupon">
                                        <?= $title ?>
                                    </h4>

                                    <p class="value">
                                        <?= "- $value" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="coupon-right">
                                <?php
                                if (strtotime($expired) < time()) {
                                ?>
                                    <div class="status">
                                        Ưu đãi <span class="inactive">Hết hạn</span>
                                    </div>
                                <?php } else { ?>
                                    <div class="status">
                                        Ưu đãi <span class="active">Hoạt động</span>
                                    </div>
                                <?php } ?>

                                <button type="button" class="code code-coupon w-100 ">
                                    <?= $code ?>
                                </button>
                                <p class="condition">
                                    * Mã phiếu giảm giá này sẽ được áp dụng khi bạn mua sắm nhiều hơn
                                    <span><?= Format::formatCurrency($min_amount) ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>