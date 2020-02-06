<!doctype html>
<html lang="ru">
  <head>
    <title>Редактирование БД</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <style>
      .bg {
        background-image: url("https://www.tokkoro.com/picsup/3302572-lines-wavy-background-light.jpg");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
  </head>
  <body class="bg">
		<?php
			$host = 'localhost'; // Хост
			$user = 'root'; // Имя пользователя
			$pass = ''; // Пароль пользователю
			$db_name = 'medical2'; // Имя БД
			$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

			// Ошибка, если соединение установить не удалось
			if (!$link) {
				echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
				exit;
			}

			//Если переменная ID передана
			if (isset($_POST["medicine"])) {
				//Если это запрос на обновление, то обновляем
				if (isset($_GET['red_id'])) {
					$sql = mysqli_query($link, "UPDATE `medication` SET `medicine` = '{$_POST['medicine']}',`dose` = '{$_POST['dose']}',`start_date` = '{$_POST['start_date']}', `ending_date` = '{$_POST['ending_date']}' WHERE `id_number` = {$_GET['red_id']}");
				} else {
					//Иначе вставляем данные, подставляя их в запрос
					$sql = mysqli_query($link, "INSERT INTO `medication` (`medicine`, `dose`, `start_date`, `ending_date`) VALUES ('{$_POST['medicine']}', '{$_POST['dose']}', '{$_POST['start_date']}', '{$_POST['ending_date']}')");
				}

				//Если вставка прошла успешно
				if ($sql) {

				} else {
					echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
				}
			}

			if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
				//удаляем строку из таблицы
				$sql = mysqli_query($link, "DELETE FROM `medication` WHERE `id_number` = {$_GET['del_id']}");
				if ($sql) {
					echo "<p>Препарат удален.</p>";
				} else {
					echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
				}
			}

			//Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
			if (isset($_GET['red_id'])) {
				$sql = mysqli_query($link, "SELECT `id_number`, `id_medication`, `id_patient`, `medicine`, `dose`, `start_date`, `ending_date` FROM `medication` WHERE `id_number`={$_GET['red_id']}");
				$medication = mysqli_fetch_array($sql);
			}
		?>

    <header class="py-4 bg-primary text-white text-center">
      <img class="d-block mx-auto mb-3 rounded-circle" src="http://www.fnkc.ru/img/logo.png" width="150px">
      <h2>Редактирование записей о препарате</h2>
    </header>
    <div class="container bg-light p-4">
    	<h4 class="mb-4">Краткая инструкция по редактированию</h4>
    	<hr class="mb-3"> 
	    <ul>
	    	<li>Значения таблицы отсортированы по ID пациента;</li>
	    	<li>Для редактирования данных о препарате:</li>
	    		<ol>
	    			<li>Обратитесь к таблице, расположенной в нижней части экрана;</li>
	    			<li>Найдите нужный ID препарата;</li>
	    			<li>Нажмите <u>Изменить</u>;</li>
	    			<li>После обновления страницы вы обнаружите заполненные формы;</li>
	    			<li>Выберите нужную форму, и отредактируйте ее;</li>
	    			<li>Нажмите кнопку <u>Сохранить изменения</u>;</li>
	    			<li>После обновления страницы вы обнаружите, что строка изменена.</li>
	    		</ol>
	    		<li>Для удаления данных о препарата:</li>
	    		<ol>
	    			<li>Обратитесь к таблице, расположенной в нижней части экрана;</li>
	    			<li>Найдите нужный ID препарата;</li>
	    			<li>Нажмите <u>Удалить</u>;</li>
	    			<li>После обновления страницы вы обнаружите, что строка удалена.</li>
	    		</ol>
	    </ul>
	    <hr class="mb-3"> 
      <form action="" method="POST">          
	    	<div class="form-group mb-3">
	        <label>Название препарата</label>
	        <input type="text" class="form-control" name="medicine" value="<?= isset($_GET['red_id']) ? $medication['medicine'] : ''; ?>">
	      </div>
	      <div class="form-group mb-3">
	        <label>Доза</label>
	        <input type="text" class="form-control" name="dose" value="<?= isset($_GET['red_id']) ? $medication['dose'] : ''; ?>">
	      </div>
	      <div class="form-row">
	       	<div class="form-group col-md-6 mb-3">
	          <label>Дата начала использования</label>
	          <input type="date" class="form-control" name="start_date" value="<?= isset($_GET['red_id']) ? $medication['start_date'] : ''; ?>">
	       	</div>
	        <div  class="form-group col-md-6 mb-3">
	          <label>Дата окончания использования</label>
	          <input type="date" class="form-control" name="ending_date" value="<?= isset($_GET['red_id']) ? $medication['ending_date'] : ''; ?>">
	        </div>
	      </div>
	      <button class="btn btn-primary btn-lg btn-block w-50 mb-3" type="submit">Сохранить изменения</button>
	    </form>
	 		<div class="table-responsive">
		  	<table class="table table-striped">
		  		<tr>
		  			<td>ID препарата</td>
		  			<td>ID пациента</td>
						<td>Название препарата</td>
						<td>Доза</td>
						<td>Дата начала использования</td>
						<td>Дата окончания использования</td>
						<td>Удаление</td>
						<td>Редактирование</td>
		  		</tr>
		  		<?php
						$sql = mysqli_query($link, 'SELECT `id_number`,`id_medication`, `id_patient`, `medicine`, `dose`, `start_date`,  `ending_date` FROM `medication` ORDER BY `id_patient`');
						while ($result = mysqli_fetch_array($sql)) {
			  			echo '<tr>' .
			  			"<td>{$result['id_medication']}</td>" .
			  			"<td>{$result['id_patient']}</td>" .
			  			"<td>{$result['medicine']}</td>" .
			  			"<td>{$result['dose']}</td>" .
			  			"<td>{$result['start_date']}</td>" .
			  			"<td>{$result['ending_date']}</td>" .
			  			"<td><a href='?del_id={$result['id_number']}'>Удалить</a></td>" .
			  			"<td><a href='?red_id={$result['id_number']}'>Изменить</a></td>" .
			  			'</tr>';
						}
		  		?>
				</table>
	  	</div>
	  	<hr class="mb-4">
	  	<a href="mainMenu.html" class="btn btn-secondary btn-lg btn-block w-50">Вернуться на главную страницу</a>
		</div>
		<footer class="bg-dark text-white text-center p-2">
      <div class="container">
        <p>Федеральное государственное бюджетное учреждение «Национальный медицинский исследовательский центр детской гематологии, онкологии и иммунологии имени Дмитрия Рогачева» Министерства здравоохранения Российской Федерации<br>© 2016 – 2020 гг. Все права защищены.</p>
      </div>
    </footer>
    <script>(function() {'use strict'; window.addEventListener('load', function() { var forms = document.getElementsByClassName('needs-validation'); var validation = Array.prototype.filter.call(forms, function(form) { form.addEventListener('submit', function(event) { if (form.checkValidity() === false) { event.preventDefault(); event.stopPropagation(); } form.classList.add('was-validated'); }, false); }); }, false); })();</script>
  </body>
</html>