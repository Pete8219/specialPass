<?php
$host ="localhost:8889";
$db = "devPass";
$table = "inform";
$user = "dev";
$password= "123456";


$id = $_POST['id'];
    //Запрос на создание записи в таблице

    $conn = mysqli_connect($host, $user, $password, $db);
    if(!$conn) {
        echo "Ошибка соединения с базой данных". PHP_EOL;
    } 
    
        if(isset($_POST['id'])&&(!empty($_POST['id']))) {
            
            /* $result['id'] = $id; */
     
            $query = "SELECT keygen, email FROM inform WHERE id=$id";
            $result = mysqli_query($conn, $query); 
    
            
            $jsonData = array();
    
            while($row = $result->fetch_assoc()) {
                $jsonData[] = $row;
                
            }
    
            echo json_encode($jsonData);
            foreach ($jsonData as $jsonData => $value) {
                
                $keygen = $value['keygen'];
                $email = $value['email'];
            }
            
   
            
            $result->close();
            mysqli_close($conn);
        }

$to = $email;


$subject = "Спецпропуск для проезда в Салехард";

$message = ' <p>Для получения пропуска пройдите по ссылке<p><a href=http://localhost/specialPass/admin/index.php?keygen='.$keygen.'>Пропуск для авто</a>';

$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers .= "From:<psavrasov@gmail.com>\r\n"; 
 

mail($to, $subject, $message, $headers);
    







?>