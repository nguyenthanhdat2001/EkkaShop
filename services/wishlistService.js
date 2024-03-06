const getWishListData = async () => {
  try {
    const response = await fetch('wishList/getAllWishListApi');

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        updateHtmlWishlist(data.data);
      }
    } else {
      throw new Error('Request failed');
    }
  } catch (error) {
    console.log(error);
  }
};
getWishListData();

const addWishList = async (prod_variant_id = null) => {
  try {
    let data = [];

    let response;
    // Nếu không variant truyền qua thì lấy từ element
    if (!prod_variant_id) {
      //kiem tra da chon bien the chua
      if (!$('#product_variant_id').val()) {
        return showToast('error', 'Vui lòng lựa chọn phân loại.');
      }

      const prod_variant_id = $('#product_variant_id').val();

      response = await fetch(`wishlist/addNewWishListApi/${prod_variant_id}`, {
        method: 'GET',
      });
    } else {
      // Nếu có thì lấy trực tiếp từ pram truyền vào
      response = await fetch(`wishlist/addNewWishListApi/${prod_variant_id}`, {
        method: 'GET',
      });
    }

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
    getWishListData();
  } catch (error) {
    console.log(error);
  }
};

const updateHtmlWishlist = (data) => {
  if (data.length > 0) {
    $('#wishlist-quantity').html(data.length);
  } else {
    $('#wishlist-products').append(
      `  <p class="emp-wishlist-msg">Danh sách ưa thích của bạn đang trống!</p>`,
    );
    $('#wishlist-quantity').html(0);
  }
};

const deleteWishlist = async (id) => {
  try {
    const response = await fetch(`wishlist/deleteWishlistApi/${id}`, {
      method: 'DELETE',
    });

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        $('#wishlist-item-' + id).remove();
        getWishListData();
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
