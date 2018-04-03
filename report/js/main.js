gta = "#about";
function lol(name) {
$(document).ready(function(){
		$(name).slideDown('slow');
		$(gta).fadeOut();
		gta = name;
		
});
}

$(document).ready(function(){
	$('.getVal').click(function(){
		getVal = $('.event option:selected').text();
		var href = "https://crossorigin.me/http://ssc2017.ml/generate_report/"+getVal+"/?";

$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: href,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            jsonVar = data;
            // college = "VIPS";
            college = {};
            studentVolunteers = {};
            name = jsonVar.name;
            attendees = jsonVar.attendees;
            registrations = jsonVar.registrations;
            venue = jsonVar.venue;
            teams = jsonVar.teams;
            time = jsonVar.time;
            description = jsonVar.description;
            techerIncharge = jsonVar.techerIncharge;
            jQuery.each( jsonVar.colleges, function( i, val ) {
                $('#coll').append("<li><span>"+val+"</span></li>");
            });
            jQuery.each( jsonVar.studentVolunteers, function( i, val ) {
                $('#student').append("<li><span>"+val+"</span></li>");
            });
            techerIncharge = "<li><span>"+techerIncharge;
            techerIncharge = techerIncharge.replace(",", "</span></li><li><span>");
            techerIncharge = techerIncharge+"</span></li>";

            winner = jsonVar.winners;
            first = jsonVar.winners.one[0]+" ("+jsonVar.winners.one[1]+")";
            second = jsonVar.winners.two[0]+" ("+jsonVar.winners.two[1]+")";
            third = jsonVar.winners.three[0]+" ("+jsonVar.winners.three[1]+")";
            //alert(first);
            $('.winners1').text(first);
            $('.winners2').text(second);
            $('.winners3').text(third);



            $('#teacher').append(techerIncharge);
            $('.gta').fadeOut();
            $('#abouts h2').text(description);
            $('#participantsStrong').text(registrations);
            $('#teamStrong').text(teams);
            $('.time span').text(time);
            $('.venue span').text(venue);
            var heroBg = "url(img/"+getVal+".jpg) 50%";
            $('.hero-bg').css("background",heroBg);


        }
    });
});

	});
});