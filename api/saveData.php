<?php
$host ="localhost:8889";
$db_name = "devPass";
$user = "dev";
$password= "123456";


//Получаем переменные из массива POST

$org = $_POST['name'];
$address = $_POST['address'];
$inn = $_POST['inn'];
$kod = $_POST['okved'];
$transcript = $_POST['primaryActivity'];
$ruk = $_POST['manadgement'];
/* $phone = $_POST['phone']; */
$email = $_POST['email'];
$marka = $_POST['marka'];
$nomer = $_POST['nomer'];
$status = $_POST['status'];
$comment = $_POST['comment'];
$keygen = $_POST['keygen'];



//Функция очистки переменных

function clean($value="") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}



    $org = clean($org);
    $address = clean($address);
    $inn = clean($inn);
    $kod = clean($kod);
    $transcript = clean($transcript);
    $ruk = clean($ruk);
    $email = clean($email);
    $marka = clean($marka);
    $nomer = clean($nomer);
    $keygen = clean($keygen);
    $status = clean($status);
    $comment = clean($comment);

    




            try {
                // Открываем соединение, указываем адрес сервера, имя бд, имя пользователя и пароль
                $db = new PDO("mysql:host=$host;dbname=$db_name", $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
                // Устанавливаем атрибут сообщений об ошибках (выбрасывать исключения)
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
              
/*             
            $statement = $db->prepare('SELECT * FROM inform WHERE nomer = ?');
            
            $statement->execute([$_POST['nomer']]);
            $result = $statement->fetch();
            
            if($result){
                $row['message'] = "Автомобилю с таким госномером уже выдан пропуск";
                echo json_encode($row['message']);
            } */
            
            
           /*  else { */
                
            
                  //создаем ассоциативный массив для подстановки в запрос
                $data = array (
                    'org' => $org,
                    'address' => $address,
                    'inn' => $inn,
                    'kod' => $kod,
                    'transcript' => $transcript,
                    'ruk' => $ruk,
                    'email' => $email,
                    'marka' => $marka,
                    'nomer' => $nomer,
                    'status' => $status,
                    'keygen' => $keygen,
                    'comment' => $comment

                );
            
                //Запрос на создание записи в таблице
            
                $query = "INSERT INTO inform (org,address,inn,kod,transcript,ruk,email,marka,nomer,status,keygen,comment)".
                " VALUES (:org,:address,:inn,:kod,:transcript,:ruk,:email,:marka,:nomer,:status,:keygen,:comment)";
                $stmt = $db-> prepare($query);
                //выполение запроса
                $res = $stmt->execute($data);

                $statement = $db->prepare('SELECT id FROM inform WHERE nomer = ?');
            
                $statement->execute([$_POST['nomer']]);
                $result = $statement->fetch();
                
               
                    echo json_encode($result);
                
            
/*                 $message["text"] = "Заявка отправлена. После рассмотрения заявки на Ваш электронный адрес будет выслано уведомление";
            
                echo json_encode($message["text"]); */
             
            }
            
            
            catch(PDOException $e) {
                echo "Ошибка записи в базу данных: ". $e->getMessage();
            }
            
            $db = null;



        

 

?>