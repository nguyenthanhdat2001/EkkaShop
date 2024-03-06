<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Danh sách giá trị thuộc tính</h3>
                    <a href="admin/add-attribute" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm giá trị thuộc tính</a>
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
                                <th>Giá trị</th>
                                <th>Thực thi</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataAttributeValue as $key => $dataAttributeValueItem) {
                                    extract($dataAttributeValueItem)
                                ?>
                                    <tr>

                                        <td class=""><?= $name ?></td>
                                        <td class=""><?= $value_name ?></td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button onclick="handleConfirm('admin/attributes/deleteAttributeValue/<?= $id ?>/<?= $attribute_id ?>')" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
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


<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="expaddLabel"> Thêm giá trị thuộc tính</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="admin/attributes/addAttributeValue" method="post">
                <div class="modal-body">

                    <div class="deadline-form">
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                                <input type="hidden" name="attribute_id" value="<?= $attribute_id ?>">
                                <label for="depone" class="form-label">Giá trị thuộc tính</label>
                                <input name="value_name" type="text" class="form-control" id="depone" placeholder="Thêm nhiều cách nhau bởi dấu ','. Ex: Màu đỏ, Màu xanh,...">
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>