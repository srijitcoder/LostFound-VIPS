
/* Global Variable */
LgLt = 0;
emailCheck1 = "@vips.edu";
emailCheck2 = "@vips.edu.test-google-a.com";
checkWhich = "";

LostEmail = "";
LostName = "";
LostRoll = "";
LostX = "";
LostY = "";

FoundEmail = "";
FoundName = "";
FoundRoll = "";
FoundX = "";
FoundY = "";

IdVal = 0;
ItemType = 0;

/* Global Variable end */

  /* LostOAuth */
  var googleUserLost = {};
  var LostOAuth = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '163491363356-cg22pvcm46i7p5u6v48oqt4d9u5k32p0.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachLost(document.getElementById('LostOAuth'));
    });
  };

  function attachLost(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUserLost) {
              LostEmail = googleUserLost.getBasicProfile().getEmail();
              LostName = googleUserLost.getBasicProfile().getName();
              if(LostEmail.indexOf(emailCheck1) != -1 || LostEmail.indexOf(emailCheck2) != -1){
                $('#clickMSG').show(300);
                LgLt = 1;
                checkWhich = "Lost";
                LostRoll = LostEmail.replace(emailCheck1, "");
              }
              else {
                $('#dangMSG').show(300); 
              }
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  /* LostOAuth End */

  /* FoundOAuth */
  var googleUserFound = {};
  var FoundOAuth = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '163491363356-cg22pvcm46i7p5u6v48oqt4d9u5k32p0.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachFound(document.getElementById('FoundOAuth'));
    });
  };

  function attachFound(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUserFound) {
              FoundEmail = googleUserFound.getBasicProfile().getEmail();
              FoundName = googleUserFound.getBasicProfile().getName();
              if(FoundEmail.indexOf(emailCheck1) != -1 || FoundEmail.indexOf(emailCheck2) != -1){
                $('#clickMSG').show(300);
                LgLt = 1;
                checkWhich = "Found";
                FoundRoll = FoundEmail.replace(emailCheck1, "");
              }
              else {
                $('#dangMSG').show(300); 
              }
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  /* FoundOAuth End */

  /* Request Item */
  function requestItem(Id,itemVal) {
    IdVal = Id;
    ItemType = itemVal;
    $('#ModalAlert').modal('show');
  }

  /* LostFound Request OAuth */
  var googleUserLostFound = {};
  var LostFound = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '163491363356-cg22pvcm46i7p5u6v48oqt4d9u5k32p0.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachLostFound(document.getElementById('LostFoundYes'));
    });
  };

  function attachLostFound(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUserLostFound) {
          var EmailReq = googleUserLostFound.getBasicProfile().getEmail();
          if(EmailReq.indexOf(emailCheck1) != -1 || EmailReq.indexOf(emailCheck2) != -1){
              var RollReq = EmailReq.replace(emailCheck1, "");
              if(ItemType == 0) {
                $("#lostReqEmail").val(googleUserLostFound.getBasicProfile().getEmail());
                $("#lostReqName").val(googleUserLostFound.getBasicProfile().getName());
                $("#lostReqRoll").val(RollReq);
                $("#lostReqId").val(IdVal);
                $('#LostReqModal').modal('show');
              }
              else {
                $("#foundReqEmail").val(googleUserLostFound.getBasicProfile().getEmail());
                $("#foundReqName").val(googleUserLostFound.getBasicProfile().getName());
                $("#foundRegRoll").val(RollReq);
                $("#foundReqId").val(IdVal);
                $('#FoundReqModal').modal('show');
              }
          }
          else {
                $('#dangMSG').show(300); 
          }
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }

