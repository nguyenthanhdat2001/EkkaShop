<?php

class DashBoard extends Controller
{

    use SweetAlert;
    private $req = null;
    private $res = null;
    private $productModel;
    private $userModel;
    private $categoryModel;
    private $storeCustomModel;
    private $orderModel;
    private $purchaseOrderModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->storeCustomModel = $this->model('StoreCustomModel');
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
        $this->purchaseOrderModel = $this->model('PurchaseOrderModel');
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

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $prodCount = $this->productModel->countProduct();
        $userCount = $this->userModel->countUser();
        $orderCount = $this->orderModel->countOrder();

        $dataProdOrderBySold = $this->productModel->getAllProductOrderBySold();
        $dataProdAll = $this->productModel->getAllProduct();
        $dataRatingsProd = $this->productModel->getAllRatingDashboard() ?? [];
        $dataAmount = $this->orderModel->getAmountStatistical();
        $sumPurchaseOrder = $this->purchaseOrderModel->sumPurchaseOrder();


        $totalRevenue = 0;
        $totalSold = 0;
        foreach ($dataProdAll as $item) {
            $totalSold += $item['sold'];
        }
        foreach ($dataAmount as $itemAmount) {
            $totalRevenue += $itemAmount['total_amount'];
        }

        $this->view('layoutServer', [
            'title' => 'Bảng điều khiển',
            'active' => 'dashboard',
            'pages' => 'dashboard',
            'prodCount' => $prodCount['countProduct'] ?? 0,
            'userCount' => $userCount['countUser'] ?? 0,
            'dataProdOrderBySold' => $dataProdOrderBySold ?? [],
            'totalRevenue' => $totalRevenue ?? 0,
            'totalSold' => $totalSold ?? 0,
            'orderCount' => $orderCount ?? 0,
            'sumPurchaseOrder' => $sumPurchaseOrder ?? 0,
            'dataRatingsProd' => $dataRatingsProd ?? [],
        ]);
    }
}
