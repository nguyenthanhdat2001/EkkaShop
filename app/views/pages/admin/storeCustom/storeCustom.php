<?php
// echo '<pre>';
// print_r($dataStoreCustom);
// echo '</pre>';
?>

<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Chỉnh sửa thông tin cửa hàng</h3>
                        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Lưu</button>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">

                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Thông tin cửa hàng</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <input type="hidden" name="store_id" value="<?= $dataStoreCustom['id'] ?? '' ?>">
                                <div class="col-md-12">
                                    <label class="form-label">Tên cửa hàng</label>
                                    <input type="text" value="<?= $dataStoreCustom['name'] ?? '' ?>" name="name" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Địa chỉ cửa hàng</label>
                                    <textarea class="form-control " name="address" cols="30" rows="3"><?= $dataStoreCustom['address'] ?? '' ?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" value="<?= $dataStoreCustom['phone'] ?? '' ?>" name="phone" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Địa chỉ email</label>
                                    <input type="text" value="<?= $dataStoreCustom['email'] ?? '' ?>" name="email" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Giờ mở cửa</label>
                                    <input type="text" value="<?= $dataStoreCustom['open_time'] ?? '' ?>" name="open_time" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Logo</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label class="form-label">Tải lên hình logo</label>
                                    <small class="d-block text-muted mb-2">Chỉ hình ảnh dọc hoặc hình vuông,
                                        Đúng định dạng file (jpg, png, webp) tối đa 5MB.</small>
                                    <input type="file" name="logo" id="input-file-to-destroy" class="dropify" data-allowed-formats="portrait square" data-max-file-size="5M" data-max-height="2000">
                                </div>

                            </div>

                            <div class="mt-4 gap-3 flex-wrap  d-flex">
                                <?php
                                if (empty($dataStoreCustom['logo'])) {
                                ?>
                                    <span class="text-center ">Chưa có ảnh..</span>
                                <?php } else { ?>
                                    <div class="position-relative">
                                        <img class="border p-2" style="width: 150px; display: block; object-fit: contain; border-radius: 10px;" src="<?= $dataStoreCustom['logo'] ?? '' ?>" alt="<?= $dataStoreCustom['logo'] ?? '' ?>">
                                        <!-- <a class="btn btn-outline-light text-light position-absolute text-center bg-danger d-inline-flex align-items-center justify-content-center" style="border-radius: 100%; width: 24px; height: 24px; line-height: 1; right: -7px; top: -9px; " href="">x</a> -->
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- Row end  -->
            <form />
    </div>
</div>