<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Danh sách nhà cung cấp</h3>
                    <a href="admin/add-suppliers" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm nhà cung cấp</a>
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
                                    <th>Tên nhà cung cấp</th>
                                    <th>Ngày tham gia</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Thực thi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataSuppliers as $key => $dataSuppliersItem) {
                                    extract($dataSuppliersItem)
                                ?>
                                    <tr>

                                        <td class=""><?= $name ?></td>
                                        <td><?= date('Y-m-d', strtotime($create_at)) ?></td>
                                        <td><?= $email ?></td>
                                        <td><?= $phone ?></td>
                                        <td><?= $address ?></td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="admin/update-suppliers/<?= $id ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                <button onclick="handleConfirm('admin/suppliers/deleteSuppliers/<?= $id ?>')" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                            </div>
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