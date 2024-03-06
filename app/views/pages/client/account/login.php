   <!-- Ec login page -->
   <section class="ec-page-content section-space-p">
       <div class="container">
           <div class="row">
               <div class="col-md-12 text-center">
                   <div class="section-title">
                       <h2 class="ec-bg-title">Đăng nhập</h2>
                       <h2 class="ec-title">Đăng nhập</h2>
                       <p class="sub-title mb-3">Nơi tốt nhất để mua và bán các sản phẩm.</p>
                   </div>
               </div>
               <div class="ec-login-wrapper">
                   <div class="ec-login-container">
                       <div class="ec-login-form">
                           <form method="post">
                               <span class="ec-login-wrap">
                                   <label>Địa chỉ Email<small class="text-danger ">*</small></label>
                                   <input value="<?= $dataValueOld['email'] ?? '' ?>" type="text" name="email" placeholder="Nhập email của bạn" />
                               </span>
                               <span class="ec-login-wrap">
                                   <label>Mật khẩu<small class="text-danger ">*</small></label>
                                   <input value="<?= $dataValueOld['password'] ?? '' ?>" type="password" name="password" placeholder="Nhập mật khẩu của bạn" />
                               </span>
                               <span class="ec-login-wrap ec-login-fp">
                                   <label><a class="link-body-emphasis   " href="#">Quên mật khẩu?</a></label>
                               </span>
                               <span class="ec-login-wrap ec-login-btn ">
                                   <button class="btn btn-primary rounded-1" type="submit">Đăng nhập</button>
                                   <a href="signup" class="btn btn-secondary rounded-1">Đăng ký</a>
                               </span>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>