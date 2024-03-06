<?php
// echo '<pre>';
// print_r($dataPaymentMethod);
// echo '</pre>';
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách hình thức thanh toán</h5>
            <div class="right-options">
                <ul>
                    <li>
                        <a class="btn btn-custom" href="admin/add-payment-method"> Thêm hình thức thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên phương thức</th>
                        <th>Tên hiển thị</th>
                        <th>Trạng thái</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($dataPaymentMethod as $dataPaymentMethodItem) {
                        extract($dataPaymentMethodItem)
                    ?>
                        <tr>

                            <td>
                                <div class="table-image">
                                    <img src="<?= $thumb ?>" class="img-fluid" alt="<?= $name ?>">
                                </div>
                            </td>

                            <td><?= $name ?></td>
                            <td><?= $display_name ?></td>
                            <td class=" <?= !$status == 1 ? 'status-danger' : 'status-success' ?>">
                                <span class="fw-medium">
                                    <?= $status == 1 ? 'Hoạt động' : 'Dừng hoạt động' ?>
                                </span>
                            </td>


                            <td>
                                <ul class="options">
                                    <li class="m-0 ">
                                        <a href="admin/update-payment-method/<?= $id ?>">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</section>