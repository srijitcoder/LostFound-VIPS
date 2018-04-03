
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