<?php
class TestAll extends Controller
{
    private $req = null;
    private $res = null;
    function __construct()
    {
        $this->res = new Response;
        $this->req = new Request;
    }
    function Default()
    {
        echo '<pre>';
        print_r(ViewShare::$dataShare);
        echo '</pre>';
    }

    function getDataGet()
    {
        $dataGet = $this->req->getFields();
        echo '<pre>';
        print_r($dataGet);
        echo '</pre>';
    }

    function momo()
    {
        $orderData = [
            'order_id' => time(),
            'amount' => 1290000
        ];
        $url = Services::generateMomoUrl($orderData);
        var_dump($url);
        header('Location:' . $url);
    }
    function print()
    {

        $products = [
            ['title' => 'Điện thoại iPhone 15 Pro Max 256GB', 'quantity' => 2, 'price' => 50.00],
            ['title' => 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11 (8U237PA) ', 'quantity' => 1, 'price' => 30.00],
        ];

        $dataInfo = [
            'sender' => 'tanvn',
            'order_code' => 'ABC123',
            'order_date' => '2023-11-26',
            'address' => '123 Main St, City, Country',
        ];

        $pdfContent = Services::generatePDF($dataInfo, $products, 'print');

        // Encode PDF content in base64
        $base64PDFContent = base64_encode($pdfContent);
        echo $base64PDFContent;
    }


    function detail($i)
    {
        echo 'Trang test - ' . $i;
    }

    function get_user()
    {
        $this->view('layoutLogin', [
            'title' => 'trang thu nghiem',
            'pages' => 'test/viewTest',

        ]);
    }
    function modelTest()
    {
        $testModel = $this->model('TestModel');
        echo '<pre>';
        print_r($testModel->getList());
        echo '</pre>';
    }

    function post_user()
    {
        // set rules
        $this->req->rules([
            'fullname' => 'required|min:5|max:30',
            'email' => 'required|email|min:6',
            'password' => 'required|stringong',
            're_password' => 'match:password',
        ]);

        // set message

        $this->req->message([
            'fullname.required' => 'Ho ten khong duoc de trong',
            'fullname.min' => 'Toi thieu 5 ky tu',
            'fullname.max' => 'Toi da 8 ky tu',
            'email.required' => 'Email khong duoc de trong',
            'email.email' => 'Dung dinh dang email',
            'email.min' => 'Toi thieu 6 ky tu',
            'password.required' => 'Mat khau khong duoc de trong',
            'password.stringong' => 'Mat khau chua dung yeu cau',
            're_password.match' => 'Mat khau khong khop',
        ]);

        $validate = $this->req->validate();
        $this->view('layoutLogin', [
            'pages' => 'test/viewTest',
            'dataError' => $this->req->errors(),
        ]);
    }
}
// die();
