// change isBlock
const toggleStatusProd = (id) => {
  $.ajax({
    url: 'admin/toggle-product',
    method: 'POST',
    data: {
      id: id,
    },
    dataType: 'json',
    success: function (data) {
      if (data.code == 200) {
        return showToast('success', data.message);
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
};

// change isBlock
const toggleStatusProdRating = (id) => {
  $.ajax({
    url: 'admin/hide-product-rating',
    method: 'POST',
    data: {
      id: id,
    },
    dataType: 'json',
    success: function (data) {
      if (data.code == 200) {
        return showToast('success', data.message);
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
      return showToast('error', 'Vui lòng đăng nhập tài khoản quản trị.');
    },
  });
};
// Variant value

const priceHtml = (item) => {
  if (item.discount != 0) {
    return `
          <span class="new-price">${formatCurrency(item.price)}</span>  
          <span class="fs-4 fw-bold  ms-3 me-1 text-decoration-line-through">${calculateOriginalPrice(
            item.price,
            item.discount,
          )}</span>
          <span class="text-danger fs-4">${item.discount}%</span>
          `;
  } else {
    return `<span class="new-price">${formatCurrency(item.price)}</span> `;
  }
};

const getVariant = (id) => {
  const productPrice = $('#product-price');
  const addToCartButton = $('#add-Product-To-Cart');
  $.ajax({
    url: `product/getProductVariant/${id}`,
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      const dataProd = data.data;

      if (dataProd.quantity == 0) {
        addToCartButton.addClass('disabled');
        addToCartButton.text('Sản phẩm tạm hết');
      } else {
        addToCartButton.removeClass('disabled');
        addToCartButton.text('Thêm vào giỏ hàng');
      }

      if (data.code == 200) {
        $('#product-stock').text(dataProd.quantity);
        $('#product_variant_id').val(id);
        productPrice.empty();
        productPrice.append(priceHtml(dataProd));
      }

      if (data.code == 400) {
        window.location.href = '/ecommerce_php_5_1/';
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
};

// product filter

// const productFilterHtml = (itemDataProd) => {
//   const productLink = `product/${itemDataProd.slug}-${itemDataProd.id}`;
//   const thumbSrc = `${itemDataProd.thumb}`;
//   const quantity = itemDataProd.quantity;
//   const discount = itemDataProd.discount;
//   const price = itemDataProd.price;
//   const totalRatings = itemDataProd.totalRatings;
//   const prodTitle = itemDataProd.title;
//   const prodTotalUserRatings = itemDataProd.totalUserRatings;

//   return `
//     <div class="col-xl-3 mb-5 col-lg-4 col-sm-6 col-12">
//         <div class="product-item px-3">
//             <div class="thumb">
//                 <div class="thumb-img">
//                     <a class="thumb-link" href="${productLink}">
//                         <img src="${thumbSrc}" alt="${prodTitle}">
//                     </a>

//                     <div class="actions-hover">
//                         <ul class="action-list mb-0">
//                             <li class="quickview">
//                                 <a class="btn-action" href="${productLink}"><i class="far fa-eye"></i></a>
//                             </li>

//                             <li class="select-option">
//                                 ${
//                                   quantity > 0
//                                     ? `<a href="${productLink}" class="btn-action-lagre">Mua sản phẩm</a>`
//                                     : `<a class="btn-action-lagre disabled" href="#">Sản phẩm hết hàng</a>`
//                                 }
//                             </li>

//                             <li class="wishlist">
//                                 <button class="btn-action" type="button" ><i class="far fa-heart"></i></button>
//                             </li>
//                         </ul>
//                     </div>
//                 </div>

//                 <div class="lable-sale">
//                     ${
//                       discount !== 0
//                         ? `<div class="product-badget">Giảm ${discount} %</div>`
//                         : ``
//                     }
//                 </div>
//             </div>
//             <div class="content">
//                 <div class="inner">
//                     <div class="product-rating">
//                         <span class="icon">
//                             ${renderStars(totalRatings)}
//                         </span>
//                         <span class="rating-number">(${prodTotalUserRatings})</span>
//                     </div>
//                     <h5 class="title">
//                         <a href="${productLink}">${prodTitle}</a>
//                     </h5>
//                     <div class="product-price-variant">
//                         <span class="price current-price">${formatCurrency(
//                           price,
//                         )}</span>
//                         ${
//                           discount
//                             ? `<span class="price old-price">${calculateOriginalPrice(
//                                 price,
//                                 discount,
//                               )}</span>`
//                             : ``
//                         }
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>
//   `;
// };

const productFilterHtml = (item) => {
  return `
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
            <div class="ec-product-inner">
                <div class="ec-pro-image-outer">
                    <div class="ec-pro-image">
                        <a href="product/${item.slug}-${item.id}" class="image">
                            <img class="main-image" src="${
                              item.thumb
                            }" title="${item.title}" alt="${item.title}" />
                        </a>
                        <span class="flags">
                            ${
                              item.discount !== 0
                                ? '<span class="sale">Sale</span>'
                                : ''
                            }
                        </span>
                        <a href="${item.linkProduct}" class="quickview">
                            <i class="fi-rr-eye"></i>
                        </a>
                        <div class="ec-pro-actions">
                            <a href="coming-soon" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                            <a href="product/${item.slug}-${
    item.id
  }" title="Add To Cart" class="add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                            <a href="product/${item.slug}-${
    item.id
  }" class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="ec-pro-content">
                    <h5 class="ec-pro-title">
                        <a href="product/${item.slug}-${item.id}">${
    item.title
  }</a>
                    </h5>
                    <div class="ec-pro-rating">
                        ${renderStars(item.totalRatings)}
                    </div>
                    <div class="ec-pro-list-desc">${
                      item.short_description
                    }</div>
                    <span class="ec-price">
                        ${
                          item.discount !== 0
                            ? '<span class="old-price">' +
                              calculateOriginalPrice(
                                item.price,
                                item.discount,
                              ) +
                              '</span>'
                            : ''
                        }
                        <span class="new-price">${formatCurrency(
                          item.price,
                        )}</span>
                    </span>
                </div>
            </div>
        </div>`;
};

const buttonLernMore = () => {
  return ` <div class="col-lg-12 text-center mt--20 ">
                <span onclick="learnMoreProductFilter()" class="btn-custom btn-bg-lighter">Xem thêm</span>
            </div>`;
};

const updateHtmlProductFilter = (data) => {
  const $productFilter = $('#main-product-filter');
  $productFilter.empty();
  if (data.length > 0) {
    data.forEach(function (item) {
      const prodItemHTML = productFilterHtml(item);
      $productFilter.append(prodItemHTML);
    });
    // $productFilter.append(buttonLernMore);
  } else {
    $productFilter.append(notCartHtml());
  }
};

// Xu ly lọc sản phẩm
const handleFilterChange = () => {
  filterProduct();
};

$('.product-filter-select').change(handleFilterChange);

const filterProduct = async () => {
  // Get form data
  const formData = new FormData($('#form-prod-category').get(0));
  // Kiem tra co param search hay khong
  const queryParams = new URLSearchParams(window.location.search);
  const search = queryParams.get('search');
  // neu co search se them search vao params
  if (search) {
    formData.append('search', search);
  }
  //Lay param cua form va dua len url
  const queryString = new URLSearchParams(formData).toString();
  const newURL = `https://ekkashoe.shop/ecommerce_php_5_1/product-category?${queryString}`;
  history.pushState({}, '', newURL);
  try {
    const fetchPromise = await fetch('product-filter', {
      method: 'POST',
      body: formData,
    });
    if (fetchPromise.ok) {
      const response = await fetchPromise.json();
      if (response.code == 200) {
        updateHtmlProductFilter(response.data);
      }
    }
  } catch (error) {
    console.log(error);
  }
};

function learnMoreProductFilter() {
  const valueLimit = $('#limit-product-filter').val();
  $('#limit-product-filter').val(+valueLimit + 8);
  filterProduct();
}

// Print
const printInvoice = (id) => {
  // Gửi yêu cầu AJAX để lấy base64PDFContent
  $.ajax({
    url: 'admin/order/printInvoiceApi/' + id,
    type: 'GET',

    success: function (base64PDFContent) {
      // In trang khi đã nhận được dữ liệu PDF
      // console.log(base64PDFContent);
      printPDF(base64PDFContent);
    },
    error: function (xhr, status, error) {
      console.error('Error:', error);
    },
  });
};
