<?php

class News extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $user_id = null;
    private $newsModel;

    public function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->newsModel = $this->model('NewsModel');
        $this->user_id = ViewShare::$dataShare['userData']['user_id'] ?? '';
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
        $dataNews = $this->newsModel->getAllNews();
        $this->view('layoutServer', [
            'title' => 'Tin tức',
            'active' => 'news',
            'pages' => 'news/news',
            'dataNews' => $dataNews,
        ]);
    }
    function addNews()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }

        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Kiem tra neu chua co ngươi dung
        if (empty($this->user_id)) {
            $this->Toast('error', 'Đã xảy ra lỗi vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }

        //Get image
        $thumb = $_FILES['thumb'] ?? '';

        //Validate
        if (empty($dataPost['title']) || empty($thumb['name']) || empty($dataPost['content'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataValueOld);
        }

        $dataInsert = [
            'title' => $dataPost['title'],
            'slug' => Format::createSlug($dataPost['title']),
            'content' => $dataPost['content'],
            'user_id' => $this->user_id,
            'status' => $dataPost['status'] ?? 0,
        ];



        //  validate Upload image thumb
        if (!Format::validateUploadImage($thumb)) {
            $this->Toast('error', 'Kiểm tra lại file ảnh.');
            return $this->renderAddPage($dataValueOld);
        }

        //upload anh len cloud
        $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
        if (empty($urlThumb)) {
            $this->Toast('error', 'Tải ảnh thất bại.');
            return $this->renderAddPage($dataValueOld);
        }

        $dataInsert['thumb'] = $urlThumb;

        $createNews = $this->newsModel->addNewNews($dataInsert);

        if ($createNews) {
            return $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/news');;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }

    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'news',
            'title' => 'Thêm bài viết',
            'pages' => 'news/addNews',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }

    function updateNews($id)
    {
        $dataNews = $this->newsModel->getOneNews($id);
        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataNews);
        }

        //Get data post
        $dataPost = $this->req->getFields();


        //Get image
        $thumb = $_FILES['thumb'] ?? '';

        //Validate
        if (empty($dataPost['title']) || empty($dataPost['content'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderUpdatePage($dataNews);
        }

        $dataUpdate = [
            'title' => $dataPost['title'],
            'slug' => Format::createSlug($dataPost['title']),
            'content' => $dataPost['content'],
            'status' => $dataPost['status'] ?? 0,
        ];

        if (!empty($thumb['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($thumb)) {
                $this->Toast('error', 'Kiểm tra lại file ảnh.');
                return $this->renderUpdatePage($dataNews);
            }

            //upload anh len cloud
            $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
            if (empty($urlThumb)) {
                $this->Toast('error', 'Tải ảnh thất bại.');
                return $this->renderUpdatePage($dataNews);
            }

            $dataUpdate['thumb'] = $urlThumb;
        }

        $updateNews = $this->newsModel->updateNews($id, $dataUpdate);

        if ($updateNews) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/news');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataNews);
        }
    }

    private function renderUpdatePage($dataNews)
    {
        $this->view('layoutServer', [
            'active' => 'news',
            'title' => 'Cập nhập bài viết',
            'pages' => 'news/updateNews',
            'dataNews' => $dataNews ?? [],
        ]);
    }


    function deleteNews($id)
    {
        $deleteNews = $this->newsModel->deleteNews($id);

        if (!$deleteNews) {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/news');;
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/news');;
    }
}
