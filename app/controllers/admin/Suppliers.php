<?php
class Suppliers extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $suppliersModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->suppliersModel = $this->model('SuppliersModel');
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

        $dataSuppliers = $this->suppliersModel->getAllSuppliers();

        $this->view('layoutServer', [
            'active' => 'suppliers',
            'pages' => 'suppliers/suppliers',
            'title' => 'Danh sách nhà cung cấp',
            'dataSuppliers' => $dataSuppliers,
        ]);
    }

    function addSuppliers()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;


        //Validate
        if (empty($dataPost['name']) || empty($dataPost['phone']) || empty($dataPost['address']) || empty($dataPost['email'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataValueOld);
        }


        $dataInsert = [
            'name' => $dataPost['name'],
            'phone' => $dataPost['phone'],
            'address' => $dataPost['address'],
            'email' => $dataPost['email'],
        ];

        $createSuppliers = $this->suppliersModel->addNewSuppliers($dataInsert);

        if ($createSuppliers) {
            $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/suppliers');
            return;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }
    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'suppliers',
            'title' => 'Thêm nhà cung cấp',
            'pages' => 'suppliers/addSuppliers',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }

    function updateSuppliers($id)
    {
        $dataSuppliers = $this->suppliersModel->getOneSuppliers($id) ?? [];

        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataSuppliers);
        }
        //Get data post
        $dataPost = $this->req->getFields();


        //Validate
        if (empty($dataPost['name']) || empty($dataPost['phone']) || empty($dataPost['address']) || empty($dataPost['email'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataSuppliers);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
            'phone' => $dataPost['phone'],
            'address' => $dataPost['address'],
            'email' => $dataPost['email'],
        ];


        $updateSuppliers = $this->suppliersModel->updateSuppliers($id, $dataUpdate);

        if ($updateSuppliers) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/suppliers');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataSuppliers);
        }
    }

    private function renderUpdatePage($dataSuppliers = [])
    {
        $this->view('layoutServer', [
            'active' => 'suppliers',
            'title' => 'Cập nhập thương hiệu',
            'pages' => 'suppliers/updateSuppliers',
            'dataSuppliers' => $dataSuppliers
        ]);
    }


    function deleteSuppliers($id)
    {

        $success = $this->suppliersModel->deleteSuppliers($id);

        if (!$success) {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/suppliers');
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/suppliers');
    }
}
