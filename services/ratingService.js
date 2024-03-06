// ratings

const itemCommentHtml = (item) => {
  return `
   <div class="ec-t-review-item">
                                               <div class="ec-t-review-avtar">
                                                   <img src="${
                                                     item.avatar
                                                   }" alt="${item.fullname}" />
                                               </div>
                                               <div class="ec-t-review-content">
                                                   <div class="ec-t-review-top">
                                                       <div class="ec-t-review-name">${
                                                         item.fullname
                                                       }</div>
                                                       <div class="ec-t-review-rating">
                                                          ${renderStars(
                                                            item.star,
                                                          )}
                                                       </div>
                                                   </div>
                                                   <div class="ec-t-review-bottom">
                                                       <p>“${item.comment}”</p>
                                                   </div>
                                               </div>
                                           </div>
  `;
};

const addRatingProd = async () => {
  try {
    const formData = new FormData($('#formRatings').get(0));
    const response = await fetch(`add-product-rating`, {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      const data = await response.json();

      if (data.code == 400) {
        showToast('error', data.message);
      }

      if (data.code == 200) {
        updateHtmlCart(data.data);
        showToast('success', data.message);
      }

      getDataRatingProd();
      return;
    } else {
      throw new Error('Request failed');
    }
  } catch (error) {
    console.log(error);
  }
};

const getDataRatingProd = async () => {
  const currentURL = window.location.href;
  const match = currentURL.match(/-(\d+)$/);
  if (match) {
    //lấy ra id
    const id = match[1];
    try {
      const response = await fetch('product-rating/' + id);

      if (response.ok) {
        const data = await response.json();
        if (data.code == 200) {
          updateHtmlRatingProd(data.data);
        }
      }
    } catch (error) {
      console.log(error);
    }
  }
};
getDataRatingProd();

const notCommentHtml = () =>
  `<div class="not-comment">
          <small>Chưa có đánh giá.</small>
   </div>`;

const updateHtmlRatingProd = (data) => {
  var $commentList = $('#comment-list');
  $commentList.empty();
  if (data.length > 0) {
    data.forEach(function (item) {
      $commentList.append(itemCommentHtml(item));
    });
  } else {
    $commentList.append(notCommentHtml());
  }
};
