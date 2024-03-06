<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Thêm thương hiệu</h3>
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
                                    <input class="form-check-input" value="1" id="radio1Public" type="radio" name="status" checked>
                                    <label for="radio1Public" class="form-check-label">
                                        Công khai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" id="radio1Hiden" type="radio" name="status">
                                    <label for="radio1Hiden" class="form-check-label">
                                        Ẩn
                                    </label>
                                </div>
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
                                <div class="col-md-6">
                                    <label class="form-label">Tên thương hiệu</label>
                                    <input type="text" value="<?= $dataValueOld['name'] ?? '' ?>" name="name" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div><!-- Row end  -->
        </form>

    </div>
</div>