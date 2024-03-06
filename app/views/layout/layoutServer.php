<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'Error' ?></title>
    <base href="https://ekkashoe.shop/ecommerce_php_5_1/">

    <!-- site Favicon -->
    <link rel="icon" href="public/client/images/favicon/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="public/client/images/favicon/favicon.png" />
    <meta name="msapplication-TileImage" content="public/client/images/favicon/favicon.png" />



    <!-- plugin css file  -->
    <link rel="stylesheet" href="public/admin/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="public/admin/plugin/datatables/dataTables.bootstrap5.min.css">


    <!-- icon font cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/icofont@1.0.1-alpha.1/icofont.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- project css file  -->

    <link rel="stylesheet" href="public/admin/css/ebazar.style.min.css">

    <!-- js -->
    <script src="public/includes/js/jquery.js"></script>
    <script src="public/includes/js/sweetalert2.all.min.js"></script>




</head>

<body>

    <div id="ebazar-layout" class="theme-blue">

        <?php
        require_once 'app/views/includes/admin/sidebar.php';
        ?>

        <main class="main px-lg-4 px-md-4">
            <?php
            require_once 'app/views/includes/admin/header.php';
            ?>
            <!-- body -->
            <?php require_once 'app/views/pages/admin/' . $pages . '.php' ?>

        </main>


    </div>




    <!-- Jquery Core Js -->
    <script src="public/admin/bundles/libscripts.bundle.js"></script>
    <!-- Plugin Js -->
    <script src="public/admin/bundles/apexcharts.bundle.js"></script>
    <script src="public/admin/bundles/dataTables.bundle.js"></script>
    <script src="public/admin/js/ckeditor.js"></script>
    <!-- <script src="public/admin/js/popper.min.js"></script> -->

    <!-- <script src="public/admin/js/page/profile.js"></script> -->
    <script src="public/admin/js/page/index.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&amp;callback=myMap"></script> -->
    <!-- Jquery Page Js -->
    <script src="public/admin/js/template.js"></script>

    <!-- Services -->
    <script src="services/base.js"></script>
    <script src="services/productService.js"></script>
    <script src="services/statisticalService.js"></script>

    <script>
        // DataTable
        const tableEle = document.querySelector('#myDataTable');
        if (tableEle) {

            $('#myDataTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }],
                    order: [
                        [1, 'desc']
                    ] // Sắp xếp giảm dần theo cột đầu tiên khi bảng được khởi tạo
                });
        }
        //Ch-editer
        const ckeditorEle = document.querySelector('#editor');
        if (ckeditorEle) {

            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        }
    </script>

</body>



</html>