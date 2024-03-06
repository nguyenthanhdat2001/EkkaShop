<?php
class Format
{
    static function formatDate($date)
    {
        return date('F j, Y, g:i a', strtotime($date));
    }

    static function formatCurrency($amount)
    {
        $formattedAmount = number_format($amount, 0, '.', '.') . ' ₫';
        return $formattedAmount;
    }

    static function formatNumber($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        } else {
            return $number;
        }
    }

    static function calculateOriginalPrice($price, $discount)
    {
        if ($discount < 0 || $discount > 100) {
            return $originalPrice = 0;
        }

        $originalPrice = $price / (1 - ($discount / 100));
        $originalPrice = number_format($originalPrice, 0, '.', '.') . ' ₫';

        return $originalPrice;
    }

    static function renderStars($number)
    {
        $filledStars = round($number);
        $starArray = array();

        for ($index = 0; $index < 5; $index++) {
            if ($index < $filledStars) {
                $starArray[] = '<i style="color: #ffc73a" class="fas fa-star"></i>';
            } else {
                $starArray[] = '<i style="color: #ffc73a" class="far fa-star"></i>';
            }
        }

        return implode(' ', $starArray);
    }


    static function textShorten($text, $limit = 400)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . ".....";
        return $text;
    }

    static function validation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    static function title()
    {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');

        // Handle special cases
        $special_titles = [
            'index' => 'home',
            'contact' => 'contact',
        ];

        return isset($special_titles[$title]) ? ucfirst($special_titles[$title]) : ucfirst($title);
    }

    static function createSlug($string)
    {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ằ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $string = preg_replace("/($uni)/", $nonUnicode, $string);
        }

        $string = preg_replace('/[^a-zA-Z0-9-\s]/', '', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = trim($string);
        $string = str_replace(' ', '-', $string);
        $string = strtolower($string);

        $random = uniqid();
        return "$string-$random";
    }

    static function isStrongPassword($password)
    {
        if (strlen($password) < 8) {
            return false;
        }
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
            return false;
        }

        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        if (!preg_match('/[\W_]/', $password)) {
            return false;
        }
        return true;
    }

    static function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    static function validateUploadImage($file)
    {
        $type = $file['type'];
        $size = $file['size'];
        $maxFileSize = 5000000;  //5MB

        $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/webp');

        if ($size > $maxFileSize) {
            return false;
        }
        if (!in_array($type, $allowTypes)) {
            return false;
        }

        return true;
    }

    static function uploadSingleImage($file, $url)
    {

        $name = $file['name'];
        $tmp_name = $file['tmp_name'];
        $type = $file['type'];
        $size = $file['size'];
        $maxFileSize = 8000000;

        $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/webp');

        $target_dir = "public/images/$url/";
        $target_file = $target_dir . basename($name);

        if (file_exists($target_file)) {
            return ['error' => 'File đã tồn tại.'];
        } elseif ($size > $maxFileSize) {
            return ['error' => 'File vượt quá 8M.'];
        }
        if (!in_array($type, $allowTypes)) {
            return ['error' => 'Chọn đúng định dạng image/jpg | image/png | image/jpeg | image/webp.'];
        }

        if (!move_uploaded_file($tmp_name, $target_file)) {
            return ['error' => 'Tải file thất bại.'];
        }

        return ['success' => $name];
    }
}
