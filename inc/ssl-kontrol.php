
<?php
include '../set/connect.php';
include 'sessions.php';


$domainler = $db->prepare("select * from domainler order by id desc");
$domainler->execute();
while($domain = $domainler->fetch(PDO::FETCH_BOTH)){
	$id = $domain['id'];
	$kontrol = sslKontrol($domain['domain']);
	if($kontrol == 1){
		$kontrol = "on";
	} else {
		$kontrol = "off";
	}
	$update = $db->prepare("UPDATE domainler set
		durum=?
		where id='$id'
		");
	$control = $update->execute(array(
		$kontrol
	));
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mesaj = "<u><h1>SSL BİTEN DOMAİNLER LİSTESİ</h1></u><br><br><div style='max-width: 250px;'>";

$bitenler = $db->prepare("select * from domainler where durum='off'");
$bitenler->execute();
while($biten = $bitenler->fetch(PDO::FETCH_BOTH)){

	$mesaj = $mesaj . "<b>Domain adı:</b> " . $biten['domain'] . "<br>" . "<b>Firma adı: </b>" . $biten['firma_adi'] . "<hr>";

}

$mesaj = $mesaj . "</div>";

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {  

    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mertdenemehesap@gmail.com';                 // SMTP username
    $mail->Password = 'BUyuk258';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->Charset = "UTF-8";
    //Recipients
    $mail->setFrom('mertkilic0111@gmail.com','SSL Biten Domainler Listesi');
    $mail->addAddress('mertkilic0111@gmail.com');     // Add a recipient
    $mail->addReplyTo('mertkilic0111@gmail.com');
    
    //Content
    $mail->isHTML(true);                                  //mesaj baslıgı
    $mail->Subject = 'SSL Biten Domainler';  
    $mail->Body    = nl2br($mesaj);   // mesaj acıklaması
    

    $mail->send();
    echo 'mesaj gonderildi';
}	catch (Exception $e) {
	echo 'mesaj hatası';
}
?>