<?php
$routes['default_controller'] = 'home';

// Fake url => Real url

// Client
$routes['thu-nghiem'] = 'TestAll/default';
$routes['product/(.+)'] = 'product/productDetail/$1';
$routes['product-category'] = 'product/productCategory';
$routes['product-filter'] = 'product/filterProduct';
$routes['product/getProductVariant/(.+)'] = 'product/getVariantProdApi/$1';
$routes['product-rating/(.+)'] = 'product/getAllRatingsProd/$1';
$routes['add-product-rating'] = 'product/addRatingProd';

$routes['news'] = 'news/default';
$routes['news/(.+)'] = 'news/newsDetail/$1';

$routes['login'] = 'account/login';
$routes['signup'] = 'account/register';
$routes['logout'] = 'account/logout';
$routes['reset'] = 'account/forgotPassword';
$routes['reset-password'] = 'account/resetPassword';
$routes['signup-comfirm/(.+)'] = 'account/finalRegisterUser/$1';
$routes['strongPassword'] = 'account/checkStrongPasswordApi';
$routes['isIdenti'] = 'account/checkIdentificateExistedApi';

$routes['my-account'] = 'account/default';
$routes['my-order'] = 'account/order';
$routes['order-detail/(.+)'] = 'account/orderDetail/$1';
$routes['updateUserCurrent'] = 'account/updateUserCurrent';


$routes['checkout'] = 'checkout/default';
$routes['checkout-final'] = 'checkout/checkoutFinal';
$routes['payment-final'] = 'checkout/paymentFinal';
$routes['update-order-status'] = 'checkout/updateOrderStatus';




$routes['coming-soon'] = 'Other/comingSoon';
// Server
$routes['admin/dashBoard'] = 'admin/dashBoard/default';

// Role
$routes['admin/add-role'] = 'admin/role/addRole';
$routes['admin/update-role/(.+)'] = 'admin/role/updateRole/$1';
$routes['admin/delete-role'] = 'admin/role/deleteRole';

// Brand
$routes['admin/add-brand'] = 'admin/brand/addBrand';
$routes['admin/update-brand/(.+)'] = 'admin/brand/updateBrand/$1';

// suppliers
$routes['admin/add-suppliers'] = 'admin/suppliers/addSuppliers';
$routes['admin/update-suppliers/(.+)'] = 'admin/suppliers/updateSuppliers/$1';

// suppliers
$routes['admin/add-purchaseOrder'] = 'admin/purchaseOrder/addPurchaseOrder';
$routes['admin/purchaseOrderDetail/(.+)'] = 'admin/purchaseOrder/purchaseOrderDetail/$1';
$routes['admin/update-purchaseOrder/(.+)'] = 'admin/purchaseOrder/updatePurchaseOrder/$1';

//Product
$routes['admin/add-product'] = 'admin/product/addProduct';
$routes['admin/update-product/(.+)'] = 'admin/product/updateProduct/$1';
$routes['admin/delete-product/(.+)'] = 'admin/product/deleteProduct/$1';
$routes['admin/delete-product'] = 'admin/product/deleteProduct';
$routes['admin/toggle-product'] = 'admin/product/toggleStatusApi';
$routes['admin/delete-product-thumb/(.+)'] = 'admin/product/deleteThumbProduct/$1';
$routes['admin/delete-product-image/(.+)/(.+)'] = 'admin/product/deleteImageProduct/$1/$2';

//Product ratings
$routes['admin/rating-product/(.+)'] = 'admin/product/rating/$1';
$routes['admin/hide-product-rating'] = 'admin/product/hideComment';

// Product variants
$routes['admin/product-variants/(.+)'] = 'admin/product/productVariants/$1';
$routes['admin/add-product-variants/(.+)'] = 'admin/product/addProductVariants/$1';
$routes['admin/delete-product-variant/(.+)/(.+)'] = 'admin/product/deleteProductVariant/$1/$2';

//Category
$routes['admin/add-category'] = 'admin/category/addCategory';
$routes['admin/update-category/(.+)'] = 'admin/category/updateCategory/$1';

//Coupon
$routes['admin/add-coupon'] = 'admin/coupon/addCoupon';
$routes['admin/update-coupon/(.+)'] = 'admin/coupon/updateCoupon/$1';

//User
$routes['admin/add-user'] = 'admin/user/addUser';
$routes['admin/update-user/(.+)'] = 'admin/user/updateUser/$1';
$routes['admin/delete-user'] = 'admin/user/deleteUser';

//News
$routes['admin/add-news'] = 'admin/news/addNews';
$routes['admin/update-news/(.+)'] = 'admin/news/updateNews/$1';
$routes['admin/delete-news/(.+)'] = 'admin/news/deleteNews/$1';

//Attribute
$routes['admin/add-attribute'] = 'admin/attributes/addAttribute';
$routes['admin/update-attribute/(.+)'] = 'admin/attributes/updateAttribute/$1';
$routes['admin/attribute-value/(.+)'] = 'admin/attributes/attributeValue/$1';


//Order
$routes['admin/order-detail/(.+)'] = 'admin/order/orderDetail/$1';
$routes['admin/update-order-status'] = 'admin/order/updateOrderStatus';

// PaymentMethod
$routes['admin/payment-method'] = 'admin/order/paymentMethod';
$routes['admin/add-payment-method'] = 'admin/order/addPaymentMethod';
$routes['admin/update-payment-method/(.+)'] = 'admin/order/updatePaymentMethod/$1';

// Banner
$routes['admin/banner'] = 'admin/store/banner';
$routes['admin/add-banner'] = 'admin/store/addbanner';


// Custom store
// $routes['admin/store-custom'] = 'admin/dashboard/storeCustom';
