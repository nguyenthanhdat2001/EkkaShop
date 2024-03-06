<?php
// echo '<pre>';
// print_r($dataUserAd);
// echo '</pre>';
?>
<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Danh sách hoá đơn</h3>
                    <!-- <a href="admin/add-user" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm hoá đơn</a> -->
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    // echo '<pre>';
                    // print_r($dataOrder);
                    // echo '</pre>';
                    ?>
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>

                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày tạo đơn</th>
                                    <th>Người đặt hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Thành tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hoá đơn</th>
                                    <th>Cập nhập đơn hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataOrder as $key => $dataOrderItem) {
                                    extract($dataOrderItem)
                                ?>
                                    <tr>

                                        <td>#<?= $order_code ?></td>
                                        <td><?= date('Y-m-d', strtotime($order_date)) ?></td>

                                        <td><?= $fullname ?></td>
                                        <td><?= $payment_method_name ?></td>
                                        <td><?= Format::formatCurrency($total_money) ?></td>
                                        <td>
											<?php
                                            $bg_color = '';
                                            switch ($order_status_id) {
                                                case 1:
                                                    $bg_color = 'bg-warning';
                                                    break;
                                                case 2:
                                                    $bg_color = 'bg-primary';
                                                    break;
                                                case 3:
                                                    $bg_color = 'bg-info';
                                                    break;
                                                case 4:
                                                    $bg_color = 'bg-success';
                                                    break;
                                                default:
                                                    $bg_color = 'bg-danger';
                                            }
                                            ?>
                                            <span class="badge <?=$bg_color?>"><?= $order_status_name ?></span>
                                        </td>


                                        <td>
                                            <button type="button" class="btn btn-sm btn-white" onclick="printInvoice(<?= $order_id ?>)"><i class="icofont-print fs-5"></i></button>
                                            <a class="btn btn-sm btn-white" href="admin/order/downloadInvoice/<?= $order_id ?>"><i class="icofont-download fs-5"></i></a>
                                        </td>

                                        <td>
                                            <a class="btn btn-outline-danger" href="admin/order-detail/<?= "$order_id-$order_code" ?>">Cập nhập trạng thái</a>
                                        </td>
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