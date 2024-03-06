<?php
class User extends Controller
{
    use SweetAlert;
    private $userModel;
    private $req = null;
    private $res = null;

    function __construct()
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
        $dataUserAd = $this->userModel->getAllUser() ?? [];
        $dataRole = $this->db->table('role')->get();


        $this->view('layoutServer', [
            'title' => 'Danh sách người dùng',
            'active' => 'user',
            'pages' => 'user/user',
            'dataUserAd' => $dataUserAd,
            'dataRole' => $dataRole,

        ]);
    }


    function addUser()
    {
        $dataRole = $this->db->table('role')->get();
        $dataValueOld = [];
        $type = 'error';
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataRole, $dataValueOld);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'role_id' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            're_password' => 'match:password',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ tên.',
            'role_id.required' => 'Vui chọn quyền người dùng.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            're_password.match' => 'Mật khẩu chưa khớp.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderAddPage($dataRole, $dataValueOld);
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExisted($dataPost['email']);

        if (!empty($isEmailExisted)) {
            $this->Toast($type, 'Email đã tồn tại.');
            return $this->renderAddPage($dataRole, $dataValueOld);
        }

        //Bam mat khau
        $hashedPassword = password_hash($dataPost['password'], PASSWORD_BCRYPT);

        // Them vao database
        $dataInsert =  [
            'fullname' => $dataPost['fullname'],
            'email' => $dataPost['email'],
            'password' => $hashedPassword,
            'role_id' => $dataPost['role_id'],
        ];

        $success = $this->db->create('user', $dataInsert);
        if ($success) {

            return $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/user');;
        } else {
            $this->Toast($type, 'Thêm mới thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataRole, $dataValueOld);
        }
    }

    private function renderAddPage($dataRole, $dataValueOld = [])
    {
        $this->view('layoutServer', [
            'title' => 'Thêm người dùng',
            'active' => 'user',
            'pages' => 'user/addUser',
            'dataRole' => $dataRole,
            'dataValueOld' => $dataValueOld,
        ]);
    }

    function updateUser($id)
    {
        $dataRole = $this->db->table('role')->get();
        $dataUserUp = $this->userModel->getOneUser($id) ?? [];
        $type = 'error';
        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataUserUp, $dataRole);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $avatar = $_FILES['avatar'];
        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|phone',
            'password' => 'required',
            're_password' => 'match:password',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ tên.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'phone.required' => 'Vui lòng không để trống số điện thoại.',
            'phone.phone' => 'Vui lòng nhập đúng phone.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            're_password.match' => 'Mật khẩu chưa khớp.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderUpdatePage($dataUserUp, $dataRole);
        }


        // Neu nguoi email khac voi input nguoi dung vua nhap thi se kiem tra ton tai hay khong? neu khong thi se kh kiem tra

        $checkEmail = $this->userModel->checkPhoneExisted($dataPost['email']);
        if ($dataUserUp['email'] != $dataPost['email'] && !empty($checkEmail)) {
            $this->Toast($type, 'Email đã tồn tại.');
            return $this->renderUpdatePage($dataUserUp, $dataRole);
        }

        $checkPhone = $this->userModel->checkPhoneExisted($dataPost['phone']);
        if ($dataUserUp['phone'] != $dataPost['phone'] && !empty($checkPhone)) {
            $this->Toast($type, 'Số điện thoại đã tồn tại.');
            return $this->renderUpdatePage($dataUserUp, $dataRole);
        }


        //Kiem tra lai mat khau
        if ($dataUserUp['password'] == $dataPost['password']) {
            $hashedPassword = $dataPost['password'];
        } else {
            $hashedPassword = password_hash($dataPost['password'], PASSWORD_BCRYPT);
        }

        // Cap nhap vao database
        $dataUpdate =  [
            'fullname' => $dataPost['fullname'],
            'email' => $dataPost['email'],
            'phone' => $dataPost['phone'],
            'password' => $hashedPassword,
            'address' => $dataPost['address'] ?? '',
            'isBlock' => $dataPost['isBlock'],
            'role_id' => $dataPost['role_id'],
            'update_at' => date('Y-m-d H:i:s'),
        ];


        if (!empty($avatar['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($avatar)) {
                return $this->renderUpdatePage($dataUserUp, $dataRole);
            }

            //upload anh len cloud
            $urlAvatar = Services::uploadImageToCloudinary($avatar['tmp_name']);
            if (empty($urlAvatar)) {
                return $this->renderUpdatePage($dataUserUp, $dataRole);
            }

            $dataUpdate['avatar'] = $urlAvatar;
        }

        $updateUser = $this->userModel->updateUser($id, $dataUpdate);
        if ($updateUser) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/user');;
        } else {
            $this->Toast($type, 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataUserUp, $dataRole);
        }
    }
    private function renderUpdatePage($dataUserUp, $dataRole)
    {
        $this->view('layoutServer', [
            'title' => 'Cập nhập người dùng',
            'active' => 'user',
            'pages' => 'user/updateUser',
            'dataUserUp' => $dataUserUp,
            'dataRole' => $dataRole,
        ]);
    }

    function changeIsBlock()
    {
        if ($this->req->isPost()) {
            $dataPost = $this->req->getFields();
            $dataUpdate = [
                'update_at' => date('Y-m-d H:i:s'),
            ];
            $data = $this->userModel->getOneUser($dataPost['user_id']);
            if ($data['isBlock'] == 1) {
                $dataUpdate['isBlock'] = 0;
            } else {
                $dataUpdate['isBlock'] = 1;
            }

            $update = $this->userModel->updateUser($dataPost['user_id'], $dataUpdate);
            if ($update) {
                echo json_encode(['success' => 'Cập nhập thành công.']);
                return;
            } else {
                echo json_encode(['success' => 'Cập nhập thất bại.']);
                return;
            }
        }
        return json_encode([]);
    }

    function deleteUser($id)
    {
        $success =  $this->userModel->deleteUser($id);
        if ($success) {
            Session::set('toastMessage', 'Xoá thành công.');
            return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/user');;
        }
        return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/user');;
    }
}
