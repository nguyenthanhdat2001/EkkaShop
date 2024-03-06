   <!-- Ec Contact Us page -->
   <section class="ec-page-content section-space-p">
       <div class="container">
           <div class="row">
               <div class="ec-common-wrapper">
                   <div class="ec-contact-leftside">
                       <div class="ec-contact-container">
                           <div class="ec-contact-form">
                               <form method="post" action="contact/addContact">
                                   <span class="ec-contact-wrap">
                                       <label>Tên*</label>
                                       <input type="text" name="firstname" placeholder="Vui lòng nhập tên" required />
                                   </span>
                                   <span class="ec-contact-wrap">
                                       <label>Họ và tên đệm*</label>
                                       <input type="text" name="lastname" placeholder="Vui lòng nhập họ và tên đệm" required />
                                   </span>
                                   <span class="ec-contact-wrap">
                                       <label>Địa chỉ email*</label>
                                       <input type="email" name="email" placeholder="Vui lòng nhập địa chỉ email" required />
                                   </span>
                                   <span class="ec-contact-wrap">
                                       <label>Số điện thoại*</label>
                                       <input type="text" name="phone" placeholder="Vui lòng nhập số điện thoại" required />
                                   </span>
                                   <span class="ec-contact-wrap">
                                       <label>Nhận xét/Câu hỏi*</label>
                                       <textarea name="question" placeholder="Để lại lời nhắn ở đây.."></textarea>
                                   </span>

                                   <span class="ec-contact-wrap ec-contact-btn">
                                       <button class="btn btn-primary" type="submit">Gửi ngay</button>
                                   </span>
                               </form>
                           </div>
                       </div>
                   </div>
                   <div class="ec-contact-rightside">
                       <div class="ec_contact_map">
                           <div class="ec_map_canvas">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.698791990293!2d105.7967564758416!3d21.044734787228524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3b7c7e022d%3A0x22fac83799f69bc6!2zNDggUC4gSG_DoG5nIFPDom0sIE5naMSpYSDEkMO0LCBD4bqndSBHaeG6pXksIEjDoCBO4buZaSAxMDAwMDAsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1705318560994!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                           </div>
                       </div>
                       <div class="ec_contact_info">
                           <h1 class="ec_contact_info_head">Liên hệ với chung tôi</h1>
                           <ul class="align-items-center">
                               <li class="ec-contact-item"><i class="ecicon eci-map-marker" aria-hidden="true"></i><span>Địa chỉ :</span><?= $dataStoreCustom['address'] ?? '' ?></li>
                               <li class="ec-contact-item align-items-center"><i class="ecicon eci-phone" aria-hidden="true"></i><span>Số điện thoại :</span><a href="tel:<?= $dataStoreCustom['phone'] ?? '' ?>"><?= $dataStoreCustom['phone'] ?? '' ?></a></li>
                               <li class="ec-contact-item align-items-center"><i class="ecicon eci-envelope" aria-hidden="true"></i><span>Email :</span><a href="mailto:<?= $dataStoreCustom['email'] ?? '' ?>"><?= $dataStoreCustom['email'] ?? '' ?></a></li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>