<?php
// echo '<pre>';
// print_r($dataPaymentMethod);
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
                                    <input name="name" class="form-control input-text" value="<?= $dataPaymentMethod['name'] ?? '' ?>" type="text" placeholder="Tên hình thức thanh toán" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên hiển thị<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="display_name" class="form-control input-text" value="<?= $dataPaymentMethod['display_name'] ?? '' ?>" type="text" placeholder="Tên hiển thị hình thức thanh toán" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mô tả<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control input-text" cols="1" rows="2"><?= $dataPaymentMethod['description'] ?? '' ?></textarea>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Hiển thị</label>
                                <div class="col-sm-9">
                                    <label class="switch">
                                        <?php
                                        $status = $dataPaymentMethod['status'] ?? '';
                                        $checkedStatus = $status == 1 ? 'checked' : '';
                                        ?>
                                        <input name="status" <?= $checkedStatus ?> value="1" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh hình thức thanh toán</label>
                                <div class="col-sm-6">
                                    <input name="image" class="form-control input-file" type="file">
                                </div>

                                <div class="col-sm-3">
                                    <img class="img-review" src="<?= $dataPaymentMethod['thumb'] ?>" alt="<?= 'image ' . $dataPaymentMethod['name'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Cập nhập hình thức thanh toán mới <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>