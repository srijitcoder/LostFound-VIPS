<script>
for(i = 0; i < 69; i++) {
function randomFloatBetween(minValue,maxValue,precision){
    if(typeof(precision) == 'undefined'){
        precision = 2;
    }
    
 var a =    parseFloat(Math.min(minValue + (Math.random() * (90.000000 - 10.000000)),90.000000).toFixed(6));
 
 var b =    parseFloat(Math.min(minValue + (Math.random() * (90.000000 - 10.000000)),90.000000).toFixed(6));

document.write("var myMarker = new google.maps.Marker({ position: new google.maps.LatLng("+a+","+ b+"), draggable: true });");
}
}
</script>