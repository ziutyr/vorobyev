<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Задание</title>
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
      $id_patient = $_POST['id_patient2'];
      echo $id_patient;
    ?>
    <header class="py-4 bg-primary text-white text-center">
      <img class="d-block mx-auto mb-3 rounded-circle" src="http://www.fnkc.ru/img/logo.png" width="150px">
      <h2>Простая система для сбора данных осмотра пациента</h2>
    </header>
    <div class="container bg-light p-4">
      <h4 class="mb-4">Данные препарата</h4>
      <form method="POST" action="methodPost2.php" class="needs-validation" novalidate>
        <div class="form-group mb-3">
          <label>ID препарата</label>
          <input type="number" name="id_medication" class="form-control" required>
          <div class="invalid-feedback">Требуется ввести ID препарата</div>
        </div>
        <div class="form-group mb-3">
          <label>ID пациента</label>
          <input type="number" name="id_patient" class="form-control" value="<?php echo $id_patient; ?>" required readonly>
        </div>
        <div class="form-group mb-3">
          <label>Название препарата</label>
          <input type="text" name="medicine" class="form-control" required>
          <div class="invalid-feedback">Требуется ввести название препарата</div>
        </div>
        <div class="form-group mb-3">
          <label>Доза</label>
          <input type="text" name="dose" class="form-control" required>
          <div class="invalid-feedback">Требуется ввести дозу</div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6 mb-3">
            <label>Дата начала использования</label>
            <input type="date" name="start_date" class="form-control" required>
            <div class="invalid-feedback">Требуется ввести дату</div>
          </div>
          <div class="form-group col-md-6 mb-3">
            <label>Дата окончания использования</label>
            <input type="date" name="ending_date" class="form-control" required>
            <div class="invalid-feedback">Требуется ввести дату</div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block w-50 mb-4" type="submit">Сохранить данные</button>
        <hr class="mb-4">
        <a href="methodGet.php" class="btn btn-secondary btn-lg btn-block w-50" type="submit">Вернуться на предыдущую страницу</a>
        <hr class="mb-4">
        <a href="mainMenu.html" class="btn btn-secondary btn-lg btn-block w-50" type="submit">Вернуться на главную страницу</a>
      </form>
    </div>
    <footer class="bg-dark text-white text-center p-2">
      <div class="container">
        <p>Федеральное государственное бюджетное учреждение «Национальный медицинский исследовательский центр детской гематологии, онкологии и иммунологии имени Дмитрия Рогачева» Министерства здравоохранения Российской Федерации<br>© 2016 – 2020 гг. Все права защищены.</p>
      </div>
    </footer>
    <script>(function() {'use strict'; window.addEventListener('load', function() { var forms = document.getElementsByClassName('needs-validation'); var validation = Array.prototype.filter.call(forms, function(form) { form.addEventListener('submit', function(event) { if (form.checkValidity() === false) { event.preventDefault(); event.stopPropagation(); } form.classList.add('was-validated'); }, false); }); }, false); })();</script>
  </body>
</html>