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
                        <h3 class="fw-bold mb-0">Thêm banner</h3>
                        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Lưu</button>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">

                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Thông tin banner </h6>

                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label class="form-label">Tiêu đề</label>
                                    <input type="text" value="<?= $dataValueOld['title'] ?? '' ?>" name="title" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Tiêu đề phụ</label>
                                    <input type="text" value="<?= $dataValueOld['name'] ?? '' ?>" name="name" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Mô tả</label>
                                    <textarea name="description" class="form-control " cols="30" rows="2"><?= $dataValueOld['name'] ?? '' ?></textarea>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label class="form-label">Hình ảnh banner</label>
                                        <small class="d-block text-muted mb-2">Chỉ hình ảnh dọc hoặc hình vuông,
                                            Đúng định dạng file (jpg, png, webp) tối đa 5MB.</small>
                                        <input type="file" name="thumb" id="input-file-to-destroy" class="dropify" data-allowed-formats="portrait square" data-max-file-size="5M" data-max-height="2000">
                                    </div>

                                </div>




                            </div>
                        </div>

                    </div>

                </div>
            </div><!-- Row end  -->
            <form />
    </div>
</div>