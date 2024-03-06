<!-- Ec login page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Quên mật khẩu?</h2>
                    <h2 class="ec-title">Quên mật khẩu?</h2>
                    <p class="sub-title mb-3">Vui lòng nhập địa chỉ email bạn đã sử dụng khi đăng ký, chúng tôi sẽ gửi hướng dẫn để đặt lại mật khẩu của bạn.</p>
                </div>
            </div>
            <div class="ec-login-wrapper">
                <div class="ec-login-container">
                    <div class="ec-login-form">
                        <form method="post" id="formForgot">
                            <span class="ec-login-wrap">
                                <label>Địa chỉ Email<small class="text-danger ">*</small></label>
                                <input value="<?= $dataValueOld['email'] ?? '' ?>" type="text" name="email" placeholder="Nhập email của bạn" />
                            </span>

                            <span class="ec-login-wrap ec-login-btn ">
                                <button class="btn btn-primary rounded-1 " id="btn_ele" onclick="forgotPasswordUser()" type="button">Gửi ngay</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>