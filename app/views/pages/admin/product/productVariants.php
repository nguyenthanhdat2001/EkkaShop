		<?php

        ?>
		<!-- Body: Body -->
		<div class="body d-flex py-3">
		    <div class="container-xxl">
		        <form method="post" enctype="multipart/form-data">



		            <div class="row align-items-center">
		                <div class="border-0 mb-4">
		                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
		                        <h3 class="fw-bold mb-0">Danh sách biến thể sản phẩm</h3>

		                        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Lưu</button>

		                    </div>
		                </div>
		            </div> <!-- Row end  -->



		            <div class="card mb-3">
		                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
		                    <h6 class="m-0 fw-bold">Thông tin sản phẩm</h6>
		                    <a href="admin/add-product-variants/<?= $dataProd['id'] ?>" class="btn btn-success text-white  btn-set-task w-sm-100 py-2 px-5 text-uppercase">Thêm biến thể</a>
		                </div>
		                <div class="card-body">
		                    <div class="row g-3 align-items-center">
		                        <div class="col-md-12">
		                            <label class="form-label">Tên sản phẩm </label>
		                            <input type="text" readonly value="<?= $dataProd['title'] ?? '' ?>" class="form-control">
		                        </div>

		                        <div class="col-md-6">
		                            <label class="form-label">Đơn giá </label>
		                            <input type="number" readonly value="<?= $dataProd['price'] ?? '' ?>" class="form-control">
		                        </div>
		                        <div class="col-md-6">
		                            <label class="form-label">Ngày đăng </label>
		                            <input type="text" readonly value="<?= $dataProd['create_at'] ?? '' ?>" class="form-control">
		                        </div>
		                        <!-- <div class="col-md-6">
		                            <label class="form-label">Tên sản phẩm </label>
		                            <input type="number" readonly value="<?= $dataProd['price'] ?? '' ?>" class="form-control">
		                        </div> -->

		                    </div>
		                </div>
		            </div>

		            <!-- Biến thể -->
		            <div class="card mb-3">
		                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
		                    <h6 class="mb-0 fw-bold ">Biến thể</h6>
		                </div>
		                <div class="card-body">
		                    <div class="row g-3 align-items-center">
		                        <div class="col-md-12">
		                            <div class="product-cart">
		                                <div class="checkout-table table-responsive">
		                                    <table id="myCartTable" class="table display dataTable table-hover align-middle" style="width:100%">
		                                        <thead>
		                                            <tr>
		                                                <th class="product">Kết hợp</th>
		                                                <th class="product">Giá</th>
		                                                <th class="product">Giá khuyễn mãi</th>
		                                                <th class="quantity">Giảm giá (%)</th>
		                                                <th class="quantity">Thực thi</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody id="form-variant">
		                                            <?php
                                                    if (empty($dataProdVariants)) :
                                                    ?>
		                                                <tr>
		                                                    <td id="no-variant" colspan="4" class="text-center border-0 ">Chưa có biến thể..</td>
		                                                </tr>
		                                                <?php else :
                                                        foreach ($dataProdVariants as $dataProdVariantsItem) :
                                                            extract($dataProdVariantsItem);
                                                        ?>
		                                                    <tr id="form-input-item-${itemCounter}">
		                                                        <td>
		                                                            <input type="hidden" name="attribute[]" value="">
		                                                            <input type="text" readonly class="form-control" value="<?= $attribute_values ?>" placeholder="Tên kết hợp">
		                                                        </td>
		                                                        <td>

		                                                            <input type="number" class="form-control" value="<?= $price ?>" name="price_variant[]">
		                                                        </td>
		                                                        <td>

		                                                            <input type="number" class="form-control" name="sale_price_variant[]">
		                                                        </td>

		                                                        <td>
		                                                            <input type="number" readonly class="form-control" value="<?= $discount ?>">
		                                                        </td>

		                                                        <td>
		                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
		                                                                <button type="button" onclick="handleConfirm('admin/delete-product-variant/<?= $dataProd['id'] ?>/<?= $id ?>')" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
		                                                            </div>
		                                                        </td>
		                                                    </tr>
		                                            <?php endforeach;
                                                    endif; ?>

		                                        </tbody>
		                                    </table>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>



		        </form>

		    </div>
		</div><!-- Row end  -->