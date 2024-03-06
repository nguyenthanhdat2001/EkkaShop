<?php
class Store extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $categoryModel;
    private $storeCustomModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->categoryModel = $this->model('CategoryModel');
        $this->storeCustomModel = $this->model('StoreCustomModel');
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
        $dataStoreCustom = $this->storeCustomModel->getAllStoreCustom();
        $dataBanner = $this->storeCustomModel->getAllBanner();
        $dataCate = $this->categoryModel->getAllCategory();

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');

            $this->ToastSession($toastMessage, $toastType);
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        }

        $dataPost = $this->req->getFields();

        //Get image
        $logo = $_FILES['logo'] ?? '';

        //Set rule
        $this->req->rules([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|phone',
            'email' => 'required|email',
            'open_time' => 'required',

        ]);

        // Set message
        $this->req->message([
            'name.required' => 'Vui lòng không để trống tên cửa hàng.',
            'address.required' => 'Vui lòng không để trống địa chỉ.',
            'phone.required' => 'Vui lòng không để trống số điện thoại.',
            'phone.phone' => 'Vui lòng nhập đúng đúng số điện thoại.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng email.',
            'open_time.required' => 'Vui lòng không để trống giờ mở cửa.',

        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        }


        $dataStoreCustomUpdate = [
            'name' => $dataPost['name'],
            'address' => $dataPost['address'],
            'phone' => $dataPost['phone'],
            'email' => $dataPost['email'],
            'open_time' => $dataPost['open_time'],
        ];


        if (!empty($logo['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($logo)) {
                $this->Toast('error', 'Kiểm tra lại file upload.');
                return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
            }

            //upload anh len cloud
            $urlLogo = Services::uploadImageToCloudinary($logo['tmp_name']);
            if (empty($urlLogo)) {
                $this->Toast('error', 'Upload ảnh thất bại.');
                return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
            }
            $dataStoreCustomUpdate['logo'] = $urlLogo;
        }

        $updateStoreCustom = $this->storeCustomModel->updateStoreCustom($dataPost['store_id'], $dataStoreCustomUpdate);


        if ($updateStoreCustom) {
            $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/store');
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        } else {
            $this->Toast('error', 'Cập nhập thất bại.');
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        }
    }

    private function renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate)
    {
        $dataStoreCustom = $this->storeCustomModel->getAllStoreCustom();

        $this->view('layoutServer', [
            'title' => 'Tuỳ chỉnh cửa hàng',
            'active' => 'storeCustom',
            'pages' => 'storeCustom/storeCustom',
            'dataBanner' => $dataBanner,
            'dataStoreCustom' => $dataStoreCustom,
            'dataCate' => $dataCate,

        ]);
    }


    function banner()
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');

            $this->ToastSession($toastMessage, $toastType);
            return $this->renderBannerPage();
        }
        $dataPost = $this->req->getFields();


        if (empty($dataPost['id'][0]) || empty($dataPost['title'][0]) || empty($dataPost['description'][0]) || empty($dataPost['name'][0])) {
            $this->Toast('error', 'Vui lòng nhập đầy đủ thông tin.');
            return $this->renderBannerPage();
        }

        foreach ($dataPost['id'] as $key => $id) {
            //    Cập nhập banner
            $createBanner = $this->storeCustomModel->updateBanner($id, [
                'title' => $dataPost['title'][$key],
                'description' => $dataPost['description'][$key],
                'name' => $dataPost['name'][$key],
            ]);

            if (!$createBanner) {
                // $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/store/banner');
                $this->Toast('error', 'Có lỗi vui lòng thử lại.');
                return $this->renderBannerPage();
            }
        }

        return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/store/banner');
    }
    private function renderBannerPage()
    {
        $dataBanner = $this->storeCustomModel->getAllBanner();

        $this->view('layoutServer', [
            'title' => 'Tuỳ chỉnh banner',
            'active' => 'banner',
            'pages' => 'storeCustom/bannerCustom',
            'dataBanner' => $dataBanner ?? [],

        ]);
    }

    function addBanner()
    {

        $dataValueOld = [];
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');

            $this->ToastSession($toastMessage, $toastType);
            return $this->renderAddBannerPages($dataValueOld);
        }

        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;
        $thumb = $_FILES['thumb'] ?? '';


        if (empty($dataPost['title']) || empty($dataPost['description']) || empty($dataPost['name'])) {
            $this->Toast('error', 'Vui lòng nhập đầy đủ thông tin');
            return $this->renderAddBannerPages($dataValueOld);
        }

        if (empty($thumb['name'])) {
            $this->Toast('error', 'Vui lòng nhập đầy đủ thông tin');
            return $this->renderAddBannerPages($dataValueOld);
        }

        $dataInsert = [
            'title' => $dataPost['title'],
            'description' => $dataPost['description'],
            'name' => $dataPost['name'],
        ];

        //  validate Upload image thumb
        if (!Format::validateUploadImage($thumb)) {
            $this->Toast('error', 'Kiểm tra lại file upload.');
            return $this->renderAddBannerPages($dataValueOld);
        }

        //upload anh len cloud
        $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
        if (empty($urlThumb)) {
            $this->Toast('error', 'Upload ảnh thất bại.');
            return $this->renderAddBannerPages($dataValueOld);
        }
        $dataInsert['thumb'] = $urlThumb;


        $createBanner = $this->storeCustomModel->addNewBanner($dataInsert);

        if (!$createBanner) {
            $this->Toast('error', 'Thất bại vui lòng thử lại.');
            return $this->renderAddBannerPages($dataValueOld);
        }
        return $this->res->setToastSession('success', 'Thêm banner thành công.', 'admin/store/banner');
    }

    function renderAddBannerPages($dataValueOld)
    {
        $this->view('layoutServer', [
            'title' => 'Tuỳ chỉnh banner',
            'active' => 'banner',
            'pages' => 'storeCustom/addNewbanner',
            'dataValueOld' => $dataValueOld ?? []

        ]);
    }

    function deleteBanner($id)
    {
        $delete = $this->storeCustomModel->deleteBanner($id);

        if ($delete) {
            return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/store/banner');
        }
        return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/store/banner');
    }
}
