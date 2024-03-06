<?php
class Checkout extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $paymentModel;
    private $userModel;
    private $productModel;
    private $cartModel;
    private $couponModel;
    private $orderModel;
    private $user_id = null;
    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
        $this->paymentModel = $this->model('PaymentModel');
        $this->userModel = $this->model('UserModel');
        $this->cartModel = $this->model('CartModel');
        $this->couponModel = $this->model('CouponModel');
        $this->orderModel = $this->model('OrderModel');
        $this->productModel = $this->model('ProductModel');
        $this->user_id = ViewShare::$dataShare['userData']['user_id'] ?? '';
    }

    function Default()
    {
        if (!$this->req->isPost()) {
            $toatMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toatMessage, $toastType);
        }

        $dataCart = $this->cartModel->getAllCart($this->user_id);

        //Kiem tra da co san pham trong gio hang chua
        if (empty($dataCart)) {
            return $this->res->setToastSession('warning', 'Vui lòng thêm sản phẩm vào giỏ hàng.', 'home');
        }


        $dataAddress = $this->userModel->getAddress($this->user_id);
        $dataPaymentMethod = $this->paymentModel->getAllPaymentMethod();
        $dataCoupon = $this->couponModel->getAllCoupon();

        // handle khi co datacart
        if (!empty($dataCart)) {
            $dataCartNew = [];
            foreach ($dataCart as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataCartNew[$idVariant])) {
                    $dataCartNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'cart_item_id' => $item['cart_item_id'],
                        'product_id' => $item['product_id'],
                        'cart_id' => $item['cart_id'],
                        'totalPrice' => $item['totalPrice'],
                        'title' => $item['title'],
                        'slug' => $item['slug'],
                        'thumb' => $item['thumb'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'attribute_values' => [$item['attribute_value']],
                    ];
                } else {
                    $dataCartNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataCartNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            $dataCartNew = array_values($dataCartNew);
        }

        $this->view('layoutClient', [
            'title' => 'Thanh toán',
            'currentPath' => '',
            'pages' => 'checkout/checkout',
            'dataPaymentMethod' => $dataPaymentMethod,
            'dataAddress' => $dataAddress,
            'dataCart' => $dataCartNew,
            'dataCoupon' => $dataCoupon,

        ]);
    }

    function checkoutFinal()
    {
        $dataPost = $this->req->getFields();
        $dataCart = $this->cartModel->getAllCart($this->user_id);
        $totalPrice = null;

        // handle khi co datacart
        if (!empty($dataCart)) {
            $dataCartNew = [];
            foreach ($dataCart as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataCartNew[$idVariant])) {
                    $dataCartNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'cart_item_id' => $item['cart_item_id'],
                        'product_id' => $item['product_id'],
                        'cart_id' => $item['cart_id'],
                        'totalPrice' => $item['totalPrice'],
                        'title' => $item['title'],
                        'thumb' => $item['thumb'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'attribute_values' => [$item['attribute_value']],
                    ];
                } else {
                    $dataCartNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataCartNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            $dataCartNew = array_values($dataCartNew);
        }
        $totalPrice = $dataCartNew[0]['totalPrice'];

        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'phone' => 'required|phone',
            'address' => 'required',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ và tên.',
            'phone.required' => 'Vui lòng không để trống số điện thoại.',
            'phone.phone' => 'Vui lòng nhập đúng số điện thoại.',
            'address.required' => 'Vui lòng không để trống địa chỉ.',
        ]);

        //Bat dau kiem tra da nhap dia chi hay chua
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            return $this->res->setToastSession('error', reset($dataError), 'checkout');
        }

        //Kiem tra da chon hinh thuc thanh toan hay chua
        if (!isset($dataPost['payment_method'])) {
            return $this->res->setToastSession('error', 'Vui lòng chọn hình thức thanh toán.', 'checkout');
        }

        $order_code = Format::generateRandomString(5) . time();

        $dataInsertOrder = [
            'order_code' => $order_code,
            'user_id' => $this->user_id,
            'fullname' => $dataPost['fullname'] ?? '',
            'phone' => $dataPost['phone'] ?? '',
            'address' => $dataPost['address'] ?? '',
            'note' => $dataPost['note'] ?? '',
            'coupon_id' => 0,
            'total_money' => $totalPrice,
            'order_status_id' => 1,
        ];

        // Kiem tra co nhap ma giam gia hay khong de tinh
        if (!empty($dataPost['coupon_code']) && $dataPost['coupon_code'] != 0) {
            $dataCoupon = $this->couponModel->getOneCouponCode($dataPost['coupon_code']);
            // Kiem tra ma giam gia co hop le hay khong

            if (empty($dataCoupon) || $dataCoupon['min_amount'] > $totalPrice || strtotime($dataCoupon['expired']) < time() || $dataCoupon['quantity'] == 0 || $dataCoupon['status'] == 0) {
                return $this->res->setToastSession('error', 'Vui lòng kiểm tra lại mã giảm giá.', 'checkout');
            }

            // Xu ly ma giam gia
            preg_match('/(\d+)(%)/', $dataCoupon['value'], $couponValueArr);

            //Xu ly la % hay la tru thang vao gia tien
            if (end($couponValueArr) == '%') {
                $totalPrice = $totalPrice * (1 - $couponValueArr[1] / 100);
            } else {
                $totalPrice -= $dataCoupon['value'];
            }

            $dataInsertOrder['coupon_id'] = $dataCoupon['id'];
            $dataInsertOrder['total_money'] = $totalPrice;
        }


        //Bat dau kiem tra hinh thuc thanh toan
        $paymentMethodArr = explode('-', $dataPost['payment_method']);
        $payment_method_id = reset($paymentMethodArr);

        //Thanh toan khi nhan hang
        if (trim(end($paymentMethodArr)) == 'cash_on_delivery') {
            return $this->handlePaymentMethod($dataInsertOrder, $dataCartNew, $payment_method_id);
        }

        // Thanh toan khi dung vnpay
        if (trim(end($paymentMethodArr)) == 'vnpay') {

            $dataOrderTemp = [
                'payment_method_id' => $payment_method_id,
                'dataInsertOrder' => $dataInsertOrder,
                'dataCartNew' => $dataCartNew,
            ];

            $bankUrl = Services::generateVnPayUrl([
                'amount' => $dataInsertOrder['total_money'],
                'order_code' => $dataInsertOrder['order_code'],
            ]);


            if (!empty($bankUrl)) {
                //Set tam vao data vao cookie
                Cookie::set('dataOrderTemp', json_encode($dataOrderTemp));
                header('location: ' . $bankUrl);
                return;
            }

            return $this->res->setToastSession('error', 'Phương thức thanh toán lỗi vui lòng thử lại.', 'home');
        }


        // Thanh toan khi dung momo
        if (trim(end($paymentMethodArr)) == 'momo') {

            $dataOrderTemp = [
                'payment_method_id' => $payment_method_id,
                'dataInsertOrder' => $dataInsertOrder,
                'dataCartNew' => $dataCartNew,
            ];

            $bankUrl = Services::generateMomoUrl([
                'amount' => $dataInsertOrder['total_money'],
                'order_code' => $dataInsertOrder['order_code'],
            ]);


            if (!empty($bankUrl)) {
                //Set tam vao data vao cookie
                Cookie::set('dataOrderTemp', json_encode($dataOrderTemp));
                header('location: ' . $bankUrl);
                return;
            }
            return $this->res->setToastSession('error', 'Phương thức thanh toán lỗi vui lòng thử lại.', 'home');
        }
    }
    private function handlePaymentMethod($dataInsertOrder, $dataCartNew, $payment_method_id, $dataGet = [])
    {

        // Them vao hoa don va hoa don chi tiet
        $createOrder = $this->orderModel->addNewOrder($dataInsertOrder);
        $cart_id = $dataCartNew[0]['cart_id'];
        $payment_transaction_id = 0;



        if (!$createOrder) {
            return $this->res->setToastSession('error', 'Đặt hàng thất bại vui lòng thử lại.', 'checkout');
        }

        $order_id = $this->db->lastInsertId();

        foreach ($dataCartNew as $orderItem) {

            $createOrderItem = $this->orderModel->addNewOrderItem([
                'order_id' => $order_id,
                'product_variant_id' => $orderItem['product_variant_id'],
                'price' => $orderItem['price'],
                'quantity' => $orderItem['quantity'],
                'total_money' => $orderItem['price'] * $orderItem['quantity'],
            ]);

            //Them vao order item
            if (!$createOrderItem) {
                return $this->res->setToastSession('error', 'Đặt hàng thất bại vui lòng thử lại.', 'checkout');
            }
        }



        // xu ly payment_transactions
        if (!empty($dataGet)) {

            //VNPAY
            if ($dataGet['vnp_OrderInfo'] == 'vnpay_payment') {

                $createPaymentTransactions = $this->paymentModel->addNewPaymentTransactions([
                    'bankCode' => $dataGet['vnp_BankCode'],
                    'bankTranNo' => $dataGet['vnp_BankTranNo'],
                    'cardType' => $dataGet['vnp_CardType'],
                    'payDate' => $dataGet['vnp_PayDate'],
                    'transactionNo' => $dataGet['vnp_TransactionNo'],
                    'secureHash' => $dataGet['vnp_SecureHash'],
                ]);
                if (!$createPaymentTransactions) {
                    return $this->res->setToastSession('error', 'Đặt hàng thất bại vui lòng thử lại.', 'checkout');
                }

                $payment_transaction_id = $this->db->lastInsertId();
            }

            // MOMO

            if ($dataGet['orderInfo'] == 'momo_payment') {

                $createPaymentTransactions = $this->paymentModel->addNewPaymentTransactions([
                    'bankCode' => 'SML',
                    'bankTranNo' => $dataGet['transId'],
                    'cardType' => $dataGet['payType'],
                    'payDate' => strtotime($dataGet['responseTime']) ?? time(),
                    'transactionNo' => $dataGet['transId'],
                    'secureHash' => $dataGet['signature'],
                ]);
                if (!$createPaymentTransactions) {
                    return $this->res->setToastSession('error', 'Đặt hàng thất bại vui lòng thử lại.', 'checkout');
                }

                $payment_transaction_id = $this->db->lastInsertId();
            }

            // ZALOPAY
        }

        //Them vao payment

        $createPayment = $this->paymentModel->addNewPayment([
            'order_id' => $order_id,
            'payment_method_id' => $payment_method_id,
            'payment_transaction_id' => $payment_transaction_id,
        ]);

        if (!$createPayment) {
            return $this->res->setToastSession('error', 'Đặt hàng thất bại vui lòng thử lại.', 'checkout');
        }


        // Dat hang thanh cong se xoa gio hang
        $deleteCartItem = $this->cartModel->deleteAllCartItem($cart_id);

        $deleteCart = $this->cartModel->deleteAllCart($cart_id);

        // delete cookie
        Cookie::unsetCookie('dataOrderTemp');

        if ($deleteCart && $deleteCartItem) {
            return $this->res->setToastSession('success', 'Bạn đã đặt hàng thành công.', 'my-account');
        } else {
            return $this->res->setToastSession('error', 'Đặt hàng thất bại vui lòng thử lại.', 'checkout');
        }
    }



    //Xử lý khi có thanh toán online
    function paymentFinal()
    {
        $dataOrderTemp = json_decode(Cookie::get('dataOrderTemp'), 1);
        if (empty($dataOrderTemp)) {
            return $this->res->redirect('home');
        }
        $dataGet = $this->req->getFields();
        unset($dataGet['url']);

        $dataInsertOrder = $dataOrderTemp['dataInsertOrder'];
        $dataCartNew = $dataOrderTemp['dataCartNew'];
        $payment_method_id = $dataOrderTemp['payment_method_id'];


        //Kiem tra do la hinh thuc thanh toan nao

        //Thanh toan vnpay
        if (isset($dataGet['vnp_OrderInfo']) == 'vnpay_payment' && $dataGet['vnp_ResponseCode'] == '00' && $dataGet['vnp_TransactionStatus'] == '00') {
            return $this->handlePaymentMethod($dataInsertOrder, $dataCartNew, $payment_method_id, $dataGet);
        }

        // Thanh toan momo

        if (isset($dataGet['orderInfo']) == 'momo_payment' && $dataGet['errorCode'] == '0') {
            return $this->handlePaymentMethod($dataInsertOrder, $dataCartNew, $payment_method_id, $dataGet);
        }

        // Thanh toan zalopay

        // Neu thanh toan that bai 
        Cookie::unsetCookie('dataOrderTemp');
        return $this->res->setToastSession('error', 'Đặt hàng thất bại vui lòng thử lại.', 'my-account');
    }

    // Xu ly trang thai don hang
    function updateOrderStatus()
    {
        if (!$this->req->isPost()) {
            return $this->res->redirect('my-account');
        }

        $dataPost = $this->req->getFields();

        if (empty($dataPost['order_id']) || empty($dataPost['order_status_id'])) {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại', 'my-account');
        }

        $updateStatus = $this->orderModel->updateOrder($dataPost['order_id'], [
            'order_status_id' => $dataPost['order_status_id']
        ]);

        if (!$updateStatus) {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại', 'my-account');
        }

        if ($dataPost['order_status_id'] == 4) {
            $dataOrderItem = $this->orderModel->getOderItem($dataPost['order_id']);

            foreach ($dataOrderItem as $orderItem) {
                $product_variant_id = $orderItem['product_variant_id'];
                $order_quantity = $orderItem['quantity'];

                $dataProductVariant = $this->productModel->getOneProdVariant($product_variant_id);
                // Update luot ban

                $this->productModel->updateProduct($dataProductVariant['prod_id'], [
                    'sold' => $dataProductVariant['sold'] + $order_quantity
                ]);
                // Update so luong da mua
                $this->productModel->updateProductVariant($product_variant_id, [
                    'quantity' => $dataProductVariant['variant_quantity'] - $order_quantity
                ]);
            }
        }

        return $this->res->setToastSession('success', 'Bạn đã cập nhập đơn hàng thành công.', 'my-account');
    }
}
