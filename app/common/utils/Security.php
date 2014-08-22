<?php
/**
 * 暗号化・復号機能(セキュリテイ)
 *
 * @author ou
 */

namespace App\Common\Utils;

class Security
{

    public static function AES128Encrypt($data, $key) {
        if(16 !== strlen($key)) $key = hash('MD5', $key, true);
        $padding = 16 - (strlen($data) % 16);
        $data .= str_repeat(chr($padding), $padding);
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16)));
    }

    public static function AES128Decrypt($data, $key) {
        if(16 !== strlen($key)) $key = hash('MD5', $key, true);
        $data = base64_decode($data);
        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
        $padding = ord($data[strlen($data) - 1]); 
        return substr($data, 0, -$padding); 
    }

    public static function AES256Encrypt($data, $key) {
        if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
        $padding = 16 - (strlen($data) % 16);
        $data .= str_repeat(chr($padding), $padding);
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16)));
    }

    public static function AES256Decrypt($data, $key) {
        if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
        $data = base64_decode($data);
        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
        $padding = ord($data[strlen($data) - 1]); 
        return substr($data, 0, -$padding); 
    }

    public static function getFullUrl()
    {
        return 'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's://' : '://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    // 認証用文字列つけるURLの作成
    public static function buildSecureUrl($baseUrl, $key, $params = array())
    {
        $params['key'] = time();
        $url = 'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's://' : '://') . $_SERVER['HTTP_HOST'] . $baseUrl.'?'.http_build_query($params);
        $token = self::AES256Encrypt($url, $key);
        //error_log('url: '.$url);
        //error_log('token: '.$token);
        return $url.'&token='.urlencode($token);
    }

    // URL有効かどうかのチェック
    public static function isValidUrl($key)
    {
        if(!isset($_REQUEST['token'])) {
            return false;
        }
        $url = self::getFullUrl();
        //$url = preg_replace('#https?://.*?/#', '/', $url);
        $url = preg_replace('#[&?]token=.*$#i', '', $url);
        $url2 = self::AES256Decrypt($_REQUEST['token'], $key);
        //error_log('url2: '.$url2);
        return ($url == $url2);
    }
}