<!DOCTYPE html>
<html>
<head>
	<title>LostFound &middot; VIPS</title>

	<link rel="stylesheet" type="text/css" href="css/fontello.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">  
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="imgs/favicon.PNG">

	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="LostFound @ VIPS">
 	<meta property="og:title" content="LostFound - VIPS" />
 	<meta property="og:description" content="An portal to find lost/found stuff built by ACE members at VIPS." />
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
</head>
<body id="slide">
	<header style="margin:0;">
	<div id="wrap">
		<img src="imgs/logo.jpg" width="170px">
	
  <ul class="navi">
	 <li> 
    <a href="log.php">
      <span class="icon-menu">
        <span class="aa">Found/Lost Items</span>
      </span>
    </a>
   </li> 

	 <li> 
    <a href="http://facebook.com/vipsace" target="_blank">
      <span class="icon-facebook-squared">
        <span class="aa">ACE Facebook</span>
      </span>
    </a>
   </li>

	 <li>
    <a href="http://vips.edu" target="_blank">
      <span class="icon-globe">
        <span class="aa">VIPS</span>
      </span>
    </a>
   </li> 
	</ul>

	</div>
	</header>

 <div id="map"></div>
 <div class="mapAlert">
   <div class="mapRel">
    <div class="mapMsg">
        <div class="container">
            <center>
              <div class="alert alert-info fade in" id="clickMSG" style="display:none;">
                  <a href="#" class="close" onclick="$('.alert').hide()" style="color:black;">x</a>
                  <strong>Great:</strong>  Now point to the place in the map, where you have lost or found this item.
              </div>
              <div class="alert alert-danger fade in" id="dangMSG" style="display:none;">
                  <a href="#" class="close" onclick="$('.alert').hide()" style="color:black;">x</a>
                  <strong>Oops:</strong>   You can only login through ( @vips.edu ) student account.
              </div>
              <?php
              if(@$_GET['error'] == '1'){
              echo "<div class='alert alert-danger fade in' id='dangMSG'>
                  <a href='#' class='close' onclick=$('.alert').hide() style='color:black;'>x</a>
                  <strong>Oops:</strong> Some fields are blank.
              </div>";
              }
              elseif(@$_GET['error'] == '2') {
              echo "<div class='alert alert-danger fade in' id='dangMSG'>
                  <a href='#' class='close' onclick=$('.alert').hide() style='color:black;'>x</a>
                  <strong>Oops:</strong> Please upload image having these extension png, jpg, jpeg
              </div>";
              }
              elseif(@$_GET['succ'] == '1') {
              echo "<div class='alert alert-info fade in' id='dangMSG'>
                  <a href='#' class='close' onclick=$('.alert').hide() style='color:black;'>x</a>
                  <strong>Success:</strong> Please check your email for contact details.
              </div>";
              }
              ?>
            </center>
        </div> 
    </div>    
   </div>
 </div>

 <div id="menu">
 <center>
 	<a href="#" class="button btnRes" id="LostOAuth"> Lost  </a>
	<a href="#" class="button btnRes blue" id="FoundOAuth"> Found </a>
	</center>
 </div>

 <div class="addItem">
  <div style="position:relative;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
      <center>
        <div class="addItemCard">

        </div>
      </center>
    </div>
  </div>
 </div>

 <div id="ModalAlert" class="modal fade" role="dialog">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <center>
              <div class="AlertHeader">
                <i class="glyphicon glyphicon-bullhorn AlertIcon"></i><br>
                ARE YOU SURE?
              </div><br>
              <div class="AlertMsg">
                <p> Are you sure the item is yours or you have found it? This person will be intimated and <br> contact info of this person will be mailed to you. Your email will be saved to prevent misuse.</p>
              </div>
              <div>
                <a href="#" class="button" data-dismiss="modal"> No </a>
                <a href="#" class="button blue" id="LostFoundYes" data-dismiss="modal"> Yes </a>
              </div>
          </center>
        </div>
      </div> 
    </div>
  </div>

 <div id="LostReqModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" id="lostModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">REQUEST TO SUBMIT THE ITEM</h3>
      </div>
      <form action="controllers/LostReq.php" method="post">
      <div class="modal-body">
        <p>PHONE NUMBER</p>
        <center>
          <input maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="text" name="lostReqPhn" class="ModalText">
        </center>
        <br>
        <input type="hidden" name="lostReqEmail" id="lostReqEmail" value="" class="lostEmail">
        <input type="hidden" name="lostReqName" id="lostReqName" value="" class="lostName">
        <input type="hidden" name="lostReqId" id="lostReqId" value="" class="lostId">
        <input type="hidden" name="lostReqRoll" id="lostReqRoll" value="" class="lostRoll">
      </div>
      <div class="modal-footer">
        <input type="submit" name="lostReqSubmit" class="ModalBut" value="SUBMIT">
      </div>
      </form>
    </div>
  </div>
