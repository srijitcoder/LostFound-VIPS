<!DOCTYPE html>
<html>
<head>
	<title>LostFound &middot; VIPS</title>
	<link rel="shortcut icon" href="imgs/favicon.png">
  	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">  
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<link rel="icon" href="imgs/favicon.PNG">
	<link rel="stylesheet" type="text/css" href="css/style.css">


	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="LostFound @ VIPS">
 	<meta property="og:title" content="LostFound - VIPS" />
 	<meta property="og:description" content="A portal to find lost/found stuff at VIPS." />
</head>
<body>

	<header>
	<div id="wrap">
		<img src="imgs/logo.jpg" width="170px">
	</div>
	</header>
	
	<div id="wrap">	
	<div id="content">
		

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<center>
			<thead>
				<tr>
					<td>Item</td>
					<td>Details</td>
					<td>Specification</td>
					<td>Report</td>
					<td>Image</td>
				</tr>
			</thead>
			<?php
			include('controllers/config.php');
			try {
			  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $host, $password);
			  $sql = "SELECT * FROM items order by id desc";
			  $query = $conn->prepare($sql);
			  $query->execute();
			  $final = $query->fetchAll();
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
			    echo "
			    	<tr>
			    		<td>".$item."</td>
			    		<td>".$time."</td>
			    		<td>".$desc."</td>";

			    if($item_type == "found") {
			    	echo "
			    		<td><button class='btn btn-info btn-md confirm-button' data-toggle='modal' onclick=requestItem(".$id.",1) data-remote='true'  data-type='lost' data-id='331' >It's Mine</button></td>
			    	"; 
			    }
			    else {
			    	echo "
			    		<td><button class='btn btn-danger btn-md confirm-button' data-toggle='modal' data-remote='true' onclick=requestItem(".$id.",0)  data-type='lost' data-id='331' >I've found it.</button></td>
			    	";
			    }

			    if($img == "") {
			    	echo "
			    		<td> <center> <span style='color:#d3d3d3; font-size:1.5em;' class='glyphicon glyphicon-camera' > </span> </center></td>	
			    	"; 
			    }
			    else {
			    	echo "
			    		<td> <center> <a href=".$img." target='_blank'> <span style='color:#000; font-size:1.5em;' class='glyphicon glyphicon-camera' > </span></a> </center></td>	
			    	";
			    }	
			    echo "</tr>
			    ";
			  }
			}
			catch(PDOException $e) {
			  echo $sql . "<br>" . $e->getMessage();
			}
			$conn = null;
			?>
		</center>
	</table>
	 <div id="map"></div>
	 <div class="mapAlert">
	   <div class="mapRel">
	    <div class="mapMsg">
	        <div class="container">
	            <center>
	              <div class="alert alert-info fade in" id="clickMSG" style="display:none;">
	                  <a href="#" class="close" onclick="$('.alert').hide()" style="color:black;">x</a>
	                  <strong>Great:</strong>  Now point to the place, where you have lost or found this item.
	              </div>
	              <div class="alert alert-danger fade in" id="dangMSG" style="display:none;">
	                  <a href="#" class="close" onclick="$('.alert').hide()" style="color:black;">x</a>
	                  <strong>Oops:</strong>   You can only login through ( @vips.edu ) student account.
	              </div>
	            </center>
	        </div> 
	    </div>    
	   </div>
	 </div>
 
	</div>
	</div>
	<footer>
		
	</footer>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="js/LostFoundLog.js"></script>
<script>LostFound();</script>
</body>
</html>
