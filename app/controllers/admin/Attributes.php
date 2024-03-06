<?php
class Attributes extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $attributeModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->attributeModel = $this->model('AttributeModel');
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

        $dataAttribute = $this->attributeModel->getAllAttribute() ?? [];

        $this->view('layoutServer', [
            'title' => 'Danh sách thuộc tính',
            'active' => 'attributes',
            'pages' => 'attribute/attribute',
            'dataAttribute' => $dataAttribute,
        ]);
    }




    function addAttribute()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;


        // check empty field
        if (empty($dataPost['name']) || empty($dataPost['display_name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataValueOld);
        }

        //check tieng viet co dau va co dau cach
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $dataPost['name'])) {
            $this->Toast('error', 'Tên thuộc tính không được ghi tiếng việt và có dấu cách.');
            return $this->renderAddPage($dataValueOld);
        }



        $dataInsert = [
            'name' => $dataPost['name'],
            'display_name' => $dataPost['display_name'],
        ];

        $createAttribute = $this->attributeModel->addNameAttribute($dataInsert);
        if (!$createAttribute) {
            $this->Toast('error', 'Thêm thất bại.');
            return $this->renderAddPage($dataValueOld);
        }

        $attribute_id = $this->db->lastInsertId();

        //Them gia tri cho thuoc tinh
        if (!empty($dataPost['value_name'])) {
            $attributeValueArr = explode(',', $dataPost['value_name']);

            foreach ($attributeValueArr as $attributeValue) {
                $success = $this->db->create('attribute_value', [
                    'attribute_id' => $attribute_id,
                    'value_name' => $attributeValue,
                ]);

                if (!$success) {
                    $this->Toast('error', 'Thêm thất bại.');
                    return $this->renderAddPage($dataValueOld);
                }
            }
        }

        return $this->res->setToastSession('success', 'Thêm thành công', 'admin/attributes');
    }

    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'attributes',
            'title' => 'Thêm thuộc tính',
            'pages' => 'attribute/addAttribute',
            'dataValueOld' => $dataValueOld
        ]);
    }

    function updateAttribute($id)
    {
        $dataAttribute = $this->attributeModel->getOneAttribute($id) ?? [];
        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataAttribute);
        }

        $dataPost = $this->req->getFields();

        // check empty field
        if (empty($dataPost['name']) || empty($dataPost['display_name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderUpdatePage($dataAttribute);
        }

        //check tieng viet co dau va co dau cach
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $dataPost['name'])) {
            $this->Toast('error', 'Tên thuộc tính không được ghi tiếng việt và có dấu cách.');
            return $this->renderUpdatePage($dataAttribute);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
            'display_name' => $dataPost['display_name'],
        ];

        $updateAttribute = $this->attributeModel->updateNameAttribute($id, $dataUpdate);

        if ($updateAttribute) {
            return $this->res->setToastSession('success', 'Cập nhập thành công', 'admin/attributes');
        } else {
            $this->Toast('error', 'Cập nhập thất bại.');
            return $this->renderUpdatePage($dataAttribute);
        }
    }
    private function renderUpdatePage($dataAttribute)
    {
        $this->view('layoutServer', [
            'active' => 'attributes',
            'pages' => 'attribute/updateAttribute',
            'title' => 'Cập nhập thuộc tính',
            'dataAttribute' => $dataAttribute
        ]);
    }

    function deleteAttribute($id)
    {

        $deleteAttribute = $this->attributeModel->deleteNameAttribute($id);
        if ($deleteAttribute) {
            return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/attributes');
        } else {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/attributes');
        }
    }

    function attributeValue($id)
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $dataAttributeValue = $this->attributeModel->getAttributeValue($id) ?? [];
        $this->view('layoutServer', [
            'active' => 'attributes',
            'pages' => 'attribute/attributeValue',
            'title' => 'Cập nhập thuộc tính',
            'dataAttributeValue' => $dataAttributeValue,
            'attribute_id' => $id
        ]);
    }

    function getOneAttributeValueApi($id)
    {
        $data = $this->attributeModel->getOneAttributeValue($id);
        if (!empty($data)) {
            echo $this->res->dataApi('200', 'success', $data);
        } else {
            echo $this->res->dataApi('400', 'error', []);
        }
    }

    function addAttributeValue()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/attributes');
        }

        $dataPost = $this->req->getFields();


        if (empty($dataPost['value_name'])) {
            return $this->res->setToastSession('error', 'Vui lòng không để trống.', 'admin/attribute-value/' . $dataPost['attribute_id']);
        }

        //Tach chuoi thanh mang mang 
        $dataAttributes = explode(',', $dataPost['value_name']);

        foreach ($dataAttributes as $dataAttribute) {
            $success = $this->db->create('attribute_value', [
                'attribute_id' => $dataPost['attribute_id'],
                'value_name' => $dataAttribute,
            ]);

            if (!$success) {
                return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/attribute-value/' . $dataPost['attribute_id']);
            }
        }

        return $this->res->setToastSession('success', 'Thêm thành công.', 'admin/attribute-value/' . $dataPost['attribute_id']);
    }

    function updateAttributeValue()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/attributes');
        }


        $dataPost = $this->req->getFields();

        if (empty($dataPost['value_name'])) {
            return $this->res->setToastSession('error', 'Vui lòng không để trống.', 'admin/attribute-value/' . $dataPost['attribute_id']);
        }

        $success = $this->db->findByIdAndUpdate('attribute_value', $dataPost['id'], [
            'value_name' => $dataPost['value_name'],
        ]);

        if (!$success) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/attribute-value/' . $dataPost['attribute_id']);
        }

        return $this->res->setToastSession('success', 'Thêm thành công.', 'admin/attribute-value/' . $dataPost['attribute_id']);
    }

    function deleteAttributeValue($id, $attributeId)
    {

        $deleteAttribute = $this->attributeModel->deleteAttributeValue($id);

        if ($deleteAttribute) {
            return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/attribute-value/' . $attributeId);
        } else {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/attribute-value/' . $attributeId);
        }
    }
}