</div>

 <div id="FoundReqModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" id="foundModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">REQUEST FOR YOUR ITEM</h3>
      </div>
      <form action="controllers/FoundReq.php" method="post">
      <div class="modal-body">
        <p>PHONE NUMBER</p>
        <center>
          <input maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="text" name="foundReqPhn" class="ModalText blueTxt">
        </center>
        <br>
        <input type="hidden" name="foundReqEmail" id="foundReqEmail" value="" class="foundEmail">
        <input type="hidden" name="foundReqName" id="foundReqName" value="" class="foundName">
        <input type="hidden" name="foundReqId" id="foundReqId" value="" class="foundId">
        <input type="hidden" name="foundReqRoll" id="foundReqRoll" value="" class="foundRoll">
      </div>
      <div class="modal-footer">
        <input type="submit" name="foundReqSubmit" class="ModalBut txtBlue" value="SUBMIT">
      </div>
      </form>
    </div>
  </div>
</div>


 <div id="LostModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="lostModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">LOST ITEM</h3>
      </div>
      <form action="controllers/VIPSLost.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <label for="file-input-lost" style="float:right;">
            <span class="glyphicon glyphicon-camera imgUpl"></span>
        </label>
        <input id="file-input-lost" type="file" style="display:none;" name="lostImg"/>
        <p>ITEM NAME</p>
        <center>
          <input maxlength="35" type="text" name="lostItem" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g,'');" class="ModalText">
        </center>
        <br>
        <p>LAST TIME SEEN</p>
        <center>
          <input maxlength="75" type="text" name="lostSeen" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g,'');" class="ModalText">
        </center>
        <br>
        <p>PHONE NUMBER</p>
        <center>
          <input maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="text" name="lostPhn" class="ModalText">
        </center>
        <br>
        <p>SPECIFICATION</p>
        <center>
          <textarea maxlength="180" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g,'');" name="lostDesc" class="ModalTextArea"></textarea>
        </center>
        <input type="hidden" name="lostEmail" value="" class="lostEmail">
        <input type="hidden" name="lostName" value="" class="lostName">
        <input type="hidden" name="lostRoll" value="" class="lostRoll">
        <input type="hidden" name="lostX" value="" class="lostX">
        <input type="hidden" name="lostY" value="" class="lostY">
      </div>
      <div class="modal-footer">
        <input type="submit" name="lostSubmit" class="ModalBut" value="SUBMIT">
      </div>
      </form>
    </div>

  </div>
</div>

 <div id="FoundModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="foundModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">FOUND ITEM</h3>
      </div>
      <form action="controllers/VIPSFound.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <label for="file-input-found" style="float:right;">
            <span class="glyphicon glyphicon-camera imgUpl" id="blueTxt"></span>
        </label>
        <input id="file-input-found" type="file" style="display:none;" name="foundImg"/>
        <p>ITEM NAME</p>
        <center>
          <input maxlength="35" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g,'');" type="text" name="foundItem" class="ModalText blueTxt">
        </center>
        <br>
        <p>FOUND AT</p>
        <center>
          <input maxlength="75" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g,'');" type="text" name="foundSeen" class="ModalText blueTxt">
        </center>
        <br>
        <p>PHONE NUMBER</p>
        <center>
          <input maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="text" name="foundPhn" class="ModalText blueTxt">
        </center>
        <br>
        <p>SPECIFICATION</p>
        <center>
          <textarea onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g,'');" maxlength="180" name="foundDesc" class="ModalTextArea blueTxt"></textarea>
        </center>
        <input type="hidden" name="foundEmail" value="" class="foundEmail">
        <input type="hidden" name="foundName" value="" class="foundName">
        <input type="hidden" name="foundRoll" value="" class="foundRoll">
        <input type="hidden" name="foundX" value="" class="foundX">
        <input type="hidden" name="foundY" value="" class="foundY">
      </div>
      <div class="modal-footer">
        <input type="submit" name="foundSubmit" class="ModalBut txtBlue" value="SUBMIT">
      </div>
      </form>
    </div>

  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<script src="https://apis.google.com/js/api:client.js"></script>
<?php
include('controllers/config.php');
try {
  echo "
        <script type='text/javascript'>
          arrMapList = new Array();
  ";
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $host, $password);
  $sql = "SELECT * FROM items";
  $query = $conn->prepare($sql);
  $query->execute();
  $final = $query->fetchAll();
  $neut = 0;
  foreach ($final as $row) {
    $id = $row['id'];
    $x = $row['x'];
    $y = $row['y'];
    $item = $row['item'];
    $desc = $row['desc'];
    $time = $row['time'];
    $item_type = $row['item_type'];
    $link = $row['link'];
    $img = $row['img'];
    echo "arrMapList[$neut] = new Array('$id', '$x', '$y', '$item', '$desc', '$time', '', '$item_type', '$link', '$img');
    ";
    $neut++;
  }
  echo "</script>";
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>
<script src="js/LostFoundVips.js"></script>
<script>FoundOAuth();</script>
<script>LostOAuth();</script>
<script>LostFound();</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMiqfHPAc3Mn_JIjC5JOa0D85mGFpbUSs&callback=initialize" async defer></script>
  </body>
</html>
</body>
</html>
