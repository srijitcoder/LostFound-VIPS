<?php
$lostPhn = $_POST['lostReqPhn'];
$lostEmail = $_POST['lostReqEmail'];
$lostName = $_POST['lostReqName'];
$lostRoll = $_POST['lostReqRoll'];
$lostId = $_POST['lostReqId'];


if($lostPhn == ''){
	header('location:../index.php?error=1');
	exit();
}

include('config.php');
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $host, $password);
  $sql = "INSERT INTO request VALUES(:id, :reqId, :name, :email, :roll, :phn)";
  $query = $conn->prepare($sql);
  $query->execute(array('id' => '', 'reqId' => $lostId, 'name' => $lostName, 'email' => $lostEmail, 'roll' => $lostRoll, 'phn' => $lostPhn));


  $sqlReq = "SELECT * FROM items where id = :id";
  $queryReq = $conn->prepare($sqlReq);
  $queryReq->execute(array('id' => $lostId));

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
	There is a good news for you.
	<br>
	<b>".$lostName."</b> has founded your <b>".$item."</b>. You can contact this person
	and take your belongings. 
	<br>
	With Regards,<br>
	LostFound.
	<br><br>
	<b>Contact Detail</b><br>
	<b>Name:</b> ".$lostName."<br>
	<b>Email:</b> ".$lostEmail."<br>
	<b>Phone Number:</b> ".$lostPhn."
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
	$subject = "LostFound";
	mail($email,$subject,$mail,$headers);

  }
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
header('location:../?succ=1');
?>