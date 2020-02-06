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
    <header class="py-4 bg-primary text-white text-center">
      <img class="d-block mx-auto mb-3 rounded-circle" src="http://www.fnkc.ru/img/logo.png" width="150px">
      <h2>Просмотр данных</h2>
    </header>
    <div class="container bg-light p-4" style="height: 583px;">
	    </form>
	    	 		<div class="table-responsive">
		  	<table class="table table-striped">
		  		<tr>
		  			<td>ID пациента</td>
		  			<td>Фамилия</td>
		  			<td>Имя</td>
		  			<td>Отчество</td>
						<td>Препараты</td>
		  		</tr>
		  		<?php
		  			$hostname="localhost";
						$username="root"; 
						$password="";
						$db = "medical2";
						$dbh = new PDO("mysql:host=$hostname;dbname=$db", $username, $password);

						foreach($dbh->query('SELECT p.`id_patient`, p.`surname`, p.`name`, p.`middle_name`, GROUP_CONCAT(medicine) AS medicine 
						FROM patient p
						INNER JOIN medication m ON m.`id_patient` = p.`id_patient`
						GROUP BY p.`id_patient`')
						as $row) {
						echo "<tr>";
						echo "<td>" . $row['id_patient'] . "</td>";
						echo "<td>" . $row['surname'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['middle_name'] . "</td>";
						echo "<td>" . $row['medicine'] . "</td>";
						echo "</tr>"; 
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
  </body>
</html>