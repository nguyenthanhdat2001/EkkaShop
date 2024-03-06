   <!-- Ec login page -->
   <section class="ec-page-content section-space-p">
       <div class="container">
           <div class="row">
               <div class="col-md-12 text-center">
                   <div class="section-title">
                       <h2 class="ec-bg-title">Đăng ký</h2>
                       <h2 class="ec-title">Đăng ký</h2>
                       <p class="sub-title mb-3">Nơi tốt nhất để mua và bán các sản phẩm.</p>
                   </div>
               </div>
               <div class="ec-login-wrapper">
                   <div class="ec-login-container">
                       <div class="ec-login-form">
                           <form method="post" id="formRegister">
                               <div class="form-group mb-3 ">
                                   <label>Họ và tên</label>
                                   <input type="text" class="form-control mb-0 " name="fullname" placeholder="Họ và tên">

                               </div>

                               <div class="form-group mb-3 ">
                                   <label>Email</label>
                                   <input type="text" class="form-control mb-0 " id="emailLogin" name="email" placeholder="Email">
                                   <div class="invalid-feedback">
                                       Email đã tồn tại.
                                   </div>
                               </div>

                               <div class="form-group mb-3 ">
                                   <label>Mật khẩu</label>
                                   <input type="password" class="form-control mb-0 " id="passwordLogin" name="password" placeholder="Mật khẩu">
                                   <div class="invalid-feedback ">
                                       Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.
                                   </div>
                               </div>

                               <!-- <div class="form-group mb-3 ">
                                   <label>Nhập lại mật khẩu</label>
                                   <input type="password" class="form-control mb-0 " id="re_passwordLogin" name="re_password" placeholder="Nhập lại mật khẩu">
                                   <div class="invalid-feedback ">
                                       Mật khẩu chưa khớp.
                                   </div>
                               </div> -->

                               <span class="ec-login-wrap ec-login-btn ">
                                   <button id="btn_ele" class="btn btn-primary rounded-1" onclick="registerUser()" type="button">Đăng ký</button>
                               </span>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>