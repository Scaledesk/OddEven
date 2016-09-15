/*
Copyright (c) 2016 Night club wordpress theme 
------------------------------------------------------------------
[Master Javascript]

Project:	Night club wordpress theme

-------------------------------------------------------------------*/

(function ($) {
	"use strict";
	var NightClub = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			/*-------------- NightClub Functions Calling ---------------------------------------------------
			------------------------------------------------------------------------------------------------*/
			this.RTL();
			this.OwlSlider();
			this.Player();
			this.Style_Switcher();
			this.Popup();
			
		},
		
		/*-------------- NightClub Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/
		RTL: function () {
			// On Right-to-left(RTL) add class 
			var rtl_attr = $("html").attr('dir');
			if(rtl_attr){
				$('html').find('body').addClass("rtl");	
			}		
		},
		OwlSlider: function () {
			// event slider 
			var event_owl = $(".rock_event");
			event_owl.owlCarousel({
				items : 2,
				pagination: false,
				itemsDesktop : [1000,2],
				itemsDesktopSmall : [900,2],
				itemsTablet: [600,2],
				itemsMobile : [480,1]
			});	
			
			// home event slider
			var home_event_owl = $(".event_crousel");
			home_event_owl.owlCarousel({
				items : 2,
				margin:30
			});	
			
			//track slider
			var track_owl = $(".rock_track_playlist_slider");
			track_owl.owlCarousel({
				items : 4,
				margin:20,
				pagination: false,
				itemsDesktop : [1000,2],
				itemsDesktopSmall : [900,2],
				itemsTablet: [600,2],
				itemsMobile : [480,1],
				navigation:true,
				navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
			});	
			// Custom Navigation Events
			$("#rock_track_playlist_slider_next").on("click",function(){
				track_owl.trigger('owl.next');
			});
			$("#rock_track_playlist_slider_prev").on("click",function(){
				track_owl.trigger('owl.prev');
			});
			
			// DJ's slider
			var djs_owl = $("#rock_disc_jockcy_slider");
			djs_owl.owlCarousel({
				items : 3,
				margin: 30,
				itemsDesktop : [1000,3],
				itemsDesktopSmall : [900,3],
				itemsTablet: [600,2],
				autoPlay : false
			});
			// Custom Navigation Events
			$(".next").click(function(){
				djs_owl.trigger('owl.next');
			});
			$(".prev").click(function(){
				djs_owl.trigger('owl.prev');
			});
			
			
			
			
		},
		Player:function(){
			//player
			$('.rock_player').mediaelementplayer({
				alwaysShowControls: true,
				features: ['playlistfeature', 'prevtrack', 'playpause', 'nexttrack', 'shuffle', 'tracks', 'current', 'duration', 'progress', 'volume'],
				audioVolume: 'horizontal',
				audioWidth: 450,
				audioHeight: 70,
				iPadUseNativeControls: true,
				iPhoneUseNativeControls: true,
				AndroidUseNativeControls: true
			});

			$('.rockon_player audio').mediaelementplayer({
				loop: true,
				shuffle: true,
				audioVolume: 'horizontal',
				playlist: false,
				features: ['playlistfeature','playpause', 'nexttrack'],
				keyActions: []
			});
			
			//show audio player after 3 sec
			setTimeout(function(){
				$('.rockon_player').css('display','block');
			}, 3000);
			
			// video mediaelementplayer
			$('video').mediaelementplayer({
				success: function(media, node, player) {
					$('#' + node.id + '-mode').html('mode: ' + media.pluginType);
				}
			});
		
		},
		Style_Switcher:function(){
			$("#style-switcher .bottom a.settings").on('click', function(e){
				e.preventDefault();
				var div = $("#style-switcher");
				if (div.css("left") === "-161px") {
					$("#style-switcher").animate({
						left: "0px"
					}); 
				} else {
					$("#style-switcher").animate({
						left: "-161px"
					});
				}
			});
			
			//color change
			$('.colorchange').on('click', function(){
				var color_name=$(this).attr('id');
				var siteurl = $('#rockon_style_siteurl').val();
				if(color_name != 'style' && color_name != 'style_light_version'){
					var new_style= siteurl+'/css/color/'+color_name+'.css';
				}else{
					var new_style= '';
				}
				$('#basic_color-css').attr('href',new_style);
				if($('#basic_color_rs-css')){
					$('#basic_color_rs-css').attr('href','');
				}
				$.ajax({
					type : "post",
					url : $('#rockon_style_ajaxurl').val(),
					data : {'colorcssfile_url' : color_name, 'action' : 'rockon_style_swticher_setting'},
					success: function(response) {
						console.log(response);
					}
				});
			});
			//pattern change
			
			$('.pattern_change').on('click', function(){
				var name=$(this).attr('id');
				var siteurl = $('#rockon_style_siteurl').val();
				var new_style=siteurl+'/css/pattern/'+name+'.css';
				$('#basic_patern-css').attr('href',new_style);
				$.ajax({
					type : "post",
					url : $('#rockon_style_ajaxurl').val(),
					data : {'patterncssfile_url' : name, 'action' : 'rockon_style_swticher_setting'},
					success: function(response) {
						console.log(response);
					}
				});
			});
			
		},
		Popup:function(){
			// club photo image popup
			$(".fancybox").fancybox({
				openEffect	: 'elastic',
				closeEffect	: 'elastic',
				helpers :
					{
						overlay:
					{
						locked: false
					}
				}
			});
			// portfolio video popup
			$(".fancybox-video").fancybox({
				openEffect	: 'elastic',
				closeEffect	: 'elastic',
				type : 'iframe',
				helpers :
					{
						overlay:
					{
						locked: false
					}
				}
			});
		
		}
		
		
		
		
	};

	NightClub.init();

	// Load Event
	$(window).on('load', function() {
		/* Trigger side menu scrollbar */
		//NightClub.menuScrollbar();
	});

	// Scroll Event
	$(window).on('scroll', function () {
	
	});
	
	// ready function
	$(document).ready(function() {
		
	});
	

})(jQuery);