<!DOCTYPE html>
<html>
	<head>
		<title>Добавление в БД</title>
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
      <h2>Простая система для сбора данных осмотра пациента</h2>
    </header>
    <div class="container bg-light p-4" style="height: 583px;">
			<?php
				$id_patient = filter_input(INPUT_POST, 'id_patient');
				$surname = filter_input(INPUT_POST, 'surname');
				$name = filter_input(INPUT_POST, 'name');
				$middle_name = filter_input(INPUT_POST, 'middle_name');
				$height = filter_input(INPUT_POST, 'height');
				$weight = filter_input(INPUT_POST, 'weight');
				$blood = filter_input(INPUT_POST, 'blood');

				$host = "localhost";
				$dbusername = "root";
				$dbpassword = "";
				$dbname = "medical2";

				// Create connection
				$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
				$sql = "INSERT INTO patient (id_patient, surname, name, middle_name, height, weight, blood)
				values ('$id_patient', '$surname','$name', '$middle_name', '$height', '$weight', '$blood')";

				if ($conn->query($sql)){
					echo "Данные о пациенте добавлены в БД успешно!";
				}

				else{
					echo "Error: ". $sql ."
					". $conn->error;
				}
			?>
			<a href="medical.html" class="btn btn-primary btn-lg btn-block w-50 mt-4" type="submit">Добавить пациента</a>
			<hr class="mb-4">
			<a href="mainMenu.html" class="btn btn-secondary btn-lg btn-block w-50 mt-4" type="submit">Вернуться на главную страницу</a>
		</div>
		<footer class="bg-dark text-white text-center p-2">
      <div class="container">
        <p>Федеральное государственное бюджетное учреждение «Национальный медицинский исследовательский центр детской гематологии, онкологии и иммунологии имени Дмитрия Рогачева» Министерства здравоохранения Российской Федерации<br>© 2016 – 2020 гг. Все права защищены.</p>
      </div>
    </footer>
	</body>
</html>