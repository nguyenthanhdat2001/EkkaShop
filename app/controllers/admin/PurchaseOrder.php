<?php

class PurchaseOrder extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $purchaseOrderModel;
    private $suppliersModel;
    private $productModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->purchaseOrderModel = $this->model('PurchaseOrderModel');
        $this->suppliersModel = $this->model('SuppliersModel');
        $this->productModel = $this->model('ProductModel');
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

        $dataPurchaseOrder = $this->purchaseOrderModel->getAllPurchaseOrder();

        $this->view('layoutServer', [
            'active' => 'purchaseOrder',
            'pages' => 'purchaseOrder/purchaseOrder',
            'title' => 'Danh sách nhập hàng',
            'dataPurchaseOrder' => $dataPurchaseOrder,
        ]);
    }

    function purchaseOrderDetail($id)
    {
        if (!$this->req->isPost()) {

            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');

            $this->ToastSession($toastMessage, $toastType);
        }

        $dataPurchaseOrderDetail = $this->purchaseOrderModel->getAllPurchaseOrderDetail($id);


        $this->view('layoutServer', [
            'active' => 'purchaseOrder',
            'pages' => 'purchaseOrder/purchaseOrderDetail',
            'title' => 'Chi tiết danh sách hàng đã nhập',
            'dataPurchaseOrderDetail' => $dataPurchaseOrderDetail,
        ]);
    }


    function addPurchaseOrder()
    {
        if (!$this->req->isPost()) {

            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');

            $this->ToastSession($toastMessage, $toastType);
        }

        $dataValueOld = [];
        $dataSuppliers = $this->suppliersModel->getAllSuppliers();
        $dataProdVariants = $this->productModel->getAllVariants();
        // echo '<pre>';
        // print_r($dataProdVariants);
        // echo '</pre>';

        if (!empty($dataProdVariants)) {
            $dataProdVariantsNew = [];
            foreach ($dataProdVariants as $item) {
                $idVariant = $item['id'];
                if (!isset($dataProdVariantsNew[$idVariant])) {
                    $dataProdVariantsNew[$idVariant] = [
                        'id' => $idVariant,
                        'title' => $item['title'],
                        'attribute_values' => [$item['attribute_value']],
                    ];
                } else {
                    $dataProdVariantsNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            // Chuyển đổi display_names thành chuỗi
            // Dấu & ở đây có nghĩa là tham chiếu thẳng tới mảng gốc để sửa
            foreach ($dataProdVariantsNew as &$item) {
                $item['attribute_values'] = implode(', ', $item['attribute_values']);
            }

            $dataProdVariantsNew = array_values($dataProdVariantsNew);
            $dataProdVariants = $dataProdVariantsNew;
        }


        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld, $dataSuppliers, $dataProdVariants);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;


        //Validate
        if (empty($dataPost['name_and_id_product_variant']) || empty($dataPost['quantity']) || empty($dataPost['price']) || empty($dataPost['supplier_id'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataValueOld, $dataSuppliers, $dataProdVariants);
        }

        // Kiểm tra xem có nhà cung cấp hay chưa nếu có thì tăng ngày cập nhập
        $dataPurchaseOrder = $this->purchaseOrderModel->getPurchaseOrder($dataPost['supplier_id']);
        $purchaseOrderId = null;

        // Tách tên và id product variant

        $name_prod_variant = explode('+', $dataPost['name_and_id_product_variant']);
        //      [0] => 1 
        //      [1] => Điện thoại iPhone 15 Pro Max 256GB ( 1TB,  Titan tự nhiên )

        // id prodcut variant
        // tên của biến thể


        // Data insert hàng nhập
        $dataInsertPurchaseOrder = [
            'supplier_id' => $dataPost['supplier_id'],
        ];

        // Lấy ra số lượng trong hàng
        $dataQuantityVariantsStock = $this->db->table('product_variants')->select('quantity')->where('id', '=', $name_prod_variant[0])->getOne();


        // Data insert cộng số lượng cho biến thể đó
        $dataQuantityVariants = [
            'quantity' => $dataQuantityVariantsStock['quantity'] + $dataPost['quantity'],
        ];

        //Data insert chi tiết hàng nhập
        $dataInsertPurchaseOrderDetails = [
            'quantity' => $dataPost['quantity'],
            'price' => $dataPost['price'],
            'prod_name' => end($name_prod_variant),
        ];

        // Nếu chưa tồn nhà cung cấp đó thì thêm nhà cung cấp
        if (empty($dataPurchaseOrder)) {
            $createPurchaseOrder = $this->purchaseOrderModel->addNewPurchaseOrder($dataInsertPurchaseOrder);

            if (!$createPurchaseOrder) {
                $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
                return $this->renderAddPage($dataValueOld, $dataSuppliers, $dataProdVariants);
            }
            // Lấy ra id nhà cung cấp đơn hàng đó
            $purchaseOrderId = $this->db->lastInsertId();
        } else {
            $updatePurchaseOrder = $this->purchaseOrderModel->updatePurchaseOrder($dataPurchaseOrder['id'], ['update_at' => date('Y-m-d H:i:s')]);

            if (!$updatePurchaseOrder) {
                $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
                return $this->renderAddPage($dataValueOld, $dataSuppliers, $dataProdVariants);
            }

            // Lấy ra id nhà cung cấp đơn hàng đó
            $purchaseOrderId = $dataPurchaseOrder['id'];
        }


        // Thêm chi tiét hàng cho đơn hàng nhập vào
        $dataInsertPurchaseOrderDetails['purchase_order_id'] = $purchaseOrderId;

        $createPurchaseOrderDetails = $this->purchaseOrderModel->addNewPurchaseOrderDetail($dataInsertPurchaseOrderDetails, $purchaseOrderId);


        if (!$createPurchaseOrderDetails) {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld, $dataSuppliers, $dataProdVariants);
        }

        // Cập nhập lại số lương cho biến thể sản phẩm
        $updateQuantityVariants = $this->productModel->updateProductVariant($name_prod_variant[0], $dataQuantityVariants);

        if (!$updateQuantityVariants) {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld, $dataSuppliers, $dataProdVariants);
        }



        $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/add-purchaseOrder');
        return;
    }
    private function renderAddPage($dataValueOld = [], $dataSuppliers, $dataProdVariants)
    {
        $this->view('layoutServer', [
            'active' => 'purchaseOrder',
            'title' => 'Nhập thêm hàng',
            'pages' => 'purchaseOrder/addPurchaseOrder',
            'dataValueOld' => $dataValueOld ?? [],
            'dataSuppliers' => $dataSuppliers ?? [],
            'dataProdVariants' => $dataProdVariants ?? [],
        ]);
    }

    function updatePurchaseOrder($id)
    {
        $dataPurchaseOrder = $this->purchaseOrderModel->getOnePurchaseOrder($id) ?? [];

        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataPurchaseOrder);
        }
        //Get data post
        $dataPost = $this->req->getFields();


        //Validate
        if (empty($dataPost['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderUpdatePage($dataPurchaseOrder);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
            'status' => $dataPost['status']
        ];


        $updatePurchaseOrder = $this->purchaseOrderModel->updatePurchaseOrder($id, $dataUpdate);

        if ($updatePurchaseOrder) {
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/purchaseOrder');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataPurchaseOrder);
        }
    }

    private function renderUpdatePage($dataPurchaseOrder = [])
    {
        $this->view('layoutServer', [
            'active' => 'purchaseOrder',
            'title' => 'Cập nhập thương hiệu',
            'pages' => 'purchaseOrder/updatePurchaseOrder',
            'dataPurchaseOrder' => $dataPurchaseOrder
        ]);
    }


    function deletePurchaseOrder($id)
    {

        $success = $this->purchaseOrderModel->deletePurchaseOrder($id);

        if (!$success) {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/purchaseOrder');
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/purchaseOrder');
    }
}
