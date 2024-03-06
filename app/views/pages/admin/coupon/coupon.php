	<!-- Body: Body -->
	<div class="body d-flex py-3">
		<div class="container-xxl">
			<div class="row align-items-center">
				<div class="border-0 mb-4">
					<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
						<h3 class="fw-bold mb-0">Danh sách mã giảm giá</h3>
						<a href="admin/add-coupon" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm mã giảm giá</a>
					</div>
				</div>
			</div> <!-- Row end  -->
			<div class="row g-3 mb-3">
				<div class="col-md-12">
					<div class="card">
						<?php
						// echo '<pre>';
						// print_r($dataCoupon);
						// echo '</pre>';
						?>
						<div class="card-body">
							<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
								<thead>
									<tr>
										<th>Ảnh</th>
										<th>Ngày tạo mã</th>
										<th>Tiêu đề</th>
										<th>Mã</th>
										<th>Giá trị mã</th>
										<th>Giá tối thiểu</th>
										<th>Trạng thái</th>
										<th>Thực thi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($dataCoupon as $dataCouponItem) {
										extract($dataCouponItem);

									?>
										<tr>
											<td>
												<div class="d-flex align-items-center ">
													<img style="width: 50px;" class="rounded-2 me-3  object-fit-contain  " src="<?= $thumb ?>" alt="<?= $title ?>">

												</div>

											</td>
											<td><?= date('Y-m-d', strtotime($create_at)) ?></td>
											<td><?= $title ?></td>

											<td><?= $code ?></td>
											<td><?= $value ?></td>
											<td><?= Format::formatCurrency($min_amount) ?></td>
											<td>

												<span class="badge <?= strtotime($expired) < time() ? 'bg-danger' : 'bg-success' ?>"><?= strtotime($expired) < time() ? 'Hết hạn' : 'Công bố' ?></span>
											</td>
											<td>
												<div class="btn-group" role="group" aria-label="Basic outlined example">
													<a href="admin/update-coupon/<?= $id ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
													<button onclick="handleConfirm('admin/coupon/deleteCoupon/<?= $id ?>')" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
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