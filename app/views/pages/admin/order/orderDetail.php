	<!-- Body: Body -->
	<div class="body d-flex py-3">
	    <div class="container-xxl">
	        <div class="row align-items-center">
	            <?php
                // echo '<pre>';
                // print_r($dataOrder);
                // echo '</pre>';
                ?>
	            <div class="border-0 mb-4">
	                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
	                    <h3 class="fw-bold mb-0">Chi tiết đơn hàng: #<?= $dataOrder[0]['order_code'] ?></h3>

	                </div>
	            </div>
	        </div> <!-- Row end  -->
	        <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
	            <div class="col">
	                <div class="alert-success alert mb-0">
	                    <div class="d-flex align-items-center">
	                        <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></div>
	                        <div class="flex-fill ms-3 text-truncate">
	                            <div class="h6 mb-0">Đơn hàng được tạo tại</div>
	                            <span class="small"><?= $dataOrder[0]['order_date'] ?></span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="alert-danger alert mb-0">
	                    <div class="d-flex align-items-center">
	                        <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-user fa-lg" aria-hidden="true"></i></div>
	                        <div class="flex-fill ms-3 text-truncate">
	                            <div class="h6 mb-0">Tên</div>
	                            <span class="small"><?= $dataOrder[0]['fullname'] ?></span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="alert-warning alert mb-0">
	                    <div class="d-flex align-items-center">
	                        <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></div>
	                        <div class="flex-fill ms-3 text-truncate">
	                            <div class="h6 mb-0">Địa chỉ</div>
	                            <span class="small"><?= $dataOrder[0]['address'] ?></span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="alert-info alert mb-0">
	                    <div class="d-flex align-items-center">
	                        <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></div>
	                        <div class="flex-fill ms-3 text-truncate">
	                            <div class="h6 mb-0">Số điện thoại</div>
	                            <span class="small"><?= $dataOrder[0]['phone'] ?></span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div> <!-- Row end  -->

	        <div class="row g-3 mb-3">
	            <div class="col-xl-12 col-xxl-8">
	                <div class="card">
	                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
	                        <h6 class="mb-0 fw-bold ">Tóm tắt đơn hàng</h6>
	                    </div>
	                    <div class="card-body">
	                        <div class="product-cart">
	                            <div class="checkout-table table-responsive">
	                                <table id="myCartTable" class="table display dataTable table-hover align-middle" style="width:100%">
	                                    <thead>
	                                        <tr>
	                                            <th class="price">Ảnh </th>
	                                            <th>Tên sản phẩm</th>
	                                            <th class="quantity">Số lượng</th>
	                                            <th class="price">Đơn giá</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <?php
                                            $subtotal = 0;
                                            foreach ($dataOrder as $dataOrderItem) {
                                                extract($dataOrderItem);
                                                $subtotal += $sub_total;
                                            ?>
	                                            <tr>
	                                                <td>
	                                                    <img src="<?= $thumb ?>" class="avatar rounded lg object-fit-contain " alt="<?= $title ?>">
	                                                </td>
	                                                <td>
	                                                    <h6 class="title"><?= $title ?>
	                                                        <span class="d-block fs-6 text-primary"><?= $attribute_values ?></span>
	                                                    </h6>
	                                                </td>
	                                                <td>
	                                                    x<?= $quantity ?>
	                                                </td>
	                                                <td>
	                                                    <p class="price"><?= Format::formatCurrency($price) ?></p>
	                                                </td>
	                                            </tr>
	                                        <?php } ?>

	                                    </tbody>
	                                </table>
	                            </div>
	                            <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap justify-content-end">
	                                <div class="checkout-total">
	                                    <div class="single-total">
	                                        <p class="value">Giá phụ:</p>
	                                        <p class="price"><?= Format::formatCurrency($subtotal) ?></p>
	                                    </div>

	                                    <div class="single-total">
	                                        <p class="value">Ưu đãi (-):</p>
	                                        <p class="price"><?= Format::formatCurrency($total_money - $subtotal) ?></p>
	                                    </div>

	                                    <div class="single-total total-payable">
	                                        <p class="value">Tổng số tiền phải trả:</p>
	                                        <p class="price fw-bold "><?= Format::formatCurrency($total_money) ?></p>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-xl-12 col-xxl-4">
	                <div class="card mb-3">

	                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
	                        <h6 class="mb-0 fw-bold ">Trạng thái đơn hàng</h6>
	                    </div>
	                    <div class="card-body">
	                        <form method="post" action="admin/order/updateOrderStatus">
	                            <div class="row g-3 align-items-center">
	                                <div class="col-md-12">
	                                    <label class="form-label">Mã đơn hàng</label>
	                                    <input type="hidden" value="<?= $order_id ?>" name="order_id">
	                                    <input type="hidden" value="<?= $idData ?>" name="idData">
	                                    <input type="text" readonly class="form-control" value="#<?= $order_code ?>">
	                                </div>

	                                <div class="col-md-12">
	                                    <label class="form-label">Thương thức thanh toán</label>
	                                    <input type="text" readonly class="form-control" value="<?= $payment_method_name ?>">
	                                </div>
	                                <div class="col-md-12">

	                                    <label class="form-label">Trạng thái đơn hàng</label>
	                                    <select name="order_status_id" class="form-select" aria-label="Default select example">
	                                        <?php
                                            foreach ($dataOrderStatus as $dataOrderStatusItem) {
                                            ?>
	                                            <option <?= $dataOrderStatusItem['id'] == $order_status_id ? 'selected' : '' ?> value="<?= $dataOrderStatusItem['id'] ?>"><?= $dataOrderStatusItem['name'] ?></option>
	                                        <?php } ?>

	                                    </select>
	                                </div>

	                                <div class="col-md-12">
	                                    <label class="form-label">Trạng thái hiển thị</label>
	                                    <?php
                                        foreach ($dataOrderStatus as $item) {
                                            if ($item['id'] == $order_status_id) {
                                        ?>
	                                            <input type="text" readonly class="form-control" value="<?= $item['description'] ?>">
	                                    <?php }
                                        } ?>
	                                </div>

	                            </div>
	                            <?php if (!in_array($order_status_id, [3, 4, 5])) : ?>
	                                <button type="submit" onclick="" class="btn btn-primary mt-4 text-uppercase">Cập nhập</button>
	                            <?php else : ?>

	                                <button type="button" class="btn btn-<?= $order_status_id == 5 ? 'danger' : 'success' ?> mt-4 text-uppercase disabled ">
	                                    <?php
                                        if ($order_status_id == 3) :
                                            echo 'Sắp đến tay người dùng';
                                        elseif ($order_status_id == 4) :
                                            echo 'Hoàn tất giao hàng';
                                        else :
                                            echo 'Đơn hàng đã huỷ';
                                        endif;
                                        ?>
	                                </button>
	                            <?php endif ?>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div> <!-- Row end  -->
	    </div>
	</div>