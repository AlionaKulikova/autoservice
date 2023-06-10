<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);
//от кого письмо
// Настройки вашей почты
    $mail->Host       = 'da1.d.fozzy.com'; // SMTP сервера вашей почты
    $mail->Username   = 'postmaster@avtonovovoronezh.ru'; // Логин на почте
    $mail->Password   = 'dgg$53!jkF47'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = '465';
    $mail->setFrom('postmaster@avtonovovoronezh.ru', 'Настя'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('kulikovaaliona@mail.ru');  
      $mail->addAddress('anastasiia.kharina@mail.ru');
//тема письма
$mail->Subject = 'Поступил новый заказ!';

//рука
/*Send = "Белый";
if($_POST['hand'] == "left"){
	$hand = "белый";

}*/
//тело письма
//заголовок нашего письма
$body = '<h1>Заказ шин</h1>';

/*еще раз проверяем нашу форму на ошибки с помощью уже php*/
if(trim(!empty($_POST['name']))){
	$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';

}


if(trim(!empty($_POST['telephone']))){
	$body.='<p><strong>Телефон:</strong> '.$_POST['telephone'].'</p>';

}
if(trim(!empty($_POST['email']))){
	$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';

}



if(trim(!empty($_POST['letnie']))){
	$body.='<p><strong>Летние:</strong> '.$_POST['letnie'].'</p>';

}

if(trim(!empty($_POST['zimnie']))){
	$body.='<p><strong>Зимние:</strong> '.$_POST['zimnie'].'</p>';

}

if(trim(!empty($_POST['zimaleto']))){
	$body.='<p><strong>Всесезонные:</strong> '.$_POST['zimaleto'].'</p>';

}







if(trim(!empty($_POST['yesShipi']))){
	$body.='<p><strong>С шипами:</strong> '.$_POST['yesShipi'].'</p>';

}

if(trim(!empty($_POST['noShipi']))){
	$body.='<p><strong>Без шипов:</strong> '.$_POST['noShipi'].'</p>';

}






/*
if(trim(!empty($_POST['hand']))){
	$body.='<p><strong>Цвет:</strong> '.$_POST['hand'].'</p>';

}
*/
if(trim(!empty($_POST['proizvoditel']))){
	$body.='<p><strong>Производитель:</strong> '.$_POST['proizvoditel'].'</p>';

}



if(trim(!empty($_POST['Shirina']))){
	$body.='<p><strong>Ширина:</strong> '.$_POST['Shirina'].'</p>';

}



if(trim(!empty($_POST['Profil']))){
	$body.='<p><strong>Профиль:</strong> '.$_POST['Profil'].'</p>';

}


if(trim(!empty($_POST['diametr']))){
	$body.='<p><strong>Диаметр:</strong> '.$_POST['diametr'].'</p>';

}




if(trim(!empty($_POST['message']))){
	$body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';

}

//прикрепить файл

if (!empty($_FILES['image']['tmp_name'])) {
	//путь загруски файл
	$filePath = __DIR__ . "/files/" .$_FILES['image']['name'];
	//грузим файл

	if (copy($_FILES['image']['tmp_name'], $filePath)){
		$fileAttach = $filePath;
		$body.='<p><strong>Фото в приложении</strong>';
		$mail->addAttachment($fileAttach);
	}

}


$mail->Body = $body;
//отпраляем
if (!$mail->send()) {
	$message = 'ошибка в php';
} else {
	$message = 'Данные отправлены!';
}

$response = ['message' => $message];
header('Content-type: application/json');
echo json_encode($response);
?>