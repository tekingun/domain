<?php

require('method.whois-socket.php');
function sslKontrol($domain)
{
    $ssl_check = @fsockopen('ssl://' . $domain, 443, $errno, $errstr, 30);
    $res = !!$ssl_check;
    if ($ssl_check) {
        fclose($ssl_check);
    }
    return $res;
}


function filter($post)
{
    return htmlspecialchars($post);
}

function tr($yazi)
{
    $yazi = str_replace("&ccedil;", "ç", $yazi);
    $yazi = str_replace("&yacute;", "ı", $yazi);
    $yazi = str_replace("&Ccedil;", "Ç", $yazi);
    $yazi = str_replace("&Ouml;", "Ö", $yazi);
    $yazi = str_replace("&Uuml;", "Ü", $yazi);
    $yazi = str_replace("&ETH;", "Ğ", $yazi);
    $yazi = str_replace("&THORN;", "Ş", $yazi);
    $yazi = str_replace("&Yacute;", "İ", $yazi);
    $yazi = str_replace("&ouml;", "ö", $yazi);
    $yazi = str_replace("&thorn;", "ş", $yazi);
    $yazi = str_replace("&eth;", "ğ", $yazi);
    $yazi = str_replace("&uuml;", "ü", $yazi);
    $yazi = str_replace("&amp;", "&", $yazi);
    $yazi = str_replace("&nbsp;", " ", $yazi);
    return $yazi;
}

function oes($str, $options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function telfilter($str)
{
    $s_str = substr($str, 0, 1);
    if ($s_str == '0') {
        $res = $str;
    } else if ($s_str == '9') {
        $res = substr($str, 1);
    } else if ($s_str == '5') {
        $res = "0" . $str;
    } else if ($s_str != '0' && $s_str != '9') {
        $res = substr($str, -11);
    }
    return $res;
}


function domainFilter($str)
{
    $s_str = substr($str, 0, 4);
    if ($s_str == 'http') {
        $res = substr($str,7);
    } else if ($s_str == 'www.') {
        $res = substr($str, 4);
    } else {
        $res = $str;
    }
    return $res;
}


function bitisSuresi($domain){
    $domain = search($domain, array('com','net'));
    $dom = $domain[0]['whois'];
    $regular_exp = "\:(.*?)\:";
    preg_match_all('#' . $regular_exp . '#', $dom, $matches);
    $domainBitisTarihi = substr($matches[1][3],0,11);
    return $domainBitisTarihi;
}

function ssl_kontrol($domain)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://www.natro.com/ssl-checker-result");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, "text/html; Charset=utf-8");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "command=result&domain_name=$domain");
    curl_setopt($curl, CURLOPT_COOKIE, "XSipCode=332335006THSN");
    curl_setopt($curl, CURLOPT_COOKIE, "ASPSESSIONIDQCBBCQBQ=JJLGHCKDJBIHLPDJMPMHFHKD");
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36');
    $sonuc = curl_exec($curl);
    return $sonuc;
    curl_close($curl);
}

function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}


function netgsm($gsm, $mesaj)
{
    global $db;
    $username = "NETGSM User";
    $pass = "MET GSM Şifre";
    $header = "";
    $telefonnumarasi = $gsm;
    $startdate = date('d.m.Y H:i');
    $startdate = str_replace('.', '', $startdate);
    $startdate = str_replace(':', '', $startdate);
    $startdate = str_replace(' ', '', $startdate);

    $stopdate = date('d.m.Y H:i', strtotime('+1 day'));
    $stopdate = str_replace('.', '', $stopdate);
    $stopdate = str_replace(':', '', $stopdate);
    $stopdate = str_replace(' ', '', $stopdate);


    $msg = html_entity_decode($mesaj, ENT_COMPAT, "UTF-8");
    $msg = rawurlencode($msg);


    $gonderici = html_entity_decode($header, ENT_COMPAT, "UTF-8");
    $gonderici = rawurlencode($gonderici);

    $url = "https://api.netgsm.com.tr/bulkhttppost.asp?usercode=$username&password=$pass&gsmno=$telefonnumarasi&message=$msg &msgheader=$gonderici&startdate=$startdate&stopdate=$stopdate&dil=TR";
    //echo $url;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($ch,CURLOPT_HEADER, false);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

//netgsm => netgsm(05313241616,"Bu bir deneme mesajıdır");

function MASGSM($baslik , $message , $telno , $apikey) {
    $API_URL = "http://api.v2.masgsm.com.tr/v2/sms/basic";
    $ch   = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Key {$apikey}"));
    curl_setopt($ch, CURLOPT_POST, 1);
    $body = ["originator"=>$baslik,"message"=>$message,"to"=>$telno,"encoding"=>"auto"];
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//masgsm => MASGSM("Başlık", "Bu bir deneme mesajıdır.", "tel num.", "api key");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function mailGonder($smtp, $gonderenmail, $sifre, $smtpsecure, $port, $baslik, $gidecekmail, $icerik){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $smtp;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $gonderenmail;                 // SMTP username
    $mail->Password = $sifre;                           // SMTP password
    $mail->SMTPSecure = $smtpsecure;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $port;                                    // TCP port to connect to
    $mail->Charset = "UTF-8";
    //Recipients
    $mail->setFrom($gidecekmail,$baslik);
    $mail->addAddress($gidecekmail);     // Add a recipient
    $mail->addReplyTo($gidecekmail);

    //Content
    $mail->isHTML(true);                                  //mesaj baslıgı
    $mail->Subject = $baslik;
    $mail->Body    = nl2br($icerik);   // mesaj acıklaması
    $mail->send();

}

function bugunDusecekDomainler($aranan){
    $content = file_get_contents("https://www.domainyakala.com/ara.php?q=$aranan");
    $aranan = "@background-color:#fff;padding:20px;(.*?)</div@si"; 
    preg_match_all($aranan, $content, $sonuc);
    $sonuc = $sonuc[0][1];
    $sonuc = str_replace("background-color:#fff;padding:20px;'>", '', $sonuc);
    $sonuc = str_replace("<br>", '<hr style="max-width:50%;background-color:black;">', $sonuc);
    return $sonuc;
}