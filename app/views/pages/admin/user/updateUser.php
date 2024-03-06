<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Thêm người dùng</h3>
                        <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Lưu</button>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">
                <div class="col-lg-4">
                    <div class="sticky-lg-top">
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Trạng thái hiển thị</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" value="0" id="radio1Public" type="radio" name="isBlock" <?= $dataUserUp['isBlock'] == 0 ? 'checked' : '' ?>>
                                    <label for="radio1Public" class="form-check-label">
                                        Mở khoá người dùng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="1" id="radio1Hiden" type="radio" name="isBlock" <?= $dataUserUp['isBlock'] == 1 ? 'checked' : '' ?>>

                                    <label for="radio1Hiden" class="form-check-label">
                                        Khoá người dùng
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Quyền người dùng</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                foreach ($dataRole as $dataRoleItem) {

                                ?>
                                    <div class="form-check">
                                        <input <?php if ($dataRoleItem['id'] == $dataUserUp['role_id']) echo 'checked' ?> class="form-check-input" value="<?= $dataRoleItem['id'] ?>" id="<?= $dataRoleItem['id'] ?>" type="radio" name="role_id">
                                        <label for="<?= $dataRoleItem['id'] ?>" class="form-check-label">
                                            <?= $dataRoleItem['name'] . ' - ' . $dataRoleItem['description'] ?>
                                        </label>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Thông tin cơ bản</h6>
                        </div>
                        <div class="card-body">

                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" value="<?= $dataUserUp['fullname'] ?? '' ?>" name="fullname" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" value="<?= $dataUserUp['email'] ?? '' ?>" name="email" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="tel" value="<?= $dataUserUp['phone'] ?? '' ?>" name="phone" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Địa chỉ</label>

                                    <textarea class="form-control" name="address" id="" cols="30" rows="2"><?= $dataUserUp['address'] ?? '' ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Mật khẩu</label>
                                    <input type="password" value="<?= $dataUserUp['password'] ?? '' ?>" name="password" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" value="<?= $dataUserUp['password'] ?? '' ?>" name="re_password" class="form-control">
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Ảnh đại diện người dùng</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label class="form-label">Tải lên hình ảnh danh mục</label>
                                    <small class="d-block text-muted mb-2">Chỉ hình ảnh dọc hoặc hình vuông,
                                        Đúng định dạng file (jpg, png, webp) tối đa 5MB.</small>
                                    <input type="file" name="avatar" id="input-file-to-destroy" class="dropify" data-allowed-formats="portrait square" data-max-file-size="5M" data-max-height="2000">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Row end  -->
        </form>

    </div>
</div>