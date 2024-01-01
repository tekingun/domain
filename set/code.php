<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
ob_start();
include 'connect.php';

if (isset($_POST['admingiris'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = md5($_POST['password']);

    $sorgu = $db->prepare("select * from kullanici where username=? and password=?");
    $sorgu->execute(array($username, $password));
    $controlRow = $sorgu->rowCount();
    if ($controlRow) {
        $data = $sorgu->fetch(PDO::FETCH_BOTH);
        $_SESSION['oturum'] = "ok";
        $_SESSION['username'] = $data['username'];
        header("Location: ../inc/");
    } else {
        header("Location: ../login.php?q=hatali");
    }
}

if ($_SESSION['oturum'] == "ok" && $_SESSION['username'] != "") {

    include 'func.php';

    if (isset($_POST['musteriekle'])) {
        $domains = $db->prepare("INSERT INTO musteriler set
            ad=?,
            firma=?,
            telefon=?,
            mail=?,
            aciklama=?
            ");
        $update = $domains->execute(array(
            $_POST['ad'],
            $_POST['firma'],
            telfilter($_POST['telefon']),
            $_POST['mail'],
            $_POST['aciklama']
        ));
        if ($update) {
            header("location: ../inc/musteri-listesi.php?q=ok");
        } else {
            header("location: ../inc/musteri-listesi.php?q=no");
        }
    }

    if (isset($_POST['musteriduzenle'])) {
        $domains = $db->prepare("UPDATE musteriler set
            ad=?,
            firma=?,
            telefon=?,
            mail=?,
            aciklama=?
            where id='{$_POST['id']}'
            ");
        $update = $domains->execute(array(
            $_POST['ad'],
            $_POST['firma'],
            telfilter($_POST['telefon']),
            $_POST['mail'],
            $_POST['aciklama']
        ));
        if ($update) {
            header("location: ../inc/musteri-listesi.php?q=ok");
        } else {
            header("location: ../inc/musteri-listesi.php?q=no");
        }
    }


    if (isset($_POST['musterisil'])) {
        $id = filter($_POST['id']);
        $delete = $db->prepare("delete from musteriler where id=?");
        $control = $delete->execute(array($id));
        $delete = $db->prepare("delete from vhizmetler where musteri_id=?");
        $control = $delete->execute(array($id));
        $delete = $db->prepare("delete from domainler where musteri_id=?");
        $control = $delete->execute(array($id));
        if ($control) {
            echo 1;
        } else {
            echo 0;
        }   
    }

    if (isset($_POST['hizmetekle'])) {
        $domains = $db->prepare("INSERT INTO hizmetler set
            ad=?
            ");
        $update = $domains->execute(array(
            $_POST['ad']
        ));
        if ($update) {
            header("location: ../inc/hizmet-listesi.php?q=ok");
        } else {
            header("location: ../inc/hizmet-listesi.php?q=no");
        }
    }

    if (isset($_POST['vhizmetekle'])) {
        $domains = $db->prepare("INSERT INTO vhizmetler set
            hizmet_id=?,
            baslangic_tarihi=?,
            bitis_tarihi=?,
            musteri_id=?
            ");
        $update = $domains->execute(array(
            $_POST['hizmet'],
            $_POST['baslangic_tarihi'],
            $_POST['bitis_tarihi'],
            $_POST['musteri']
        ));
        if ($update) {
            header("location: ../inc/v-hizmet-listesi.php?q=ok");
        } else {
            header("location: ../inc/v-hizmet-listesi.php?q=no");
        }
    }

    if (isset($_POST['hizmetduzenle'])) {
        $domains = $db->prepare("UPDATE hizmetler set
            ad=?
            where id='{$_POST['id']}'
            ");
        $update = $domains->execute(array(
            $_POST['ad']
        ));
        if ($update) {
            header("location: ../inc/hizmet-listesi.php?q=ok");
        } else {
            header("location: ../inc/hizmet-listesi.php?q=no");
        }
    }

    if (isset($_POST['hizmetsil'])) {
        $id = filter($_POST['id']);
        $delete = $db->prepare("delete from hizmetler where id='$id'");
        $control = $delete->execute(array($id));
        if ($control) {
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['domainsil'])) {
        $id = filter($_POST['id']);
        $delete = $db->prepare("delete from domainler where id='$id'");
        $control = $delete->execute(array($id));
        if ($control) {
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['vhizmetsil'])) {
        $id = filter($_POST['id']);
        $delete = $db->prepare("delete from vhizmetler where id='$id'");
        $control = $delete->execute(array($id));
        if ($control) {
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['domainekle'])) {
        if(!empty($_POST['m_ad'] && $_POST['m_telefon'] && $_POST['m_mail'])){
            $insertMusteri = $db->prepare("INSERT into musteriler set 
                ad=?,firma=?,telefon=?,mail=?,aciklama=?");
            $controlMusteri = $insertMusteri->execute(array(
                $_POST['m_ad'],$_POST['m_firma'],$_POST['m_telefon'],$_POST['m_mail'],$_POST['m_aciklama']
            ));
            $musteriId = $db->lastInsertId();
        } else {
            $musteriId = $_POST['musteri'];
        }

        $donustur = array("http://" => "", "https://" => "", "www." => "");
        $domain = strtr(trim($_POST['domain']),$donustur);
        $domainSonrasi = explode('.', $domain);
        $bitisTarihi = bitisSuresi($domainSonrasi[0]);
        $sslKontrol = json_decode(ssl_kontrol($domain));
        $obj = $sslKontrol[0];
        $sslKontrol = object_to_array($obj);
        $ssl_kalan_gun = $sslKontrol['data'][0]['remaining_days'];
        $ssl_durum = sslKontrol($domain);

        /*TARİH FARKI*/
        $tarih1 = new DateTime(date('Y-m-d'));
        $tarih2 = new DateTime($bitisTarihi);
        $interval = $tarih1->diff($tarih2);
        $xGunKaldi = $interval->format('%a');


        $domains = $db->prepare("INSERT INTO domainler set
            domain=?,
            bitis_tarihi=?,
            domain_kalangun=?,
            ssl_durum=?,
            ssl_kalangun=?,
            musteri_id=?
            ");
        $update = $domains->execute(array(
            $domain,
            $bitisTarihi,
            $xGunKaldi,
            $ssl_durum,
            $ssl_kalan_gun,
            $musteriId
        ));
        if ($update) {
            header("location: ../inc/domain-listesi.php?q=ok");
        } else {
            header("location: ../inc/domain-listesi.php?q=no");
        }
    }

    if (isset($_POST['domainduzenle'])) {
        $donustur = array("http://" => "", "https://" => "", "www." => "");
        $domain = strtr(trim($_POST['domain']),$donustur);
        $update = $db->prepare("update domainler set musteri_id=?,domain=? where id='{$_POST['id']}'");
        $control = $update->execute(array($_POST['musteri'], $domain));
        if ($control) {
            header("location: ../inc/domain-listesi.php?q=ok");
        } else {
            header("location: ../inc/domain-listesi.php?q=no");
        }
    }

    if (isset($_POST['vhizmetduzenle'])) {
        $update = $db->prepare("update vhizmetler set hizmet_id=?,baslangic_tarihi=?,bitis_tarihi=?,musteri_id=? where id='{$_POST['id']}'");
        $control = $update->execute(array($_POST['hizmet'],$_POST['baslangic_tarihi'],$_POST['bitis_tarihi'], $_POST['musteri']));
        if ($control) {
            header("location: ../inc/v-hizmet-listesi.php?q=ok");
        } else {
            header("location: ../inc/v-hizmet-listesi.php?q=no");
        }
    }

    if(isset($_POST['mailsablonkaydet'])){
        $sablon = $_POST['mail_sablon'];
        $update = $db->prepare("update sablonlar set mail_sablon=? where id='0'");
        $control = $update->execute(array($sablon));
        if ($control) {
            header("location: ../inc/mail-sablonu.php?q=ok");
        } else {
            header("location: ../inc/mail-sablonu.php?q=no");
        }
    }

    if(isset($_POST['smssablonkaydet'])){
        $sablon = $_POST['sms_sablon'];
        $update = $db->prepare("update sablonlar set sms_sablon=? where id='0'");
        $control = $update->execute(array($sablon));
        if ($control) {
            header("location: ../inc/sms-sablonu.php?q=ok");
        } else {
            header("location: ../inc/sms-sablonu.php?q=no");
        }
    }


    if (isset($_POST['profilduzenle'])) {
        if ($_FILES['resim']['size'] > 0) {
            $up_directory = 'img';
            @$tmp = $_FILES['resim']["tmp_name"];
            @$name = $_FILES['resim']['name'];
            $resim = $up_directory . "/" . time() . $name;
            @move_uploaded_file($tmp, "../../$up_directory/" . time() . "$name");
            unlink("../../" . $_POST['resim_eski']);
        } else {
            $resim = $_POST['resim_eski'];
        }

        $username = filter($_POST['username']);
        $password = md5(filter($_POST['password']));

        $update = $db->prepare("update kullanici set username=?, password=?,resim=? where id='0'");
        $control = $update->execute(array($username, $password, $resim));
        if ($control) {
            header("location: ../inc/profili-duzenle.php?q=ok");
        } else {
            header("location: ../inc/profili-duzenle.php?q=no");
        }
    }

    if (isset($_POST['musteriteklismsgonder'])) {
        $page = $_POST['page'];
        $sms = $_POST['musteriteklisms'];
        $tel = $_POST['musteri_tel'];
        $smsBilgiler = $db->query("select * from sms_ayar where id='0'")->fetch();
        $baslik = $smsBilgiler['baslik'];
        $apikey = $smsBilgiler['apikey'];

        MASGSM($baslik, $sms, $tel, $apikey);


        if ($page == 'domain') {
            header("location: ../inc/domain-listesi.php?q=ok");
        } else if ($page == 'vhizmet') {
            header("location: ../inc/v-hizmet-listesi.php?q=ok");
        } else if ($page == 'musteri') {
            header("location: ../inc/musteri-listesi.php?q=ok");
        }
    }

    if (isset($_POST['musteriteklimailgonder'])) {
        $page = $_POST['page'];
        $mailBilgi = $db->query("select * from mail_ayar where id='0'")->fetch();
        $smtp = $mailBilgi['smtp'];
        $gonderen_mail = $mailBilgi['gonderen_mail'];
        $gonderen_sifre = $mailBilgi['gonderen_sifre'];
        $smtp_secure = $mailBilgi['smtp_secure'];
        $port = $mailBilgi['port'];
        $baslik = $_POST['baslik'];
        $icerik = $_POST['icerik'];
        $gidecek_mail = $_POST['mail'];
        mailGonder($smtp, $gonderen_mail, $gonderen_sifre, $smtp_secure, $port, $baslik, $gidecek_mail, $icerik);
        if ($page == 'domain') {
            header("location: ../inc/domain-listesi.php?q=ok");
        } else if ($page == 'vhizmet') {
            header("location: ../inc/v-hizmet-listesi.php?q=ok");
        } else if ($page == 'musteri') {
            header("location: ../inc/musteri-listesi.php?q=ok");
        }
    }

    if (isset($_POST['smsayarguncelle'])) {
        $baslik = $_POST['baslik'];
        $apikey = $_POST['apikey'];

        $update = $db->prepare("update sms_ayar set baslik=?,apikey=? where id='0'");
        $control = $update->execute(array($baslik, $apikey));
        if ($control) {
            header("location: ../inc/sms-ayarlari.php?q=ok");
        } else {
            header("location: ../inc/sms-ayarlari.php?q=no");
        }
    }

    if (isset($_POST['mailayarguncelle'])) {
        $smtp = $_POST['smtp'];
        $smtp_secure = $_POST['smtp_secure'];
        $gonderen_mail = $_POST['gonderen_mail'];
        $gonderen_sifre = $_POST['gonderen_sifre'];
        $port = $_POST['port'];

        $update = $db->prepare("update mail_ayar set smtp=?,gonderen_mail=?,gonderen_sifre=?,smtp_secure=?,port=? where id='0'");
        $control = $update->execute(array($smtp, $gonderen_mail, $gonderen_sifre, $smtp_secure, $port));
        if ($control) {
            header("location: ../inc/mail-ayarlari.php?q=ok");
        } else {
            header("location: ../inc/mail-ayarlari.php?q=no");
        }
    }

    if (isset($_POST['xgunduzenle'])) {
        $sms_xgun = $_POST['sms_xgun'];
        $mail_xgun = $_POST['mail_xgun'];
        $sms_g = $_POST['sms_g'];
        $mail_g = $_POST['mail_g'];

        $update = $db->prepare("update xgun set sms_xgun=?,mail_xgun=?,sms_g=?,mail_g=? where id='0'");
        $control = $update->execute(array($sms_xgun, $mail_xgun,$sms_g,$mail_g));
        if ($control) {
            header("location: ../inc/x-gun-ayarlari.php?q=ok");
        } else {
            header("location: ../inc/x-gun-ayarlari.php?q=no");
        }
    }

    if(isset($_POST['aranan'])){
        $aranan = oes(strtolower($_POST['aranan']));
        $yazacak = "<h6 class='control-label mt-5 mb-5'> Bugün düşecek $aranan ile ilgili alan domainler; </h6>";
        $yazacak = $yazacak . bugunDusecekDomainler($aranan);
        echo $yazacak;
    }
}