<?php

class News extends Controller
{

    private $req = null;
    private $res = null;
    private $newsModel;
    private $productModel;

    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
        $this->newsModel = $this->model('NewsModel');
        $this->productModel = $this->model('ProductModel');
    }

    function Default()
    {

        $dataNews = $this->newsModel->getAllNews();
        $dataProdRecent = $this->productModel->getProdRecently() ?? [];

        $this->view('layoutClient', [
            'title' => 'Tin tức',
            'currentPath' => 'news',
            'pages' => 'news/news',
            'dataNews' => $dataNews,
            'dataProdRecent' => $dataProdRecent,

        ]);
    }
    function newsDetail($id)
    {
        //Lay ra id tu chuoi slug
        $id = explode("-", $id);
        $id = end($id);

        $dataNew = $this->newsModel->getNewsUser($id);

        $updateViewNew = $this->newsModel->updateNews($id, ['view' => $dataNew['view'] + 1]);
        $dataNews = $this->newsModel->getAllNews();
        $dataProdRecent = $this->productModel->getProdRecently() ?? [];
        $this->view('layoutClient', [
            'title' => $dataNew['title'],
            'currentPath' => 'news',
            'pages' => 'news/newsDetail',
            'dataNew' => $dataNew,
            'dataNews' => $dataNews,
            'dataProdRecent' => $dataProdRecent,
        ]);
    }
}
