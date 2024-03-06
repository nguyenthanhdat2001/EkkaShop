<?php
// echo '<pre>';
// print_r($dataValueOld);
// echo '</pre>';
?>
<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin hình thức thanh toán</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="name" class="form-control input-text" value="<?= $dataValueOld['name'] ?? '' ?>" type="text" placeholder="Tên hình thức thanh toán" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên hiển thị<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="display_name" class="form-control input-text" value="<?= $dataValueOld['display_name'] ?? '' ?>" type="text" placeholder="Tên hiển thị hình thức thanh toán" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mô tả<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control input-text" cols="1" rows="2"><?= $dataValueOld['description'] ?? '' ?></textarea>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh hình thức thanh toán<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="thumb" class="form-control input-file" type="file" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Thêm hình thức thanh toán mới <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>