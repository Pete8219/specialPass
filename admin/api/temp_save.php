<?php
$host ="localhost:8889";
$db_name = "devPass";
$user = "dev";
$password= "123456";


try {
    // Открываем соединение, указываем адрес сервера, имя бд, имя пользователя и пароль
    $db = new PDO("mysql:host=$host;dbname=$db_name", $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    // Устанавливаем атрибут сообщений об ошибках (выбрасывать исключения)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $org = $_POST['org'];
    $address = $_POST['address'];
    $inn = $_POST['inn'];
    $kod = $_POST['kod'];
    $transcript = $_POST['desc'];
    $ruk = $_POST['ruk'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $marka = $_POST['marka'];
    $nomer = $_POST['nomer'];
    $status = 'на рассмотрении';

$statement = $db->prepare('SELECT * FROM inform WHERE nomer = ?');

$statement->execute([$_POST['nomer']]);
$result = $statement->fetch();

if($result){
    $row['message'] = "Автомобилю с таким госномером уже выдан пропуск";
    echo json_encode($row['message']);
}


else {
    

      //создаем ассоциативный массив для подстановки в запрос
    $data = array (
        'org' => $org,
        'address' => $address,
        'inn' => $inn,
        'kod' => $kod,
        'transcript' => $transcript,
        'ruk' => $ruk,
        'phone' => $phone,
        'email' => $email,
        'marka' => $marka,
        'nomer' => $nomer,
        'status' => $status,
    );

    //Запрос на создание записи в таблице

    $query = "INSERT INTO inform (org,address,inn,kod,transcript,ruk,phone,email,marka,nomer,status)".
    " VALUES (:org,:address,:inn,:kod,:transcript,:ruk,:phone,:email,:marka,:nomer,:status)";
    $stmt = $db-> prepare($query);
    //выполение запроса
    $res = $stmt->execute($data);

    $message = "Заявка отправлена. После рассмотрения заявки на Ваш электронный адрес будет выслано уведомление";

    echo json_encode($message);
 
}
}

catch(PDOException $e) {
    echo "Ошибка записи в базу данных: ". $e->getMessage();
}

$db = null;

?>