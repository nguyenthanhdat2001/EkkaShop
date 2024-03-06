<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <form method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Nhập thêm hàng</h3>
                        <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Lưu</button>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">
                <div class="col-lg-4">
                    <div class="sticky-lg-top">
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Thông tin nhà cung cấp</h6>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Lựa chọn nhà cung cấp</label>
                                <select class="form-select" name="supplier_id">
                                    <?php
                                    foreach ($dataSuppliers as $dataSuppliersItem) {
                                        $selectedSuppliers = $dataValueOld['supplier_id'] == $dataSuppliersItem['id'] ? 'selected' : '';
                                    ?>
                                        <option <?= $selectedSuppliers ?> value="<?= $dataSuppliersItem['id'] ?>"><?= $dataSuppliersItem['name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Thông tin sản phẩm</h6>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Lựa chọn sản phẩm</label>
                                <select class="form-select" name="name_and_id_product_variant">
                                <?php
                                    foreach ($dataProdVariants as $dataProdVariantsItem) {
                                        $selectedSuppliers = $dataValueOld['name_and_id_product_variant'] ?? '' == $dataProdVariantsItem['id'] ? 'selected' : '';

                                        $prod_name = $dataProdVariantsItem['id'] . '-' . $dataProdVariantsItem['title'] . ' ( ' . $dataProdVariantsItem['attribute_values'] . ' )';

                                        $prod_name_value = $dataProdVariantsItem['id'] . '+' . $dataProdVariantsItem['title'] . ' ( ' . $dataProdVariantsItem['attribute_values'] . ' )';
                                    ?>
                                        <option <?= $selectedSuppliers ?> value="<?= $prod_name_value ?>"><?= $dataProdVariantsItem['title'] . ' - ' . ' ( ' . $dataProdVariantsItem['attribute_values'] . ' )' ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label class="form-label">Số lượng </label>
                                    <input type="number" value="<?= $dataValueOld['quantity'] ?? '' ?>" name="quantity" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Giá</label>
                                    <input type="number" value="<?= $dataValueOld['price'] ?? '' ?>" name="price" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div><!-- Row end  -->
        </form>

    </div>
</div>