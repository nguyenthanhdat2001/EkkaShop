<?php

class Contact extends Controller
{

    use SweetAlert;
    private $req = null;
    private $res = null;
    private $contactHelpModel;
    function __construct()
    {
        $this->res = new Response;
        $this->req = new Request;
        $this->contactHelpModel = $this->model('ContactHelpModel');
    }

    function Default()
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');

            $this->ToastSession($toastMessage, $toastType);
        }

        $this->view('layoutClient', [
            'title' => 'Liên hệ',
            'currentPath' => 'contact',
            'pages' => 'contact/contact',

        ]);
    }

    function addContact()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Vui lòng nhập đầy đủ thông tin.', 'contact');
        }
        //Get data post
        $dataPost = $this->req->getFields();

        //Validate
        if (empty($dataPost['firstname']) || empty($dataPost['lastname']) || empty($dataPost['email']) || empty($dataPost['question']) || empty($dataPost['question'])) {
            $this->res->setToastSession('error', 'Vui lòng không để trống thông tin.', 'contact');
        }

        $dataInsert = [
            'firstname' => $dataPost['firstname'],
            'lastname' => $dataPost['lastname'],
            'email' => $dataPost['email'],
            'phone' => $dataPost['phone'],
            'question' => $dataPost['question'],
        ];


        $createContact = $this->contactHelpModel->addNewContactHelp($dataInsert);

        if ($createContact) {
            $this->res->setToastSession('success', 'Chúng tôi sẽ liên hệ cho bạn.', 'contact');
            return;
        } else {
            $this->Toast('error', 'Thất bại vui lòng thử lại.');
        }
    }
}
