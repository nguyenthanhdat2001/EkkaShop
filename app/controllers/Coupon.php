<?php

class Coupon extends Controller
{

    private $couponModel;
    private $res = null;

    function __construct()
    {
        $this->couponModel = $this->model('CouponModel');
        $this->res = new Response;
    }
    function Default()
    {

        $dataCoupon = $this->couponModel->getAllCoupon();

        $this->view('layoutClient', [
            'title' => 'Ưu đãi dành riêng cho bạn',
            'currentPath' => 'coupon',
            'pages' => 'coupon/coupon',
            'dataCoupon' => $dataCoupon,

        ]);
    }

    function applyCouponApi($code, $totalPrice)
    {
        $dataCoupon = $this->couponModel->getOneCouponCode($code);
        // Kiem tra ma giam gia co hop le hay khong

        if (empty($dataCoupon) || $dataCoupon['min_amount'] > $totalPrice || strtotime($dataCoupon['expired']) < time() || $dataCoupon['quantity'] == 0 || $dataCoupon['status'] == 0) {
            echo $this->res->dataApi('400', 'Mã giảm giá đã hết hạn hoặc không phù hợp.', []);
            return;
        }

        // Xu ly ma giam gia
        preg_match('/(\d+)(%)/', $dataCoupon['value'], $couponValueArr);

        //Xu ly la % hay la tru thang vao gia tien
        if (end($couponValueArr) == '%') {
            $totalPrice = $totalPrice * (1 - $couponValueArr[1] / 100);
        } else {
            $totalPrice -= $dataCoupon['value'];
        }

        echo $this->res->dataApi('200', 'Áp dụng mã giảm giá thành công.', [
            'totalPrice' => $totalPrice
        ]);
        return;
    }
}
