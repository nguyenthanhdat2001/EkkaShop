<?php
trait SweetAlert
{
    function Toast($type, $message, $condition = '', $duration = 2500)
    {
        echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: ' . $duration . ', // Thời gian tự định nghĩa
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
            didClose: () => {
                ' . (!empty($condition) ? 'window.location.href = "' . $condition . '";' : '') . '
            }
        });

        Toast.fire({
            icon: "' . $type . '",
            title: "' . $message . '",
        });
    })
    </script>';
    }


    function Alert($title, $icon, $condition = '', $duration = 2500)
    {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "' . $title . '",
            text: "Vấn đề bạn đang gặp phải là gì? Vui lòng liên hệ với chúng tôi.",
            icon: "' . $icon . '",
            timer: ' . $duration . ',
            showConfirmButton: true,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
            didClose: () => {
                ' . (!empty($condition) ? 'window.location.href = "' . $condition . '";' : '') . '
            }
        });
    })
    </script>';
    }

    function ToastSession($message, $type)
    {
        if (
            isset($message) && isset($type) &&
            !empty($message) && !empty($type)
        ) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500, 
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
                }
            });

                Toast.fire({
                    icon: "' . $type . '",
                    title: "' . $message . '",
                });
            })
            </script>';
            Session::unsetSession('toastMessage');
            Session::unsetSession('toastType');
        }
    }
    function handleConfirm($url)
    {
        echo '
            <script>
                Swal.fire({
                    title: "Bạn có chắc chắn muốn xoá không?",
                    text: "Nếu bạn thực hiện xoá sẽ không thể khôi phục lại!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Vâng, tôi xoá",
                    cancelButtonText: "Không, tôi huỷ"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = "' . $url . '";
                    }
                });
            </script>
    ';
    }
}
