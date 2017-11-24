$(document).ready(function() {

	//Smooth Scroll
	$(function() {
		$('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});

    $('.delete').click(function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        var route = $(this).data("route");
        var tr = $(this).closest("tr");
        var x = confirm("Are you sure you want to delete?");
        if (x)
            $.ajax(
                {
                    type: "DELETE",
                    url: route + id,
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success: function () {
                        tr.fadeOut(500, function(){
                            $(this).remove();
                        });
                    }
                });
        else
            console.log("Delete failed");
    });

    $('.delete-project').click(function () {
        var id = $(this).data("id");
        var token = $(this).data("token");
        var route = $(this).data("route");
				var e = "dimmer-".concat(id);
        var x = confirm("Are you sure you want to delete?");
        if (x)
            $.ajax(

                {
                    type: "DELETE",
                    url: route + id,
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success: function () {
                        $("#" + e).fadeOut(500, function(){
                            $(this).remove();
                        });
                    }
                });
        else
            console.log("Delete failed");
    });


    //only 1 checkbox
    $('input[type="checkbox"]').on('change', function() {

        var trRow = $(this).closest("tr");
        // uncheck all checkbox in current row, except the selected radio
        trRow.find(":checkbox").not($(this)).prop("checked",false);

    });

    // Main Menu
	$('#main-nav').affix({
		offset: {
			top: $('header').height()
		}
	});


	// Top Search
	$("#ss").click(function(e) {
		e.preventDefault();
		$(this).toggleClass('current');
		$(".search-form").toggleClass('visible');
	});


	//Slider
	$('.flexslider').flexslider({
		animation: "fade",
		directionNav: false,
		pauseOnAction: false,
	});

	var containerPosition = $('.container').offset();
	var positionPad = containerPosition.left + 15;

	$('#slider').find('.caption').css({
		left: positionPad + 'px',
		marginTop: '-' + $('.caption').height() / 2 + 'px'
	});


	// number effect
	$('.about-bg-heading').one('inview', function(event, visible) {
		if (visible == true) {
			$('.count').each(function() {
				$(this).prop('Counter', 0).animate({
					Counter: $(this).text()
				}, {
					duration: 5000,
					easing: 'swing',
					step: function(now) {
						$(this).text(Math.ceil(now));
					}
				});
			});
		}
	});

    $(document).ready(function() {
        if (typeof filter !== 'undefined') {
            if (document.getElementById("filter").value == "localization"){
                document.getElementById("ifLoc").style.display = "inline-block";
            }else if(document.getElementById("filter").value == "number_clinic_history"){
                document.getElementById("ifClinic").style.display = "inline-block";
                document.getElementById("ifClinicButton").style.display = "inline-block";
			}
        }
    });

	//Google Map
    var get_latitude = $('#google-map').data('latitude');
    var get_longitude = $('#google-map').data('longitude');
    var mapsg = document.getElementById('google-map');

    function initialize_google_map() {
    	if (mapsg) {
            var myLatlng = new google.maps.LatLng(get_latitude, get_longitude);
            var mapOptions = {
                zoom: 14,
                scrollwheel: false,
                center: myLatlng
            };
            var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map
            });
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize_google_map);

});
