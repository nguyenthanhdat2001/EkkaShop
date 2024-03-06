    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form action="#">
                                    <div class="table-content cart-table-content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Đơn giá</th>
                                                    <th style="text-align: center;">Số lượng</th>
                                                    <th>Tổng</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="cart_main">

                                                <!-- <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name">
                                                        <a href="product-left-sidebar.html">
                                                            <img class="ec-cart-pro-img mr-4" src="public/client/images/product-image/1.jpg" alt="" />
                                                            <div>
                                                                <p class="mb-0  ">Stylish Baby Shoes</p>
                                                                <small style="font-size: 12px;" class="text-primary ">(Black)</small>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="ec-cart-pro-price"><span class="amount">$56.00</span></td>
                                                    <td class="ec-cart-pro-qty" style="text-align: center;">
                                                        <div class="cart-qty-plus-minus">
                                                            <input class="cart-plus-minus" type="text" name="cartqtybutton" value="1" />
                                                            <div class="ec_cart_qtybtn">
                                                                <div class="inc ec_qtybtn">+</div>
                                                                <div class="dec ec_qtybtn">-</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">$56.00</td>
                                                    <td data-label="Remove" class="ec-cart-pro-remove">
                                                        <button type="button"><i class="ecicon eci-trash-o"></i></button>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a href="product">Tiếp tục mua sắm</a>
                                                <a href="checkout" class="btn btn-primary text-white text-decoration-none ">Thanh toán</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Tóm tắt</h3>
                            </div>
                            <!-- <div class="ec-sb-block-content">
                                <h4 class="ec-ship-title">Estimate Shipping</h4>
                                <div class="ec-cart-form">
                                    <p>Enter your destination to get a shipping estimate</p>
                                    <form action="#" method="post">
                                        <span class="ec-cart-wrap">
                                            <label>Country *</label>
                                            <span class="ec-cart-select-inner">
                                                <select name="ec_cart_country" id="ec-cart-select-country" class="ec-cart-select">
                                                    <option selected="" disabled="">United States</option>
                                                    <option value="1">Country 1</option>
                                                    <option value="2">Country 2</option>
                                                    <option value="3">Country 3</option>
                                                    <option value="4">Country 4</option>
                                                    <option value="5">Country 5</option>
                                                </select>
                                            </span>
                                        </span>
                                        <span class="ec-cart-wrap">
                                            <label>State/Province</label>
                                            <span class="ec-cart-select-inner">
                                                <select name="ec_cart_state" id="ec-cart-select-state" class="ec-cart-select">
                                                    <option selected="" disabled="">Please Select a region, state
                                                    </option>
                                                    <option value="1">Region/State 1</option>
                                                    <option value="2">Region/State 2</option>
                                                    <option value="3">Region/State 3</option>
                                                    <option value="4">Region/State 4</option>
                                                    <option value="5">Region/State 5</option>
                                                </select>
                                            </span>
                                        </span>
                                        <span class="ec-cart-wrap">
                                            <label>Zip/Postal Code</label>
                                            <input type="text" name="postalcode" placeholder="Zip/Postal Code">
                                        </span>
                                    </form>
                                </div>
                            </div> -->

                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Tạm tính</span>
                                            <span id="order-subtotal" class="text-right">$80.00</span>
                                        </div>

                                        <!-- <div>
                                            <span class="text-left">Mã giảm giá</span>
                                            <span class="text-right"><a class="ec-cart-coupan">Áp dụng mã</a></span>
                                        </div>

                                        <div class="ec-cart-coupan-content">
                                            <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="post" action="#">
                                                <input class="ec-coupan" type="text" required="" placeholder="Enter Your Coupan Code" name="ec-coupan" value="">
                                                <button class="ec-coupan-btn button btn-primary" type="button" name="subscribe" value="">Áp dụng</button>
                                            </form>
                                        </div> -->
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Tổng tiền</span>
                                            <span id="order-total-amount" class="text-right">$80.00</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>