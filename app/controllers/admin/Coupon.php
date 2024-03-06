<?php

class Coupon extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $couponModel;

    public function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->couponModel = $this->model('CouponModel');
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
        $dataCoupon = $this->couponModel->getAllCoupon();
        $this->view('layoutServer', [
            'title' => 'Mã giảm giá',
            'active' => 'coupon',
            'pages' => 'coupon/coupon',
            'dataCoupon' => $dataCoupon,
        ]);
    }
    function addCoupon()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }

        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Get image
        $thumb = $_FILES['thumb'] ?? '';

        //Set rule
        $this->req->rules([
            'title' => 'required',
            'code' => 'required',
            'value' => 'required',
            'min_amount' => 'required',
            'quantity' => 'required',
            'expired' => 'required',
        ]);

        // Set message
        $this->req->message([
            'title.required' => 'Vui lòng không để trống tiêu đề.',
            'code.required' => 'Vui lòng không để trống mã.',
            'quantity.required' => 'Vui lòng không để trống số lượng.',
            'value.required' => 'Vui lòng không để trống giá trị mã.',
            'min_amount.required' => 'Vui lòng không để trống giá tối thiểu.',
            'expired.required' => 'Vui lòng không để trống ngày hết hạn.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderAddPage($dataValueOld);
        }


        //Validate image
        if (empty($thumb['name'])) {
            $this->Toast('error', 'Vui lòng không ảnh.');
            return $this->renderAddPage($dataValueOld);
        }



        $dataInsert = [
            'title' => $dataPost['title'],
            'code' => $dataPost['code'],
            'value' => $dataPost['value'],
            'min_amount' => $dataPost['min_amount'],
            'quantity' => $dataPost['quantity'],
            'expired' => $dataPost['expired'],
            'status' => strtotime($dataPost['expired']) > time() ? 1 : 0,
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

        $createCoupon = $this->couponModel->addNewCoupon($dataInsert);

        if ($createCoupon) {
            return $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/coupon');;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }

    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'coupon',
            'title' => 'Thêm mã giảm giá',
            'pages' => 'coupon/addCoupon',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }

    function updateCoupon($id)
    {
        $dataCoupon = $this->couponModel->getOneCoupon($id);
        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataCoupon);
        }

        //Get data post
        $dataPost = $this->req->getFields();

        //Get image
        $thumb = $_FILES['thumb'] ?? '';

        //Set rule
        $this->req->rules([
            'title' => 'required',
            'code' => 'required',
            'value' => 'required',
            'min_amount' => 'required',
            'quantity' => 'required',
            'expired' => 'required',
        ]);

        // Set message
        $this->req->message([
            'title.required' => 'Vui lòng không để trống tiêu đề.',
            'code.required' => 'Vui lòng không để trống mã.',
            'quantity.required' => 'Vui lòng không để trống số lượng.',
            'value.required' => 'Vui lòng không để trống giá trị mã.',
            'min_amount.required' => 'Vui lòng không để trống giá tối thiểu.',
            'expired.required' => 'Vui lòng không để trống ngày hết hạn.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderAddPage($dataCoupon);
        }


        $dataUpdate = [
            'title' => $dataPost['title'],
            'code' => $dataPost['code'],
            'value' => $dataPost['value'],
            'min_amount' => $dataPost['min_amount'],
            'quantity' => $dataPost['quantity'],
            'expired' => $dataPost['expired'],
            'status' => strtotime($dataPost['expired']) > time() ? 1 : 0,
        ];

        if (!empty($thumb['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($thumb)) {
                $this->Toast('error', 'Kiểm tra lại file ảnh.');
                return $this->renderUpdatePage($dataCoupon);
            }

            //upload anh len cloud
            $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
            if (empty($urlThumb)) {
                $this->Toast('error', 'Tải ảnh thất bại.');
                return $this->renderUpdatePage($dataCoupon);
            }

            $dataUpdate['thumb'] = $urlThumb;
        }

        $updateCoupon = $this->couponModel->updateCoupon($id, $dataUpdate);

        if ($updateCoupon) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/coupon');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataCoupon);
        }
    }

    private function renderUpdatePage($dataCoupon)
    {
        $this->view('layoutServer', [
            'active' => 'coupon',
            'title' => 'Cập nhập mã giảm giá',
            'pages' => 'coupon/updateCoupon',
            'dataCoupon' => $dataCoupon ?? [],
        ]);
    }


    function deleteCoupon($id)
    {

        $deleteCoupon = $this->couponModel->deleteCoupon($id);

        if (!$deleteCoupon) {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/coupon');;
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/coupon');;
    }
}
