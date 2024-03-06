const showToast = (type, message, timer = 1500) => {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: timer,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: type,
    title: message,
  });
};

const showAlert = (title, type, timer = 3000) => {
  Swal.fire({
    title: title,
    text: 'Vấn đề bạn đang gặp là gì vui lòng liên hệ chúng tôi.',
    icon: type,
    showCancelButton: false,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Đi tới gmail',
    timer: timer,
    timerProgressBar: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.open('http://gmail.com/', '_blank');
      return;
    }
    window.location.href = 'login';
  });
};

function handleConfirm(url) {
  Swal.fire({
    title: 'Bạn có chắc chắn muốn xoá không?',
    text: 'Nếu thực hiện xoá bạn sẽ bị xoá vĩnh viễn không thể khôi phục lại hãy suy nghĩ thật kĩ trước khi xoá!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Vâng, tôi xoá',
    cancelButtonText: 'Không, tôi huỷ',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = url;
    }
  });
}

const formatCurrency = (amount) => {
  var formattedAmount = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  }).format(amount);
  return formattedAmount;
};
function calculateOriginalPrice(price, discount) {
  if (discount < 0 || discount > 100) {
    return '0đ';
  }

  const originalPrice = price / (1 - discount / 100);
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  }).format(originalPrice);
}

const renderStars = (number) => {
  const filledStars = Math.round(number);
  const starArray = [];

  for (let index = 0; index < 5; index++) {
    if (index < filledStars) {
      starArray.push('<i style="color: #ffc73a" class="fas fa-star"></i>');
    } else {
      starArray.push('<i style="color: #ffc73a" class="far fa-star"></i>');
    }
  }
  return starArray.join(' ');
};

function printPDF(base64PDFContent) {
  // Chuyển đổi base64 thành dữ liệu nhị phân
  var binaryPDFContent = atob(base64PDFContent);

  // Chuyển đổi dữ liệu nhị phân thành mảng byte
  var byteNumbers = new Array(binaryPDFContent.length);
  for (var i = 0; i < binaryPDFContent.length; i++) {
    byteNumbers[i] = binaryPDFContent.charCodeAt(i);
  }
  var byteArray = new Uint8Array(byteNumbers);

  // Tạo Blob từ mảng byte
  var blob = new Blob([byteArray], { type: 'application/pdf' });

  // Chuyển đổi Blob thành URL
  var url = URL.createObjectURL(blob);

  // Tạo một iframe để hiển thị PDF
  var iframe = document.createElement('iframe');
  iframe.style.display = 'none';
  iframe.src = url;

  // Thêm iframe vào trang
  document.body.appendChild(iframe);

  // Khi iframe đã sẵn sàng, gọi window.print() để in trang
  iframe.onload = function () {
    iframe.contentWindow.print();
  };
}
