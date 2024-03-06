<?php

class Product extends Controller
{
    use SweetAlert;
    private $productModel;
    private $userModel;
    private $categoryModel;
    private $brandModel;
    private $attributeModel;
    private $user_id = null;
    private $req = null;
    private $res = null;



    public function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->user_id = ViewShare::$dataShare['userData']['user_id'] ?? '';
        $this->req = new Request;
        $this->productModel = $this->model('ProductModel');
        $this->userModel = $this->model('UserModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->brandModel = $this->model('BrandModel');
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

        $prod = $this->productModel->getAllProduct() ?? [];
        $cateData = $this->categoryModel->getAllCategory() ?? [];
        $brandData = $this->brandModel->getAllBrand() ?? [];
        $productVariant = $this->productModel->getProductStock() ?? [];


        $productVariantNew = array();
        foreach ($productVariant as $item) {
            $prod_id = $item['prod_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];

            if (!isset($productVariantNew[$prod_id])) {
                $productVariantNew[$prod_id] = [
                    'prod_id' => $prod_id,
                    'quantity' => $quantity,
                    'min_price' => $price,
                    'max_price' => $price,
                ];
            } else {
                // Cộng dồn số lượng
                $productVariantNew[$prod_id]['quantity'] += $quantity;
                // Nếu đã có giá trị, so sánh và cập nhật giá trị nhỏ nhất và lớn nhất
                $productVariantNew[$prod_id]['min_price'] = min($productVariantNew[$prod_id]['min_price'], $price);
                $productVariantNew[$prod_id]['max_price'] = max($productVariantNew[$prod_id]['max_price'], $price);
            }
        }

        $productVariantNew = array_values($productVariantNew);



        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Danh sách sản phẩm',
            'pages' => 'product/product',
            'prodData' => $prod,
            'cateData' => $cateData,
            'brandData' => $brandData,
            'productVariant' => $productVariantNew,
        ]);
    }


    function addProduct()
    {
        $cateData = $this->categoryModel->getAllCategory() ?? [];
        $brandData = $this->brandModel->getAllBrand() ?? [];
        $attributeData = $this->attributeModel->getAllAttribute() ?? [];
        $attributeValueData = $this->attributeModel->getAllAttributeValue() ?? [];


        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
        }
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Get image
        $image = $_FILES['images'] ?? '';
        $thumb = $_FILES['thumb'] ?? '';

        //Set rule
        $this->req->rules([
            'title' => 'required',
            'cate_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
        ]);

        // Set message
        $this->req->message([
            'title.required' => 'Vui lòng không để trống tên sản phẩm.',
            'cate_id.required' => 'Vui lòng không để trống danh mục.',
            'brand_id.required' => 'Vui lòng không để trống thương hiệu.',
            'price.required' => 'Vui lòng không để trống giá.',
        ]);
        // echo '<pre>';
        // print_r($dataPost);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($image);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($thumb);
        // echo '</pre>';

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
        }


        if (empty($image['name'][0]) || empty($thumb['name'])) {
            $this->Toast('error', 'Vui lòng không để trống ảnh.');
            return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
        }


        $dataInsertProd = [
            'title' => $dataPost['title'],
            'slug' => Format::createSlug($dataPost['title']),
            'cate_id' => $dataPost['cate_id'],
            'brand_id' => $dataPost['brand_id'],
            'price' => $dataPost['price'],
            'status' => $dataPost['status'] ?? 0,
            'short_description' => $dataPost['short_description'] ?? '',
            'description' => $dataPost['description'] ?? '',
            'isVariant' => isset($dataPost['attribute']) ? 1 : 0, //Trang thai co bien the hay khong
        ];


        //Kiem tra co gia sale hay khong

        if (!empty($dataPost['sale_price'])) {
            // Kiem tra gia sale phai nho hon gia
            if ($dataPost['sale_price'] >= $dataPost['price']) {
                $this->Toast('error', 'Giá sale phải nhỏ hơn giá.');
                return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
            }

            $discount = round((($dataPost['price'] - $dataPost['sale_price']) / $dataPost['price']) * 100, 0);
            $dataUpdateProd['discount'] = $discount;
            $dataUpdateProd['price'] = $dataPost['sale_price'];
        }


        //  validate Upload image thumb
        if (!Format::validateUploadImage($thumb)) {
            $this->Toast('error', 'Kiểm tra lại file upload.');
            return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
        }

        //upload anh len cloud
        $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
        if (empty($urlThumb)) {
            $this->Toast('error', 'Upload ảnh thất bại.');
            return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
        }

        $dataInsertProd['thumb'] = $urlThumb;

        //Lay ra id sau khi tai san pham 
        $prod_id = $this->productModel->addNewProduct($dataInsertProd);

        if (empty($prod_id)) {
            $this->Toast('error', 'Có lỗi khi thêm sản phẩm vui lòng thử lại.');
            return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
        }


        //Kiem tra co bien the hay khong
        if (isset($dataPost['attribute']) && !empty($dataPost['attribute'][0])) {

            //Check bat buoc phai nhap cac truong 
            if (empty($dataPost['price_variant'][0])) {
                $this->Toast('error', 'Vui lòng không để trống biến thế.');
                return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
            }

            //  Mang id attribute va id attribute_value
            $dataAttributeId = [];

            foreach ($dataPost['attribute'] as $attributeItem) {
                //Tach mang 
                $dataAttributeArr = explode(',', $attributeItem);

                foreach ($dataAttributeArr as $dataAttributeItem) {
                    //id dau tien la attribute
                    //id thu 2 la attribute_value
                    $attributeIdArr = explode('-', $dataAttributeItem);
                    $dataAttributeId[] = $attributeIdArr;
                }
            }

            //dataInsert of product_variants
            $dataInsertVariants = [];


            foreach ($dataPost['price_variant'] as $keyVariant => $price_variant) {
                $dataInsertVariants[] = [
                    'prod_id' => $prod_id,
                    'price' => $price_variant,
                    'discount' => 0,
                ];

                // Kiem tra co gia sale hay khong
                if (!empty($dataPost['sale_price_variant'][$keyVariant])) {
                    // Kiem tra gia sale phai nho hon gia 
                    if ($dataPost['sale_price_variant'][$keyVariant] >= $price_variant) {
                        $this->Toast('error', 'Giá sale phải nhỏ hơn giá.');
                        return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
                    }

                    $discountVariant = round((($price_variant - $dataPost['sale_price_variant'][$keyVariant]) / $price_variant) * 100, 0);

                    $dataInsertVariants[$keyVariant]['price'] = $dataPost['sale_price_variant'][$keyVariant];
                    $dataInsertVariants[$keyVariant]['discount'] = $discountVariant;
                }
            }


            //id product_variants sau khi insert
            $prodVariantIdArr =  [];
            foreach ($dataInsertVariants as $dataInsertVariant) {
                //Them vao product_variant
                $createProductVariant = $this->db->create('product_variants', $dataInsertVariant);

                //Kiem tra loi sau khi them
                if (!$createProductVariant) {
                    $this->Toast('error', 'Có lỗi liên quan đến biến thể.');
                    return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
                }
                //Lay ra id của bang vua nhap them vao mang
                $prod_variant_id = $this->db->lastInsertId();
                $prodVariantIdArr[] = $prod_variant_id;
            }


            if (empty($prodVariantIdArr)) {
                $this->Toast('error', 'Có lỗi liên quan đến biến thể.');
                return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
            }

            //dataInsert of variant_values
            $dataInsertVariantValue = [];

            //Lap qua id cua  bien the san pham de gan gia tri vao mang de insert
            foreach ($prodVariantIdArr as $value) {
                // Lặp giá trị một vào ba phần tử đầu tiên 
                for ($i = 0; $i < count($dataAttributeArr); $i++) {
                    $dataInsertVariantValue[] = array_merge([$value], $dataAttributeId[$i]);
                }
                $dataAttributeId = array_slice($dataAttributeId, count($dataAttributeArr));
            }

            if (empty($dataInsertVariantValue)) {
                $this->Toast('error', 'Có lỗi liên quan đến biến thể.');
                return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
            }

            //Them vao bang variant value

            foreach ($dataInsertVariantValue as $dataInsertVariantValueItem) {
                $insertVariantValue = $this->db->create('variants_value', [
                    'product_variant_id' => $dataInsertVariantValueItem[0],
                    'attribute_id' => $dataInsertVariantValueItem[1],
                    'attribute_value_id' => $dataInsertVariantValueItem[2],
                ]);

                if (empty($insertVariantValue)) {
                    $this->Toast('error', 'Có lỗi liên quan đến biến thể.');
                    return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
                }
            }
        }

        //  validate Upload image image
        $urlUploadImages = [];
        foreach ($image['tmp_name'] as $key => $name) {
            $type = $image['type'][$key];
            $size = $image['size'][$key];
            $maxFileSize = 5000000;
            $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/webp');

            if ($size > $maxFileSize) {
                // Kiem tra dung luong file
                $this->Toast('error', 'Dung lượng file < 5MB.');
                return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
            } elseif (!in_array($type, $allowTypes)) {
                // Kiem tra loai file
                $this->Toast('error', 'Đuôi file phải đúng quy định.');
                return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
            } else {
                //Upload file len cloud
                $urlImage =  Services::uploadImageToCloudinary($name);

                if (empty($urlImage)) {
                    $this->Toast('error', 'Upload ảnh thất bại.');
                    return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
                }
                //Gan cac link image vao mang
                $urlUploadImages[] = $urlImage;
            }
        }

        //bat dau upload anh len database
        foreach ($urlUploadImages as $urlUploadImage) {

            $uploadImage = $this->db->create('images_product', [
                'prod_id' => $prod_id,
                'image' => $urlUploadImage,
            ]);

            if (!$uploadImage) {
                $this->Toast('error', 'Upload ảnh thất bại.');
                return $this->renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld);
            }
        }

        // Thanh cong se sang trang danh sach san pham
        return $this->res->setToastSession('success', 'Thêm sản phẩm thành công.', 'admin/product');
    }
    private function renderAddPage($cateData, $brandData, $attributeData, $attributeValueData, $dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Thêm sản phẩm mới',
            'pages' => 'product/addProduct',
            'cateData' => $cateData,
            'brandData' => $brandData,
            'attributeData' => $attributeData,
            'attributeValueData' => $attributeValueData,
            'dataValueOld' => $dataValueOld
        ]);
    }



    function updateProduct($id)
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $cateData = $this->categoryModel->getAllCategory() ?? [];
        $brandData = $this->brandModel->getAllBrand() ?? [];
        $dataProd = $this->productModel->getOneProd($id) ?? [];
        $prodImages = $this->productModel->getAllProdImages($id) ?? [];


        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
        }
        $dataPost = $this->req->getFields();

        //Get image
        $image = $_FILES['images'] ?? '';
        $thumb = $_FILES['thumb'] ?? '';

        //Set rule
        $this->req->rules([
            'title' => 'required',
            'cate_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
        ]);

        // Set message
        $this->req->message([
            'title.required' => 'Vui lòng không để trống tên sản phẩm.',
            'cate_id.required' => 'Vui lòng không để trống danh mục.',
            'brand_id.required' => 'Vui lòng không để trống thương hiệu.',
            'price.required' => 'Vui lòng không để trống giá.',
        ]);

        // //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
        }


        $dataUpdateProd = [
            'title' => $dataPost['title'],
            'slug' => Format::createSlug($dataPost['title']),
            'cate_id' => $dataPost['cate_id'],
            'brand_id' => $dataPost['brand_id'],
            'price' => $dataPost['price'],
            'status' => $dataPost['status'] ?? 0,
            'short_description' => $dataPost['short_description'] ?? '',
            'description' => $dataPost['description'] ?? '',
        ];


        //Kiem tra co gia sale hay khong


        if (!empty($dataPost['sale_price'])) {
            // Kiem tra gia sale phai nho hon gia
            if ($dataPost['sale_price'] >= $dataPost['price']) {
                $this->Toast('error', 'Giá sale phải nhỏ hơn giá.');
                return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
            }

            $discount = round((($dataPost['price'] - $dataPost['sale_price']) / $dataPost['price']) * 100, 0);
            $dataUpdateProd['discount'] = $discount;
            $dataUpdateProd['price'] = $dataPost['sale_price'];
        }



        //  validate Upload image thumb
        if (!empty($thumb['name'])) {

            if (!Format::validateUploadImage($thumb)) {
                $this->Toast('error', 'Kiểm tra lại file upload.');
                return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
            }

            //upload anh len cloud
            $urlThumb = Services::uploadImageToCloudinary($thumb['tmp_name']);
            if (empty($urlThumb)) {
                $this->Toast('error', 'Upload ảnh thất bại.');
                return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
            }

            $dataUpdateProd['thumb'] = $urlThumb;
        }

        //Lay ra id sau khi tai san pham 
        $updateProd = $this->productModel->updateProduct($id, $dataUpdateProd);

        if (empty($updateProd)) {
            $this->Toast('error', 'Có lỗi khi cập nhập sản phẩm.');
            return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
        }


        if (!empty($image['name'][0])) {
            //  validate Upload image image
            $urlUploadImages = [];
            foreach ($image['tmp_name'] as $key => $name) {
                $type = $image['type'][$key];
                $size = $image['size'][$key];
                $maxFileSize = 5000000;
                $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/webp');

                if ($size > $maxFileSize) {
                    // Kiem tra dung luong file
                    $this->Toast('error', 'Dung lượng file < 5MB.');
                    return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
                } elseif (!in_array($type, $allowTypes)) {
                    // Kiem tra loai file
                    $this->Toast('error', 'Đuôi file phải đúng quy định.');
                    return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
                } else {
                    //Upload file len cloud
                    $urlImage =  Services::uploadImageToCloudinary($name);

                    if (empty($urlImage)) {
                        $this->Toast('error', 'Upload ảnh thất bại.');
                        return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
                    }
                    //Gan cac link image vao mang
                    $urlUploadImages[] = $urlImage;
                }
            }

            //bat dau upload anh len database
            foreach ($urlUploadImages as $urlUploadImage) {

                $uploadImage = $this->db->create('images_product', [
                    'prod_id' => $id,
                    'image' => $urlUploadImage,
                ]);

                if (!$uploadImage) {
                    $this->Toast('error', 'Upload ảnh thất bại.');
                    return $this->renderUpdatePage($cateData, $brandData, $prodImages, $dataProd);
                }
            }
        }
        // Thanh cong se sang trang danh sach san pham
        return $this->res->setToastSession('success', 'Cập nhập sản phẩm thành công.', 'admin/product');
    }

    private function renderUpdatePage($cateData, $brandData, $prodImages, $dataProd)
    {
        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Cập nhập sản phẩm',
            'pages' => 'product/updateProduct',
            'cateData' => $cateData,
            'brandData' => $brandData,
            'prodImages' => $prodImages,
            'dataProd' => $dataProd,
        ]);
    }

    function deleteImageProduct($id, $prodId)
    {
        $delImage = $this->productModel->deleteImageProduct($id);
        if ($delImage) {
            return $this->res->setToastSession('success', 'Xoá ảnh thành công.', 'admin/update-product/' . $prodId);
        }

        return $this->res->setToastSession('error', 'Xoá ảnh thất bại.', 'admin/update-product/' . $prodId);
    }

    function deleteThumbProduct($id)
    {
        $delThumb = $this->productModel->updateProduct($id, ['thumb' => '2004']);
        if ($delThumb) {
            return $this->res->setToastSession('success', 'Xoá ảnh thành công.', 'admin/update-product/' . $id);
        }

        return $this->res->setToastSession('error', 'Xoá ảnh thất bại.', 'admin/update-product/' . $id);
    }

    function productVariants($id)
    {
        $toastMessage = Session::get('toastMessage');
        $toastType = Session::get('toastType');
        $this->ToastSession($toastMessage, $toastType);

        $dataProd = $this->db->findById('product', 'id, title, price, create_at', $id);
        $dataProdVariants = $this->productModel->getAllProdVariants($id);

        if (!empty($dataProdVariants)) {
            $dataProdVariantsNew = [];
            foreach ($dataProdVariants as $item) {
                $idVariant = $item['id'];
                if (!isset($dataProdVariantsNew[$idVariant])) {
                    $dataProdVariantsNew[$idVariant] = [
                        'id' => $idVariant,
                        'title' => $item['title'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'discount' => $item['discount'],
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
            return $this->view('layoutServer', [
                'title' => 'Biến thể sản phẩm',
                'active' => 'product',
                'pages' => 'product/productVariants',
                'dataProdVariants' => $dataProdVariants ?? [],
                'dataProd' => $dataProd ?? [],
            ]);
        }

        $dataPost = $this->req->getFields();

        //Kiem tra co bien the hay khong
        $dataUpdateVariants = [];
        if (isset($dataPost['product_variants_id']) && !empty($dataPost['product_variants_id'][0])) {
            //Check bat buoc phai nhap cac truong 
            if (empty($dataPost['quantity_variant'][0]) || empty($dataPost['price_variant'][0])) {
                return $this->res->setToastSession('error', 'Vui lòng không để trống biến thế', 'admin/product-variants/' . $id);
            }



            foreach ($dataPost['product_variants_id'] as $keyVariantId => $product_variants_id) {
                $dataUpdateVariants[] = [
                    'id' => $product_variants_id,
                    'quantity' => $dataPost['quantity_variant'][$keyVariantId],
                    'price' => $dataPost['price_variant'][$keyVariantId],
                    'discount' => $dataPost['discount'][$keyVariantId],
                ];

                // Kiem tra co gia sale hay khong
                if (!empty($dataPost['sale_price_variant'][$keyVariantId])) {
                    // Kiem tra gia sale phai nho hon gia 
                    if ($dataPost['sale_price_variant'][$keyVariantId] > $dataPost['price_variant'][$keyVariantId]) {
                        return $this->res->setToastSession('error', 'Giá sale phải nhỏ hơn giá', 'admin/product-variants/' . $id);
                    }

                    $discountVariant = round((($dataPost['price_variant'][$keyVariantId] - $dataPost['sale_price_variant'][$keyVariantId]) / $dataPost['price_variant'][$keyVariantId]) * 100, 0);

                    $dataUpdateVariants[$keyVariantId]['price'] = $dataPost['sale_price_variant'][$keyVariantId];
                    $dataUpdateVariants[$keyVariantId]['discount'] = $discountVariant;
                }
            }
        }


        foreach ($dataUpdateVariants as $value) {
            $updateProductVariant = $this->db->findByIdAndUpdate('product_variants', $value['id'], [
                'quantity' => $value['quantity'],
                'price' => $value['price'],
                'discount' => $value['discount'],
            ]);
            if (!$updateProductVariant) {
                return $this->res->setToastSession('error', 'Có lỗi trong quá trình cập nhập.', 'admin/product-variants/' . $id);
            }
        }

        return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/product-variants/' . $id);
    }


    function addProductVariants($id)
    {
        $toastMessage = Session::get('toastMessage');
        $toastType = Session::get('toastType');
        $this->ToastSession($toastMessage, $toastType);

        $dataProd = $this->db->findById('product', 'id, title, price, create_at', $id);
        $attributeData = $this->attributeModel->getAllAttribute() ?? [];
        $attributeValueData = $this->attributeModel->getAllAttributeValue() ?? [];

        if (!$this->req->isPost()) {
            return $this->view('layoutServer', [
                'title' => 'Biến thể sản phẩm',
                'active' => 'product',
                'pages' => 'product/addProductVariants',
                'dataProd' => $dataProd ?? [],
                'attributeData' => $attributeData ?? [],
                'attributeValueData' => $attributeValueData ?? [],
            ]);
        }


        $dataPost = $this->req->getFields();

        if (!isset($dataPost['attribute'])) {
            return $this->res->setToastSession('error', 'Vui lòng chọn thuộc tính.', 'admin/add-product-variants/' . $id);
        }
        //Kiem tra co bien the hay khong


        //Check bat buoc phai nhap cac truong 
        if (empty($dataPost['price_variant'][0])) {
            return $this->res->setToastSession('error', 'Vui lòng không để trống biến thế.', 'admin/add-product-variants/' . $id);
        }

        //  Mang id attribute va id attribute_value
        $dataAttributeId = [];

        foreach ($dataPost['attribute'] as $attributeItem) {
            //Tach mang 
            $dataAttributeArr = explode(',', $attributeItem);

            foreach ($dataAttributeArr as $dataAttributeItem) {
                //id dau tien la attribute
                //id thu 2 la attribute_value
                $attributeIdArr = explode('-', $dataAttributeItem);
                $dataAttributeId[] = $attributeIdArr;
            }
        }

        //dataInsert of product_variants
        $dataInsertVariants = [];

        foreach ($dataPost['price_variant'] as $keyVariant => $price_variant) {
            $dataInsertVariants[] = [
                'prod_id' => $id,
                'price' => $price_variant,
                'discount' => 0,
            ];

            // Kiem tra co gia sale hay khong
            if (!empty($dataPost['sale_price_variant'][$keyVariant])) {
                // Kiem tra gia sale phai nho hon gia 
                if ($dataPost['sale_price_variant'][$keyVariant] >= $price_variant) {
                    return $this->res->setToastSession('error', 'Giá sale phải nhỏ hơn giá.', 'admin/add-product-variants/' . $id);
                }

                $discountVariant = round((($price_variant - $dataPost['sale_price_variant'][$keyVariant]) / $price_variant) * 100, 0);

                $dataInsertVariants[$keyVariant]['price'] = $dataPost['sale_price_variant'][$keyVariant];
                $dataInsertVariants[$keyVariant]['discount'] = $discountVariant;
            }
        }


        //id product_variants sau khi insert
        $prodVariantIdArr = [];
        foreach ($dataInsertVariants as $dataInsertVariant) {
            //Them vao product_variant
            $createProductVariant = $this->db->create('product_variants', $dataInsertVariant);

            //Kiem tra loi sau khi them
            if (!$createProductVariant) {
                return $this->res->setToastSession('error', 'Có lỗi liên quan đến biến thể.', 'admin/add-product-variants/' . $id);
            }
            //Lay ra id của bang vua nhap them vao mang
            $prod_variant_id = $this->db->lastInsertId();
            $prodVariantIdArr[] = $prod_variant_id;
        }


        if (empty($prodVariantIdArr)) {
            return $this->res->setToastSession('error', 'Có lỗi liên quan đến biến thể.', 'admin/add-product-variants/' . $id);
        }

        //dataInsert of variant_values
        $dataInsertVariantValue = [];

        //Lap qua id cua  bien the san pham de gan gia tri vao mang de insert
        foreach ($prodVariantIdArr as $value) {
            // Lặp giá trị một vào ba phần tử đầu tiên 
            for ($i = 0; $i < count($dataAttributeArr); $i++) {
                $dataInsertVariantValue[] = array_merge([$value], $dataAttributeId[$i]);
            }
            $dataAttributeId = array_slice($dataAttributeId, count($dataAttributeArr));
        }

        if (empty($dataInsertVariantValue)) {
            return $this->res->setToastSession('error', 'Có lỗi liên quan đến biến thể.', 'admin/add-product-variants/' . $id);
        }

        //Them vao bang variant value

        foreach ($dataInsertVariantValue as $dataInsertVariantValueItem) {
            $insertVariantValue = $this->db->create('variants_value', [
                'product_variant_id' => $dataInsertVariantValueItem[0],
                'attribute_id' => $dataInsertVariantValueItem[1],
                'attribute_value_id' => $dataInsertVariantValueItem[2],
            ]);

            if (empty($insertVariantValue)) {
                return $this->res->setToastSession('error', 'Có lỗi liên quan đến biến thể.', 'admin/add-product-variants/' . $id);
            }
        }


        //Cap nhap lai isVariant
        $updateProd = $this->productModel->updateProduct($id, ['isVariant' => 1]);

        if (!$updateProd) {
            return $this->res->setToastSession('error', 'Có lỗi liên quan đến biến thể.', 'admin/add-product-variants/' . $id);
        }

        // Thanh cong se sang trang danh sach san pham
        return $this->res->setToastSession('success', 'Thêm biến thể thành công.', 'admin/product-variants/' . $id);
    }

    function deleteProductVariant($prodId, $prodVariantId)
    {

        $delVariant = $this->productModel->deleteProductVariant($prodVariantId);

        if ($delVariant) {
            return $this->res->setToastSession('success', 'Xoá biến thể thành công.', 'admin/product-variants/' . $prodId);
        }

        return $this->res->setToastSession('error', 'Xoá biến thể thất bại.', 'admin/product-variants/' . $prodId);
    }

    function deleteProduct($id)
    {
        $delProd = $this->productModel->deleteProduct($id);

        if ($delProd) {
            return $this->res->setToastSession('success', 'Xoá sản phẩm thành công.', 'admin/product');
        }

        return $this->res->setToastSession('error', 'Xoá sản phẩm thất bại.', 'admin/product');
    }

    function toggleStatusApi()
    {
        if (!$this->req->isPost()) {
            echo $this->res->dataApi('400', 'Cập nhập thất bại.', []);
            return;
        }

        $dataPost = $this->req->getFields();
        $dataUpdate = [
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $data = $this->productModel->getOneProd($dataPost['id']);

        if ($data['status'] == 1) {
            $dataUpdate['status'] = 0;
        } else {
            $dataUpdate['status'] = 1;
        }

        $update = $this->productModel->updateProduct($dataPost['id'], $dataUpdate);

        if (!$update) {
            echo $this->res->dataApi('400', 'Cập nhập thất bại.', []);
            return;
        }

        echo $this->res->dataApi('200', 'Cập nhập thành công.', []);
        return;
    }


    function rating($prod_id)
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }
        $dataRatings = $this->productModel->getAllRatings($prod_id) ?? [];
        $this->view('layoutServer', [
            'title' => 'Danh sách đánh giá',
            'active' => 'product',
            'pages' => 'product/ratings',
            'dataRatings' => $dataRatings,
        ]);
    }

    function hideComment()
    {
        $dataUser = $this->userModel->getOneUser($this->user_id);
        if ($dataUser['role_id'] != 1) {
            echo $this->res->dataApi('400', 'Xin lỗi bạn không có quyền. Vui lòng liên hệ quản trị.', []);
            return;
        }

        $dataPost = $this->req->getFields();
        $dataUpdate = [
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $data = $this->productModel->getOneRating($dataPost['id']);

        if ($data['status'] == 1) {
            $dataUpdate['status'] = 0;
        } else {
            $dataUpdate['status'] = 1;
        }

        $updateRating = $this->productModel->updateRatingProd($dataPost['id'], $dataUpdate);

        if (!$updateRating) {
            echo $this->res->dataApi('400', 'Cập nhập thất bại.', []);
            return;
        }

        echo $this->res->dataApi('200', 'Cập nhập thành công.', []);
        return;
    }
}
