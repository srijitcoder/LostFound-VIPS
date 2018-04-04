<?php
$foundItem = $_POST['foundItem'];
$foundSeen = $_POST['foundSeen'];
$foundPhn = $_POST['foundPhn'];
$foundDesc = $_POST['foundDesc'];
$foundEmail = $_POST['foundEmail'];
$foundName = $_POST['foundName'];
$foundRoll = $_POST['foundRoll'];
$foundX = $_POST['foundX'];
$foundY = $_POST['foundY'];

//validation
if($foundItem == '' || $foundSeen == '' || $foundDesc == '' || $foundPhn == ''){
	header('location:../index.php?error=1');
	exit();
}

//photo upload check
$allowed = array('png', 'jpg', 'jpeg');

if(isset($_FILES['foundImg']) && $_FILES['foundImg']['error'] == 0){
	$extension = pathinfo($_FILES['foundImg']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		header('location:../index.php?error=2');
		exit();
	}
	$date = date("Y_m_d_h_i_sa");
	if(move_uploaded_file($_FILES['foundImg']['tmp_name'], 'uploads/'.$date.'_'.$_FILES['foundImg']['name'])){
		global $foundImg;
		$foundImg = 'controllers/uploads/'.$date.'_'.$_FILES['foundImg']['name'];
	}
}
else {
	$foundImg="";
}


include('config.php');
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $host, $password);
  $sql = "INSERT INTO items VALUES(:id, :x, :y, :item, :des, :tim, :item_type, :link, :img, :name, :email, :roll, :phn)";
  $query = $conn->prepare($sql);

  $query->execute(array('id' => '', 'x' => $foundX, 'y' => $foundY, 'item' => $foundItem, 'des' => $foundDesc, 'tim' => $foundSeen, 'item_type' => 'found', 'link' => '#', 'img' => $foundImg, 'name' => $foundName, 'email' => $foundEmail, 'roll' => $foundRoll, 'phn' => $foundPhn));
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
header('location:../');
?>