<?php
// Thong ke
class Statistical extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $categoryModel;
    private $orderModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->categoryModel = $this->model('CategoryModel');
        $this->orderModel = $this->model('OrderModel');
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
    }
    function getProdForCateChart()
    {
        $data = $this->categoryModel->getProdForCateChart();
        echo $this->res->dataApi('200', 'thanh cong', $data);
    }

    function amountStatistical()
    {
        $data = $this->orderModel->getAmountStatistical();
        echo $this->res->dataApi('200', 'thanh cong', $data);
    }
}
