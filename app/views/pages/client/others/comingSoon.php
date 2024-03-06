	<!-- Start Header Section -->
	<section id="hero-section" class="hero-section particles">
		<div class="container-fluid main-container">
			<div class="row">
				<div class="col-md-12 p-0">
					<div class="main-block">
						<div id="particles-js"></div>
						<div class="main-info">
							<div class="hero-container">
								<div class="hero-counter">
									<div class="hero-detail">
										<div class="logo">
											<img src="<?= $dataStoreCustom['logo'] ?? '' ?>" alt="logo">
										</div>
										<h1 class="title">Đang <span>phát triển</span> sớm.</h1>
										<p class="hero-counter-desc">Chúng tôi đang trong quá trình phát triển và sẽ quay lại lại sớm và mang lại trải nghiệm tốt nhất.</p>
										<!-- Countdown -->
										<span class="counter">
											<span id="timer" data-date="September 30, 2023 19:15:10 PDT"></span>
										</span>
										<!-- END Countdown -->
										<!-- Newsletter -->
										<form class="subscribe_form" id="subscribe_form" method="post">
											<div class="input-group">
												<input type="email" id="subscribe_email" class="form-control" name="email" placeholder="Enter your email">
												<button class="btn btn-default button" id="subscribe_btn" type="button"><span class="btn-text">Đăng ký</span></button>
												<span id="success" class="validation">Cảm ơn đã đăng ký!</span>
												<span id="warning" class="validation">Vui lòng nhập email.</span>
												<span id="faild" class="validation">Đăng ký thất bại!!!</span>
											</div>
										</form>
										<!-- End Newsletter -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Header Section -->