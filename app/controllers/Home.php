<?php

class Home extends Controller
{
    use SweetAlert;
    private $productModel;
    private $storeCustomModel;
    private $categoryModel;
    private $req = null;

    public function __construct()
    {
        $this->req = new Request;
        $this->productModel = $this->model('ProductModel');
        $this->storeCustomModel = $this->model('StoreCustomModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    function Default()
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $dataCate = $this->categoryModel->getAllCategory() ?? [];
        $dataCateCount = $this->categoryModel->countAllProdCate() ?? [];
        $dataBanner = $this->storeCustomModel->getAllBanner() ?? [];
        $dataProdMostView = $this->productModel->getProdRecently() ?? [];
        $dataProdMostSold = $this->productModel->getProdMostSold() ?? [];
        $dataProdNewDate = $this->productModel->getProdNewDate() ?? [];
        $dataProdClothes = $this->productModel->getProdByCate(1) ?? [];
        $dataProdShoe = $this->productModel->getProdByCate(38) ?? [];
        $dataProdHat = $this->productModel->getProdByCate(39) ?? [];



        $this->view('layoutClient', [
            'title' => 'Trang chủ',
            'currentPath' => 'home',
            'pages' => 'home',
            'dataBanner' => $dataBanner ?? [],
            'dataCate' => $dataCate ?? [],
            'dataProdMostView' => $dataProdMostView ?? [],
            'dataProdMostSold' => $dataProdMostSold ?? [],
            'dataProdNewDate' => $dataProdNewDate ?? [],
            'dataProdClothes' => $dataProdClothes ?? [],
            'dataProdShoe' => $dataProdShoe ?? [],
            'dataProdHat' => $dataProdHat ?? [],
            'dataCateCount' => $dataCateCount ?? [],
        ]);
    }
}
