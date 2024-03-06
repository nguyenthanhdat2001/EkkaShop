<?php
// echo '<pre>';
// print_r($dataStoreCustom);
// echo '</pre>';
?>

<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form action="admin/store/banner" method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Chỉnh sửa thông tin banner</h3>
                        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Lưu</button>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">

                <div class="col-xl-12 col-lg-12">


                    <?php
                    $i = 0;
                    foreach ($dataBanner as $item) {
                        $i++;
                    ?>
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Thông tin banner <?= $i ?></h6>
                                <button type="button" onclick="handleConfirm('admin/store/deleteBanner/<?= $item['id'] ?>')" class="btn btn-danger text-white">Xoá <?= $i ?></button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <input type="hidden" name="id[]" value="<?= $item['id'] ?? '' ?>">
                                    <div class="col-md-12">
                                        <label class="form-label">Tiêu đề</label>
                                        <input type="text" value="<?= $item['title'] ?? '' ?>" name="title[]" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Tiêu đề phụ</label>
                                        <input type="text" value="<?= $item['name'] ?? '' ?>" name="name[]" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Mô tả</label>
                                        <textarea name="description[]" class="form-control " cols="30" rows="2"><?= $item['description'] ?? '' ?></textarea>
                                    </div>

                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12">
                                            <label class="form-label">Hình ảnh banner</label>

                                        </div>

                                    </div>

                                    <div class="gap-3 flex-wrap  d-flex">
                                        <?php
                                        if (empty($item['thumb'])) {
                                        ?>
                                            <span class="text-center ">Chưa có ảnh..</span>
                                        <?php } else { ?>
                                            <div class="position-relative">
                                                <img class="border p-2" style="width: 150px; display: block; object-fit: contain; border-radius: 10px;" src="<?= $item['thumb'] ?? '' ?>" alt="<?= $item['thumb'] ?? '' ?>">
                                                <!-- <a class="btn btn-outline-light text-light position-absolute text-center bg-danger d-inline-flex align-items-center justify-content-center" style="border-radius: 100%; width: 24px; height: 24px; line-height: 1; right: -7px; top: -9px; " href="">x</a> -->
                                            </div>
                                        <?php } ?>

                                    </div>


                                </div>
                            </div>

                        </div>
                    <?php } ?>

                    <a href="admin/add-banner" type="button" class="btn btn-dark btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i>Thêm banner mới</a>

                </div>
            </div><!-- Row end  -->
            <form />
    </div>
</div>