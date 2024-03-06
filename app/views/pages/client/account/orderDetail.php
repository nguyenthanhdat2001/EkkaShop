<?php
// echo '<pre>';
// print_r($dataOrder);
// echo '</pre>';
?>
<section class="order-detail-area">
    <div class="container">
        <div class="order-detail-wrap">
            <div class="card border-0  p-0 ">
                <div class="title-header">
                    <h5 class="mb-5 fw-bold ">Đơn hàng #<?= $dataOrder[0]['order_code'] ?></h5>
                </div>

                <div class="order-detail">
                    <div class="order-top">
                        <ul class="info">
                            <li><?= $dataOrder[0]['order_date'] ?></li>
                            <li><?= count($dataOrder) ?> mặt hàng</li>
                            <li>Tổng <?= Format::formatCurrency($dataOrder[0]['total_money']) ?></li>
                        </ul>
                    </div>
                    <div class="row g-4 pt-5 ">
                        <div class="col-xl-8">
                            <div class="table-details">
                                <div class="heading">Mặt hàng</div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        foreach ($dataOrder as $dataOrderItem) {
                                            extract($dataOrderItem);
                                            $subtotal += $sub_total;
                                        ?>
                                            <tr class="table-order">
                                                <td>
                                                    <a href="product/<?= "{$dataOrderItem['slug']}-{$dataOrderItem['prod_id']}" ?>" class="image" target="_blank">
                                                        <img src="<?= $thumb ?>" class="img-fluid blur-up lazyload" alt="<?= $title ?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="product_variant">
                                                        <h5 class="mt-0">
                                                            <a href="product/<?= "{$dataOrderItem['slug']}-{$dataOrderItem['prod_id']}" ?>" target="_blank">
                                                                <?= $title ?>
                                                            </a>
                                                        </h5>
                                                        <p>Phân loại: <span><?= $attribute_values ?></span></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>Số lượng</p>
                                                    <h5><?= $quantity ?></h5>
                                                </td>
                                                <td>
                                                    <p>Giá</p>
                                                    <h5><?= Format::formatCurrency($price) ?></h5>
                                                </td>
                                            </tr>

                                        <?php } ?>


                                    </tbody>

                                    <tfoot class="mt-4">
                                        <tr class="table-order-footer">
                                            <td colspan="3">
                                                <h5>Tạm tính :</h5>
                                            </td>
                                            <td>
                                                <h4><?= Format::formatCurrency($subtotal) ?></h4>
                                            </td>
                                        </tr>

                                        <tr class="table-order-footer ">

                                            <td colspan="3">
                                                <h5>Ưu dãi :</h5>
                                            </td>
                                            <td>

                                                <h4><?= Format::formatCurrency($total_money - $subtotal) ?></h4>
                                            </td>
                                        </tr>

                                        <tr class="table-order-footer">
                                            <td colspan="3">
                                                <h4 class="theme-color fw-bold">Thành tiền :</h4>
                                            </td>
                                            <td>
                                                <h4 class="theme-color fw-bold"><?= Format::formatCurrency($total_money) ?></h4>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!--  -->
                        <?php
                        // echo '<pre>';
                        // print_r($dataOrder);
                        // echo '</pre>';
                        ?>

                        <div class="col-xl-4">
                            <div class="order-summery">
                                <div class="row g-4">
                                    <h4 class="mb-2 mt-3 
                                    ">Tóm tắt</h4>
                                    <ul class="order-details">
                                        <li>Mã đơn hàng: #<?= $order_code ?></li>
                                        <li>Ngày đặt hàng: <?= date('d/m/Y', strtotime($order_date)) ?></li>
                                        <li>Tổng tiền: <?= Format::formatCurrency($total_money) ?></li>
                                    </ul>

                                    <h4 class="mb-2 mt-3 ">Địa chỉ giao hàng</h4>
                                    <ul class="order-details">
                                        <li><?= "$fullname - $phone - $address" ?></li>
                                    </ul>

                                    <h4 class="mb-2 mt-3 ">Phương thức thanh toán</h4>
                                    <ul class="order-details">
                                        <li><?= $payment_method_name ?></li>
                                    </ul>

                                    <div class="payment-mode">
                                        <h4 class="mb-2 mt-3 ">Trạng thái đơn hàng</h4>
                                        <?php
                                        foreach ($dataOrderStatus as $item) {
                                            $cancer = $item['id'] == 5 ? 'inactive' : 'active';
                                            if ($selected = $item['id'] == $order_status_id) {
                                        ?>
                                                <p class="status <?= $cancer ?>"><?= $item['name'] ?></p>
                                        <?php }
                                        } ?>
                                    </div>

                                    <div class="payment-mode mb-2 mt-3 ">
                                        <h4>Thao tác</h4>
                                        <?php
                                        if ($order_status_id == 1 || $order_status_id == 2) {
                                        ?>
                                            <!-- 5 la trang thai huy don hang -->
                                            <a onclick="setDataIdToInput(5)" data-bs-toggle="modal" data-bs-target="#deleteConfirm" class="btn rounded btn-secondary  ">Huỷ đơn hàng</a>
                                        <?php } elseif ($order_status_id == 3) { ?>
                                            <!-- 4 la trang thai da nhan duoc hang -->
                                            <a onclick="setDataIdToInput(4)" data-bs-toggle="modal" data-bs-target="#deleteConfirm" class="btn btn-info text-white rounded">Đã nhận được hàng</a>
                                        <?php } elseif ($order_status_id == 4) { ?>
                                            <a class="btn rounded btn-primary  " href="<?= "product/$slug-$prod_id" ?>">Đánh giá</a>
                                        <?php } else { ?>
                                            <p>Đã huỷ.</p>
                                        <?php } ?>
                                    </div>

                                    <div class="delivery-sec mt-4 ">
                                        <h3>Dự kiến nhận hàng: <span><?= date('d/m/Y', strtotime($order_date) + 3 * 24 * 3600) ?></span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    function setDataIdToInput(id) {
        $('#order_status_id').val(id)
    }
</script>

<div class="modal fade theme-modal" id="deleteConfirm" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Bạn đã chắc chắn chưa?</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 text-center">Nếu thực hiện 'đồng ý' bạn sẽ không để thực hiện lại hãy suy nghĩ thật kĩ trước khi hành động.</p>
            </div>
            <div class="modal-footer border-0 ">
                <form method="POST" action="update-order-status">
                    <input type="hidden" value="<?= $order_id ?>" name="order_id">
                    <input type="hidden" value="<?= $prod_id ?>" name="prod_id">
                    <input type="hidden" id="order_status_id" name="order_status_id">
                    <button type="submit" class="btn btn-primary px-4  text-capitalize  rounded btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-primary px-4  text-capitalize  rounded btn-no fw-bold" data-bs-dismiss="modal">Huỷ</button>
                </div>

            </div>
        </div>
    </div>
</div>