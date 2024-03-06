<?php

class Wishlist extends Controller
{
    use SweetAlert;
    private $cartModel;
    private $productModel;
    private $wishlistModel;
    private $user_id = null;
    private $req = null;
    private $res = null;
    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
        $this->checkLogin();
        $this->cartModel = $this->model('WishlistModel');
        $this->productModel = $this->model('ProductModel');
        $this->wishlistModel = $this->model('WishlistModel');
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
        $dataWishlist = $this->wishlistModel->getAllWishlist($this->user_id);



        if (!empty($dataWishlist)) {
            $dataWishlistNew = [];
            foreach ($dataWishlist as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataWishlistNew[$idVariant])) {
                    $dataWishlistNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'wishlist_item_id' => $item['wishlist_item_id'],
                        'product_id' => $item['product_id'],
                        'wishlist_id' => $item['wishlist_id'],
                        'title' => $item['title'],
                        'slug' => $item['slug'],
                        'thumb' => $item['thumb'],
                        'price' => $item['price'],
                        'totalRatings' => $item['totalRatings'],
                        'discount' => $item['discount'],
                        'attribute_values' => [$item['attribute_value']],
                    ];
                } else {
                    $dataWishlistNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataWishlistNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            $dataWishlistNew = array_values($dataWishlistNew);
        }


        $this->view('layoutClient', [
            'title' => 'Sản phẩm yêu thích',
            'currentPath' => 'product',
            'pages' => 'wishList/wishList',
            'dataWishlist' => $dataWishlistNew ?? [],
        ]);
    }






    function getAllWishlistApi()
    {
        if (empty($this->user_id)) {
            echo $this->res->dataApi(200, '', []);
            return;
        }

        $dataWishlist = $this->cartModel->getAllWishlist($this->user_id);

        // handle khi co datacart
        if (!empty($dataWishlist)) {
            $dataWishlistNew = [];
            foreach ($dataWishlist as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataWishlistNew[$idVariant])) {
                    $dataWishlistNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'wishlist_item_id' => $item['wishlist_item_id'],
                        'product_id' => $item['product_id'],
                        'wishlist_id' => $item['wishlist_id'],
                        'title' => $item['title'],
                        'slug' => $item['slug'],
                        'thumb' => $item['thumb'],
                        'price' => $item['price'],
                        'totalRatings' => $item['totalRatings'],
                        'discount' => $item['discount'],
                        'attribute_values' => [$item['attribute_value']],
                    ];
                } else {
                    $dataWishlistNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataWishlistNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            $dataWishlistNew = array_values($dataWishlistNew);
        }

        if (empty($dataWishlist)) {
            echo $this->res->dataApi(200, '', []);
            return;
        }

        echo $this->res->dataApi(200, '', $dataWishlistNew);
        return;
    }


    function addNewWishListApi($product_variant_id)
    {
        // Phải đăng nhập mới được thêm vào giỏ hàng
        if (empty($this->user_id)) {
            echo $this->res->dataApi(300, '', []);
            return;
        }

        // lấy ra id wishlist
        $dataWishlist = $this->wishlistModel->getWishlistId($this->user_id);

        // Kiem tra so luong cua san pham co con khong
        $dataProductVariant = $this->productModel->getOneProdVariantApi($product_variant_id);

        if ($dataProductVariant['quantity'] < 1) {
            echo $this->res->dataApi(400, 'Vui lòng kiểm tra lại số lượng.', []);
            return;
        }

        //Kiem tra san pham da co trong wishlist hay chua
        $dataWishlistItem = $this->wishlistModel->getOneWishlistItemProdVariant($product_variant_id, $dataWishlist['id']);

        if (!empty($dataWishlistItem)) {
            echo $this->res->dataApi(400, 'Bạn đã thêm vào ưa thích trước đây.', []);
            return;
        } else {
            // Nếu chưa có sản phẩm trong giỏ hàng thì thêm mới
            $createWishlistItem = $this->wishlistModel->addNewWishlistItem([
                'product_variant_id' => $product_variant_id,
                'wishlist_id' => $dataWishlist['id'],
            ]);
        }

        if ($createWishlistItem) {
            echo $this->res->dataApi(200, 'Thêm sản phẩm vào sản phẩm ưa thích.', []);
        } else {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
        }
    }
    function addWishListToWishlist()
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
        $dataWishlist = $this->cartModel->getWishlistId($this->user_id);
        $dataProductVariant = $this->productModel->getOneProdVariantApi($dataPost['product_variant_id']);

        if ($dataProductVariant['quantity'] < $dataPost['quantity']) {
            echo $this->res->dataApi(400, 'Vui lòng kiểm tra lại số lượng.', []);
            return;
        }

        //số lượng người dùng chọn
        $quantityToAdd = $dataPost['quantity'];

        // Loi o day phai kiem tra cart id nua 
        $dataWishlistItem = $this->cartModel->getOneWishlistItemProdVariant($dataPost['product_variant_id'], $dataWishlist['id']);

        if (!empty($dataWishlistItem)) {

            // Kiem tra so luong san pham trong gio hang
            $dataProductWishlistItem = $this->cartModel->getOneWishlistItem($dataWishlistItem['id']);

            // Tong so luong san pham chuan bi them vao gio hang
            $quantityToAdd += $dataWishlistItem['quantity'];

            //Kiem tra so luong cua bien the co lon hon so luong cua gio hang hay khong
            if ($quantityToAdd > $dataProductWishlistItem['product_variant_quantity']) {
                echo $this->res->dataApi(400, 'Vui lòng kiểm tra lại số lượng.', []);
                return;
            }

            $updateWishlistItem = $this->cartModel->updateWishlistItem($dataWishlistItem['id'], [
                'quantity' => $quantityToAdd,
            ]);

            $updateWishlist = $this->cartModel->updateWishlist($dataWishlist['id'], [
                'totalPrice' => $dataWishlist['totalPrice'] + ($dataProductVariant['price'] * $dataPost['quantity']),
                'update_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            // Nếu chưa có sản phẩm trong giỏ hàng thì thêm mới
            $createWishlistItem = $this->cartModel->addNewWishlistItem([
                'product_variant_id' => $dataPost['product_variant_id'],
                'quantity' => $dataPost['quantity'],
                'cart_id' => $dataWishlist['id'],
            ]);

            $updateWishlist = $this->cartModel->updateWishlist($dataWishlist['id'], [
                'totalPrice' => $dataWishlist['totalPrice'] + ($dataProductVariant['price'] * $dataPost['quantity']),
                'update_at' => date('Y-m-d H:i:s'),
            ]);

            $updateWishlistItem = $createWishlistItem;
        }

        if ($updateWishlistItem && $updateWishlist) {
            echo $this->res->dataApi(200, 'Thêm sản phẩm vào giỏ hàng thành công.', []);
        } else {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
        }
    }



    function deleteWishListApi($id)
    {

        $deleteWishlistItem = $this->wishlistModel->deleteWishlistItemApi($id);

        if ($deleteWishlistItem) {
            echo $this->res->dataApi(200, '', []);
        } else {
            echo $this->res->dataApi(400, 'Có lỗi vui lòng thử lại.', []);
        }
    }

    function deleteAllWishList()
    {
        if (empty($this->user_id)) {
            return  $this->res->setToastSession('error', 'Vui lòng đăng nhập', 'cart');
        }

        $dataWishlist = $this->cartModel->getWishlistId($this->user_id);

        $deleteWishlistItem = $this->cartModel->deleteAllWishlistItem($dataWishlist['id']);

        $deleteWishlist = $this->cartModel->deleteAllWishlist($dataWishlist['id']);

        if ($deleteWishlist && $deleteWishlistItem) {
            return  $this->res->setToastSession('success', 'Bạn đã xoá hết sản phẩm trong giỏ hàng.', 'cart');
        } else {
            return  $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'cart');
        }
    }
}
