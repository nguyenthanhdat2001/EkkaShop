<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Danh sách thuộc tính</h3>
                    <a href="admin/add-attribute" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm thuộc tính</a>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>

                                <th>Tên thuộc tính</th>
                                <th>Tên hiển thị</th>
                                <th>Giá trị</th>
                                <th>Thực thi</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataAttribute as $key => $dataAttributeItem) {
                                    extract($dataAttributeItem)
                                ?>
                                    <tr>

                                        <td class=""><?= $name ?></td>
                                        <td class=""><?= $display_name ?></td>
                                        <td>
                                            <a class="link-info " href="admin/attribute-value/<?= $id ?>">Chi tiết</a>
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="admin/update-attribute/<?= $id ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                <button onclick="handleConfirm('admin/attributes/deleteAttribute/<?= $id ?>')" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
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