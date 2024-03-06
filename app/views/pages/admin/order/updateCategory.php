<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin danh mục</h5>
                        </div>
                        <div class="form-input">
                            <input type="hidden" value="<?php echo $dataCate['id'] ?>">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input name="name" value="<?php echo $dataCate['name'] ?>" class="form-control input-text" type="text" placeholder="Tên danh mục">
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh danh mục</label>
                                <div class="col-sm-6">
                                    <input name="image" class="form-control input-file" type="file">

                                </div>

                                <div class="col-sm-3">
                                    <img class="img-review" src="public/images/category/<?php echo $dataCate['image'] ?>" alt="<?php echo 'image ' . $dataCate['name'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-custom col-sm-8 m-auto ">Cập nhập danh mục</button>
            </div>
        </form>
    </div>

</section>