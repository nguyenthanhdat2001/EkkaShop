<?php

class Category extends Controller
{
    use SweetAlert;
    private $categoryModel;
    private $req = null;
    private $res = null;

    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->categoryModel = $this->model('CategoryModel');
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

        $dataCate = $this->categoryModel->getAllCategory();

        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Danh sách danh mục',
            'pages' => 'category/category',
            'dataCate' => $dataCate ?? [],
        ]);
    }


    function addCategory()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Get image
        $image = $_FILES['image'] ?? '';

        //Validate
        if (empty($dataPost['name']) || empty($image['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataValueOld);
        }



        // Data Insert
        $dataInsert = [
            'name' => $dataPost['name'],
            'status' => $dataPost['status'],
        ];

        //  validate Upload image thumb
        if (!Format::validateUploadImage($image)) {
            $this->Toast('error', 'Kiểm tra lại file upload.');
            return $this->renderAddPage($dataValueOld);
        }

        //upload anh len cloud
        $urlThumb = Services::uploadImageToCloudinary($image['tmp_name']);
        if (empty($urlThumb)) {
            $this->Toast('error', 'Upload ảnh thất bại.');
            return $this->renderAddPage($dataValueOld);
        }
        $dataInsert['image'] = $urlThumb;


        $createCategory = $this->categoryModel->addNewCategory($dataInsert);

        if ($createCategory) {

            return $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/category');;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }
    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Thêm danh mục',
            'pages' => 'category/addCategory',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }

    function updateCategory($id)
    {
        $dataCate = $this->categoryModel->getOneCategory($id) ?? [];

        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataCate);
        }
        //Get data post
        $dataPost = $this->req->getFields();

        //Get image
        $image = $_FILES['image'] ?? '';

        //Validate
        if (empty($dataPost['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderUpdatePage($dataCate);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
            'status' => $dataPost['status'],
        ];

        if (!empty($image['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($image)) {
                $this->Toast('error', 'Kiểm tra lại file upload.');
                return $this->renderAddPage($dataCate);
            }

            //upload anh len cloud
            $urlThumb = Services::uploadImageToCloudinary($image['tmp_name']);
            if (empty($urlThumb)) {
                $this->Toast('error', 'Upload ảnh thất bại.');
                return $this->renderAddPage($dataCate);
            }
            $dataUpdate['image'] = $urlThumb;
        }

        $updateCategory = $this->categoryModel->updateCategory($id, $dataUpdate);

        if ($updateCategory) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/category');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataCate);
        }
    }

    private function renderUpdatePage($dataCate = [])
    {
        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Cập nhập danh mục',
            'pages' => 'category/updateCategory',
            'dataCate' => $dataCate
        ]);
    }



    function deleteCategory($id)
    {

        $success = $this->categoryModel->deleteCategory($id);

        if (!$success) {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/category');;
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/category');;
    }
}
