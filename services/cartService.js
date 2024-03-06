// cart
const notCartHtml = () => {
  return `<div class="text-center">
            <img class="img-fluid" src="https://www.maytinhtrangbom.vn/client/theme/image/emptycart.webp" alt="Chưa có sản phẩm img">
            <p >Chưa có sản phẩm.</p>
          </div>`;
};

const itemCartHtml = (item) => `
  <li class="d-flex align-items-center ">
                    <a style="background-color: #f7f7f7;" href="product/${
                      item.slug
                    }-${item.product_id}" class="sidekka_pro_img  rounded-2  ">
                        <img style="object-fit: contain; mix-blend-mode: darken;" class="img-responsive rounded-2" src="${
                          item.thumb
                        }" alt="product">
                    </a>
                    <div class="ec-pro-content">
                        <a href="product/${item.slug}-${
  item.product_id
}" class="cart_pro_title">${item.title}</a>
                        <label style="font-size: 12px" class="mb-0">
                            <span class="title-variant fw-bold ">Phân loại: </span>
                            <span>${item.attribute_values}</span>
                        </label>
                        <span class="cart-price mt-0 ">
                            <span>${formatCurrency(item.price)}</span>
                            <small>x ${item.quantity}</small>
                        </span>
                        <div class="qty-plus-minus">
                            <div onclick="updateQuantityCart(${
                              item.cart_item_id
                            }, 'minus')" class="dec ec_qtybtn">-</div>
                            <input class="qty-input" type="text" name="ec_qtybtn" value="${
                              item.quantity
                            }" />
                            <div onclick="updateQuantityCart(${
                              item.cart_item_id
                            }, 'plus')" class="inc ec_qtybtn">+</div>
                        </div>
                        <button type="button" onclick="deleteCart(${
                          item.cart_item_id
                        })" class="remove">×</button>
                    </div>
                </li>
`;

const cartHtmlMain = (item) => {
  return `
  <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name">
                                                        <a href="product/${
                                                          item.slug
                                                        }-${item.product_id}">
                                                            <img class="ec-cart-pro-img mr-4" src="${
                                                              item.thumb
                                                            }" alt="${
    item.title
  }" />
                                                            <div>
                                                                <p class="mb-0  ">${
                                                                  item.title
                                                                }</p>
                                                                <small style="font-size: 12px;" class="text-primary ">(${
                                                                  item.attribute_values
                                                                } )</small>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount">${formatCurrency(
                                                      item.price,
                                                    )}</span></td>
                                                    <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                        <div class="cart-qty-plus-minus">
                                                            <input class="cart-plus-minus" type="text" name="cartqtybutton" value="${
                                                              item.quantity
                                                            }" />
                                                            <div class="ec_cart_qtybtn">
                                                              <div onclick="updateQuantityCart(${
                                                                item.cart_item_id
                                                              }, 'plus')" class="inc ec_qtybtn">+</div>
                                                              <div onclick="updateQuantityCart(${
                                                                item.cart_item_id
                                                              }, 'minus')" class="dec ec_qtybtn">-</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">${formatCurrency(
                                                      item.price *
                                                        item.quantity,
                                                    )}</td>
                                                    <td data-label="Remove" class="ec-cart-pro-remove">
                                                        <button onclick="deleteCart(${
                                                          item.cart_item_id
                                                        })" type="button"><i class="ecicon eci-trash-o"></i></button>
                                                    </td>
                                                </tr>
  `;
};
// fetch
const getCartData = async () => {
  try {
    const response = await fetch('cart/getAllCartApi');

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        updateHtmlCart(data.data);
      }
    } else {
      throw new Error('Request failed');
    }
  } catch (error) {
    console.log(error);
  }
};
getCartData();

const addCart = async () => {
  try {
    let data = [];
    //kiem tra da chon bien the chua
    if (!$('#product_variant_id').val()) {
      return showToast('error', 'Vui lòng lựa chọn phân loại.');
    }

    const formData = new FormData($('#formProduct').get(0));
    const response = await fetch(`cart/addCartApi`, {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      data = await response.json();
    }
    //Neu chua co tai khoan phai login
    if (data.code == 300) {
      window.location.href = 'login';
      return;
    }
    if (data.code == 200) {
      showToast('success', data.message);
    }
    if (data.code == 400) {
      showToast('error', data.message);
    }
    getCartData();
  } catch (error) {
    console.log(error);
  }
};

const updateQuantityCart = async (id, action) => {
  try {
    const response = await fetch(`cart/updateQuantityApi/${id}/${action}`, {
      method: 'GET',
    });
    if (response.ok) {
      const data = await response.json();

      if (data.code == 200) {
        getCartData();
      }

      if (data.code == 400) {
        showToast('error', data.message);
      }
    }
  } catch (error) {
    console.log(error);
  }
};

const deleteCart = async (id) => {
  try {
    const response = await fetch(`cart/deleteCartApi/${id}`, {
      method: 'POST',
    });

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        getCartData();
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    } else {
      console.log('Error deleting cart:', response.status);
    }
  } catch (error) {
    console.error('An error occurred:', error);
  }
};

const updateHtmlCart = (data) => {
  let cartList = $('#cartList');
  let cartMain = $('#cart_main');

  cartList.empty();
  cartMain.empty();

  if (data.length > 0) {
    let totalAmout = 0;

    data.forEach(function (item) {
      //cart modal
      cartList.append(itemCartHtml(item));
      //cart main
      cartMain.append(cartHtmlMain(item));
      totalAmout = item.totalPrice;
    });

    $('#subtotal-amount').html(formatCurrency(totalAmout));
    $('#shopping-cart-quantity').html(data.length);

    //Cart Mian
    $('#order-subtotal').html(formatCurrency(totalAmout));
    $('#order-total-amount').html(formatCurrency(totalAmout));
  } else {
    cartList.append(notCartHtml());
    $('#subtotal-amount').html(formatCurrency(0));
    $('#not-cart-main').append(
      `<tr>
        <td>Chưa có sản phẩm nào.</td>
        </tr>`,
    );

    //Cart main
    $('#order-subtotal').html(formatCurrency(0));
    $('#order-total-amount').html(formatCurrency(0));
  }
};

const updateProductCoupon = async (totalPrice) => {
  const couponCodeEle = $('#coupon_code');
  const order_coupon_amount = $('.order-coupon-amount');
  const order_total_amount = $('.order-total-amount');
  const couponCodeVal = couponCodeEle.val();
  if (!couponCodeVal) {
    return showToast('error', 'Vui lòng không để trống mã giảm giá.');
  }

  try {
    const response = await fetch(
      `coupon/applyCouponApi/${couponCodeVal}/${totalPrice}`,
      {
        method: 'GET',
      },
    );

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        order_coupon_amount.text(
          '-' + formatCurrency(totalPrice - data.data.totalPrice),
        );
        order_total_amount.text(formatCurrency(data.data.totalPrice));
        return showToast('success', data.message);
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    } else {
      console.log('Error deleting cart:', response.status);
    }
  } catch (error) {
    console.error('An error occurred:', error);
  }
};
