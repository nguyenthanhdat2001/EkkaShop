<!-- User history section -->
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                <div class="ec-sidebar-wrap ec-border-box">
                    <!-- Sidebar Category Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-vendor-block">
                            <div class="ec-vendor-block-items">
                                <ul>
                                    <li><a href="my-account">Hồ sơ của bạn</a></li>
                                    <li><a href="my-order">Lịch sử mua hàng</a></li>
                                    <li><a href="wishlist">Sản phẩm ưu thích</a></li>
                                    <li><a href="cart">Giỏ hàng</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <div class="ec-vendor-dashboard-card">
                    <div class="ec-vendor-card-header">
                        <h5>Lịch sử mua hàng</h5>
                        <!-- <div class="ec-header-btn">
                            <a class="btn btn-lg btn-primary" href="#">Shop Now</a>
                        </div> -->
                    </div>
                    <div class="ec-vendor-card-body">
                        <div class="ec-vendor-card-table">
                            <table class="table ec-table">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Tổng</th>
                                        <th>Đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dataOrder as $orderItemDetail) {
                                    ?>
                                        <tr>
                                            <th scope="row"><span> <?= '#' . $orderItemDetail['order_code'] ?></span></th>
                                            <td><span><?= $orderItemDetail['order_date'] ?></span></td>
                                            <td><span> <?= $orderItemDetail['payment_method_name'] ?></span></td>
                                            <td class="fw-bold  <?= $orderItemDetail['order_status_id'] == 5 ? 'text-danger' : 'text-success' ?>">
                                                <span class="fw-medium">
                                                    <?= $orderItemDetail['order_status_name'] ?>
                                                </span>
                                            </td>
                                            <td><span><?= Format::formatCurrency($orderItemDetail['total_money']) ?></span></td>
                                            <td><span class="tbl-btn"><a class="btn btn-lg btn-primary" href="order-detail/<?= "{$orderItemDetail['order_id']}-{$orderItemDetail['order_code']}" ?>">Xem</a></span></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End User history section -->