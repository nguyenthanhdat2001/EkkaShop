    <!-- Footer Start -->
    <footer class="ec-footer section-space-mt">
        <div class="footer-container">
            <div class="footer-top section-space-footer-p">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-3 ec-footer-contact">
                            <div class="ec-footer-widget">
                                <div class="ec-footer-logo"><a href="#"><img src="<?= $dataStoreCustom['logo'] ?>" alt="">
                                        <img class="dark-footer-logo" src="<?= $dataStoreCustom['logo'] ?>" alt="Site Logo" style="display: none;" /></a></div>
                                <h4 class="ec-footer-heading">Liên hệ với chúng tôi</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><?= $dataStoreCustom['address'] ?>.</li>
                                        <li class="ec-footer-link"><span>Gọi cho chúng tôi:</span><a href="tel:<?= $dataStoreCustom['phone'] ?>"><?= $dataStoreCustom['phone'] ?></a></li>
                                        <li class="ec-footer-link"><span>Email:</span><a href="mailto:<?= $dataStoreCustom['email'] ?>"><?= $dataStoreCustom['email'] ?></a>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-info">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Thông tin</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="contact">Giới thiệu về chúng tôi</a></li>
                                        <li class="ec-footer-link"><a href="comming-soon">Câu hỏi thường gặp</a></li>
                                        <li class="ec-footer-link"><a href="comming-soon">Thông tin giao hàng</a>
                                        </li>
                                        <li class="ec-footer-link"><a href="contact">Liên hệ với chúng tôi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-account">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Tài khoản</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="my-account">Tài khoản của tôi</a></li>
                                        <li class="ec-footer-link"><a href="order">Lịch sử đặt hàng</a></li>
                                        <li class="ec-footer-link"><a href="wishlist">Danh sách mong muốn</a></li>
                                        <li class="ec-footer-link"><a href="coupon">Đặc biệt</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-service">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Dịch vụ</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="comming-soon">Giảm giá hoàn trả</a></li>
                                        <li class="ec-footer-link"><a href="comming-soon">Chính sách & chính sách </a>
                                        </li>
                                        <li class="ec-footer-link"><a href="comming-soon">Dịch vụ khách hàng</a>
                                        </li>
                                        <li class="ec-footer-link"><a href="comming-soon">Điều khoản & điều kiện</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3 ec-footer-news">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Bản tin</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">Nhận thông tin cập nhật tức thì về các sản phẩm mới của chúng tôi và
                                            khuyến mãi đặc biệt!</li>
                                    </ul>
                                    <div class="ec-subscribe-form">
                                        <form id="ec-newsletter-form" name="ec-newsletter-form" Method="post" action="#">
                                            <div id="ec_news_signup" class="ec-form">
                                                <input class="ec-email" type="email" require="" placeholder="Nhập email của bạn vào đây..." name="ec-email" value="" />
                                                <button id="ec-news-btn" class="button btn-primary" type="button" name="subscribe" value=""><i class="ecicon eci-paper-plane-o" aria- ẩn="true"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Footer social Start -->
                        <div class="col text-left footer-bottom-left">
                            <div class="footer-bottom-social">
                                <span class="social-text text-upper">Theo dõi chúng tôi trên:</span>
                                <ul class="mb-0">
                                    <li class="list-inline-item"><a class="hdr-facebook" href="#"><i class="ecicon eci-facebook"></i></a></li>
                                    <li class="list-inline-item"><a class="hdr-twitter" href="#"><i class="ecicon eci-twitter"></i></a></li>
                                    <li class="list-inline-item"><a class="hdr-instagram" href="#"><i class="ecicon eci-instagram"></i></a></li>
                                    <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i class="ecicon eci-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer social End -->
                        <!-- Footer Copyright Start -->
                        <div class="col text-center footer-copy">
                            <div class="footer-bottom-copy ">
                                <div class="ec-copy">Copyright © 2023 <a class="site-name text-upper" href="#">Nguyễn Thành Đạt<span>.</span></a>. All Rights Reserved</div>
                            </div>
                        </div>
                        <!-- Footer Copyright End -->
                        <!-- Footer payment -->
                        <div class="col footer-bottom-right">
                            <div class="footer-bottom-payment d-flex justify-content-end">
                                <div class="payment-link">
                                    <img src="public/client/images/icons/payment.png" alt="">
                                </div>

                            </div>
                        </div>
                        <!-- Footer payment -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- Footer navigation panel for responsive display -->
    <div class="ec-nav-toolbar">
        <div class="container">
            <div class="ec-nav-panel">
                <div class="ec-nav-panel-icons">
                    <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i class="fi-rr-menu-burger"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i class="fi-rr-shopping-bag"></i><span class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="index.html" class="ec-header-btn"><i class="fi-rr-home"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="wishlist.html" class="ec-header-btn"><i class="fi-rr-heart"></i><span class="ec-cart-noti">4</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="login.html" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer navigation panel for responsive display end -->