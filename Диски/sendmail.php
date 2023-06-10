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
$body = '<h1>Заказ дисков</h1>';

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



if(trim(!empty($_POST['marka']))){
	$body.='<p><strong>Марка:</strong> '.$_POST['marka'].'</p>';

}






if(trim(!empty($_POST['dvigatel']))){
	$body.='<p><strong>Тип двигателя:</strong> '.$_POST['dvigatel'].'</p>';

}

if(trim(!empty($_POST['Vdvigatel']))){
	$body.='<p><strong>Объем двигателя:</strong> '.$_POST['Vdvigatel'].'</p>';

}

if(trim(!empty($_POST['gotvipuska']))){
	$body.='<p><strong>Год выпуска:</strong> '.$_POST['gotvipuska'].'</p>';

}







if(trim(!empty($_POST['diametrdiskov']))){
	$body.='<p><strong>Диаметр дисков:</strong> '.$_POST['diametrdiskov'].'</p>';

}

if(trim(!empty($_POST['tipdiskov']))){
	$body.='<p><strong>Тип дисков:</strong> '.$_POST['tipdiskov'].'</p>';

}






/*
if(trim(!empty($_POST['hand']))){
	$body.='<p><strong>Цвет:</strong> '.$_POST['hand'].'</p>';

}
*/
if(trim(!empty($_POST['proizvoditel']))){
	$body.='<p><strong>Производитель:</strong> '.$_POST['proizvoditel'].'</p>';

}



if(trim(!empty($_POST['color']))){
	$body.='<p><strong>Цвет:</strong> '.$_POST['color'].'</p>';

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