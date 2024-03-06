<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title  ?? 'Error' ?></title>
    <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">
    <base href="https://ekkashoe.shop/ecommerce_php_5_1/">

    <!-- site Favicon -->
    <link rel="icon" href="public/client/images/favicon/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="public/client/images/favicon/favicon.png" />
    <meta name="msapplication-TileImage" content="public/client/images/favicon/favicon.png" />

    <!-- CSS -->

    <link rel="stylesheet" href="public/client/css/plugins/bootstrap.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="public/client/css/base-custom.css">
    <link rel="stylesheet" type="text/css" href="public/client/css/style-custom.css">

</head>

<body>
    <div class="main ">

        <main>
            <?php require_once 'app/views/pages/client/' . $pages . '.php' ?>
        </main>

    </div>

</body>


</html>