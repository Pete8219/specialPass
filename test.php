<?php

require("./service/dbconn.php");

$nomer = $_REQUEST['nomer'];

$sql = "SELECT * FROM inform WHERE nomer='$nomer' LIMIT 1";

$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
 <title>Поиск номера по базе</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<style>
		@media only screen and (max-device-width: 560px) { 
		
		}

		// Medium devices (tablets, 768px and up)
		@media (max-width: 768px) { 
		
		}
		
		// Large devices (desktops, 992px and up)
		@media (max-width: 992px) { 
			
			div.container {width:992px};
		}
		
		// Extra large devices (large desktops, 1200px and up)
		@media (min-width: 1200px) {
			div.container {width:1200px};
			
		}
	</style>
	
	
  <div class="container" style="padding-top:40px;">
 <form method="post" action="">
	<p style="text-align:centre;">Введите госномер автомобиля. Пример: A001AA89</p>	
  <input class="form-control" name="nomer" type="text" placeholder="Госномер автомобиля"/><br>
  
   <input type="submit" value="Найти номер" style="margin-bottom:3em;"/>
 </form>
  </div>
  
 <table class="table" border="1" cellpadding="10px" width="95%" align="center" margin-bottom="2em" margin-top="3em">
 		<tr>
			<th>Организация</th>
			<th>Адрес</th>
			<th>ФИО руководителя</th>
			<th>Телефон</th>
			<th>Email</th>
			<th>Номер авто</th>
			<th>ИНН</th>
			<th>Вид деятельности</th>
			<th>ОКВЭД</th>
		</tr> 
	
		<?php while ($row = mysqli_fetch_array($result)) {?>
		
	
		<tr>
			<td><?php echo $row['org'];?></td>
			<td><?php echo $row['address'];?></td>
			<td><?php echo $row['ruk'];?></td>
			<td><?php echo $row['phone'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php echo $row['nomer'];?></td>
			<td><?php echo $row['inn'];?></td>
			<td><?php echo $row['transcript'];?></td>
			<td><?php echo $row['kod'];?></td>
		</tr>
			
		 <?php 
		}?> 
 </table> 
  
  
</body>
</html>

 