		<!-- Body: Body -->
		<div class="body d-flex py-3">
		    <div class="container-xxl">
		        <form action="" method="post" enctype="multipart/form-data">
		            <div class="row align-items-center">
		                <div class="border-0 mb-4">
		                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
		                        <h3 class="fw-bold mb-0">Thêm bài viết mới</h3>
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
		                                    <input class="form-check-input" value="1" id="public" type="radio" name="status" checked>
		                                    <label for="public" class="form-check-label">
		                                        Công khai
		                                    </label>
		                                </div>
		                                <div class="form-check">
		                                    <input class="form-check-input" value="0" id="hidden" type="radio" name="status">
		                                    <label for="hidden" class="form-check-label">
		                                        Không công khai
		                                    </label>
		                                </div>

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
		                                    <label class="form-label">Tiêu đề bài viết mới</label>
		                                    <input type="text" value="<?= $dataValueOld['title'] ?? '' ?>" name="title" class="form-control">
		                                </div>

		                                <div class="col-md-12">
		                                    <label class="form-label">Nội dung bài viết</label>
		                                    <textarea id="editor" name="content" class="form-control">
												<?php
                                                if (empty($dataValueOld['content'])) {
                                                ?>
												<h1>Viết Nội dung ở đây..</h1>
												<?php } ?>
												<?= $dataValueOld['content'] ?? '' ?>
											</textarea>
		                                </div>

		                            </div>
		                        </div>
		                    </div>

		                    <div class="card mb-3">
		                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
		                            <h6 class="mb-0 fw-bold ">Ảnh bài viết mới</h6>
		                        </div>
		                        <div class="card-body">
		                            <div class="row g-3 align-items-center">
		                                <div class="col-md-12">
		                                    <label class="form-label">Tải lên hình ảnh bài viết mới</label>
		                                    <small class="d-block text-muted mb-2">Chỉ hình ảnh dọc hoặc hình vuông,
		                                        Đúng định dạng file (jpg, png, webp) tối đa 5MB.</small>
		                                    <input type="file" name="thumb" id="input-file-to-destroy" class="dropify" data-allowed-formats="portrait square" data-max-file-size="5M" data-max-height="2000">
		                                </div>

		                            </div>
		                        </div>
		                    </div>

		                </div>
		            </div><!-- Row end  -->
		            <form />
		    </div>
		</div>