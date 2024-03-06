<?php

class Other extends Controller
{
    private $storeCustomModel;
    function __construct()
    {
        $this->storeCustomModel = $this->model('StoreCustomModel');;
    }
    function Default()
    {
        $this->view('layoutLogin', [
            'title' => '404 Not Found',
            'pages' => 'others/notFound',
        ]);
    }
    function comingSoon()
    {
        $dataStoreCustom = $this->storeCustomModel->getAllStoreCustom();

        $this->view('layoutComingSoon', [
            'title' => 'Coming Soon',
            'pages' => 'others/comingSoon',
            'dataStoreCustom' => $dataStoreCustom,
        ]);
    }
}
