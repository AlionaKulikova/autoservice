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
$mail->Subject = 'Поступил новый заказ';

//рука
/*Send = "Белый";
if($_POST['hand'] == "left"){
	$hand = "белый";

}*/
//тело письма
//заголовок нашего письма
$body = '<h1>Заказ запчастей</h1>';

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

if(trim(!empty($_POST['vinavto']))){
	$body.='<p><strong>VIN автомобиля:</strong> '.$_POST['vinavto'].'</p>';

}

if(trim(!empty($_POST['mmasl']))){
	$body.='<p><strong>Моторное масло:</strong> '.$_POST['mmasl'].'</p>';

}

if(trim(!empty($_POST['tmasl']))){
	$body.='<p><strong>Трансмиссионное масло:</strong> '.$_POST['tmasl'].'</p>';

}

if(trim(!empty($_POST['fmasl']))){
	$body.='<p><strong>Фильтр маслянный:</strong> '.$_POST['fmasl'].'</p>';

}

if(trim(!empty($_POST['fvozd']))){
	$body.='<p><strong>Фильтр воздушный:</strong> '.$_POST['fvozd'].'</p>';

}

if(trim(!empty($_POST['fsal']))){
	$body.='<p><strong>Фильтр салонный:</strong> '.$_POST['fsal'].'</p>';

}

if(trim(!empty($_POST['ftop']))){
	$body.='<p><strong>Фильтр топливный:</strong> '.$_POST['ftop'].'</p>';

}

if(trim(!empty($_POST['szazh']))){
	$body.='<p><strong>Свечи зажигания:</strong> '.$_POST['szazh'].'</p>';

}

if(trim(!empty($_POST['ktormp']))){
	$body.='<p><strong>Колодки тормозные передние:</strong> '.$_POST['ktormp'].'</p>';

}

if(trim(!empty($_POST['ktormz']))){
	$body.='<p><strong>Колодки тормозные задние:</strong> '.$_POST['ktormz'].'</p>';

}


/*
if(trim(!empty($_POST['hand']))){
	$body.='<p><strong>Цвет:</strong> '.$_POST['hand'].'</p>';

}
*//*
if(trim(!empty($_POST['age']))){
	$body.='<p><strong>Марка:</strong> '.$_POST['age'].'</p>';

}
*/

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