<?php
class UserModel extends BaseModel
{
    use SweetAlert;

    function tableName()
    {
        return 'user';
    }
    function tableField()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }

    function getAddress($user_id)
    {
        return $this->db->findById($this->tableName(), 'fullname, address, phone', $user_id);
    }

    function checkEmailExisted($email)
    {
        $isHasEmail = $this->db->table($this->tableName())->select('id ,email, isBlock, password, role_id, avatar, fullname')->where('email', '=', $email)->getOne();
        if (!empty($isHasEmail)) {
            return $isHasEmail;
        }
        return [];
    }

    function checkPhoneExisted($phone)
    {
        $isHasPhone = $this->db->table($this->tableName())->select('id ,phone, isBlock, password, role_id, avatar, fullname')->where('phone', '=', $phone)->getOne();
        if (!empty($isHasPhone)) {
            return $isHasPhone;
        }
        return [];
    }


    function checkEmailExistedApi($email)
    {
        $isHasEmail = $this->db->table($this->tableName())->select('email')->where('email', '=', $email)->getOne();
        if (!empty($isHasEmail)) {
            return ['code' => '200'];
        }
        return ['code' => '400'];
    }


    function updateToken($id, $data)
    {
        $success = $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
        return $success ? true : false;
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
        $tempUser = json_decode(Cookie::get('tempUser'), true);


        if (empty($tempUser) || !password_verify($token, $tempUser['token'])) {
            return $dataError;
        }


        $dataInsert = ['email' => $tempUser['email'], 'fullname' => $tempUser['fullname'], 'password' => $tempUser['password']];

        $success = $this->create('user', $dataInsert);
        if ($success) {
            Cookie::unsetCookie('tempUser');
            return $dataSuccess;
        } else {
            Cookie::unsetCookie('tempUser');
            return $dataError;
        }
    }

    function updatePassword($email, $dataUpdate)
    {

        $updatePass = $this->db->findAndUpdate($this->tableName(), $dataUpdate, ['email' => $email]);

        return $updatePass;
    }

    function countUser()
    {
        $data = $this->db->table($this->tableName())->select('COUNT(*) AS countUser')->where('role_id', '<>', 1)->where('role_id', '<>', 2)->getOne();
        return $data;
    }

    function getAllUser()
    {
        return $this->db->table($this->tableName())->select('id, fullname, email, password, avatar, phone, isBlock, role_id, create_At')->orderBy('id')->get();
    }
    function getOneUser($id)
    {
        return $this->db->table($this->tableName())->select('id, avatar, fullname, email, password, avatar, address, phone, isBlock, create_At, role_id')->where('id', '=', $id)->getOne();
    }
    function updateUser($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }
    function deleteUser($id)
    {
        return $this->db->findIdAndDelete($this->tableName(), $id);
    }


    // Role
    function getAllRole()
    {
        return $this->db->table('role')->orderBy('id')->get();
    }

    function addNewRole($data)
    {
        return $this->db->create('role', $data);
    }

    function getOneRole($id)
    {
        return $this->db->findById('role', '*', $id);
    }

    function updateRole($id, $data)
    {
        return $this->db->findByIdAndUpdate('role', $id, $data);
    }
}
