/*
Copyright (c) 2016 Himanshu Softtech.
------------------------------------------------------------------
[Master Javascript]

Project:	Rockon Responsive WordPress Theme
Version:	1.3
Assigned to:	Themeforest
-------------------------------------------------------------------*/

(function ($) {
	"use strict";
	var rsplayer = '';
	var playerduration = 0;
	var rockonwp = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			/*-------------- rockonwp Functions Calling ---------------------------------------------------
			------------------------------------------------------------------------------------------------*/
			this.RTL();
			this.Smooth_Scrolling();
			this.Tooltip();
			this.MainSlider();
			this.Style_Switcher();
			this.Accordion();
			this.Woocomerce();
			this.Portfolio();
			this.EventTab();
			this.PageTitleBG();
			this.Player();
			this.PlayListSlider();
			this.TrackSlider();
			this.PortfolioFilterSlider();
			this.Popup();
			this.Gallery();
			//this.BookTable();
			this.DiscJockcySlider();
			this.ClubPhoto_Slider();
			this.FooterBG();
			this.WidgetSelect();
			this.DateTimePicker();
			this.SidebarCategoryDD();
			//this.palyMusic();
			
			
		},
		
		/*-------------- rockonwp Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/
		palyMusic: function(){
			
		},
		
		RTL: function () {
			// On Right-to-left(RTL) add class 
			var rtl_attr = $("html").attr('dir');
			if(rtl_attr){
				$('html').find('body').addClass("rtl");	
			}		
		},
		
		Preloader: function () {
			$("#status").fadeOut();
			$("#preloader").delay(350).fadeOut("slow");	
		},
		
		Smooth_Scrolling: function () {
			//smooth scrolling
			$.smoothScroll();
		},
		
		MainMenu:function (){
			// fixed menu on scroll
			var slider_height = window.innerHeight - 200;
			$(window).bind('scroll', function() {
				 if ($(window).scrollTop() > slider_height) {
					$('#rock_header').addClass('rock_header_fixed');
				 }
				 else {
					$('#rock_header').removeClass('rock_header_fixed');
				 }
			});
			// $(window).bind('scroll', function() {
				 // if ($(window).scrollTop() > 0) {
					 // $('#rock_header_otherpage').addClass('rock_header_fixed');
				 // }
				 // else {
					 // $('#rock_header_otherpage').removeClass('rock_header_fixed');
				 // }
			// });
			$(window).bind('scroll', function() {
				if ($(window).scrollTop() > slider_height) {
					$('#rock_header_single_page').addClass('rock_header_fixed');
				}
				else {
					$('#rock_header_single_page').removeClass('rock_header_fixed');
				}
			});
			 
			// dropdown menu on mobile width
			var width = $(document).width();
			if (width < 767) {
				$("li.rockon_dropdown").append("<span class='dropdown_toggle'></span>");	
				$('.menu-rockon-menu-container > ul > li > .dropdown_toggle').on('click', function(){
					$(this).prev('.sub-menu').slideToggle();	
				});
				
				$('.menu-rockon-menu-container > ul > li > ul.sub-menu > li > .dropdown_toggle').on('click', function(){
					$(this).prev('.sub-menu').slideToggle();	
				});
				
			}else if(width > 767){
			
			}
			
			
			// check dropdown is visible or not
			$('li').has('ul.sub-menu').addClass('rockon_dropdown');
			// Menu toggle
				var $menuToggle = $(".rock_menu_toggle");
				$menuToggle.on("click",function(){
					$('.rock_menu').toggleClass('open');
					$(this).toggleClass('open_toggle');
			});
			$('.menu_close').on("click",function(){
				$('.rock_menu').removeClass('open');
			});
			
			
			//active menu on scroll single page
			$(window).scroll(function() {
				var windscroll = $(window).scrollTop();
				if (windscroll >= 100) {
					$('.rockon_section').each(function(i) {
						if ($(this).position().top <= windscroll + 10 ) {
							$('.rock_menu_single ul li').removeClass('active');
							$('.rock_menu_single ul li').eq(i).addClass('active');
						}
					});
				} else {
			
					$('.rock_menu_single ul li').removeClass('active');
					$('.rock_menu_single ul li:first').addClass('active');
				}
			}).scroll();		
			
			
			
		},
		
		Tooltip: function () {
			// tooltip
			$('[data-toggle="tooltip"]').tooltip();
		},
		
		MainSlider: function(){
			//main slider
			$('.carousel').carousel({
				interval: 4000,  // manage speed for the slider 
				pause: "false"
			});
			
			//background grid main slider
			$( '#ri-grid' ).gridrotator( {
				rows : 4,
				columns : 8,
				maxStep : 2,
				interval : 2000,   // manage interval for grid image rotation 
				w1024 : {
					rows : 5,
					columns : 6
				},
				w768 : {
					rows : 5,
					columns : 5
				},
				w480 : {
					rows : 6,
					columns : 4
				},
				w320 : {
					rows : 7,
					columns : 4
				},
				w240 : {
					rows : 7,
					columns : 3
				},
			});
		},
		
		Style_Switcher:function(){
			$("#style-switcher .bottom a.settings").on('click', function(e){
				$("#style-switcher").toggleClass('open');
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
		
		Accordion:function(){
			//accordion
			jQuery(function ($) {
				var $active = $('#accordion .panel-collapse.in').prev().addClass('active');
				$active.find('a').prepend('<i class="glyphicon glyphicon-minus"></i>');
				$('#accordion .panel-heading').not($active).find('a').prepend('<i class="glyphicon glyphicon-plus"></i>');
				$('#accordion').on('show.bs.collapse', function (e) {
					$('#accordion .panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
					$(e.target).prev().addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
				})
			});

		},
		
		Woocomerce:function(){
			//woocomerce single page number input
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});

			//woocommerce-message
			var woocommerce_error =	setTimeout(function () {
				$('.woocommerce-error').fadeOut(500);
			}, 5000);
			var woocommerce_info =	setTimeout(function () {
				$('.woocommerce-info').fadeOut(500);
			}, 5000);
			var woocommerce_message =	setTimeout(function () {
				$('.woocommerce-message').fadeOut(500);
			}, 5000);
			
			
			//woocomerce related product slider
			var rps_owl = $(".related_product_slider");
			rps_owl.owlCarousel({
				items : 3,
				pagination: false,
				responsive:{
					0:{
						items:1,
					},
					600:{
						items:2,
					},
					1000:{
						items:3,
					}
				}
			});
			// Custom Navigation Events
			$(".next").click(function(){
				rps_owl.trigger('next.owl.carousel');
			});
			$(".prev").click(function(){
				rps_owl.trigger('prev.owl.carousel');
			});
			
			
			//woocomerce product image thumbnails  slider
			var woothumbowl = $(".images .thumbnails");
			woothumbowl.owlCarousel({
				items : 3,
				margin:0,
				nav: true,
				navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
				pagination: false
			});
			// Custom Navigation Events
			$(".next").click(function(){
				woothumbowl.trigger('next.owl.carousel');
			});
			$(".prev").click(function(){
				woothumbowl.trigger('prev.owl.carousel');
			});
			
			
		},
		
		Portfolio:function(){
			// Portfolio filter
			if ($.fn.mixitup) {
				$('#grid').mixitup({
					filterSelector: '.filter-item'
				});
				$(".filter-item").click(function(e) {
					e.preventDefault();
				});
			}
		},
		
		EventTab:function(){
			// event tab
			$('.rock_event_tab > ul').each(function(){
				var $active, $content, $links = $(this).find('a');
				$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
				$active.addClass('active');
				$content = $($active[0].hash);
				$links.not($active).each(function () {
					$(this.hash).hide();
				});
				$(this).on('click', 'a', function(e){
					$active.removeClass('active');
					$content.hide();
					$active = $(this);
					$content = $(this.hash);
					$active.addClass('active');
					$content.fadeIn().addClass('animated fadeIn');
					e.preventDefault();
				});
			}); 
		  
		},
		
		PageTitleBG:function(){
			//page title background grid
			$( '#rock_page_title_bg' ).gridrotator({
				rows : 1,
				columns : 8,
				maxStep : 2,
				interval : 2000,
				w1024 : {
					rows : 1,
					columns : 6
				},
				w768 : {
					rows : 1,
					columns : 5
				},
				w480 : {
					rows : 2,
					columns : 4
				},
				w320 : {
					rows : 2,
					columns : 4
				},
				w240 : {
					rows : 3,
					columns : 3
				},
			});
		},
		
		Player:function(){
			//player
			$('.rock_portfolio_player').mediaelementplayer({
				alwaysShowControls: true,
				features: ['playlistfeature', 'prevtrack', 'playpause', 'nexttrack', 'shuffle', 'tracks', 'current', 'duration', 'progress', 'volume'],
				audioVolume: 'horizontal',
				audioWidth: 450,
				audioHeight: 70,
				iPadUseNativeControls: true,
				iPhoneUseNativeControls: true,
				AndroidUseNativeControls: true
			});
			if($('.rock_player').length){
				//var i = 0;
				var rsplayer = new MediaElementPlayer('.rock_player',{
					alwaysShowControls: true,
					features: ['playlistfeature', 'playpause', 'prevtrack', 'nexttrack', 'shuffle', 'tracks', 'current', 'duration', 'progress', 'volume'],
					audioVolume: 'horizontal',
					audioWidth: 450,
					audioHeight: 70,
					iPadUseNativeControls: true,
					iPhoneUseNativeControls: true,
					AndroidUseNativeControls: true,
					success: function(mediaElement, domObject) {
						
						/*mediaElement.addEventListener('seeked', function() {
							console.log('addEventListener - seeked' + i); 
							i++;	
						}, false);*/
						// mediaElement.play(60.6195);
						// add event listener
				       /* mediaElement.addEventListener('timeupdate', function(e) {
				             
				            console.log(mediaElement.currentTime);
				             
				        }, false);*/
					},
				});
			}
			$('.play_music').click(function(){
				var src = $(this).attr('data-src');
				var title = $(this).attr('data-title');
				var audio = $(this).attr('data-audio');
				
				$('.rock_audio_player_track_image').find('img').attr('src',src);
				$('.rock_audio_player_title').html(title);
				$('.rock_audio_player_track_image_overlay').html(title);
				
				var audiosrc = audio.split(",");
				
				
				
				var arr = [];
				
				for(var i =0;i<audiosrc.length;i++){
					var track = {};
					track.src = audiosrc[i];
					track.type = 'audio/mpeg';
					arr.push(track);
				}
				
				console.log(arr);
				
				//rsplayer.pause();
				rsplayer.setSrc(arr);
				//rsplayer.load();
				rsplayer.play();
				
			});
			
			$('.rockon_player audio').mediaelementplayer({
				loop: true,
				shuffle: true,
				audioVolume: 'horizontal',
				playlist: false,
				features: ['playlistfeature','playpause', 'nexttrack'],
				keyActions: [],
				success: function(mediaElement, domObject) {
					//console.log($('.rockon_player').attr('data-duration'));
					var val = $.cookie("rockon_audio_duration") ? $.cookie("rockon_audio_duration") : 0;
					mediaElement.setCurrentTime(val);
					mediaElement.addEventListener('timeupdate', function(e) {
						playerduration = mediaElement.currentTime;			             
			        }, false);
				}
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
		
		PlayListSlider:function(){
			//play list slider
			$('.rock_track_playlist_slider').bxSlider({
				mode: 'vertical',
				slideMargin: 0,
				minSlides: 4,
				auto: true,
				default: 500,
				controls: true,
				pager: false,
				autoHover: true,
				nextSelector: '#rock_track_playlist_slider_next',
				prevSelector: '#rock_track_playlist_slider_prev',
				nextText: '<i class="fa fa-angle-up"></i>',
				prevText: '<i class="fa fa-angle-down"></i>'
			});
		},
		
		TrackSlider:function(){
			//club track slider
			$('.bxslider').bxSlider({
				mode: 'vertical',
				slideMargin: 5,
				minSlides: 2,
				auto: true,
				default: 500,
				controls: false,
				pager: false,
				autoHover: true
			});
		},
		
		PortfolioFilterSlider:function(){
			// portfolio fliter slider
			$('.portfolio_filter_slider').bxSlider({
				minSlides: 4,
				maxSlides: 4,
				slideWidth: 360,
				slideMargin: 10,
				pager: false,
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
		
		},
		
		Gallery:function(){
			// gallery tab 
			$('.main_gallery_tab > ul').each(function(){
				var $active, $content, $links = $(this).find('a');
				$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
				$active.addClass('active');
				$content = $($active[0].hash);
				$links.not($active).each(function () {
					$(this.hash).hide();
				});
				$(this).on('click', 'a', function(e){
					$active.removeClass('active');
					$content.hide();
					$active = $(this);
					$content = $(this.hash);
					$active.addClass('active');
					$content.fadeIn();
					e.preventDefault();
				});
			});

			// gallery item click
			$('.main_gallery_item_link').click(function(){
				$('.main_gallery_item_popup').each(function(){
					$(this).hide();
				});
				var shaid=$(this).attr('id');
				$('.'+shaid).slideDown();
			});
			$('.main_gallery_item_popup_close').click(function(){
				$('.main_gallery_item_popup').slideUp();
			}); 
			
		},
		
		BookTable:function(){
			// book table
			$('.rock_book_table').click(function(){
				$(this).addClass('active');
				$(this).children('.rock_table_1').children('.table_overlay').children('p').html('<p>Reserve</p>');
				$(this).children('.rock_table_1').children('.table_overlay').children('p').css('margin-left','-27px');
				$(this).children('.rock_table_1').children('.table_overlay').css('cursor','not-allowed');
			});
		},
		
		DiscJockcySlider:function(){
			var djs_owl = $("#rock_disc_jockcy_slider");
			djs_owl.owlCarousel({
				items : 4,
				autoPlay : true,
				responsive:{
					0:{
						items:1,
					},
					600:{
						items:2,
					},
					1000:{
						items:4,
					}
				}
			});
			// Custom Navigation Events
			$(".next").click(function(){
				djs_owl.trigger('next.owl.carousel');
			});
			$(".prev").click(function(){
				djs_owl.trigger('prev.owl.carousel');
			});
		},
		
		ClubPhoto_Slider:function(){
			// club photo slider
			var cps_owl = $("#rock_club_photo_slider");
			cps_owl.owlCarousel({
				items : 3,
				responsive:{
					0:{
						items:1,
					},
					600:{
						items:2,
					},
					1000:{
						items:3,
					}
				} 
			});
			// Custom Navigation Events
			$(".rock_club_photo .next").click(function(){
				cps_owl.trigger('next.owl.carousel');
			});
			$(".rock_club_photo .prev").click(function(){
				cps_owl.trigger('prev.owl.carousel');
			});
		},
		
		FooterBG:function(){
			// footer copyright background
			$( '#ri-grid2' ).gridrotator({
				rows : 1,
				columns : 8,
				maxStep : 2,
				interval : 2000,
				w1024 : {
					rows : 1,
					columns : 6
				},
				w768 : {
					rows : 1,
					columns : 5
				},
				w480 : {
					rows : 2,
					columns : 4
				},
				w320 : {
					rows : 2,
					columns : 4
				},
				w240 : {
					rows : 3,
					columns : 3
				},
			});
		},
		
		WidgetSelect:function(){
			//widget select
			$('.widget select').addClass('selectpicker');
		},
		
		DateTimePicker:function(){
			// date time picker
			var logic = function( currentDateTime ){
				if( currentDateTime ){
					if( currentDateTime.getDay()==6 ){
						this.setOptions({
							minTime:'11:00'
						});
					}else
					this.setOptions({
						minTime:'8:00'
					});
				}
			};
			$('#datetimepicker').datetimepicker({
				onChangeDateTime:logic,
				onShow:logic
			});
		
		},
		
		SidebarCategoryDD:function(){
			// sidebar categories dropdown
			$('.rock_categories ul li').click(function(){
				$(this).children('ul').slideToggle();
			});
		}
		
		
		
	};

	rockonwp.init();
	
	window.onbeforeunload = function(e) {
		$.cookie("rockon_audio_duration", playerduration); 
		//return playerduration;
	};
	// Load Event
	$(window).on('load', function() {
		/* Trigger side menu scrollbar */
		rockonwp.MainMenu();
		rockonwp.Preloader();
		
		
		if($(".rockon_portfolio_width").hasClass( "rockon_portfolio_width" )){
			var offset = $(".rockon_portfolio_width").offset();
			var ls = 0;
			if(offset.left > 0){
				ls = -offset.left;
			}
			$('.rockon_portfolio_width').css( { position: 'relative',
			left: ls+'px',
			width: $(window).width()+'px' } );
		}
		
		
		// select picker
		$('.selectpicker').selectpicker({
			'selectedText': 'cat'
		});
		// $('.selectpicker').selectpicker('hide');
		
	});

	// Scroll Event
	$(window).on('scroll', function () {
	
	});
	
	// Resize Event
	$(window).on('resize', function(){
		//function for main slider height on resize
		var slider_height = $(window).innerHeight();
		$('.rock_slider_div .main').css('height', slider_height);
		
		if (window.innerHeight > 992){
			 //slider height on resize
			var slider_height = $(window).innerHeight();
			$('.rock_slider_div .main').css('height', slider_height);
		}
		else{
			var slider_height1 = $('.rock_slider_div .main #ri-grid').innerHeight();
			$('.rock_slider_div .main').css('height', slider_height1);
		}
		
		
	});
	
	// ready function
	$(document).ready(function() {
		
		// single page
		//$("#rockon_single").single({
		//	speed: 1000
		//});
		
		//Check if browser is Safari or not
		if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
			$('.products').addClass('product_sufari');
		}
		
		
		// single page slider bg
		var bg_w = window.innerWidth;
		var bg_h = window.innerHeight;
		$('rock_single_page_slider_bg').css('width', bg_w);
		$('rock_single_page_slider_bg').css('height', bg_h);
		
		
		// drop down menu
		// $('.rock_menu ul li').children('ul').addClass('animated fadeInDown');
		// $('.rock_menu ul li ul li').children('ul').addClass('animated fadeInLeft');
		
		
		/*************** Contact-form start *****************/
		$.validate({
			form : '#rockon_contactform',
			modules : 'security',
			onSuccess : function() {
			contactform();
			return false; // Will stop the submission of the form
			}
		});
		function contactform(){
			var formdata = $( "#rockon_contactform" ).serialize();
			formdata += '&action=rockon_sndadminmail';
			$.ajax({
				type : "post",
				url : $('#rockon_ajaxurl').val(),
				data : formdata,
				success: function(response) {
					alert(response);
					$('.rockon_infotext').text(response);
					$('#Message').val('');
				}
			});
		}
		/*************** Contact-form end *****************/
		
		
		$('#goGrid').click(function(){
			$('.product_wrapper').removeClass('col-lg-12 col-md-12 col-sm-12 product_list_wrapper').addClass('col-lg-4 col-md-4 col-sm-4');
			$('.rockon_product_shop_content').css('display','none');
			$('#goGrid').removeClass('active');
			$(this).addClass('active');
			$('#goList').removeClass('active');
		});

		$('#goList').click(function(){
			$('.product_wrapper').removeClass('col-lg-4 col-md-4 col-sm-4').addClass('col-lg-12 col-md-12 col-sm-12 product_list_wrapper');
			$('.rockon_product_shop_content').css('display','block');
			$('#goList').removeClass('active');
			$(this).addClass('active');
			$('#goGrid').removeClass('active');
		});
		
		
		/*$('.single_add_to_cart_button').click(function(e){
			e.preventDefault();
			var id = $(this).attr('data');
			$.ajax({
				type : "post",
				url : $('#woo_rockon_ajax').val(),
				data : {'product_id' : id, 'action' : 'woo_rockon_add_to_cart_single'},
				success: function(response) {
					alert(response);
					console.log(response);
				}
			});

		});*/
		
		
		/*************** Booking event start *****************/
		jQuery('.rockon_event_form').hide();
		jQuery('.book_btn').click(function(e){  
			e.preventDefault();
			//alert('asd');
			jQuery('.rockon_event_form').fadeIn();
		});
		jQuery('.rockon_event_close_tag').click(function(e){
			e.preventDefault();	
			jQuery('.rockon_event_form').fadeOut();
		});
		$('.event_minus').click(function () {
			var $input = $(this).parent().next();
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			var singlecost = parseInt($('.change_cost_single').text());
			var total = parseInt(count) * parseInt(singlecost);
			$('.change_cost_total').text(total);
			$('.paypal_amount').val(total);
			return false;
		});
		$('.event_plus').click(function () {
			var input = $(this).parent().prev();
			var left = $('.ticket_left').text();
			if(parseInt(left)>input.val()){
				var qty = parseInt(input.val()) + 1;
				input.val(qty);
				var singlecost = parseInt($('.change_cost_single').text());
				var total = parseInt(qty) * parseInt(singlecost);
				$('.change_cost_total').text(total);
				$('.paypal_amount').val(total);
			}
			return false;
		});
		
		$('.loading_event').hide();
		
		$('.apply_coupon').click(function(e){
			e.preventDefault();
			$('.loading_event').show();
			var slug = $('#coupon_code').val();
			var obj = $(this);
			var postid = $('.event_post_id').val();
			var qty = $('.input-number').val();
			$.ajax({
				type : "post",
				url : $('#event_ajaxurl').val(),
				data : {'slug' : slug,'postid':postid,'qty':qty, 'action' : 'rockon_checkcouponcode'},
				success: function(response) {
					var result = JSON.parse(response);
					if(result[0] == '1'){
						var amt = parseInt($('.change_cost_total').text());
						var discount = amt * parseInt(result[1]) / 100;
						discount = parseInt(discount);
						amt = amt - discount;
						$('.change_cost_total').text(amt);
						$('.paypal_amount').val(amt);
						$(obj).prop('disabled', true);
						$('.event_minus').prop('disabled', true);
						$('.event_plus').prop('disabled', true);
						$('#coupon_code').prop('disabled', true);
						$('#p_coupon_code').val(slug);
						$('.success_msg').text(result[2]);
					}else{
						$('.success_msg').text(result[0]);
					}
					$('.loading_event').hide();
				}
			});
		});
		var usernumber = '1235';
		$.validate({
			form : '#event_paypal_form',
			modules : 'security',
			onSuccess : function() {
				
				if($('#p_coupon_code').length){
					var code = $('#coupon_code').val();
				}else{
					var code = '';
				}
				
				var data = {
					'action' : 'rockon_save_event_booking_data',
					'name' : $('.e_name').val(),
					'email' : $('.e_email').val(),
					'number' : $('.e_number').val(),
					'adderss' : $('.e_address').val(),
					'couponcode' : code,
					'qty' : $('.input-number').val(),
					'event_id' : $('.event_post_id').val(),
				};
				
				var info = $('.usr_information').val();
				if(usernumber != info){
					$.ajax({
						type : "post",
						url : $('#event_ajaxurl').val(),
						data : data,
						success: function(response) {
							usernumber = response;
							$('.usr_information').val(response);
							$('#event_paypal_form').submit();
						}
					});
					return false;
				}else{
					return true;
				}
				return false;
			}
		});
		/*************** Booking event end *****************/
		
	});
	
})(jQuery);