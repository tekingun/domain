<?php

error_reporting(E_ALL);
ini_set("display_errors", 0);

set_time_limit(999); // 

date_default_timezone_set('Europe/Istanbul');
include 'connect.php';
include 'func.php';

$xgun = $db->query("select * from xgun where id='0'")->fetch();
$sms_xgun = $xgun['sms_xgun'];
$mail_xgun = $xgun['mail_xgun'];
$sms_g = $xgun['sms_g'];
$mail_g = $xgun['mail_g'];
$sablon = $db->query("select * from sablonlar where id='0'")->fetch();
$smsSablon = $sablon['sms_sablon'];
$mailSablon = $sablon['mail_sablon'];

$smsAyar = $db->query("select * from sms_ayar where id='0'")->fetch();
$baslik = $smsAyar['baslik'];
$apikey = $smsAyar['apikey'];

$domainler = $db->prepare("select * from domainler");
$domainler->execute();

while($domain = $domainler->fetch(PDO::FETCH_BOTH)){

	$domain_adi_mail = $domain['domain'];

	$id = $domain['id'];

	/*DOMAİN BİTİŞ VERİTABANI*/
	$bitis_tarihi = $domain['bitis_tarihi'];
	/*MÜŞTERİ BİLGİLERİ*/
	$musteriid = $domain['musteri_id'];
	$musteriBilgi = $db->query("SELECT * from musteriler where id='{$musteriid}'")->fetch();


	/*DOMAİN KONTROLLERİ & BİLGİLERİ*/
	$domain = $domain['domain'];
	$domainSonrasi = explode('.', $domain);
	$bitisTarihi = bitisSuresi($domainSonrasi[0]);
	$sslKontrol = json_decode(ssl_kontrol($domain));
	$obj = $sslKontrol[0];
	$sslKontrol = object_to_array($obj);
	$ssl_kalan_gun = $sslKontrol['data'][0]['remaining_days'];
	$ssl_durum = sslKontrol($domain);
	if($ssl_durum == 1){
		$ssl_durum_sms = "aktif";
	} else {
		$ssl_durum_sms = "pasif";
	}

	if($ssl_kalan_gun == ""){
		$ssl_kalan_gun = "0";
	}

	/*TARİH FARKI*/
	$tarih1 = new DateTime(date('Y-m-d'));
	$tarih2 = new DateTime($bitis_tarihi);
	$interval = $tarih1->diff($tarih2);
	$xGunKaldi = $interval->format('%a');

	if($sms_g == 'on'){

		$smsSablon = $sablon['sms_sablon'];

		$musteriTel = $musteriBilgi['telefon'];
		$musteriAdi = $musteriBilgi['ad'];

		if($sms_xgun == $xGunKaldi && $sms_g == 'on'){
			/*SMS ŞABLONU DEĞİŞİMİ*/
			@$smsSablon = @str_replace('{musteri}', $musteriAdi, $smsSablon);
			@$smsSablon = @str_replace('{domain}', $domain, $smsSablon);
			@$smsSablon = @str_replace('{bitis}', $bitisTarihi, $smsSablon);
			@$smsSablon = @str_replace('{kalan_gun}', $xGunKaldi, $smsSablon);
			@$smsSablon = @str_replace('{ssl_durum}', $ssl_durum_sms, $smsSablon);
			@$smsSablon = @str_replace('{ssl_kalangun}', $ssl_kalan_gun, $smsSablon);

			/*SMS GÖNDER*/
			MASGSM($baslik, $smsSablon, $musteriTel, $apikey);

		}
	}

	if($mail_g == 'on'){
		$mailBilgi = $db->query("select * from mail_ayar where id='0'")->fetch();
		$smtp = $mailBilgi['smtp'];
		$gonderen_mail = $mailBilgi['gonderen_mail'];
		$gonderen_sifre = $mailBilgi['gonderen_sifre'];
		$smtp_secure = $mailBilgi['smtp_secure'];
		$port = $mailBilgi['port'];

		/*MAİL BAŞLIĞI*/
		$baslik = $domain_adi_mail . " bilgileri";

		$mailSablon = $sablon['mail_sablon'];

		$musteriAdi = $musteriBilgi['ad'];
		$musteriMail = $musteriBilgi['mail'];

		if($mail_xgun == $xGunKaldi && $mail_g == 'on'){

			/*MAİL ŞABLONU DEĞİŞİMİ*/
			@$mailSablon = @str_replace('{musteri}', $musteriAdi, $mailSablon);
			@$mailSablon = @str_replace('{domain}', $domain_adi_mail, $mailSablon);
			@$mailSablon = @str_replace('{bitis}', $bitisTarihi, $mailSablon);
			@$mailSablon = @str_replace('{kalan_gun}', $xGunKaldi, $mailSablon);
			@$mailSablon = @str_replace('{ssl_durum}', $ssl_durum_mail, $mailSablon);
			@$mailSablon = @str_replace('{ssl_kalangun}', $ssl_kalan_gun, $mailSablon);

			mailGonder($smtp, $gonderen_mail, $gonderen_sifre, $smtp_secure, $port, $baslik, $musteriMail, $mailSablon);
		}
	}

	$update = $db->prepare("UPDATE domainler set bitis_tarihi=?,domain_kalangun=?,ssl_durum=?,ssl_kalangun=? where id='$id'");
	$control = $update->execute(array($bitisTarihi,$xGunKaldi,$ssl_durum,$ssl_kalan_gun));

}

