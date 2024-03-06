	<!-- Body: Body -->
	<div class="body d-flex py-3">
		<div class="container-xxl">
			<div class="row align-items-center">
				<div class="border-0 mb-4">
					<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
						<h3 class="fw-bold mb-0">Danh sách sản phẩm</h3>
						<a href="admin/add-product" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm sản phẩm</a>
					</div>
				</div>
			</div> <!-- Row end  -->
			<div class="row g-3 mb-3">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
								<thead>
									<tr>
										<th>Tên sản phẩm</th>
										<th>Ngày nhập</th>
										<th>Danh mục</th>
										<th>Tồn kho </th>
										<th>Đơn giá </th>
										<th>Trạng thái</th>
										<th>Biến thể</th>
										<th>Đánh giá</th>
										<th>Thực thi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($prodData as $prodDataItem) {

									?>
										<tr>
											<td>
												<div class="d-flex align-items-center ">
													<img style="width: 50px;" class="rounded-2 me-3  object-fit-contain  " src="<?= $prodDataItem['thumb'] ?>" alt="<?= $prodDataItem['title'] ?>">
													<p class="mb-0 text-truncate " style="max-width: 200px"><?= $prodDataItem['title'] ?></p>
												</div>

											</td>
											<td><?= date('Y-m-d', strtotime($prodDataItem['create_at'])) ?></td>
											<td>
												<div class="d-flex align-items-start flex-column text-success ">
													<?php
													foreach ($cateData as $cateDataItem) {
														if ($cateDataItem['id'] == $prodDataItem['cate_id']) {
													?>
															<span class="fw-bold ">- <?= $cateDataItem['name'] ?? '' ?></span>
														<?php }
													}
													foreach ($brandData as $brandDataItem) {
														if ($brandDataItem['id'] == $prodDataItem['brand_id']) {
														?>
															<span class="fw-bold ">- <?= $brandDataItem['name'] ?? '' ?></span>
													<?php }
													} ?>
												</div>
											</td>
											<?php
											foreach ($productVariant as $prodVariantItem) {
												if ($prodVariantItem['prod_id'] == $prodDataItem['id']) {
											?>
													<td><?= $prodVariantItem['quantity'] ?></td>
													<td class=""><?= Format::formatCurrency($prodVariantItem['min_price']) . ' - ' . Format::formatCurrency($prodVariantItem['max_price']) ?></td>
													<td>
														<span class="badge <?= $prodDataItem['status'] == 0 || $prodVariantItem['quantity'] == 0 ? 'bg-danger' : 'bg-success' ?>"><?= $prodDataItem['status'] == 0 || $prodVariantItem['quantity'] == 0 ? 'Chưa công bố' : 'Công bố' ?></span>
													</td>
											<?php }
											} ?>


											<td><a class="link-dark  text-decoration-underline" href="admin/product-variants/<?= $prodDataItem['id'] ?>">Chi tiết</a></td>
											<td><a class="link-dark  text-decoration-underline" href="admin/rating-product/<?= $prodDataItem['id'] ?>">Chi tiết</a></td>
											<td>
												<div class="btn-group" role="group" aria-label="Basic outlined example">
													<a href="admin/update-product/<?= $prodDataItem['id'] ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
													<button onclick="handleConfirm('admin/delete-product/<?= $prodDataItem['id'] ?>')" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
												</div>
											</td>

										<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>