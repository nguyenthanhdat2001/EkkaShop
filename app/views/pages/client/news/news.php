    <!-- Ec Blog page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-blogs-rightside col-lg-12 col-md-12">

                    <!-- Blog content Start -->
                    <div class="ec-blogs-content">
                        <div class="ec-blogs-inner">
                            <div class="row">
                                <?php
                                foreach ($dataNews as $dataNewItem) {
                                    $urlLink = 'news/' . $dataNewItem['slug'] . '-' . $dataNewItem['id'];
                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-6 ec-blog-block">
                                        <div class="ec-blog-inner">
                                            <div class="ec-blog-image">
                                                <a href="<?= $urlLink ?>">
                                                    <img style="height: 260px; width: 100%; object-fit: cover;" class="blog-image" src="<?= $dataNewItem['thumb'] ?>" alt="<?= $dataNewItem['title'] ?>" />
                                                </a>
                                            </div>
                                            <div class="ec-blog-content">
                                                <h5 class="ec-blog-title"><a href="<?= $urlLink ?>"><?= $dataNewItem['title'] ?></a></h5>

                                                <div class="ec-blog-date">Bởi <span><?= $dataNewItem['fullname'] ?></span> / <?= $dataNewItem['create_at'] ?></div>
                                                <div class="ec-blog-desc"><?= $dataNewItem['title'] ?></div>

                                                <div class="ec-blog-btn"><a href="<?= $urlLink ?>" class="btn btn-primary">Đọc thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <!-- Ec Pagination Start -->
                        <!-- <div class="ec-pro-pagination">
                            <span>Showing 1-12 of 21 item(s)</span>
                            <ul class="ec-pro-pagination-inner">
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a class="next" href="#">Next <i class="ecicon eci-angle-right"></i></a></li>
                            </ul>
                        </div> -->
                        <!-- Ec Pagination End -->
                    </div>
                    <!--Blog content End -->
                </div>
            </div>
        </div>
    </section>