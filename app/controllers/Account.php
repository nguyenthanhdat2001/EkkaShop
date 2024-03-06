<?php
class Account extends Controller
{
    use SweetAlert;

    private $req = null;
    private $res = null;
    private $userModel;
    private $orderModel;
    private $user_id = null;

    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
        $this->user_id = ViewShare::$dataShare['userData']['user_id'] ?? '';
    }

    function Default()
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $dataOrder = $this->orderModel->getAllOrderByUser($this->user_id);
        $dataUserCurrent = $this->userModel->getOneUser($this->user_id);


        $this->view('layoutClient', [
            'title' => 'Quản lý tài khoản',
            'currentPath' => '',
            'pages' => 'account/myAccount',
            'dataOrder' => $dataOrder ?? [],
            'dataUserCurrent' => $dataUserCurrent ?? [],
        ]);
    }

    function order()
    {
        $dataOrder = $this->orderModel->getAllOrderByUser($this->user_id);

        $this->view('layoutClient', [
            'title' => 'Lịch sử mua hàng',
            'currentPath' => '',
            'pages' => 'account/order',
            'dataOrder' => $dataOrder ?? [],
        ]);
    }


    function orderDetail($order_id)
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $orderIdArr = explode('-', $order_id);
        // [0] => 10 // order_id
        // [1] => zFicq1700390884 // order_code
        $order_id = reset($orderIdArr);

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
                        'prod_id' => $item['prod_id'],
                        'slug' => $item['slug'],
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



        $this->view('layoutClient', [
            'title' => 'Chi tiết đơn hàng',
            'currentPath' => '',
            'pages' => 'account/orderDetail',
            'dataOrder' => $dataOrderNew ?? [],
            'dataOrderStatus' => $dataOrderStatus ?? [],
        ]);
    }


    function checkIdentificateExistedApi()
    {
        if ($this->req->isPost()) {
            $dataPost = $this->req->getFields();
            $data = $this->userModel->checkEmailExistedApi($dataPost['email']);
            echo json_encode($data);
            return;
        }
    }

    function checkStrongPasswordApi()
    {
        if ($this->req->isPost()) {
            $dataPost = $this->req->getFields();
            $isCheckPass = Format::isStrongPassword($dataPost['password']);
            echo json_encode($isCheckPass ? ['code' => 200] : ['code' => 400]);
        }
    }

    // Login
    public function login()
    {
        $dataValueOld = [];
        $type = 'error';

        if (!$this->req->isPost()) {
            $toatMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toatMessage, $toastType);
            return $this->renderLoginPage($dataValueOld);
        }

        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Set rule
        $this->req->rules([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Set message
        $this->req->message([
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderLoginPage($dataValueOld);
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExisted($dataPost['email']);

        if (empty($isEmailExisted)) {
            $this->Toast($type, 'Email hoặc mật khẩu không chính xác.');
            return $this->renderLoginPage($dataValueOld);
        }

        // Neu tai khoan bi khoa se hien thi loi
        if ($isEmailExisted['isBlock'] != 0) {
            $this->Toast($type, 'Tài khoản của bạn đã bị khoá.');
            return $this->renderLoginPage($dataValueOld);
        }

        // Check password
        if (password_verify($dataPost['password'], $isEmailExisted['password'])) {
            $userData = [
                'user_id' => $isEmailExisted['id'],
                'role_id' => $isEmailExisted['role_id'],
                'fullname' => $isEmailExisted['fullname'],
                'avatar' => $isEmailExisted['avatar'],
                'isBlock' => $isEmailExisted['isBlock'],
            ];

            if (!empty($isEmailExisted['avatar'])) {
                $userData['avatar'] = $isEmailExisted['avatar'];
            }

            // Create token
            $accessToken = JWT::createJWT($userData, (2 * 3600)); // 2h
            $refreshToken = JWT::createJWT(['refreshToken' => $isEmailExisted['id']], (7 * 24 * 3600)); //7 day

            $dataToken = [
                'accessToken' => $accessToken,
                'refreshToken' => $refreshToken,
                'update_at' => date('Y-m-d H:i:s'),
            ];

            //Update token
            if ($this->userModel->updateToken($isEmailExisted['id'], $dataToken)) {
                Session::set('userLogin', $accessToken);
                Cookie::set('keepLogin', $refreshToken, 7 * 24 * 3600);

                $redirectUrl = ($isEmailExisted['role_id'] == 1) ? 'admin/DashBoard' : 'home';
                $this->Alert('Đăng nhập thành công.', 'success', $redirectUrl, 1200);
                return $this->renderLoginPage($dataValueOld);
            } else {
                $this->Toast('error', 'Có lỗi vui lòng đăng nhập lại.');
                return $this->renderLoginPage($dataValueOld);
            }
        } else {
            $this->Toast('error', 'Tài khoản hoặc mật khẩu không chính xác.');
            return $this->renderLoginPage($dataValueOld);
        }
    }
    private function renderLoginPage($dataValueOld = [])
    {

        $this->view('layoutClient', [
            'title' => 'Đăng nhập',
            'currentPath' => '',
            'pages' => 'account/login',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }
    // End Login

    // Register
    function register()
    {
        if ($this->req->isPost()) {
            $dataValueOld = $this->req->getFields();
        }
        $this->view('layoutClient', [
            'title' => 'Đăng ký',
            'pages' => 'account/register',
            'currentPath' => '',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }
    function registerApi()
    {
        $type = 'error';
        $dataPost = $this->req->getFields();

        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required|strong',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ và tên.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            'password.strong' => 'Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            echo json_encode([$type => reset($dataError)]);
            return;
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExisted($dataPost['email']);
        if (!empty($isEmailExisted)) {
            echo json_encode([$type => 'Email đã tồn tại vui lòng đăng nhập.']);
            return;
        }

        //Bam mat khau
        $hashedPassword = password_hash($dataPost['password'], PASSWORD_BCRYPT);

        //Tao token
        $token = Format::generateRandomString(64);
        $subject = 'Xác nhận đăng ký.';
        $tokenUrl = 'https://ekkashoe.shop/ecommerce_php_5_1/signup-comfirm/' . $token;
        $body = TemplateHtml::emailConfirm($tokenUrl);

        // luu tam du lieu vao cookie truoc khi xac nhan
        $tempUser = array(
            'email' => $dataPost['email'],
            'fullname' => $dataPost['fullname'],
            'password' => $hashedPassword,
            'token' => password_hash($token, PASSWORD_BCRYPT)
        );
        //gui mail
        $sendMail = Services::sendCode($dataPost['email'], $subject,  $body);

        //gui thanh cong
        if ($sendMail) {
            Cookie::set('tempUser', json_encode($tempUser));
            echo json_encode(['success' => 'Vui lòng xác nhận email để hoàn tất đăng ký.']);
            return;
        }

        echo json_encode(['error' => 'Đã có lỗi sảy ra vui lòng đăng ký lại.']);
        return;
    }
    function finalRegisterUser($token)
    {

        $dataSuccess = [
            'icon' => 'check',
            'h1' => 'Xác nhận đăng ký thành công.',
            'h5' => 'Xác nhận đăng ký thành công vui lòng đăng nhập.'

        ];
        $dataError = [
            'icon' => 'times',
            'h1' => 'Xác nhận đăng ký thất bại.',
            'h5' => 'Đường link xác nhận đã hết hạn vui lòng đăng ký lại.'
        ];

        //Lay du lieu tu cookie da luu tu buoc tren
        $tempUser = json_decode(Cookie::get('tempUser'), true);

        //Xac nhan neu khong dung thi hien data loi
        if (empty($tempUser) || !password_verify($token, $tempUser['token'])) {

            return $this->view('layoutLogin', [
                'title' => 'Xác nhận đăng ký',
                'pages' => 'account/activeAccount',
                'dataRegister' => $dataError ?? []
            ]);
        }

        //Neu dung thi them du lieu tai khoan vao database
        $dataInsert = ['email' => $tempUser['email'], 'fullname' => $tempUser['fullname'], 'password' => $tempUser['password']];

        $success = $this->db->create('user', $dataInsert);
        if ($success) {
            Cookie::unsetCookie('tempUser');
            return $this->view('layoutLogin', [
                'title' => 'Xác nhận đăng ký',
                'pages' => 'account/activeAccount',
                'dataRegister' => $dataSuccess ?? []
            ]);
        } else {
            Cookie::unsetCookie('tempUser');
            return $this->view('layoutLogin', [
                'title' => 'Xác nhận đăng ký',
                'pages' => 'account/activeAccount',
                'dataRegister' => $dataError ?? []
            ]);
        }
    }
    // End Register

    // forgot Password
    function forgotPassword()
    {
        $this->view('layoutClient', [
            'title' => 'Quên mật khẩu',
            'currentPath' => '',
            'pages' => 'account/forgotPassword'
        ]);
    }

    function forgotPasswordApi()
    {
        $type = 'error';
        $dataPost = $this->req->getFields();


        //Set rule
        $this->req->rules([
            'email' => 'required|email',
        ]);

        // Set message
        $this->req->message([
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
        ]);

        //Start validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            echo json_encode([$type => reset($dataError)]);
            return;
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExistedApi($dataPost['email']);
        if ($isEmailExisted['code'] == 400) {
            echo json_encode([$type => 'Email không tồn tại vui lòng đăng ký.']);
            return;
        }

        // Create token
        $token = Format::generateRandomString(64);
        $subject = 'Đặt lại mật khẩu.';
        $tokenUrl = 'https://ekkashoe.shop/ecommerce_php_5_1/account/finalForgotPassword/' . $token;
        $body = TemplateHtml::resetPasswordConfirm($tokenUrl);


        //Send mail
        $sendMail = Services::sendCode($dataPost['email'], $subject,  $body);

        //Set data with cookie
        $dataResetPassword = [
            'email' => $dataPost['email'],
            'token' => password_hash($token, PASSWORD_BCRYPT)
        ];

        if ($sendMail) {
            Cookie::set('resetPassword', json_encode($dataResetPassword));
            echo json_encode(['success' => 'Vui lòng xác nhận email để đổi mật khẩu.']);
            return;
        }
    }



    function finalForgotPassword($token)
    {
        $resetPasswordToken = json_decode(Cookie::get('resetPassword'), true);

        if (empty($resetPasswordToken) && !password_verify($token, $resetPasswordToken['token'])) {
            Session::set('toastMessage', 'Đường link xác nhận đã hết hạn vui lòng thực hiện lại.');
            Session::set('toastType', 'error');
            Cookie::unsetCookie('resetPassword');
            return $this->res->redirect('login');
        }
        return $this->res->redirect('reset-password');
    }


    function resetPassword()
    {
        $resetPasswordToken = json_decode(Cookie::get('resetPassword'), true);
        //Kiem tra co cookie khong
        if (empty($resetPasswordToken) || !isset($resetPasswordToken['email']) || !isset($resetPasswordToken['token'])) {
            Session::set('toastMessage', 'Đường link xác nhận đã hết hạn vui lòng thực hiện lại.');
            Session::set('toastType', 'error');
            Cookie::unsetCookie('resetPassword');
            return $this->res->redirect('login');
        }

        $type = 'error';
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        if (!$this->req->isPost()) {
            return $this->renderResetPasswordPage($dataValueOld);
        }

        //Set rule
        $this->req->rules([
            'password' => 'required|strong',
            're_password' => 'match:password',
        ]);

        // Set message
        $this->req->message([
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            'password.strong' => 'Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.',
            're_password.match' => 'Mật khẩu chưa khớp vui lòng thử lại.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderResetPasswordPage($dataValueOld);
        }

        $dataUpdate = [
            'email' => $resetPasswordToken['email'],
            'password' => password_hash($dataPost['password'], PASSWORD_BCRYPT),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        // Update
        $updatePass = $this->userModel->updatePassword($resetPasswordToken['email'], $dataUpdate);

        //Handle thong bao
        if ($updatePass) {
            Cookie::unsetCookie('resetPassword');
            $this->Alert('Đặt lại mật khẩu thành công vui lòng đăng nhập.', 'success', 'login');
            return $this->renderResetPasswordPage($dataValueOld);
        } else {
            Session::set('toastMessage', 'Đặt lại mật khẩu thất bại vui lòng thực hiện lại.');
            Session::set('toastType', 'error');
            Cookie::unsetCookie('resetPassword');
            return $this->res->redirect('login');
        }
    }

    private function renderResetPasswordPage($dataValueOld)
    {
        $this->view('layoutClient', [
            'title' => 'Đặt lại mật khẩu',
            'pages' => 'account/resetPassword',
            'currentPath' => '',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }
    // End forgot Password
    function logout()
    {
        Session::destroy();
        Cookie::unsetCookie('keepLogin');
        header('location: /ecommerce_php_5_1/');
    }

    function updateUserCurrent()
    {
        $dataUserUp = $this->userModel->getOneUser($this->user_id) ?? [];
        $type = 'error';
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'my-account');
        }
        //Get data post
        $dataPost = $this->req->getFields();

        $avatar = $_FILES['avatar'];
        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|phone',
            'old_password' => 'required',
            'new_password' => 'required|strong',
            're_new_password' => 'match:new_password',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ tên.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'phone.required' => 'Vui lòng không để trống số điện thoại.',
            'phone.phone' => 'Vui lòng nhập đúng phone.',
            'new_password.required' => 'Vui lòng không để trống mật khẩu.',
            'new_password.strong' => 'Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.',
            're_new_password.match' => 'Mật khẩu chưa khớp.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->res->setToastSession('error', reset($dataError), 'my-account');
        }


        // Neu nguoi email khac voi input nguoi dung vua nhap thi se kiem tra ton tai hay khong? neu khong thi se kh kiem tra

        $checkEmail = $this->userModel->checkPhoneExisted($dataPost['email']);
        if ($dataUserUp['email'] != $dataPost['email'] && !empty($checkEmail)) {
            return $this->res->setToastSession('error', 'Email đẫ tồn tại', 'my-account');
        }

        $checkPhone = $this->userModel->checkPhoneExisted($dataPost['phone']);
        if ($dataUserUp['phone'] != $dataPost['phone'] && !empty($checkPhone)) {
            return $this->res->setToastSession('error', 'Số điện thoại đẫ tồn tại', 'my-account');
        }


        //Kiem tra lai mat khau
        if (!password_verify($dataPost['old_password'], $dataUserUp['password'])) {
            return $this->res->setToastSession('error', 'Mật khẩu không chính xác.', 'my-account');
        }

        $hashedPassword = password_hash($dataPost['new_password'], PASSWORD_BCRYPT);


        // Cap nhap vao database
        $dataUpdate =  [
            'fullname' => $dataPost['fullname'],
            'email' => $dataPost['email'],
            'phone' => $dataPost['phone'],
            'password' => $hashedPassword,
            'update_at' => date('Y-m-d H:i:s'),
        ];


        if (!empty($avatar['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($avatar)) {
                return $this->res->setToastSession('error', 'Có lỗi vể ảnh vui lòng kiểm tra lại.', 'my-account');
            }

            //upload anh len cloud
            $urlAvatar = Services::uploadImageToCloudinary($avatar['tmp_name']);
            if (empty($urlAvatar)) {
                return $this->res->setToastSession('error', 'Có lỗi vể ảnh vui lòng kiểm tra lại.', 'my-account');
            }
            $dataUpdate['avatar'] = $urlAvatar;
        }

        $updateUser = $this->userModel->updateUser($this->user_id, $dataUpdate);
        if ($updateUser) {
            return $this->res->setToastSession('success', 'Cập nhập tài khoản thành công.', 'my-account');;
        } else {
            return $this->res->setToastSession('error', 'Cập nhập tài khoản thất bại.', 'my-account');;
        }
    }
}
