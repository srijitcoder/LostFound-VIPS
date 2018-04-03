<?php
$foundPhn = $_POST['foundReqPhn'];
$foundEmail = $_POST['foundReqEmail'];
$foundName = $_POST['foundReqName'];
$foundRoll = $_POST['foundReqRoll'];
$foundId = $_POST['foundReqId'];


if($foundPhn == ''){
	header('location:../index.php?error=1');
	exit();
}

include('config.php');
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $host, $password);
  $sql = "INSERT INTO request VALUES(:id, :reqId, :name, :email, :roll, :phn)";
  $query = $conn->prepare($sql);
  $query->execute(array('id' => '', 'reqId' => $foundId, 'name' => $foundName, 'email' => $foundEmail, 'roll' => $foundRoll, 'phn' => $foundPhn));


  $sqlReq = "SELECT * FROM items where id = :id";
  $queryReq = $conn->prepare($sqlReq);
  $queryReq->execute(array('id' => $foundId));

  foreach ($queryReq as $key) {
  	$email = $key['stdEmail'];
  	$name = $key['stdName'];
  	$phone = $key['stdPhone'];
  	$item = $key['item'];

  	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  	$mail = "
	Hi ".$name.",
	<br>
	<b>".$foundName."</b> is saying that the, <b>".$item."</b> is belongs to him/her. You can contact this person
	and return his/her belongings. 
	<br>
	With Regards,<br>
	LostFound.
	<br><br>
	<b>Contact Detail</b><br>
	<b>Name:</b> ".$foundName."<br>
	<b>Email:</b> ".$foundEmail."<br>
	<b>Phone Number:</b> ".$foundPhn."
	  	";
	$subject = "LostFound";
	mail($email,$subject,$mail,$headers);

	$mailReq = "
	Hi ".$stdName.",
	<br>
	<b>Contact Detail</b><br>
	<b>Name:</b> ".$name."<br>
	<b>Email:</b> ".$email."<br>
	<b>Phone Number:</b> ".$phone."
	  	";
	$subject = "foundFound";
	mail($email,$subject,$mail,$headers);

  }
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
header('location:../?succ=1');
?>