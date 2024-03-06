<?php

class Cart extends Controller
{
    use SweetAlert;
    private $cartModel;
    private $productModel;
    private $user_id = null;
    private $req = null;
    private $res = null;
    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
        $this->checkLogin();
        $this->cartModel = $this->model('CartModel');
        $this->productModel = $this->model('ProductModel');
        $this->user_id = ViewShare::$dataShare['userData']['user_id'] ?? '';
    }

    private function checkLogin()
    {

        $accessToken = null;

        //Check accessToken
        if (!empty(Session::get('userLogin'))) {
            $accessToken = JWT::verifyJWT(Session::get('userLogin')) ?? '';
        } else {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập.', 'home');
        }


        //check accessToken con han
        if (!empty($accessToken) && isset($accessToken['error'])) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập.', 'home');
        }

        $dataUserCurrent = $accessToken['payload'];
        if ($dataUserCurrent['isBlock'] == 1) {
            return $this->res->setToastSession('error', 'Tài khoản đã bị khoá vui lòng thử lại.', 'home');
        }
    }

    function Default()
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $this->view('layoutClient', [
            'title' => 'Giỏ hàng',
            'currentPath' => 'product',
            'pages' => 'cart/cart',
        ]);
    }



    function getAllCartApi()
    {
        if (empty($this->user_id)) {
            echo $this->res->dataApi(200, '', []);
            return;
        }

        $dataCart = $this->cartModel->getAllCart($this->user_id);

        // handle khi co datacart
        if (!empty($dataCart)) {
            $dataCartNew = [];
            foreach ($dataCart as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataCartNew[$idVariant])) {
                    $dataCartNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'cart_item_id' => $item['cart_item_id'],
                        'product_id' => $item['product_id'],
                        'cart_id' => $item['cart_id'],
                        'totalPrice' => $item['totalPrice'],
                        'title' => $item['title'],
                        'slug' => $item['slug'],
                        'thumb' => $item['thumb'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'attribute_values' => [$item['attribute_value']],
                    ];
                } else {
                    $dataCartNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataCartNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            $dataCartNew = array_values($dataCartNew);
        }

        if (empty($dataCart)) {
            echo $this->res->dataApi(200, '', []);
            return;
        }

        echo $this->res->dataApi(200, '', $dataCartNew);
        return;
    }

    function addCartApi()
    {
        if (!$this->req->isPost()) {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
            return;
        }

        $dataPost = $this->req->getFields();

        // Phải đăng nhập mới được thêm vào giỏ hàng
        if (empty($this->user_id)) {
            echo $this->res->dataApi(300, '', []);
            return;
        }

        if (empty($dataPost['product_variant_id']) || empty($dataPost['quantity'])) {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
            return;
        }

        // lấy ra id cart
        $dataCart = $this->cartModel->getCartId($this->user_id);
        $dataProductVariant = $this->productModel->getOneProdVariantApi($dataPost['product_variant_id']);

        if ($dataProductVariant['quantity'] < $dataPost['quantity']) {
            echo $this->res->dataApi(400, 'Vui lòng kiểm tra lại số lượng.', []);
            return;
        }

        //số lượng người dùng chọn
        $quantityToAdd = $dataPost['quantity'];

        // Loi o day phai kiem tra cart id nua 
        $dataCartItem = $this->cartModel->getOneCartItemProdVariant($dataPost['product_variant_id'], $dataCart['id']);

        if (!empty($dataCartItem)) {

            // Kiem tra so luong san pham trong gio hang
            $dataProductCartItem = $this->cartModel->getOneCartItem($dataCartItem['id']);

            // Tong so luong san pham chuan bi them vao gio hang
            $quantityToAdd += $dataCartItem['quantity'];

            //Kiem tra so luong cua bien the co lon hon so luong cua gio hang hay khong
            if ($quantityToAdd > $dataProductCartItem['product_variant_quantity']) {
                echo $this->res->dataApi(400, 'Vui lòng kiểm tra lại số lượng.', []);
                return;
            }

            $updateCartItem = $this->cartModel->updateCartItem($dataCartItem['id'], [
                'quantity' => $quantityToAdd,
            ]);

            $updateCart = $this->cartModel->updateCart($dataCart['id'], [
                'totalPrice' => $dataCart['totalPrice'] + ($dataProductVariant['price'] * $dataPost['quantity']),
                'update_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            // Nếu chưa có sản phẩm trong giỏ hàng thì thêm mới
            $createCartItem = $this->cartModel->addNewCartItem([
                'product_variant_id' => $dataPost['product_variant_id'],
                'quantity' => $dataPost['quantity'],
                'cart_id' => $dataCart['id'],
            ]);

            $updateCart = $this->cartModel->updateCart($dataCart['id'], [
                'totalPrice' => $dataCart['totalPrice'] + ($dataProductVariant['price'] * $dataPost['quantity']),
                'update_at' => date('Y-m-d H:i:s'),
            ]);

            $updateCartItem = $createCartItem;
        }

        if ($updateCartItem && $updateCart) {
            echo $this->res->dataApi(200, 'Thêm sản phẩm vào giỏ hàng thành công.', []);
        } else {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
        }
    }

    function updateQuantityApi($id, $action)
    {

        $dataCartItem = $this->cartModel->getOneCartItem($id);

        if (empty($dataCartItem)) {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
            return;
        }

        if ($action == 'plus') {
            $newQuantity = $dataCartItem['quantity'] + 1;
            //Kiem tra so luong cua bien the co lon hon so luong cua gio hang hay khong
            if ($newQuantity > $dataCartItem['product_variant_quantity']) {
                echo $this->res->dataApi(400, 'Vui lòng kiểm tra lại số lượng.', []);
                return;
            }

            $newTotalPrice =   $dataCartItem['totalPrice'] + $dataCartItem['price'];
        } elseif ($action == 'minus' && $dataCartItem['quantity'] > 1) {
            $newQuantity = $dataCartItem['quantity'] - 1;
            $newTotalPrice =  $dataCartItem['totalPrice'] - $dataCartItem['price'];
        } else {
            echo $this->res->dataApi(400, 'Vui lòng kiểm tra lại số lượng.', []);
            return;
        }

        $updateCart = $this->cartModel->updateCart($dataCartItem['cart_id'], [
            'totalPrice' => $newTotalPrice,
            'update_at' => date('Y-m-d H:i:s'),
        ]);

        $updateCartItem = $this->cartModel->updateCartItem($dataCartItem['id'], [
            'quantity' => $newQuantity,
        ]);

        if ($updateCartItem && $updateCart) {
            echo $this->res->dataApi(200, 'Cập nhập số lượng thành công.', []);
        } else {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
        }
    }

    function deleteCartApi($id)
    {

        $dataCartItem = $this->cartModel->getOneCartItem($id);
        $deleteCartItem = $this->cartModel->deleteCartItem($id);

        $newTotalPrice = $dataCartItem['totalPrice'] - ($dataCartItem['price'] * $dataCartItem['quantity']);

        $updateCart = $this->cartModel->updateCart($dataCartItem['cart_id'], [
            'totalPrice' => $newTotalPrice,
            'update_at' => date('Y-m-d H:i:s'),
        ]);

        if ($deleteCartItem && $updateCart) {
            echo $this->res->dataApi(200, '', []);
        } else {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
        }
    }

    function deleteAllCart()
    {
        if (empty($this->user_id)) {
            return  $this->res->setToastSession('error', 'Vui long dang nhap', 'cart');
        }

        $dataCart = $this->cartModel->getCartId($this->user_id);

        $deleteCartItem = $this->cartModel->deleteAllCartItem($dataCart['id']);

        $deleteCart = $this->cartModel->deleteAllCart($dataCart['id']);

        if ($deleteCart && $deleteCartItem) {
            return  $this->res->setToastSession('success', 'Bạn đã xoá hết sản phẩm trong giỏ hàng.', 'cart');
        } else {
            return  $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'cart');
        }
    }
}
