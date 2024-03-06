<?php

class Order extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $orderModel;
    private $paymentModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->orderModel = $this->model('OrderModel');
        $this->paymentModel = $this->model('PaymentModel');
    }

    private function checkRoleAdmin()
    {
        $accessToken = null;
        //Check accessToken
        if (!empty(Session::get('userLogin'))) {
            $accessToken = JWT::verifyJWT(Session::get('userLogin')) ?? '';
        } else {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }

        //check accessToken con han
        if (!empty($accessToken) && isset($accessToken['error'])) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }

        $dataUserCurrent = $accessToken['payload'];
        if ($dataUserCurrent['role_id'] == 3) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }
    }


    function Default()
    {

        $dataOrder = $this->orderModel->getAllOrder();

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $this->view('layoutServer', [
            'active' => 'order',
            'title' => 'Danh sách đơn hàng',
            'pages' => 'order/order',
            'dataOrder' => $dataOrder ?? [],
        ]);
    }


    function orderDetail($idData)
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        // Lay ra id tu url
        $idDataArr = explode('-', $idData);

        // [0] => 10 order_id
        // [2] => zFicq1700390884 order_code
        $order_id = reset($idDataArr);
        // $order_code = end($idDataArr);

        $dataOrder = $this->orderModel->getAllOrderItemByUser($order_id);
        $dataOrderStatus = $this->orderModel->getAllOrderStatus();

        if (!empty($dataOrder)) {
            $dataOrderNew = [];
            foreach ($dataOrder as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataOrderNew[$idVariant])) {
                    $dataOrderNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'title' => $item['title'],
                        'thumb' => $item['thumb'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'order_id' => $item['order_id'],
                        'order_date' => $item['order_date'],
                        'order_code' => $item['order_code'],
                        'fullname' => $item['fullname'],
                        'phone' => $item['phone'],
                        'address' => $item['address'],
                        'order_status_id' => $item['order_status_id'],
                        'total_money' => $item['total_money'],
                        'coupon_id' => $item['coupon_id'],
                        'sub_total' => $item['price'] * $item['quantity'],
                        'payment_method_name' => $item['payment_method_name'],
                        'attribute_values' => [$item['attribute_value']],

                    ];
                } else {
                    $dataOrderNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataOrderNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            $dataOrderNew = array_values($dataOrderNew);
        }


        $this->view('layoutServer', [
            'active' => 'order',
            'title' => 'Chi tiết đơn hàng',
            'pages' => 'order/orderDetail',
            'dataOrder' => $dataOrderNew,
            'dataOrderStatus' => $dataOrderStatus,
            'idData' => $idData,
        ]);
    }

    // Xu ly trang thai don hang
    function updateOrderStatus()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại', 'admin/order');
        }

        $dataPost = $this->req->getFields();

        if (empty($dataPost['order_id']) || empty($dataPost['order_status_id']) || empty($dataPost['idData'])) {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại.', 'admin/order');
        }

        $dataOrder = $this->orderModel->getOneOrder($dataPost['order_id']);
        if ($dataOrder['order_status_id'] >= $dataPost['order_status_id']) {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại', 'admin/order-detail/' . $dataPost['idData']);
        }

        $updateStatus = $this->orderModel->updateOrder($dataPost['order_id'], [
            'order_status_id' => $dataPost['order_status_id']
        ]);

        if ($updateStatus) {
            return $this->res->setToastSession('success', 'Bạn đã cập nhập đơn hàng thành công.', 'admin/order-detail/' . $dataPost['idData']);
        } else {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại', 'admin/order-detail/' . $dataPost['idData']);
        }
    }

    function paymentMethod()
    {
        $dataPaymentMethod = $this->paymentModel->getAllPaymentMethodAd();

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Danh sách hình thức thanh toán',
            'pages' => 'order/paymentMethod',
            'dataPaymentMethod' => $dataPaymentMethod ?? [],
        ]);
    }

    function addPaymentMethod()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPaymentMethod($dataValueOld);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Get image
        $thumb = $_FILES['thumb'] ?? '';

        //Validate
        if (empty($thumb['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPaymentMethod($dataValueOld);
        }

        if (empty($dataPost['name']) || empty($dataPost['display_name']) || empty($dataPost['description'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPaymentMethod($dataValueOld);
        }

        $dataInsert = [
            'name' => $dataPost['name'],
            'display_name' => $dataPost['display_name'],
            'description' => $dataPost['description'],
        ];

        //  validate Upload image thumb
        if (!Format::validateUploadImage($thumb)) {
            $this->Toast('error', 'Kiểm tra lại file ảnh.');
            return $this->renderAddPaymentMethod($dataValueOld);
        }

        //upload anh len cloud
        $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
        if (empty($urlThumb)) {
            $this->Toast('error', 'Tải ảnh thất bại.');
            return $this->renderAddPaymentMethod($dataValueOld);
        }

        $dataInsert['thumb'] = $urlThumb;

        $createPaymentMethod = $this->paymentModel->addNewPaymentMethod($dataInsert);

        if ($createPaymentMethod) {
            return $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/payment-method');;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPaymentMethod($dataValueOld);
        }
    }

    private function renderAddPaymentMethod($dataValueOld)
    {
        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Thêm hình thức thanh toán',
            'pages' => 'order/addPaymentMethod',
            'dataValueOld' => $dataValueOld,
        ]);
    }

    function updatePaymentMethod($id)
    {
        $dataPaymentMethod = $this->paymentModel->getOnePaymentMethod($id);
        if (!$this->req->isPost()) {
            return $this->renderUpdatePaymentMethod($dataPaymentMethod);
        }

        //Get data post
        $dataPost = $this->req->getFields();
        //Get image
        $thumb = $_FILES['thumb'] ?? '';
        //Validate

        if (empty($dataPost['name']) || empty($dataPost['display_name']) || empty($dataPost['description'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPaymentMethod($dataPaymentMethod);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
            'display_name' => $dataPost['display_name'],
            'description' => $dataPost['description'],
            'status' => $dataPost['status'] ?? 0,
        ];

        if (!empty($thumb['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($thumb)) {
                $this->Toast('error', 'Kiểm tra lại file ảnh.');
                return $this->renderAddPaymentMethod($dataPaymentMethod);
            }

            //upload anh len cloud
            $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
            if (empty($urlThumb)) {
                $this->Toast('error', 'Tải ảnh thất bại.');
                return $this->renderAddPaymentMethod($dataPaymentMethod);
            }

            $dataUpdate['thumb'] = $urlThumb;
        }

        $updatePaymentMethod = $this->paymentModel->updatePaymentMethod($id, $dataUpdate);

        if ($updatePaymentMethod) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/payment-method');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderAddPaymentMethod($dataPaymentMethod);
        }
    }

    private function renderUpdatePaymentMethod($dataPaymentMethod)
    {
        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Thêm hình thức thanh toán',
            'pages' => 'order/updatePaymentMethod',
            'dataPaymentMethod' => $dataPaymentMethod,
        ]);
    }

    function printInvoiceApi($order_id)
    {

        $dataOrder = $this->orderModel->getAllOrderItemByUser($order_id);

        if (empty($dataOrder)) {
            return $this->res->dataApi('400', 'Có lỗi vui lòng thử lại.', []);
        }
        $dataUserCurrent = ViewShare::$dataShare;
        $nameCurrent = $dataUserCurrent['userData']['fullname'];


        if (!empty($dataOrder)) {
            $dataOrderNew = [];
            foreach ($dataOrder as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataOrderNew[$idVariant])) {
                    $dataOrderNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'title' => $item['title'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'order_date' => $item['order_date'],
                        'order_code' => $item['order_code'],
                        'address' => $item['fullname'] . ' - ' . $item['phone'] . ' - ' . $item['address'],
                        'sub_total' => $item['price'] * $item['quantity'],
                        'total_money' => $item['total_money'],
                        'coupon_id' => $item['coupon_id'],
                        'payment_method_name' => $item['payment_method_name'],
                        'attribute_values' => [$item['attribute_value']],

                    ];
                } else {
                    $dataOrderNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataOrderNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            foreach ($dataOrderNew as &$item) {
                $item['title'] = $item['title'] . " - ({$item['attribute_values']})";
            }

            $dataOrderNew = array_values($dataOrderNew);
        }

        $dataInfo = [
            'sender' => $nameCurrent,
            'order_code' => $dataOrderNew[0]['order_code'],
            'order_date' => $dataOrderNew[0]['order_date'],
            'address' => $dataOrderNew[0]['address'],
        ];

        $pdfContent = Services::generatePDF($dataInfo, $dataOrderNew, 'print');

        // Encode PDF content in base64
        $base64PDFContent = base64_encode($pdfContent);
        echo $base64PDFContent;
    }

    function downloadInvoice($order_id)
    {
        $dataOrder = $this->orderModel->getAllOrderItemByUser($order_id);

        if (empty($dataOrder)) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'order');
        }
        $dataUserCurrent = ViewShare::$dataShare;
        $nameCurrent = $dataUserCurrent['userData']['fullname'];


        if (!empty($dataOrder)) {
            $dataOrderNew = [];
            foreach ($dataOrder as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataOrderNew[$idVariant])) {
                    $dataOrderNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'title' => $item['title'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'order_date' => $item['order_date'],
                        'order_code' => $item['order_code'],
                        'address' => $item['fullname'] . ' - ' . $item['phone'] . ' - ' . $item['address'],
                        'sub_total' => $item['price'] * $item['quantity'],
                        'total_money' => $item['total_money'],
                        'coupon_id' => $item['coupon_id'],
                        'payment_method_name' => $item['payment_method_name'],
                        'attribute_values' => [$item['attribute_value']],

                    ];
                } else {
                    $dataOrderNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataOrderNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            foreach ($dataOrderNew as &$item) {
                $item['title'] = $item['title'] . " - ({$item['attribute_values']})";
            }

            $dataOrderNew = array_values($dataOrderNew);
        }

        $dataInfo = [
            'sender' => $nameCurrent,
            'order_code' => $dataOrderNew[0]['order_code'],
            'order_date' => $dataOrderNew[0]['order_date'],
            'address' => $dataOrderNew[0]['address'],
        ];



        return Services::generatePDF($dataInfo, $dataOrderNew);
    }
}
