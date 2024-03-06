   <?php
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    ?>
   <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
       <div class="container">
           <div class="row">
               <!-- Sidebar Area Start -->
               <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                   <div class="ec-sidebar-wrap ec-border-box">
                       <!-- Sidebar Category Block -->
                       <div class="ec-sidebar-block">
                           <div class="ec-vendor-block">
                               <!-- <div class="ec-vendor-block-bg"></div>
                                <div class="ec-vendor-block-detail">
                                    <img class="v-img" src="public/client/images/user/1.jpg" alt="vendor image">
                                    <h5>Mariana Johns</h5>
                                </div> -->
                               <div class="ec-vendor-block-items">
                                   <ul>
                                       <li><a href="my-account">Hồ sơ của bạn</a></li>
                                       <li><a href="my-order">Lịch sử mua hàng</a></li>
                                       <li><a href="wishlist">Sản phẩm ưu thích</a></li>
                                       <li><a href="cart">Giỏ hàng</a></li>

                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="ec-shop-rightside col-lg-9 col-md-12">
                   <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                       <div class="ec-vendor-card-body">
                           <div class="row">
                               <div class="col-md-12">
                                   <div class="ec-vendor-block-profile">
                                       <div class="ec-vendor-block-img space-bottom-30">
                                           <div class="ec-vendor-block-bg">
                                               <a href="#" class="btn btn-lg btn-primary" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal">Chỉnh sửa chi tiết</a>
                                           </div>
                                           <div class="ec-vendor-block-detail">
                                               <img class="v-img" src="<?= $dataUserCurrent['avatar'] ?>" alt="<?= $dataUserCurrent['fullname'] ?>">
                                               <h5 class="name"><?= $dataUserCurrent['fullname'] ?></h5>
                                           </div>
                                           <p>Xin chào, <span><?= $dataUserCurrent['fullname'] ?>!</span></p>
                                           <p>Từ tài khoản của bạn, bạn có thể dễ dàng xem và theo dõi đơn hàng. Bạn có thể quản lý và thay đổi thông tin tài khoản của mình như địa chỉ, thông tin liên hệ và lịch sử đơn hàng.</p>
                                       </div>
                                       <h5>Thông tin tài khoản</h5>

                                       <div class="row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                   <h6>Địa chỉ E-mail <a href="javasript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                   <ul>
                                                       <li><strong>Email 1 : </strong><?= $dataUserCurrent['email'] ?></li>
                                                       <li><strong>Email 2 : </strong>...</li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                   <h6>Số điện thoại<a href="javasript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                   <ul>
                                                       <li><strong>Số điện thoại 1 : </strong><?= $dataUserCurrent['phone'] ?? '' ?></li>
                                                       <li><strong>Số điện thoại 2 : </strong>...</li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                   <h6>Địa chỉ<a href="javasript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                   <ul>
                                                       <li><strong>Địa chỉ : </strong><?= $dataUserCurrent['address'] ?? '' ?></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="ec-vendor-detail-block ec-vendor-block-address">
                                                   <h6>Địa chỉ giao hàng<a href="javasript:void(0)" data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                   <ul>
                                                       <li><strong>Địa chỉ : </strong><?= $dataUserCurrent['address'] ?? '' ?></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>

   <!-- Modal -->
   <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-body">
                   <div class="row">
                       <div class="ec-vendor-block-img space-bottom-30">
                           <div class="ec-vendor-block-bg cover-upload">
                               <div class="thumb-upload">
                                   <!-- <div class="thumb-edit">
                                       <input type='file' id="thumbUpload01" class="ec-image-upload" accept=".png, .jpg, .jpeg" />
                                       <label><i class="fi-rr-edit"></i></label>
                                   </div> -->
                                   <div class="thumb-preview ec-preview">
                                       <div class="image-thumb-preview">
                                           <img class="image-thumb-preview ec-image-preview v-img" src="public/client/images/banner/8.jpg" alt="edit" />
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="ec-vendor-block-detail">
                               <div class="thumb-upload">
                                   <div class="thumb-edit">
                                       <input type='file' id="thumbUpload02" class="ec-image-upload" name="avatar" accept=".png, .jpg, .jpeg" />
                                       <label><i class="fi-rr-edit"></i></label>
                                   </div>
                                   <div class="thumb-preview ec-preview">
                                       <div class="image-thumb-preview">
                                           <img class="image-thumb-preview ec-image-preview v-img" src="<?= $dataUserCurrent['avatar'] ?>" alt="<?= $dataUserCurrent['fullname'] ?>" />
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="ec-vendor-upload-detail">
                               <form class="row g-3" method="post" entries="multipart/form-data">
                                   <div class="col-md-6 space-t-15">
                                       <label class="form-label">Họ và tên</label>
                                       <input type="text" name="fullname" class="form-control" value="<?= $dataUserCurrent['fullname'] ?? '' ?>">
                                   </div>
                                   <div class="col-md-6 space-t-15">
                                       <label class="form-label">Địa chỉ email</label>
                                       <input type="email" name="email" class="form-control" value="<?= $dataUserCurrent['email'] ?? '' ?>">
                                   </div>
                                   <div class="col-md-12 space-t-15">
                                       <label class="form-label">Số điện thoại</label>
                                       <input type="text" name="phone" class="form-control" value="<?= $dataUserCurrent['phone'] ?? '' ?>">
                                   </div>
                                   <div class="col-md-12 space-t-15">
                                       <label class="form-label">Địa chỉ</label>
                                       <input type="text" name="address" class="form-control" value="<?= $dataUserCurrent['address'] ?? '' ?>">
                                   </div>

                                   <div class="col-md-12 space-t-15">
                                       <label class="form-label">Mật khẩu cũ</label>
                                       <input type="password" name="old_password" class="form-control">
                                   </div>

                                   <div class="col-md-12 space-t-15">
                                       <label class="form-label">Mật khẩu mới</label>
                                       <input type="password" name="new_password" class="form-control">
                                   </div>

                                   <div class="col-md-12 space-t-15">
                                       <label class="form-label">Nhập lại mật khẩu mới</label>
                                       <input type="password" name="re_new_password" class="form-control">
                                   </div>

                                   <div class="col-md-12 space-t-15">
                                       <button type="submit" class="btn btn-primary">Cập nhập</button>
                                       <a href="#" class="btn btn-lg btn-secondary qty_close" data-bs-dismiss="modal" aria-label="Close">Huỷ bỏ</a>
                                   </div>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Modal end -->