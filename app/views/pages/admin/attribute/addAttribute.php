<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Thêm thuộc tính</h3>
                        <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Lưu</button>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">

                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Thông tin cơ bản</h6>
                        </div>
                        <div class="card-body">

                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label class="form-label">Tên thuộc tính</label>
                                    <input type="text" value="<?= $dataValueOld['name'] ?? '' ?>" name="name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Tên hiển thị</label>
                                    <input type="text" value="<?= $dataValueOld['display_name'] ?? '' ?>" name="display_name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Giá trị thuộc tính</label>
                                    <input type="text" value="<?= $dataValueOld['value_name'] ?? '' ?>" name="value_name" class="form-control" placeholder="Thêm nhiều cách nhau bởi dấu ','. Ex: Màu đỏ, Màu xanh,...">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div><!-- Row end  -->
        </form>

    </div>
</div>