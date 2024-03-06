<?php

class Product extends Controller
{
    private $productModel;
    private $categoryModel;
    private $couponModel;
    private $brandModel;
    private $user_id = null;

    private $res = null;
    private $req = null;
    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->couponModel = $this->model('CouponModel');
        $this->brandModel = $this->model('BrandModel');
        $this->user_id = ViewShare::$dataShare['userData']['user_id'] ?? '';
    }


    function Default()
    {
        $this->res->redirect('product-category');
    }

    function filterProduct()
    {
        $dataPost = $this->req->getFields();

        $conditions = array();

        // Kiem tra co thuong hieu khong
        if (!empty($dataPost['brand'])) {
            $conditions[] = "brand_id = '" . $dataPost['brand'] . "'";
        }

        // Kiem tra co danh muc khong
        if (!empty($dataPost['category'])) {
            $conditions[] = "cate_id = '" . $dataPost['category'] . "'";
        }

        // Kiem tra co gia khong
        if (!empty($dataPost['price'])) {
            // Split the price range
            $priceRange = explode(' - ', $dataPost['price']);
            $conditions[] = "price BETWEEN " . intval($priceRange[0]) . " AND " . intval($priceRange[1]);
        }

        // Kiem tra co xap xep khong
        if (!empty($dataPost['sort'])) {
            $sortOrder = ($dataPost['sort'][0] === '-') ? 'DESC' : 'ASC';
            // Remove the '-' prefix if present
            $sortColumn = ltrim($dataPost['sort'], '-');
            $orderBy = " ORDER BY $sortColumn $sortOrder";
        } else {
            // Default sorting if not specified
            $orderBy = " ORDER BY create_at DESC";
        }

        // Kiem tra co tim kiem khong
        if (!empty($dataPost['search'])) {
            $conditions[] = "title LIKE '%" . $dataPost['search'] . "%'";
        }

        // Them gioi han
        $limit = !empty($dataPost['limit']) ? intval($dataPost['limit']) : 12;

        // Build the WHERE clause using the conditions
        $whereClause = '';
        if (!empty($conditions)) {
            $whereClause = " WHERE " . implode(' AND ', $conditions);
        }

        $sql = "SELECT id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings FROM product" . $whereClause . $orderBy . ' LIMIT ' . $limit;
        $dataProd = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        echo $this->res->dataApi('200', '', $dataProd);
    }

    function productCategory()
    {
        $dataCateList = $this->categoryModel->getAllCategory() ?? [];
        $dataBrand = $this->brandModel->getAllBrand() ?? [];


        $dataGet = $this->req->getFields();

        $conditions = array();

        // Kiem tra co thuong hieu khong
        if (!empty($dataGet['brand'])) {
            $conditions[] = "brand_id = '" . $dataGet['brand'] . "'";
        }

        // Kiem tra co danh muc khong
        if (!empty($dataGet['category'])) {
            $conditions[] = "cate_id = '" . $dataGet['category'] . "'";
        }

        // Kiem tra co gia khong
        if (!empty($dataGet['price'])) {
            // Split the price range
            $priceRange = explode(' - ', $dataGet['price']);
            $conditions[] = "price BETWEEN " . intval($priceRange[0]) . " AND " . intval($priceRange[1]);
        }

        // Kiem tra co xap xep khong
        if (!empty($dataGet['sort'])) {
            $sortOrder = ($dataGet['sort'][0] === '-') ? 'DESC' : 'ASC';
            // Remove the '-' prefix if present
            $sortColumn = ltrim($dataGet['sort'], '-');
            $orderBy = " ORDER BY $sortColumn $sortOrder";
        } else {
            // Default sorting if not specified
            $orderBy = " ORDER BY create_at DESC";
        }

        // Kiem tra co tim kiem khong
        if (!empty($dataGet['search'])) {
            $conditions[] = "title LIKE '%" . $dataGet['search'] . "%'";
        }

        // Them gioi han
        $limit = !empty($dataGet['limit']) ? intval($dataGet['limit']) : 12;

        // Build the WHERE clause using the conditions
        $whereClause = '';
        if (!empty($conditions)) {
            $whereClause = " WHERE " . implode(' AND ', $conditions);
        }

        $sql = "SELECT id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings, short_description FROM product" . $whereClause . $orderBy . ' LIMIT ' . $limit;
        $dataProd = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($dataProd);
        // echo '</pre>';

        $this->view('layoutClient', [
            'title' => 'Danh mục sản phẩm',
            'currentPath' => 'product',
            'pages' => 'product/productCategory',
            'dataCateList' => $dataCateList,
            'dataBrand' => $dataBrand,
            'dataProd' => $dataProd,
        ]);
    }

    function productDetail($id)
    {
        //Lay ra id tu chuoi slug
        $id = explode("-", $id);
        $id = end($id);

        $dataProd = $this->productModel->getOneProd($id) ?? [];
        $dataImageProd = $this->productModel->getImageProd($id) ?? [];
        $dataProdCategory = $this->productModel->getProdByCate($dataProd['cate_id']) ?? [];
        $dataVariant = $this->productModel->getAllProdVariants($id);
        $dataCoupon = $this->couponModel->getAllCoupon();
        $productPrice = $this->productModel->getProductPrice($id);


        // Lấy ra giá nhỏ và lớn nhất của sản phẩm
        if (!empty($productPrice)) {
            $productPriceNew = array();
            foreach ($productPrice as $item) {
                $prod_id = $item['prod_id'];
                $price = $item['price'];

                if (!isset($productPriceNew[$prod_id])) {
                    $productPriceNew[$prod_id] = [
                        'prod_id' => $prod_id,
                        'min_price' => $price,
                        'max_price' => $price,
                    ];
                } else {
                    // Nếu đã có giá trị, so sánh và cập nhật giá trị nhỏ nhất và lớn nhất
                    $productPriceNew[$prod_id]['min_price'] = min($productPriceNew[$prod_id]['min_price'], $price);
                    $productPriceNew[$prod_id]['max_price'] = max($productPriceNew[$prod_id]['max_price'], $price);
                }
            }

            $productPriceNew = array_values($productPriceNew);
        }

        // update View
        $newView = $dataProd['view'] + 1;
        $this->db->findByIdAndUpdate('product', $id, ['view' => $newView]);
        //Lay ra variant
        if (!empty($dataVariant)) {
            $dataProdVariantsNew = [];
            foreach ($dataVariant as $item) {
                $idVariant = $item['id'];
                if (!isset($dataProdVariantsNew[$idVariant])) {
                    $dataProdVariantsNew[$idVariant] = [
                        'id' => $idVariant,
                        'title' => $item['title'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'discount' => $item['discount'],
                        'attribute_id' => $item['attribute_id'],
                        'display_name' => $item['display_name'],
                        'attribute_values' => [$item['attribute_value']],
                    ];
                } else {
                    $dataProdVariantsNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataProdVariantsNew as &$item) {
                $item['attribute_values'] = implode(' - ', $item['attribute_values']);
            }

            $dataProdVariantsNew = array_values($dataProdVariantsNew);
        }



        $this->view('layoutClient', [
            'title' => $dataProd['title'],
            'thumb' => $dataProd['thumb'],
            'currentPath' => 'product',
            'pages' => 'product/detailProduct',
            'dataProd' => $dataProd,
            'dataImageProd' => $dataImageProd,
            'dataVariant' => $dataProdVariantsNew ?? [],
            'dataProdCategory' => $dataProdCategory,
            'dataCoupon' => $dataCoupon,
            'productPrice' => $productPriceNew ?? [],
        ]);
    }

    function getVariantProdApi($variantId)
    {
        $data = $this->productModel->getOneProdVariantApi($variantId);
        $code = $data ? '200' : '400';
        echo $this->res->dataApi($code, '', $data);
    }


    function getAllRatingsProd($prod_id)
    {
        $data = $this->productModel->getAllRatingsProd($prod_id);
        echo $this->res->dataApi('200', 'Thanh cong', $data);
        return;
    }

    function addRatingProd()
    {
        if (empty($this->user_id)) {
            echo $this->res->dataApi('400', 'Vui lòng đăng nhập.', []);
            return;
        }

        if (!$this->req->isPost()) {
            echo $this->res->dataApi('400', 'Có lỗi vui lòng thử lại.', []);
            return;
        }
        $dataPost = $this->req->getFields();

        $dataComment = [
            'prod_id' => $dataPost['prod_id'],
            'user_id' => $this->user_id,
            'star' => $dataPost['star'],
            'comment' => $dataPost['comment'],
        ];
        if (empty($dataPost['star'])) {
            echo $this->res->dataApi('400', 'Vui lòng chọn số sao.', []);
            return;
        }

        if (empty($dataPost['comment'])) {
            $dataComment['comment'] = 'Người dùng không để lại cảm nghĩ.';
        }

        //Kiem tra co danh gia hay chua
        $dataRatings = $this->productModel->getOneRaingProd($dataPost['prod_id'], $this->user_id);

        // add new rating if not has or upate 
        if (empty($dataRatings)) {
            $createRatings = $this->productModel->addRatingProd($dataComment);

            if (!$createRatings) {
                echo $this->res->dataApi('400', 'Có lỗi vui lòng thử lại.', []);
                return;
            }
        } else {
            $dataComment['update_at'] = date('Y-m-d H:i:s');
            $updateRating = $this->productModel->updateRatingProd($dataRatings['id'], $dataComment);

            if (!$updateRating) {
                echo $this->res->dataApi('400', 'Có lỗi vui lòng thử lại.', []);
                return;
            }
        }

        //Lay ra toan bo comment cua san pham do
        $dataRatingAll = $this->productModel->getAllRatingsProd($dataPost['prod_id']);

        if (!$dataRatingAll) {
            echo $this->res->dataApi('400', 'Có lỗi vui lòng thử lại.', []);
            return;
        }

        $totalRatings = 0;
        foreach ($dataRatingAll as $dataRatingItem) {
            $totalRatings += $dataRatingItem['star'];
        }


        $dataUpdateProd = [
            'totalUserRatings' => count($dataRatingAll),
            'totalRatings' => count($dataRatingAll) > 0 ? round($totalRatings / count($dataRatingAll), 2) : $dataPost['star'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        $updateProduct =  $this->productModel->updateProduct($dataPost['prod_id'], $dataUpdateProd);

        if ($updateProduct) {
            echo $this->res->dataApi('200', 'Đánh giá thành công.', []);
            return;
        } else {
            echo $this->res->dataApi('400', 'Có lỗi vui lòng thử lại.', []);
            return;
        }
    }
}
