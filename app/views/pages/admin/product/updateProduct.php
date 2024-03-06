		<!-- Body: Body -->
		<div class="body d-flex py-3">
			<div class="container-xxl">
				<form method="post" enctype="multipart/form-data">

					<div class="row align-items-center">
						<div class="border-0 mb-4">
							<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
								<h3 class="fw-bold mb-0">Cập nhập sản phẩm</h3>
								<button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Lưu</button>
							</div>
						</div>
					</div> <!-- Row end  -->

					<div class="row g-3 mb-3">
						<div class="col-xl-4 col-lg-4">
							<div class="sticky-lg-top">
								<div class="card mb-3">
									<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
										<h6 class="m-0 fw-bold">Trạng thái hiển thị</h6>
									</div>
									<div class="card-body">
										<div class="form-check">
											<input class="form-check-input" value="1" id="radio1Public" type="radio" name="status" <?= $dataProd['status'] == 1 ? 'checked' : '' ?>>
											<label for="radio1Public" class="form-check-label">
												Công khai
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" value="0" id="radio1Hiden" type="radio" name="status" <?= $dataProd['status'] == 0 ? 'checked' : '' ?>>

											<label for="radio1Hiden" class="form-check-label">
												Ẩn
											</label>
										</div>

									</div>
								</div>

								<div class="card mb-3">
									<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
										<h6 class="m-0 fw-bold">Giá sản phẩm</h6>
									</div>
									<div class="card-body">
										<div class="row g-3 align-items-center">
											<div class="col-md-12">
												<label class="form-label">Giá </label>
												<input type="number" value="<?= $dataProd['price'] ?? '' ?>" name="price" class="form-control">
											</div>
											<div class="col-md-12">
												<label class="form-label">Giá khuyến mãi</label>
												<input type="number" name="sale_price" class="form-control">
											</div>
											<div class="col-md-12">
												<label class="form-label">Giảm giá (%)</label>
												<input type="text" value="<?= $dataProd['discount'] ?? '' ?>" readonly class="form-control">
											</div>
										</div>
									</div>
								</div>


								<div class="card mb-3">
									<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
										<h6 class="m-0 fw-bold">Danh mục</h6>
									</div>
									<div class="card-body">
										<label class="form-label">Lựa chọn danh mục</label>
										<select class="form-select" name="cate_id">
											<?php
											foreach ($cateData as $cateDataItem) {
												$selectedCate = $dataProd['cate_id'] == $cateDataItem['id'] ? 'selected' : '';
											?>
												<option <?= $selectedCate ?> value="<?= $cateDataItem['id'] ?>"><?= $cateDataItem['name'] ?></option>
											<?php } ?>

										</select>
									</div>
								</div>

								<div class="card mb-3">
									<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
										<h6 class="m-0 fw-bold">Thương hiệu</h6>
									</div>
									<div class="card-body">
										<label class="form-label">Lựa chọn thương hiệu</label>
										<select class="form-select" name="brand_id">
											<?php
											foreach ($brandData as $brandDataItem) {
												$selectedBrand = $dataProd['brand_id'] == $brandDataItem['id'] ? 'selected' : '';
											?>
												<option <?= $selectedBrand ?> value="<?= $brandDataItem['id'] ?>"><?= $brandDataItem['name'] ?></option>
											<?php } ?>

										</select>
									</div>
								</div>

							</div>
						</div>
						<div class="col-xl-8 col-lg-8">
							<div class="card mb-3">
								<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
									<h6 class="mb-0 fw-bold ">Thông tin cơ bản</h6>
								</div>
								<div class="card-body">
									<div class="row g-3 align-items-center">
										<div class="col-md-12">
											<label class="form-label">Tiêu đề sản phẩm</label>
											<input type="text" value="<?= $dataProd['title'] ?? '' ?>" name="title" class="form-control">
										</div>

										<div class="col-md-12">
											<label class="form-label">Mô tả ngắn</label>
											<textarea class="form-control" name="short_description" cols="30" rows="5"><?= $dataProd['short_description'] ?? '' ?></textarea>
										</div>

										<div class="col-md-12">
											<label class="form-label">Mô tả </label>
											<textarea id="editor" name="description" class="form-control">
												<?php
												if (empty($dataProd['description'])) {
												?>
												<h1>Viết mô tả ở đây..</h1>
												<?php } ?>
												<?= $dataProd['description'] ?? '' ?>
											</textarea>
										</div>
									</div>
								</div>
							</div>



							<!-- Biến thể -->
							<div class="card mb-3">
								<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
									<h6 class="mb-0 fw-bold ">Biến thể</h6>
									<a class="text-decoration-underline" href="admin/product-variants/<?= $dataProd['id'] ?>">Xem biến thể</a>
								</div>

							</div>

							<div class="card mb-3">
								<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
									<h6 class="mb-0 fw-bold ">Ảnh đại diện</h6>
								</div>
								<div class="card-body">
									<div class="row g-3 align-items-center">
										<div class="col-md-12">
											<label class="form-label">Tải lên 1 hình ảnh đại diện</label>
											<small class="d-block text-muted mb-2">Chỉ hình ảnh dọc hoặc hình vuông,
												Đúng định dạng file (jpg, png, webp) tối đa 5MB/1 ảnh.</small>
											<input type="file" name="thumb" class="dropify">
										</div>

									</div>
									<div class="mt-4 gap-3 flex-wrap  d-flex">
										<?php
										if (empty($dataProd['thumb'])) {
										?>
											<span class="text-center ">Chưa có ảnh..</span>
										<?php } else { ?>
											<div class="position-relative">
												<img class="border p-2" style="width: 150px; display: block; object-fit: contain; border-radius: 10px;" src="<?= $dataProd['thumb'] ?? '' ?>" alt="<?= $dataProd['title'] ?? '' ?>">
												<!-- <a class="btn btn-outline-light text-light position-absolute text-center bg-danger d-inline-flex align-items-center justify-content-center" style="border-radius: 100%; width: 24px; height: 24px; line-height: 1; right: -9px; top: -9px; " href="">x</a> -->
											</div>
										<?php } ?>


									</div>
								</div>
							</div>

							<div class="card mb-3">
								<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
									<h6 class="mb-0 fw-bold ">Ảnh phụ</h6>
								</div>
								<div class="card-body">
									<div class="row g-3 align-items-center">
										<div class="col-md-12">
											<label class="form-label">Tải lên nhiều hình ảnh phụ</label>
											<small class="d-block text-muted mb-2">Chỉ hình ảnh dọc hoặc hình vuông,
												Đúng định dạng file (jpg, png, webp) tối đa 5MB/1 ảnh.</small>
											<input type="file" name="images[]" multiple class="dropify">
										</div>
										<div class="mt-4 gap-3 flex-wrap  d-flex">
											<?php if (empty($prodImages)) : ?>
												<span class="text-center ">Chưa có ảnh..</span>
											<?php else : ?>
												<?php foreach ($prodImages as $prodImagesItem) : ?>
													<div class="position-relative">
														<img class="border p-2" style="width: 150px; display: block; object-fit: contain; border-radius: 10px;" src="<?= $prodImagesItem['image'] ?? '' ?>" alt="<?= $dataProd['title'] ?? '' ?>">
														<a class="btn btn-outline-light text-light position-absolute text-center bg-danger d-inline-flex align-items-center justify-content-center" style="border-radius: 100%; width: 24px; height: 24px; line-height: 1; right: -9px; top: -9px; " href="admin/delete-product-image/<?= $prodImagesItem['id'] . '/' . $dataProd['id'] ?>">x</a>
													</div>
												<?php endforeach; ?>
											<?php endif; ?>


										</div>
									</div>
								</div>
							</div>


						</div>
					</div><!-- Row end  -->
				</form>
			</div>
		</div>