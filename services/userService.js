$('#btn_ele').on('click', function () {
  const button = $(this);
  button.addClass('disabled');
  $('.spin').show();
});

//account
let timeoutId;

$('#emailLogin').keyup(function () {
  clearTimeout(timeoutId);
  let emailEle = $('#emailLogin');
  let emailVal = emailEle.val();

  timeoutId = setTimeout(function () {
    $.ajax({
      url: 'isIdenti',
      method: 'POST',
      data: {
        email: emailVal,
      },
      dataType: 'json',
      success: function (data) {
        console.log(data);
        if (data.code == 200) {
          emailEle.addClass('is-invalid');
        } else {
          emailEle.removeClass('is-invalid');
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }, 300);
});

$('#passwordLogin').keyup(function () {
  clearTimeout(timeoutId);
  let passEle = $('#passwordLogin');
  let passVal = passEle.val();

  timeoutId = setTimeout(function () {
    $.ajax({
      url: 'strongPassword',
      method: 'POST',
      data: {
        password: passVal,
      },
      dataType: 'json',
      success: function (data) {
        if (data.code == 400) {
          passEle.addClass('is-invalid');
        } else {
          passEle.removeClass('is-invalid');
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }, 300);
});

//Re_password
$('#re_passwordLogin').keyup(function () {
  clearTimeout(timeoutId);
  let passEle = $('#passwordLogin');
  let passVal = passEle.val();

  let rePassEle = $('#re_passwordLogin');
  let rePassVal = rePassEle.val();

  timeoutId = setTimeout(function () {
    if (passVal !== rePassVal) {
      rePassEle.addClass('is-invalid');
    } else {
      rePassEle.removeClass('is-invalid');
    }
  }, 300);
});

// change isBlock
const changeIsBlock = (id) => {
  $.ajax({
    url: 'admin/user/changeIsBlock',
    method: 'POST',
    data: {
      user_id: id,
    },
    dataType: 'json',
    success: function (data) {
      if (data.success) {
        showToast('success', data.success);
      }

      if (data.error) {
        showToast('error', data.success);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
};

// Dang ky

const registerUser = async () => {
  try {
    const spin = $('.spin');
    const btnRegister = $('#btn_ele');
    const formData = new FormData($('#formRegister').get(0));
    //fecth api
    const fetchPromise = await fetch(`account/registerApi`, {
      method: 'POST',
      body: formData,
    });

    const response = await fetchPromise.json();
    spin.hide();
    btnRegister.removeClass('disabled');

    if (response.success) {
      showAlert(response.success, 'success', 2000);
      return;
    }
    if (response.error) {
      showToast('error', response.error, 2000);
    }
  } catch (error) {
    console.log(error);
  }
};

// Quen mat khau
const forgotPasswordUser = async () => {
  try {
    const spin = $('.spin');
    const btnRegister = $('#btn_ele');
    const form = document.getElementById('formForgot');
    const formData = new FormData(form);

    const response = await fetch('account/forgotPasswordApi', {
      method: 'POST',
      body: formData,
    });

    spin.hide();
    btnRegister.removeClass('disabled');

    if (response.ok) {
      const data = await response.json();
      if (data.success) {
        showAlert(data.success, 'success', 2000);
      } else if (data.error) {
        showToast('error', data.error, 2000);
      }
    } else {
      showToast('error', data.error, 2000);
    }
  } catch (error) {
    console.log(error);
  }
};
