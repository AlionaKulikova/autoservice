

"use strict"/*добавлен строгий режим*/
/*проверяем загружен ли документ*/
document.addEventListener('DOMContentLoaded', function () {
	/*перехват отправки формы при нажатии кнопки и взять все в свои руки*/
	/*для этого объявляем переменную form куда присваеваем весь объект form 
	по идентификатору #form*/
	const form = document.getElementById('form');
	/*добавляем события на эту переменную т.е при отправки формы мы должны 
	вызвать функцию formSend()*/
	form.addEventListener('submit', formSend);

	/*пишем эту функию formSend()*/
	async function formSend(e) {
		// body...
		//запрещаем стандартную отправку формы
		e.preventDefault();
		//Валидация формы т.е проверка правильно запоненных полей
/*объявляем переменную error которой присваеваем результат работы функции
 formValidate, и в ту функцию передаем значение самого form*/

		let error = formValidate(form);

		/*для отправки формы*/
		/*строка с ее помощью вытягиваем все данные полей*/
		let formData = new FormData(form);
		//с помощью этой строки добавляем в переменную формдата еще и изображение,полученное при обработки ниже

		formData.append('image', formImage.files[0]);

/**делаем проверку*/
if (error === 0) {// то все отличтно можем отправлять
	//делаем это с помощью технологиии Ajax
	form.classList.add('_sending');
	/*объявляем переменную response и в нее ждем выполнение отправки методом POST данных formData которые мы вытянули в файл Sendmail.php*/
	let response = await fetch('sendmail.php', {
		
		method:'POST',
		body: formData
	});
	/*теперь нам нужно получить ответ успешна ли наша отправка или нет*/
	if (response.ok) {//если да
		let result = await response.json();
		//ответ пользователю
		alert(result.message);
		//чистим после отправки все поля формы и излбражения
		formPreview.innerHTML = '';
		form.reset();
		form.classList.remove('_sending');
//если нет
	} else {
		alert('Ошибка. не отправлен');
		form.classList.remove('_sending');
	}
//если нет мы выводим сообщение об ошибке
}else{
	alert('Заполните обязательные поля');
}


	}
	/*Создаем функцию form validate*/
	function formValidate(form) {
		/*для этой функции создаем свою переменную и изначльно присваеваем ей 0*/
		let error = 0;
/*создаем переменную,  и присваеваем ей все элементы с класссом req, т.е. те поля
, которые необходимо проверить на ошибки*/
//класс req нужно добавить ко всем элементам в html которые 
//необходимо проверить, после это эти оюъекты ,у нас их три , поступят в переменную
		let formReq = document.querySelectorAll('._req');
		/*Создаем цикл*/
		/* В нем будем прогручивать эти выбранные 3 элемента*/

		for (let index = 0; index < formReq.length; index++) {
			const input = formReq[index];
			/*чтобы начать проверку мы должны сначала убрать у объекта класс error*/
			formRemoveError(input);
/*теперь мы можем начать проверку*/
/*начнем проверку с email*/
/*привяжемся к классу e-mail, т.к. проверка emaila отличается от других проверок
 не забудем его добавить в html к элемету mail*/
			if (input.classList.contains('_email')){

				if (emailTest(input)){
					//если тест не пройден мы будем деать следующее
					//этому объекту будем добавлятькласс error и его родителю тоже
					formAddError(input);
					error++;//увеличиваем на 1 нашу начальную переменную, равную изначально 0

				}
				/*будем проверять наличие ch
					eckboxaт.е. если input checkbox, то будем делать для него проверки*/
					/*проверяем на тип , если это check box   и этот checkbox не включен*/
				} else if (input.getAttribute("type") === "checkbox" && input.checked === false) {
					//вешаем на него и на его родителя класс error
                formAddError(input);
					//и увеличиваем переменную на 1
					error++;

				} else {
					//проверяем заполненно ли поле вообще
					//если пустая строка , то опять же вешаем класс error и  +1
					if (input.value === '') {
						formAddError(input);
						error++;
					}
				}

			}
			/**из функции Validate мы должны вернуть значение*/
			 return error;//оно будет либо 0 либо нет
		}
	
 
/*создаем две вспомогательные функции*/
/*эта функция добавляет самому об
ъекту класс _error и родительскому объекту добавл. класс error*/
	function formAddError(input) {
		input.parentElement.classList.add('_error');
		input.classList.add('_error');
	}
//эта функция удаляет класс _error
/*удаляет этот  класс у родителя и у самого элемента*/
	function formRemoveError(input) {
		input.parentElement.classList.remove('_error');
		input.classList.remove('_error');
	}

	/*функция прверки e-mail*/

function emailTest(input) {
	return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
}
/*работа с вставленным изображенеим + мы ее можем видеть в мелком размере превью*/

/*добавляем переменную в нее получаем возможность видеть изображения самого файла*/
//получам инпут file  в переменную
const formImage = document.getElementById('formImage');
//получаем див для превью в переменную
const formPreview = document.getElementById('formPreview');
//слушаем изменения в инпуте file
formImage.addEventListener('change', () => {
	//будем передавать в функци выбранный файл только 1
	uploadFile(formImage.files[0]);
}
);

/*создаем эту функцию*/
function uploadFile(file) {
	//проверяем тип данного файл 
	if (!['image/jpeg','image/png', 'image/gif'].includes(file.type)) {
		alert('Разрешены только изображения.');
		formImage.value = '';
		return;
	}
	//проверим размер файла менее 2мб.
	if (file.size > 2 * 1024 * 1024) {
		alert('Файл должен быть менее 2 МБ.');
		return;
	}

	var reader = new FileReader();

	reader.onload = function (e) {
    formPreview.innerHTML = `<img src = "${e.target.result}"  alt="Фото">`;
	};

	reader.onerror = function (e) {
		alert('Ошибка');
	};

	reader.readAsDataURL(file);

}
});
