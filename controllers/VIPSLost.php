<?php
$lostItem = $_POST['lostItem'];
$lostSeen = $_POST['lostSeen'];
$lostPhn = $_POST['lostPhn'];
$lostDesc = $_POST['lostDesc'];
$lostEmail = $_POST['lostEmail'];
$lostName = $_POST['lostName'];
$lostRoll = $_POST['lostRoll'];
$lostX = $_POST['lostX'];
$lostY = $_POST['lostY'];

//validation
if($lostItem == '' || $lostSeen == '' || $lostDesc == '' || $lostPhn == ''){
	header('location:../index.php?error=1');
	exit();
}

//photo upload check
$allowed = array('png', 'jpg', 'jpeg');

if(isset($_FILES['lostImg']) && $_FILES['lostImg']['error'] == 0){

	$extension = pathinfo($_FILES['lostImg']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		header('location:../index.php?error=2');
		exit();
	}
	$date = date("Y_m_d_h_i_sa");
	if(move_uploaded_file($_FILES['lostImg']['tmp_name'], 'uploads/'.$date.'_'.$_FILES['lostImg']['name'])){
		global $lostImg;
		$lostImg = 'controllers/uploads/'.$date.'_'.$_FILES['lostImg']['name'];
	}
}
else {
	$lostImg="";
}

include('config.php');
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $host, $password);
  $sql = "INSERT INTO items VALUES(:id, :x, :y, :item, :des, :tim, :item_type, :link, :img, :name, :email, :roll, :phn)";
  $query = $conn->prepare($sql);

  $query->execute(array('id' => '', 'x' => $lostX, 'y' => $lostY, 'item' => $lostItem, 'des' => $lostDesc, 'tim' => $lostSeen, 'item_type' => 'lost', 'link' => '#', 'img' => $lostImg, 'name' => $lostName, 'email' => $lostEmail, 'roll' => $lostRoll, 'phn' => $lostPhn));
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
header('location:../');
?>