<!-- sidebar -->

<div class="sidebar px-4 py-4 py-md-4 me-0">
        <div class="d-flex flex-column h-100">
                <a href="admin/dashboard" class="mb-0 brand-icon">
                        <span class="logo-icon">
                                <i class="bi bi-bag-check-fill fs-4"></i>
                        </span>
                        <span class="logo-text"><?= $dataStoreCustom['name'] ?></span>
                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3">

                        <li><a class="m-link <?= $active == 'dashboard' ? 'active' : '' ?>" href="admin/dashboard"><i class="icofont-home fs-5"></i>
                                        <span>Bảng điều khiển</span></a></li>

                        <li><a class="m-link <?= $active == 'brand' ? 'active' : '' ?>" href="admin/brand"><i class="icofont-brand-mts fs-5"></i>
                                        <span>Thương hiệu</span></a></li>

                        <li><a class="m-link <?= $active == 'coupon' ? 'active' : '' ?>" href="admin/coupon"><i class="icofont-sale-discount fs-5"></i>
                                        <span>Mã giảm giá</span></a></li>

                        <li><a class="m-link <?= $active == 'category' ? 'active' : '' ?>" href="admin/category"><i class="icofont-chart-flow fs-5"></i>
                                        <span>Danh mục </span></a></li>

                        <li><a class="m-link <?= $active == 'attributes' ? 'active' : '' ?>" href="admin/attributes"><i class="icofont-swirl fs-5"></i>
                                        <span>Thuộc tính </span></a></li>


                        <li><a class="m-link <?= $active == 'product' ? 'active' : '' ?>" href="admin/product"><i class="icofont-truck-loaded fs-5"></i>
                                        <span>Sản phẩm</span></a></li>

                        <li><a class="m-link <?= $active == 'suppliers' ? 'active' : '' ?>" href="admin/suppliers"><i class="icofont-table fs-5 "></i>
                                        <span>Nhà cung cấp</span></a></li>

                        <li><a class="m-link <?= $active == 'purchaseOrder' ? 'active' : '' ?>" href="admin/purchaseOrder"><i class="icofont-ui-cart fs-5"></i>
                                        <span>Hàng nhập</span></a></li>

                        <li><a class="m-link <?= $active == 'user' ? 'active' : '' ?>" href="admin/user"><i class="icofont-funky-man fs-5 "></i>
                                        <span>Khách hàng</span></a></li>

                        <li><a class="m-link <?= $active == 'order' ? 'active' : '' ?>" href="admin/order"><i class="icofont-notepad fs-5"></i>
                                        <span>Đơn đặt hàng</span></a></li>


                        <li><a class="m-link <?= $active == 'news' ? 'active' : '' ?>" href="admin/news"><i class="icofont-law-document fs-5"></i>
                                        <span>Bài viết</span></a></li>

                        <li><a class="m-link <?= $active == 'storeCustom' ? 'active' : '' ?>" href="admin/store"><i class="icofont-presentation-alt fs-5 "></i>
                                        <span>Cửa hàng</span></a></li>

                        <li><a class="m-link <?= $active == 'banner' ? 'active' : '' ?>" href="admin/banner">
                                        <i class="icofont-unity-hand fs-5 "></i>
                                        <span>Banner</span></a></li>


                </ul>

                <!-- Menu: menu collepce btn -->
                <button type=" button" class="btn btn-link sidebar-mini-btn text-light">
                        <span class="ms-2"><i class="icofont-bubble-right"></i></span>
                </button>
        </div>
</div>