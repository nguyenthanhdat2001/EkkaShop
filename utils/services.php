<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Cloudinary\Uploader;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class Services
{

    // Gửi mã xác nhận qua email
    static function sendCode($email, $subject, $body)
    {
        global $config;
        //Cau hinh config
        $configPhpMailer = $config['phpMailer'];

        $mail = new PHPMailer(true);

        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->setLanguage('vi', '../assets/library/PHPMailer/language/');
            $mail->CharSet = 'UTF-8';
            $mail->Host       = $configPhpMailer['smtpHost'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $configPhpMailer['smtpUsername'];
            $mail->Password   = $configPhpMailer['smtpPassword'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Hoặc PHPMailer::ENCRYPTION_SMTPS nếu sử dụng 465
            $mail->Port       = $configPhpMailer['smtpPort'];


            //thông tin người gửi và email nhận
            $mail->setFrom('no-reply@accounts.admin.com', 'Ekka Shop');
            $mail->addAddress($email);

            // Tiêu đề và nội dung email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Gửi email
            $mail->send();
            // echo 'Gửi thành email công.';
            return true;
        } catch (Exception $e) {
            // echo 'Gửi không thành công. Lỗi: ', $mail->ErrorInfo;
            return false;
        }
    }

    //Upload ảnh with cloudinary
    static function uploadImageToCloudinary($uploadedFile)
    {
        global $config;
        $configCloudinary = $config['cloudinary'];
        // Thiết lập cấu hình 
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $configCloudinary['cloud_name'],
                'api_key' => $configCloudinary['api_key'],
                'api_secret' => $configCloudinary['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Thực hiện tải lên ảnh lên Cloudinary
        try {
            $upload = new UploadApi();
            $uploadOptions = [
                'public_id' => '',
                'use_filename' => true,
                'overwrite' => true,
                'folder' => $configCloudinary['forders'],
                'transformation' => [
                    ['format' => 'webp'],
                ],
            ];
            $result = $upload->upload($uploadedFile, $uploadOptions);

            return $result['secure_url'];
        } catch (\Exception $e) {
            return null;
        }
    }

    static function generateVnPayUrl($orderData)
    {
        global $config;
        $configVnpay = $config['bank']['vnpay'];

        if (empty($configVnpay)) {
            return false;
        }

        //Config
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://ekkashoe.shop/ecommerce_php_5_1/payment-final";
        $vnp_TmnCode = $configVnpay['vnp_TmnCode'];
        $vnp_HashSecret = $configVnpay['vnp_HashSecret'];

        $time = time();
        $locale = 'vn';

        // Tạo một mảng chứa thông tin cần thiết
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $orderData['amount'] * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Locale" => $locale,
            "vnp_OrderInfo" => 'vnpay_payment',
            "vnp_OrderType" => 'billpayment',
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $orderData['order_code'] . $time,
        );

        // Thêm thông tin nhưng không bắt buộc
        if (isset($orderData['bank_code']) && $orderData['bank_code'] != "") {
            $inputData['vnp_BankCode'] = $orderData['bank_code'];
        }

        if (isset($orderData['txt_bill_state']) && $orderData['txt_bill_state'] != "") {
            $inputData['vnp_Bill_State'] = $orderData['txt_bill_state'];
        }


        ksort($inputData);

        // Xây dựng chuỗi hash
        $hashdata = http_build_query($inputData, '', '&');

        $vnp_Url = $vnp_Url . "?" . $hashdata;

        // Thêm vnp_SecureHash vào URL nếu có vnp_HashSecret
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    private static function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    static function generateMomoUrl($orderData)
    {
        global $config;
        $configMomo = $config['bank']['momo'];

        if (empty($configMomo)) {
            return false;
        }

        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = $configMomo['partner_code'];
        $accessKey = $configMomo['access_key'];
        $secretKey = $configMomo['secret_key'];

        $orderInfo = "momo_payment";
        $amount = $orderData['amount'] . "";
        $orderId = $orderData['order_code'] . "";
        $returnUrl = "http://ekkashoe.shop/ecommerce_php_5_1/payment-final";
        $notifyurl = "http://localhost:8000/atm/ipn_momo.php";
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";

        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";

        // echo $serectkey;die;
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = self::execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        error_log(print_r($jsonResult, true));
        return $jsonResult['payUrl'];
    }


    static private function getHTMLPurchaseDataToPDF($dataInfo, $products)
    {
        ob_start();
?>
        <html>

        <head>
            <title>Biên nhận mua hàng - <?= $dataInfo['order_code'] ?></title>
        </head>

        <body>
            <div style="text-align:right;">
                <b>Người gửi:</b> <?= $dataInfo['sender'] ?>
            </div>
            <div style="text-align: left;border-top:1px solid #000;">
                <div style="font-size: 24px;color: #666; text-transform: uppercase;">Hoá đơn</div>
            </div>
            <table style="line-height: 1.5;">
                <tr>
                    <td><b>Hoá đơn:</b> #<?= $dataInfo['order_code'] ?>
                    </td>
                    <td style="text-align:right;"><b>Người nhận:</b></td>
                </tr>
                <tr>
                    <td><b>Ngày đặt hàng:</b> <?= date('d F Y', strtotime($dataInfo['order_date'])) ?></td>
                    <td style="text-align:right;"><?= $dataInfo['address'] ?></td>
                </tr>
            </table>
            <div></div>
            <div style="border-bottom:1px solid #000;">
                <table style="line-height: 2;">
                    <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                        <td style="border:1px solid #cccccc;width:200px;">Mặt hàng</td>
                        <td style="text-align:right;border:1px solid #cccccc;width:85px">Đơn giá</td>
                        <td style="text-align:right;border:1px solid #cccccc;width:75px;">Số lượng</td>
                        <td style="text-align:right;border:1px solid #cccccc;">Tổng</td>
                    </tr>
                    <?php
                    $subtotal = 0;
                    foreach ($products as $product) {
                        extract($product);
                        $subtotal += $sub_total;
                    ?>
                        <tr>
                            <td style="border:1px solid #cccccc;"><?= $title ?></td>
                            <td style="text-align:right; border:1px solid #cccccc;"><?= Format::formatCurrency($price) ?></td>
                            <td style="text-align:right; border:1px solid #cccccc;"><?= $quantity ?></td>
                            <td style="text-align:right; border:1px solid #cccccc;"><?= Format::formatCurrency($sub_total) ?></td>
                        </tr>
                    <?php
                    }


                    ?>

                    <tr style="font-weight: bold;">
                        <td colspan="3" style="text-align:right;">Tạm tính: </td>
                        <td style="text-align:right;"><?= Format::formatCurrency($subtotal); ?></td>
                    </tr>

                    <tr style="font-weight: bold;">
                        <td colspan="3" style="text-align:right;">Giảm giá: </td>
                        <td style="text-align:right;">- <?= Format::formatCurrency($subtotal - $total_money); ?></td>
                    </tr>

                    <tr style="font-weight: bold;">
                        <td colspan="3" style="text-align:right;">Thành tiền: </td>
                        <td style="text-align:right;"><?= Format::formatCurrency($total_money); ?></td>
                    </tr>
                </table>
            </div>
            <p><u>Vui lòng thanh toán tới</u>:<br />
                Ngân hàng: TECHCOMBANK<br />
                A/C: 1021 8686 9999<br />
            </p>
            <p><i>Lưu ý: Vui lòng gửi thông báo chuyển tiền qua email tới datxomcity2@gmail.com</i></p>
        </body>

        </html>
<?php
        return ob_get_clean();
    }

    static function generatePDF($dataInfo, $products, $action = '')
    {

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->SetHeaderData(
            '',
            PDF_HEADER_LOGO_WIDTH,
            '',
            '',
            array(0, 0, 0),
            array(255, 255, 255)
        );
        $pdf->SetTitle('Hoá đơn - ' . $dataInfo['order_code']);
        $pdf->SetMargins(20, 10, 20, true);
        $pdf->SetFont('dejavusans', '', 11);

        $pdf->AddPage();

        // Gọi phương thức writeHTML để chèn HTML vào PDF
        $pdf->writeHTML(self::getHTMLPurchaseDataToPDF($dataInfo, $products), true, false, true, false, '');

        // Lưu hoặc xuất PDF
        $filename = "hoa-don-" . $dataInfo['order_code'];
        ob_end_clean();
        if ($action == 'print') {
            $pdfContent = $pdf->Output($filename . '.pdf', 'S');
            return $pdfContent;
        }
        $pdf->Output($filename . '.pdf', 'I');

        // $pdf->Output('public/uploads/invoice/' . $filename . 'pdf', '');
    }
}
