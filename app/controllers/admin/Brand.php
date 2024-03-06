<?php

class Brand extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $brandModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->brandModel = $this->model('BrandModel');
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

        $dataBrand = $this->brandModel->getAllBrand();

        $this->view('layoutServer', [
            'active' => 'brand',
            'pages' => 'brand/brand',
            'title' => 'Danh sách thương hiệu',
            'dataBrand' => $dataBrand,
        ]);
    }
    function getOneBrandApi($id)
    {
        $data = $this->brandModel->getOneBrand($id);
        echo json_encode($data ?? []);
    }

    function addBrand()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

		

        //Validate
        if (empty($dataPost['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataValueOld);
        }


        $dataInsert = [
            'name' => $dataPost['name'],
            'status' => $dataPost['status']
        ];

        $createBrand = $this->brandModel->addNewBrand($dataInsert);

        if ($createBrand) {
            $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/brand');
            return;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }
    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'brand',
            'title' => 'Thêm thương hiệu',
            'pages' => 'brand/addBrand',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }

    function updateBrand($id)
    {
        $dataBrand = $this->brandModel->getOneBrand($id) ?? [];

        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataBrand);
        }
        //Get data post
        $dataPost = $this->req->getFields();


        //Validate
        if (empty($dataPost['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderUpdatePage($dataBrand);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
            'status' => $dataPost['status']
        ];


        $updateBrand = $this->brandModel->updateBrand($id, $dataUpdate);

        if ($updateBrand) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/brand');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataBrand);
        }
    }

    private function renderUpdatePage($dataBrand = [])
    {
        $this->view('layoutServer', [
            'active' => 'brand',
            'title' => 'Cập nhập thương hiệu',
            'pages' => 'brand/updateBrand',
            'dataBrand' => $dataBrand
        ]);
    }


    function deleteBrand($id)
    {

        $success = $this->brandModel->deleteBrand($id);

        if (!$success) {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/brand');
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/brand');
    }
}
