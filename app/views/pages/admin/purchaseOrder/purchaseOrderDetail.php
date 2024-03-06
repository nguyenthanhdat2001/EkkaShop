<?php
// echo '<pre>';
// print_r($dataPurchaseOrderDetail);
// echo '</pre>';
?>
<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Chi tiết danh sách hàng đã nhập</h3>
                    <a href="admin/add-purchaseOrder" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Nhập thêm hàng</a>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Ngày nhập hàng</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataPurchaseOrderDetail as $key => $dataPurchaseOrderDetailItem) {
                                    extract($dataPurchaseOrderDetailItem)
                                ?>
                                    <tr>

                                        <td class=""><?= $prod_name ?></td>
                                        <td><?= date('Y-m-d', strtotime($create_at)) ?></td>
                                        <td><?= $quantity ?></td>
                                        <td><?= Format::formatCurrency($price) ?></td>

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