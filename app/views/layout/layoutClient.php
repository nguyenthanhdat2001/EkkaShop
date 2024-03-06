<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title><?= $title ?? '' ?></title>
    <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">
    <base href="https://ekkashoe.shop/ecommerce_php_5_1/">

    <!-- site Favicon -->
    <link rel="icon" href="public/client/images/favicon/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="public/client/images/favicon/favicon.png" />
    <meta name="msapplication-TileImage" content="public/client/images/favicon/favicon.png" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="public/client/css/vendor/ecicons.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">


    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="public/client/css/plugins/animate.css" />
    <link rel="stylesheet" href="public/client/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="public/client/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="public/client/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="public/client/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="public/client/css/plugins/bootstrap.css" />

    <!-- Main Style -->
    <!-- <link rel="stylesheet" type="text/css" href="public/client/css/base-custom.css"> -->

    <link rel="stylesheet" href="public/client/css/demo1.css" />
    <link rel="stylesheet" href="public/client/css/style.css" />
    <link rel="stylesheet" href="public/client/css/custom.css" />
    <link rel="stylesheet" href="public/client/css/responsive.css" />

    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="public/client/css/backgrounds/bg-4.css">

    <!-- Swal -->
    <script src="public/includes/js/sweetalert2.all.min.js"></script>

</head>

<body>
    <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="main">
        <?php
        global $config;
        $chatBot = $config['chatBot'];

        require_once 'app/views/includes/header.php';
        $dataStoreCustom = ViewShare::$dataShare['dataStoreCustom'];
        //hide breadcumb
        if ($pages != 'product/detailProduct' && $pages != 'home') {
            require_once 'app/views/includes/breadcumb.php';
        }
        ?>

        <main>
            <?php require_once 'app/views/pages/client/' . $pages . '.php' ?>
        </main>

        <?php
        require_once 'app/views/includes/footer.php'
        ?>
    </div>
    <!-- <div class="closeMask"></div> -->

    <script src="public/client/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="public/client/js/vendor/popper.min.js"></script>
    <script src="public/client/js/vendor/bootstrap.min.js"></script>
    <script src="public/client/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="public/client/js/vendor/modernizr-3.11.2.min.js"></script>


    <!--Plugins JS-->
    <script src="public/client/js/plugins/swiper-bundle.min.js"></script>
    <script src="public/client/js/plugins/countdownTimer.min.js"></script>
    <script src="public/client/js/plugins/scrollup.js"></script>
    <script src="public/client/js/plugins/jquery.zoom.min.js"></script>
    <script src="public/client/js/plugins/slick.min.js"></script>
    <script src="public/client/js/plugins/infiniteslidev2.js"></script>
    <script src="public/client/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="public/client/js/plugins/jquery.sticky-sidebar.js"></script>

    <!-- Main Js -->
    <script src="public/client/js/vendor/index.js"></script>
    <script src="public/client/js/main.js"></script>

    <!-- Services -->
    <script src="services/base.js"></script>
    <script src="services/productService.js"></script>
    <script src="services/cartService.js"></script>
    <script src="services/ratingService.js"></script>
    <script src="services/userService.js"></script>
    <script src="services/wishlistService.js"></script>

    <script>
        $('.rating-wrapper .star').hover(
            function() {
                $(this).addClass('hovered');
                $(this).prevAll().addClass('hovered');
            },
            function() {
                $('.rating-wrapper .star').removeClass('hovered');
            },
        );

        $('.rating-wrapper .star').click(function() {
            var rating = $(this).data('rating');
            $('#currentRating').val(rating);
            $('.rating-wrapper .star').removeClass('selected');
            $(this).addClass('selected');
            $(this).prevAll().addClass('selected');
        });

        const couponEle = $('.code-coupon');

        couponEle.on('click', function() {
            const $this = $(this);
            const couponCode = $this.text().trim();

            navigator.clipboard
                .writeText(couponCode)
                .then(function() {
                    $this.text('Copied!');
                })
                .catch(function(err) {
                    console.error('Không thể sao chép mã: ', err);
                });
        });
    </script>

    <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
    <script>
        window.botpressWebChat.init({
            "composerPlaceholder": "Trò chuyện với bot",
            "botConversationDescription": "Chatbot này được xây dựng cùng với trang website",
            "botId": "<?= $chatBot['botId'] ?>",
            "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
            "messagingUrl": "https://messaging.botpress.cloud",
            "clientId": "<?= $chatBot['clientId'] ?>",
            "webhookId": "<?= $chatBot['webhookId'] ?>",
            "lazySocket": true,
            "themeName": "prism",
            "frontendVersion": "v1",
            "showPoweredBy": false,
            "theme": "prism",
            "themeColor": "#2563eb"
        });
    </script>


</body>


</html>