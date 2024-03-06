<!-- main body area -->


<!-- Body: Body -->
<?php

// echo '<pre>';
// print_r($totalRevenue);
// echo '</pre>';
?>
<div class="body d-flex py-3">
    <div class="container-xxl">

        <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
            <div class="col">
                <div class="alert-success alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fas fa-dollar-sign"></i></div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Doanh thu</div>
                            <span class="small"><?= Format::formatCurrency($totalRevenue) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="alert-danger alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-credit-card fa-lg"></i></div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Chi phí hàng</div>
                            <span class="small"><?= Format::formatCurrency($sumPurchaseOrder) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="alert-warning alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-smile"></i></div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Lợi nhuận ước tính</div>
                            <span class="small"><?= Format::formatCurrency($totalRevenue - $sumPurchaseOrder) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="alert-info alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Tổng sản phẩm</div>
                            <span class="small"><?= $prodCount ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row end  -->

        <div class="row g-3">
            <div class="col-lg-12 col-md-12">
                <!-- <div class="tab-filter d-flex align-items-center justify-content-between mb-3 flex-wrap">
                    <ul class="nav nav-tabs tab-card tab-body-header rounded  d-inline-flex w-sm-100">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#summery-today">Hôm nay</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#summery-week">Tuần</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#summery-month">Tháng</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#summery-year">Năm</a></li>
                    </ul>
                    <div class="date-filter d-flex align-items-center mt-2 mt-sm-0 w-sm-100">
                        <div class="input-group">
                            <input type="date" class="form-control">
                            <button class="btn btn-primary" type="button"><i class="icofont-filter fs-5"></i></button>
                        </div>
                    </div>
                </div> -->
                <div class="tab-content mt-1">
                    <div class="tab-pane fade show active" id="summery-today">
                        <div class="row g-1 g-sm-3 mb-3 row-deck">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Khách hàng</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= $userCount ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Đơn hàng</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= $orderCount ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Bán trung bình</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= Format::formatCurrency($totalRevenue / $totalSold) ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-sale-discount fs-3 color-santa-fe"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Bán mặt hàng trung bình</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= round($totalSold / $orderCount) ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-2 fs-3 color-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng doanh thu</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= Format::formatCurrency($totalRevenue) ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Lượng truy cập</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= rand(0, 10000) ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-users-social fs-3 color-light-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng số sản phẩm</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= $prodCount ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-bag fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng chi phí nhập hàng</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= Format::formatCurrency($sumPurchaseOrder) ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-star fs-3 color-lightyellow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Lợi nhuận ước tính</span>
                                            <div><span class="fs-6 fw-bold me-2"><?= Format::formatCurrency($totalRevenue - $sumPurchaseOrder) ?></span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-handshake-deal fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="summery-week">
                        <div class="row g-3 mb-4 row-deck">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Khách hàng</span>
                                            <div><span class="fs-6 fw-bold me-2">54,208</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Đơn hàng</span>
                                            <div><span class="fs-6 fw-bold me-2">12314</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Bán trung bình</span>
                                            <div><span class="fs-6 fw-bold me-2">$11770</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-sale-discount fs-3 color-santa-fe"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Bán mặt hàng trung bình</span>
                                            <div><span class="fs-6 fw-bold me-2">1185</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-2 fs-3 color-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng doanh thu</span>
                                            <div><span class="fs-6 fw-bold me-2">$135000</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Khách</span>
                                            <div><span class="fs-6 fw-bold me-2">111452</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-users-social fs-3 color-light-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng sản phẩm</span>
                                            <div><span class="fs-6 fw-bold me-2">194511</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-bag fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Mặt hàng bán chạy nhất</span>
                                            <div><span class="fs-6 fw-bold me-2">1122</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-star fs-3 color-lightyellow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Đại lý</span>
                                            <div><span class="fs-6 fw-bold me-2">132</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-handshake-deal fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="summery-month">
                        <div class="row g-3 mb-4 row-deck">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Khách hàng</span>
                                            <div><span class="fs-6 fw-bold me-2">74,208</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Đơn hàng</span>
                                            <div><span class="fs-6 fw-bold me-2">22314</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Bán trung bình</span>
                                            <div><span class="fs-6 fw-bold me-2">$21770</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-sale-discount fs-3 color-santa-fe"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Bán mặt hàng trung bình</span>
                                            <div><span class="fs-6 fw-bold me-2">2185</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-2 fs-3 color-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng doanh thu</span>
                                            <div><span class="fs-6 fw-bold me-2">$235000</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Khách</span>
                                            <div><span class="fs-6 fw-bold me-2">211452</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-users-social fs-3 color-light-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng sản phẩm</span>
                                            <div><span class="fs-6 fw-bold me-2">284511</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-bag fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Mặt hàng bán chạy nhất</span>
                                            <div><span class="fs-6 fw-bold me-2">222</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-star fs-3 color-lightyellow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Đại lý</span>
                                            <div><span class="fs-6 fw-bold me-2">232</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-handshake-deal fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="summery-year">
                        <div class="row g-3 mb-4 row-deck">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Khách hàng</span>
                                            <div><span class="fs-6 fw-bold me-2">104,208</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Đơn hàng</span>
                                            <div><span class="fs-6 fw-bold me-2">252314</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Trung bình bán</span>
                                            <div><span class="fs-6 fw-bold me-2">$852770</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-sale-discount fs-3 color-santa-fe"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Bán mặt hàng trung bình</span>
                                            <div><span class="fs-6 fw-bold me-2">75885</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-2 fs-3 color-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng doanh thu</span>
                                            <div><span class="fs-6 fw-bold me-2">$350000</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Khách</span>
                                            <div><span class="fs-6 fw-bold me-2">114521452</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-users-social fs-3 color-light-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Tổng sản phẩm</span>
                                            <div><span class="fs-6 fw-bold me-2">884511</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-bag fs-3 color-light-orange"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Mặt hàng bán chạy nhất</span>
                                            <div><span class="fs-6 fw-bold me-2">7522</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-star fs-3 color-lightyellow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <span class="text-muted">Đại lý</span>
                                            <div><span class="fs-6 fw-bold me-2">1832</span></div>
                                        </div>
                                        <div class="right-icon">
                                            <i class="icofont-handshake-deal fs-3 color-lavender-purple"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div><!-- Row end  -->

        <!-- <div class="row g-3 mb-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="m-0 fw-bold">Sắp ra mắt</h6>
                    </div>
                    <div class="card-body">
                        <div id="apex-GenderOverview"></div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row g-3 mb-3">
            <div class="col-xxl-12 col-xl-12">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="m-0 fw-bold">Doanh thu cửa hàng</h6>
                    </div>
                    <div class="card-body">
                        <div class="ac-line-transparent" id="report-chart"></div>
                    </div>
                </div>

            </div>


        </div><!-- Row end  -->
        <div class="row g-3 mb-3">
            <div class="col-xxl-6 col-xl-6">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="m-0 fw-bold">Sản phẩm danh mục</h6>
                    </div>
                    <div class="card-body">
                        <div id="productCate"></div>
                    </div>
                </div>

            </div>

            <div class="col-xxl-6 col-xl-6">

                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="m-0 fw-bold">Lượng người dùng</h6>
                    </div>
                    <div class="card-body">
                        <div id="apex-radar-polygon-fill"></div>
                    </div>
                </div>
            </div>


        </div><!-- Row end  -->


        <div class="row g-3 mb-3">


        </div><!-- Row end  -->



        <!-- <div class="row g-3 mb-3 row-deck">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="m-0 fw-bold">Trạng thái người dùng đang hoạt động</h6>
                    </div>
                    <div class="card-body">
                        <div class="p-4 active-user bg-lightblue rounded-2 mb-2">
                            <span class="fw-bold d-flex justify-content-center fs-3"><?= $userCount ?></span>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Các trang đang hoạt động</th>
                                        <th scope="col">Người dùng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">sản phẩm</a></td>
                                        <td>21</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">giỏ hàng sản phẩm</a></td>
                                        <td>455</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">hồ sơ quản trị</a></td>
                                        <td>45</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Lịch sử đặt hàng</a></td>
                                        <td>545</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">chi tiết sản phẩm</a></td>
                                        <td>55</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="m-0 fw-bold">Chi phí trung bình</h6>
                    </div>
                    <div class="card-body">
                        <div class="h2 mb-0">$1105.5</div>
                        <span class="text-muted small">Chi phí trung bình cả tháng</span>
                        <div id="apex-expense"></div>
                    </div>
                </div>
            </div>
        </div> -->



    </div>
</div>