<?php
$host ="localhost:8889";
$db_name = "devPass";
$user = "dev";
$password= "123456";


//Получаем переменные из массива POST
if(isset($_POST['nomer']) && !empty($_POST['nomer'])) {
$nomer = $_POST['nomer'];

//Функция очистки переменных

    function clean($value="") {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }


    $nomer = clean($nomer);

            try {
                // Открываем соединение, указываем адрес сервера, имя бд, имя пользователя и пароль
                $db = new PDO("mysql:host=$host;dbname=$db_name", $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
                // Устанавливаем атрибут сообщений об ошибках (выбрасывать исключения)
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
              
            
            $statement = $db->prepare('SELECT * FROM inform WHERE nomer = ?');
            
            $statement->execute([$_POST['nomer']]);
            $result = $statement->fetch();
            
            if($result){
                $row['message'] = "Автомобилю с таким госномером уже выдан пропуск";
                echo json_encode($row['message']);
            }
            else {
                exit();
            }
          
            }
            
            catch(PDOException $e) {
                echo "Ошибка записи в базу данных: ". $e->getMessage();
            }
            
            $db = null;

}            

?>