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
			if (isset($_POST["name"])) {
				//Если это запрос на обновление, то обновляем
				if (isset($_GET['red_id'])) {
					$sql = mysqli_query($link, "UPDATE `patient` SET `surname` = '{$_POST['surname']}',`name` = '{$_POST['name']}',`middle_name` = '{$_POST['middle_name']}', `height` = '{$_POST['height']}', `weight` = '{$_POST['weight']}', `blood` = '{$_POST['blood']}' WHERE `id_patient`={$_GET['red_id']}");
				} else {
					//Иначе вставляем данные, подставляя их в запрос
					$sql = mysqli_query($link, "INSERT INTO `patient` (`surname`, `name`, `middle_name`, `height`, `weight`, `blood`) VALUES ('{$_POST['surname']}', '{$_POST['name']}', '{$_POST['middle_name']}', '{$_POST['height']}', '{$_POST['weight']}', '{$_POST['blood']}')");
				}

				//Если вставка прошла успешно
				if ($sql) {

				} else {
					echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
				}
			}

			if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
				//удаляем строку из таблицы
				$sql = mysqli_query($link, "DELETE FROM `patient` WHERE `id_patient` = {$_GET['del_id']}");
				if ($sql) {
					echo "<p>Пациент удален.</p>";
				} else {
					echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
				}
			}

			//Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
			if (isset($_GET['red_id'])) {
				$sql = mysqli_query($link, "SELECT `id_patient`, `surname`, `name`, `middle_name`, `height`, `weight`, `blood` FROM `patient` WHERE `id_patient`={$_GET['red_id']}");
				$patient = mysqli_fetch_array($sql);
			}
		?>

    <header class="py-4 bg-primary text-white text-center">
      <img class="d-block mx-auto mb-3 rounded-circle" src="http://www.fnkc.ru/img/logo.png" width="150px">
      <h2>Редактирование записей о пациенте</h2>
    </header>
    <div class="container bg-light p-4">
    	<h4 class="mb-4">Краткая инструкция по редактированию</h4>
    	<hr class="mb-3"> 
	    <ul>
	    	<li>Значения таблицы отсортированы по ID пациента;</li>
	    	<li>Для удаления данных о пациенте:</li>
	    		<ol>
	    			<li>Обратитесь к таблице, расположенной в нижней части экрана;</li>
	    			<li>Найдите нужный ID пациента;</li>
	    			<li>Нажмите <u>Удалить</u>;</li>
	    			<li>После обновления страницы вы обнаружите, что строка удалена.</li>
	    		</ol>
	    	<li>Для редактирования данных о пациенте:</li>
	    		<ol>
	    			<li>Обратитесь к таблице, расположенной в нижней части экрана;</li>
	    			<li>Найдите нужный ID пациента;</li>
	    			<li>Нажмите <u>Изменить</u>;</li>
	    			<li>После обновления страницы вы обнаружите заполненные формы;</li>
	    			<li>Выберите нужную форму, и отредактируйте ее;</li>
	    			<li>Нажмите кнопку <u>Сохранить изменения</u>;</li>
	    			<li>После обновления страницы вы обнаружите, что строка таблицы изменена.</li>
	    		</ol>
	    	<li>Для добавления препарата пациенту:</li>
	    		<ol>
	    			<li>Обратитесь к таблице, расположенной в нижней части экрана;</li>
	    			<li>Найдите нужный ID пациента;</li>
	    			<li>Нажмите <u>Добавить препарат</u>.</li>
	    		</ol>
	    </ul>
	    <hr class="mb-3"> 
      <form action="" method="POST">          
	    	<div class="form-row">
	    		<div class="form-group col-md-4 mb-3">
	        	<label>Фамилия</label>
	        	<input type="text" class="form-control" name="surname" value="<?= isset($_GET['red_id']) ? $patient['surname'] : ''; ?>">
	      	</div>
	        <div class="form-group col-md-4 mb-3">
	          <label>Имя</label>
	          <input type="text" class="form-control" name="name" value="<?= isset($_GET['red_id']) ? $patient['name'] : ''; ?>">
	        </div>
	        <div class="form-group col-md-4 mb-3">
	          <label>Отчество</label>
	          <input type="text" class="form-control" name="middle_name" value="<?= isset($_GET['red_id']) ? $patient['middle_name'] : ''; ?>">
	        </div>
	        <div class="col-md-4 mb-3">
	          <label>Рост<span class="text-muted">(В сантиметрах)</span></label>
	          <input type="number" class="form-control" name="height" max="280" value="<?= isset($_GET['red_id']) ? $patient['height'] : ''; ?>">
	        </div>
	        <div class="col-md-4 mb-3">
	          <label>Вес<span class="text-muted">(В килограммах)</span></label>
	          <input type="number" class="form-control" name="weight" max="610" value="<?= isset($_GET['red_id']) ? $patient['weight'] : ''; ?>">
	        </div>
	        <div class="col-md-4 mb-3">
	          <label>Группа крови</label>
	          <input type="text" class="form-control" name="blood" value="<?= isset($_GET['red_id']) ? $patient['blood'] : ''; ?>">
	        </div>
	        <button class="btn btn-primary btn-lg btn-block w-50 mb-3" type="submit">Сохранить изменения</button>
          </div>
	    </form>
	 		<div class="table-responsive">
		  	<table class="table table-striped">
		  		<tr>
		  			<td>ID пациента</td>
						<td>Фамилия</td>
						<td>Имя</td>
						<td>Отчество</td>
						<td>Рост</td>
						<td>Вес</td>
						<td>Группа крови</td>
						<td>Удаление</td>
						<td>Редактирование</td>
						<td>Добавить препарат</td>
		  		</tr>
		  		<?php
						$sql = mysqli_query($link, 'SELECT `id_patient`, `surname`, `name`, `middle_name`,  `height`, `weight`, `blood` FROM `patient`');
						while ($result = mysqli_fetch_array($sql)) {
			  			echo '<tr>' .
			  			"<td>{$result['id_patient']}</td>" .
			  			"<td>{$result['surname']}</td>" .
			  			"<td>{$result['name']}</td>" .
			  			"<td>{$result['middle_name']}</td>" .
			  			"<td>{$result['height']}</td>" .
			  			"<td>{$result['weight']}</td>" .
			  			"<td>{$result['blood']}</td>" .
			  			"<td><a href='?del_id={$result['id_patient']}'>Удалить</a></td>" .
			  			"<td><a href='?red_id={$result['id_patient']}'>Изменить</a></td>" .
			  			"<td><form method='POST' action='medical2.php'><input name='id_patient1' type='submit' value='Добавить препарат'/> <input name='id_patient2' type='hidden' value='{$result['id_patient']}'/></form></td>" .
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