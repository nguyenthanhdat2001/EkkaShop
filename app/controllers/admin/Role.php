<?php

class Role extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $userModel;

    public function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->userModel = $this->model('UserModel');
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
        $dataRole = $this->userModel->getAllRole();
        $this->view('layoutServer', [
            'title' => 'Danh sách vai trò',
            'active' => 'role',
            'pages' => 'role/role',
            'dataRole' => $dataRole,
        ]);
    }
    function addRole()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }

        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Set rule
        $this->req->rules([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Set message
        $this->req->message([
            'name.required' => 'Vui lòng không để trống tên vai trò.',
            'description.required' => 'Vui lòng không để trống mô tả.',
        ]);


        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderAddPage($dataValueOld);
        }


        //check tieng viet co dau va co dau cach
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $dataPost['name'])) {
            $this->Toast('error', 'Tên vai trò không được ghi tiếng việt và có dấu cách.');
            return $this->renderAddPage($dataValueOld);
        }

        $dataInsert = [
            'name' => $dataPost['name'],
            'description' => $dataPost['description'],
        ];

        $createRole = $this->userModel->addNewRole($dataInsert);

        if ($createRole) {
            return $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/Role');;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }

    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'Role',
            'title' => 'Thêm vai trò',
            'pages' => 'role/addRole',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }

    function updateRole($id)
    {
        $dataRole = $this->userModel->getOneRole($id);
        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataRole);
        }

        //Get data post
        $dataPost = $this->req->getFields();

        //Set rule
        $this->req->rules([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Set message
        $this->req->message([
            'name.required' => 'Vui lòng không để trống tên vai trò.',
            'description.required' => 'Vui lòng không để trống mô tả.',
        ]);


        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderUpdatePage($dataRole);
        }


        //check tieng viet co dau va co dau cach
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $dataPost['name'])) {
            $this->Toast('error', 'Tên vai trò không được ghi tiếng việt và có dấu cách.');
            return $this->renderUpdatePage($dataRole);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
            'description' => $dataPost['description'],
        ];

        $updateRole = $this->userModel->updateRole($id, $dataUpdate);

        if ($updateRole) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/Role');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataRole);
        }
    }

    private function renderUpdatePage($dataRole)
    {
        $this->view('layoutServer', [
            'active' => 'Role',
            'title' => 'Cập nhập vai trò người dùng',
            'pages' => 'role/updateRole',
            'dataRole' => $dataRole ?? [],
        ]);
    }


    function deleteRole()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lõi xảy ra vui lòng thử lại.', 'admin/Role');;
        }

        return $this->res->setToastSession('warning', 'Tính năng đang phát triển.', 'admin/Role');;
    }
}
