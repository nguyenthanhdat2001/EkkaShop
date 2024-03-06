  <!-- Ec Blog page -->
  <section class="ec-page-content section-space-p">
      <div class="container">
          <div class="row">
              <div class="ec-blogs-rightside col-lg-8 order-lg-last col-md-12 order-md-first">

                  <!-- Blog content Start -->
                  <div class="ec-blogs-content">
                      <div class="ec-blogs-inner">
                          <div class="ec-blog-date">
                              <p class="date"><?= $dataNew['create_at'] ?> - </p><a href="javascript:void(0)"><?= $dataNew['view'] ?> Lượt xem</a>
                          </div>
                          <div class="ec-blog-detail">
                              <h3 class="ec-blog-title"><?= $dataNew['title'] ?></h3>
                              <?= $dataNew['content'] ?>
                          </div>


                          <!-- <div class="ec-blog-comments">
                              <div class="ec-blog-cmt-preview">
                                  <div class="ec-blog-comment-wrapper mt-55">
                                      <h4 class="ec-blog-dec-title">Comments : 05</h4>
                                      <div class="ec-single-comment-wrapper mt-35">
                                          <div class=" ec-blog-user-img">
                                              <img src="assets/images/blog-image/9.jpg" alt="blog image">
                                          </div>
                                          <div class="ec-blog-comment-content">
                                              <h5>John Deo</h5>
                                              <span>October 14, 2018 </span>
                                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                  eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim
                                                  ad minim veniam, </p>
                                              <div class="ec-blog-details-btn">
                                                  <a href="javascript:void(0)">Reply</a>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="ec-single-comment-wrapper mt-50 ml-150">
                                          <div class="ec-blog-user-img">
                                              <img src="assets/images/blog-image/10.jpg" alt="blog image">
                                          </div>
                                          <div class="ec-blog-comment-content">
                                              <h5>Jenifer lowes</h5>
                                              <span>October 14, 2018 </span>
                                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                  eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim
                                                  ad minim veniam, </p>
                                              <div class="ec-blog-details-btn">
                                                  <a href="javascript:void(0)">Reply</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="ec-blog-cmt-form">
                                  <div class="ec-blog-reply-wrapper mt-50">
                                      <h4 class="ec-blog-dec-title">Leave A Reply</h4>
                                      <form class="ec-blog-form" action="#">
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <div class="ec-leave-form">
                                                      <input type="text" placeholder="Full Name">
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="ec-leave-form">
                                                      <input type="email" placeholder="Email Address ">
                                                  </div>
                                              </div>
                                              <div class="col-md-12">
                                                  <div class="ec-text-leave">
                                                      <textarea placeholder="Message"></textarea>
                                                      <a href="#" class="btn btn-lg btn-secondary">Order Now</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div> -->
                      </div>
                  </div>
                  <!--Blog content End -->
              </div>
              <!-- Sidebar Area Start -->
              <div class="ec-blogs-leftside col-lg-4 order-lg-first col-md-12 order-md-last">
                  <div class="ec-blog-search">
                      <form class="ec-blog-search-form" action="#">
                          <input class="form-control" placeholder="Search Our Blog" type="text">
                          <button class="submit" type="submit"><i class="ecicon eci-search"></i></button>
                      </form>
                  </div>
                  <div class="ec-sidebar-wrap">
                      <!-- Sidebar Recent Blog Block -->
                      <div class="ec-sidebar-block ec-sidebar-recent-blog">
                          <div class="ec-sb-title">
                              <h3 class="ec-sidebar-title">Tin nổi bật</h3>
                          </div>
                          <div class="ec-sb-block-content">
                              <?php
                                foreach ($dataNews as $item) {

                                ?>
                                  <div class="ec-sidebar-block-item">
                                      <h5 class="ec-blog-title"><a href="news/<?= $item['slug'] . '-' . $item['id'] ?>"><?= $item['title'] ?></a></h5>
                                      <div class="ec-blog-date"><?= $item['create_at'] ?></div>
                                  </div>
                              <?php } ?>

                          </div>
                      </div>
                      <!-- Sidebar Recent Blog Block -->
                      <!-- Sidebar Category Block -->
                      <!-- <div class="ec-sidebar-block">
                          <div class="ec-sb-title">
                              <h3 class="ec-sidebar-title">Categories</h3>
                          </div>
                          <div class="ec-sb-block-content">
                              <ul>
                                  <li>
                                      <div class="ec-sidebar-block-item">
                                          <input type="checkbox" checked /> <a href="#">clothes</a><span class="checked"></span>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="ec-sidebar-block-item">
                                          <input type="checkbox" /> <a href="#">Bags</a><span class="checked"></span>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="ec-sidebar-block-item">
                                          <input type="checkbox" /> <a href="#">Shoes</a><span class="checked"></span>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="ec-sidebar-block-item">
                                          <input type="checkbox" /> <a href="#">cosmetics</a><span class="checked"></span>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="ec-sidebar-block-item">
                                          <input type="checkbox" /> <a href="#">electrics</a><span class="checked"></span>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="ec-sidebar-block-item">
                                          <input type="checkbox" /> <a href="#">phone</a><span class="checked"></span>
                                      </div>
                                  </li>
                                  <li id="ec-more-toggle-content" style="padding: 0; display: none;">
                                      <ul>
                                          <li>
                                              <div class="ec-sidebar-block-item">
                                                  <input type="checkbox" /> <a href="#">Watch</a><span class="checked"></span>
                                              </div>
                                          </li>
                                          <li>
                                              <div class="ec-sidebar-block-item">
                                                  <input type="checkbox" /> <a href="#">Cap</a><span class="checked"></span>
                                              </div>
                                          </li>
                                      </ul>
                                  </li>
                                  <li>
                                      <div class="ec-sidebar-block-item ec-more-toggle">
                                          <span class="checked"></span><span id="ec-more-toggle">More
                                              Categories</span>
                                      </div>
                                  </li>

                              </ul>
                          </div>
                      </div> -->
                      <!-- Sidebar Category Block -->
                  </div>
              </div>
          </div>
      </div>
  </section>