/* Main map API */
  var openInfoWindow = null;
  function initialize() {
    var mapOptions = {
      center: new google.maps.LatLng(28.7211979, 77.141388),
      zoom: 19,
      mapTypeId: google.maps.MapTypeId.HYBRID,
    };

    var map = new google.maps.Map(document.getElementById("map"),
        mapOptions);

    for (var i = arrMapList.length - 1; i >= 0; i--) {
      newmarker(arrMapList[i][0], arrMapList[i][1], arrMapList[i][2], arrMapList[i][3], arrMapList[i][4], arrMapList[i][5], arrMapList[i][6], arrMapList[i][7], arrMapList[i][8], arrMapList[i][9]);
    }

    //iteration for map Click
    google.maps.event.addListener(map, 'click', function (e) {
    			if(LgLt == 1){
            if(checkWhich == "Lost"){
              //alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
              LostX = e.latLng.lat();
              LostY = e.latLng.lng();
              LgLt = 0;
              $(document).ready(function(){
                $('#LostModal').modal('show');
                $('.lostEmail').val(LostEmail);
                $('.lostName').val(LostName);
                $('.lostRoll').val(LostRoll);
                $('.lostX').val(LostX);
                $('.lostY').val(LostY);
              });
            }
            else{
              //alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
              FoundX = e.latLng.lat();
              FoundY = e.latLng.lng();
              LgLt = 0;
              $(document).ready(function(){
                $('#FoundModal').modal('show');
                $('.foundEmail').val(FoundEmail);
                $('.foundName').val(FoundName);
                $('.foundRoll').val(FoundRoll);
                $('.foundX').val(FoundX);
                $('.foundY').val(FoundY);
              });
            }
    			}
            });


    function newmarker(id, x, y, name, description, time, time_of_day, item_type, link, imagelink){
      var myLatlng = new google.maps.LatLng(x, y);
      content = {
        position: myLatlng,
        map: map,
        draggable:false,
        animation: google.maps.Animation.DROP,
        title:name,
      }


      if (item_type === 'lost'){
        content.icon = "imgs/red-marker.png"
      }
      else {
        content.icon = "imgs/blue-marker.png";
      }

      var popup_html = '<div id="content" style="min-width:200px; max-width:400px;"><h3 id="firstHeading" class="firstHeading">' + name;

      if (imagelink !== ''){
        popup_html += '<a href="'+ imagelink +'" target=new><span class="glyphicon glyphicon-camera" style="margin-left:20px; color: black"></span></a>';
       }

      popup_html += '</h3> <div id="bodyContent"><p style="font-size:16px;">' + description;

      if (item_type === 'lost'){
        popup_html += '<br />Last seen <strong>' + time;
        if (time_of_day !== ''){
          popup_html += '</strong> in the ' + time_of_day;
        }
      }

      else{
        popup_html += '<br />Found <strong>' + time + '</strong>';
      }

      popup_html += '.</p><a class="btn btn-';

      if (item_type === 'lost'){
        popup_html += 'danger';
      }
      else{
        popup_html += 'info'; 
      }

      item_num = 0;

      if(item_type == 'found'){
        item_num = 1;
      }

      popup_html += ' btn-md" href="'+ link +'" onclick="requestItem('+id+','+item_num+')" >';

      if (item_type === 'lost'){
        popup_html += "I've found it.";
      }
      else{
        popup_html += "It's mine.";
      }

      popup_html += '</a> </div></div> ';
      var marker = new google.maps.Marker(content);
      
      var infowindow = new google.maps.InfoWindow({
      content: popup_html
    });
    google.maps.event.addListener(marker, 'click', function() {
    if (openInfoWindow){
      openInfoWindow.close();
    }

    openInfoWindow = infowindow;
    infowindow.open(map,marker);
   });
   marker.setMap(map);
  }
	}

  //google.maps.event.addDomListener(window, 'load', initialize);
  /* Main map API Ends*/

/* form check */

$('.lostItem').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^a-zA-Z0-9\s]/g,'') ); 
});

$('.lostSeen').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^a-zA-Z0-9\s]/g,'') ); 
});

$('.lostPhn').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^0-9]/g,'') ); 
});

$('.lostDesc').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^a-zA-Z0-9\s]/g,'') ); 
});

$('.foundItem').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^a-zA-Z0-9\s]/g,'') ); 
});

$('.foundSeen').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^a-zA-Z0-9\s]/g,'') ); 
});

$('.foundPhn').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^0-9]/g,'') ); 
});

$('.foundDesc').bind('keyup blur',function(){ 
  var node = $(this);
  node.val(node.val().replace(/[^a-zA-Z0-9\s]/g,'') ); 
});