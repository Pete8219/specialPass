<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="scripts/pdfmake.min.js"></script>
    <script src="scripts/vfs_fonts.js"></script>
    <title>Document</title>
</head>
<body>
<style>
.inn {
    width:30%;
    margin:0 auto;
    margin-top:3em;
}

.inn-label {
    align-items:;
    margin:0 auto;
}

.zapros {
    display:block; 
    margin:0 auto;
    margin-top: 2em;

}

ul.hotphone {
    color:#da7777;
    font-style:bold;
    float:right;

}

button.zapros {
    margin-bottom; 2em;
}

.field {
    margin-bottom:2em;
}

.addInfoForm {
    width:50%;
    margin:0 auto;
    margin-top:3em;
}

.errInfo {
    width:50%;
    margin:0 auto;
    margin-top: 3em;
}
</style>

<!-- Вывод модального окна с информацией -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Сообщение</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="closeModal btn btn-primary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="./index.php" style="margin-right:2em;">
                <img src="images/89.png" width="30" height="30" alt="" style="margin-right:1em;">Администрация города Салехарда
            </a>
            <ul class="navbar-nav hotphone">
                <li>Телефон горячей линии: 8-800-222-333-111</li>
            </ul>

		</nav>
    <div class="container" style="margin-top:1em;">

    <p style="text-align:justify;">В связи с распространением новой коронавирусной инфекции (COVID-19) Юридическим лицам и ИП необходимо получить специальный пропуск для осуществления своей 
трудовой деятельности на территории МО г.Салехард.</p>

<p style="text-align:justify;">Пропуск могут получить только те Юридические лица и ИП на которых распространяется:<a href="http://publication.pravo.gov.ru/Document/Text/0001202004020025"> Указ Президента Российской Федерации 
от 02 апреля 2020 года № 239 </a> "О мерах по обеспечению санитарно-эпидемиологического благополучия населения на территории
Российской Федерации", а так же Согласно <a href="https://www.yanao.ru/documents/rla/67502/">постановлению Правительства Ямало-Ненецкого автономного округа от 05 апреля 2020
года № 386-П</a> утвержден перечень иных организаций, на которые не распространяется Указ Президента Российской Федерации
от 05 апреля 2020 года № 452-П</p>


<div class="alert alert-danger" role="alert">
  Форма работает с тестовом режиме.
</div>

        <form action="" method="POST">
            <div class="inn form-group">
            <!-- <label class="inn-label">Введите Ваш ИНН</label> -->
            <input class="form-control inn-value" type = "text" name="inn" placeholder="Введите Ваш ИНН">
            <button class="btn btn-success zapros" style="margin-bottom:3em;" type="submit">Запрос пропуска</button>
            </div>
            
        </form>


        <form name="additionalInfo" class="additionalInfo" action="" method="POST">
        
            <div class="addInfoForm form-group" style="display:none;">
           <div class="alert alert-success"> Ваш основной вид деятельности входит в список разрешенных.</div>
        <p>Для выдачи пропуска нам нужно еще немного информации о Вас
        </p>
            <!-- <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com"> -->

            <label>Адрес электронной почты*</label>
            <input class="mail form-control field" type="email" name="email" placeholder= "mymail@mydomain.com" required>
            <label>Марка автомобиля</label>
            <input class="marka form-control field" type="text" name="marka"  required>
            <label>Госномер автомобиля</label>
            <input class="nomer form-control field" type="text" name="nomer" placeholder= "С001АВ89" required>
            <button type="submit" class="btn btn-success get-propusk" style="margin-bottom:3em">Получить пропуск</button> 
            </div>
            
        </form>

        <form name="errInfoForm" class="errInfoForm" action="" method="POST">
        
        <div class="errInfo form-group" style="display:none;">
       <div class="alert alert-warning"> Ваш основной вид деятельности  не входит в список разрешенных.</div>
    <p>Пожалуйста заполните форму, чтобы ваш запрос был рассмотрен комиссией
    </p>
        <!-- <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com"> -->

        <label>Адрес электронной почты*</label>
        <input class="mail form-control field" type="email" name="email" placeholder= "mymail@mydomain.com" required>
        <label>Марка автомобиля</label>
        <input class="marka form-control field" type="text" name="marka"  required>
        <label>Госномер автомобиля</label>
        <input class="nomer form-control field" type="text" name="nomer" placeholder= "С001АВ89" required>
        <label>Комментарий</label>
        <textarea class="comment form-control"  name="comment"  rows= "3" placeholder="Укажите цель посещения города Салехарда"></textarea>
        <button type="submit" class="btn btn-success ifErr" style="margin-top: 1em;margin-bottom:3em">Отправить на рассмотрение</button> 
        </div>
        
    </form>





    </div>

<script src="scripts/zapros.js" type="module"></script>    
</body>
</html>