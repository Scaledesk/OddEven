jQuery(document).ready(function($) {
	"use strict";
    $(document).on("click", ".rockon_upload_image_button,#rockon_image_button,#rockon_audio_button", function() {

        jQuery.data(document.body, 'prevElement', $(this).prev());

        window.send_to_editor = function(html) {
            var imgurl = jQuery('img',html).attr('src');
			if(imgurl == undefined){
				console.log(html);
				var imgurl=$(html).attr("href");
				}
            var inputText = jQuery.data(document.body, 'prevElement');
            if(inputText != undefined && inputText != '')
            {
                inputText.val(imgurl);
            }

            tb_remove();
        };

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
	jQuery('.rockon_icon_setings li').click(function(){
		$(this).addClass('rockon_selected_icon').siblings().removeClass('rockon_selected_icon');
		jQuery('#rockon_service_iconfont').val($(this).text());
	});

    jQuery('#image-holder a').live('click',function(event){
        event.preventDefault();
        jQuery(this).parent().remove();
        return false;
    });

	jQuery('.rockon_event_date').keypress(function(e){
		alert('Soory..you can\'t write here.');
		e.preventDefault();
	});
	
	jQuery('.rockon_event_date').live('focusin',function(event){
        event.preventDefault();
		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();

		var output = d.getFullYear() + '/' +
			(month<10 ? '0' : '') + month + '/' +
			(day<10 ? '0' : '') + day;
		
		var dt = new Date();
		var time = dt.getHours() + ":" + dt.getMinutes();

		jQuery(this).appendDtpicker({
			"minDate" : output,
			//"minTime" : time,
		});
    });
		
	jQuery('.rockon-select-sidebar').click(function(){
		jQuery('.rockon-select-sidebar').find('input').removeAttr('checked');
		jQuery('.rockon-select-sidebar').removeClass('rockon_chooseborder');
		jQuery(this).find('input').attr('checked','checked');
		jQuery(this).addClass('rockon_chooseborder');
	});
	
	if(jQuery('#event_booking_tbl').length){
		jQuery('#event_booking_tbl').DataTable();
	}
	
	$('.event_maindetail_cls').perfectScrollbar();
	
	
	jQuery('.event_maindetail_cls').hide();
	jQuery('.event_detail').click(function(e){
		e.preventDefault();
		//alert('asd');
		var ajaxurl = jQuery('#rockon_ajaxurl').val();
		var id = jQuery(this).attr('data');
		var data = { 
			'action': 'view_event_details',
			'event_id' : id
		};
		jQuery.post(ajaxurl, data, function(response) {
			var html = '';
			response = jQuery.parseJSON(response);
			console.log(response.result.length);
			html += '<h2 class="booking_for">Booking for '+response.event_name+'</h2>';
			html += '<h2 class="ticket_left">Ticket left '+response.ticket_left+'</h2>';  
			html += '<table id="singlevent_detail_tbl">';
				html += '<thead>';
					html += '<th> S. No. </th>';
					html += '<th> Full Name </th>';
					html += '<th> Email </th>';
					html += '<th> Phone Number </th>';
					html += '<th>Address </th>';
					html += '<th>Payment Recievier Email</th>';
					html += '<th>Payment Sender Email</th>';
					html += '<th>Quantity</th>';
					html += '<th>Payemt</th>';
					html += '<th>Coupon</th>';
					html += '<th>Date & Time</th>';
					html += '<th>Status</th>';
				html += '</thead>';
				html += '<tbody>';
					for(var i=0,j=1;i<response.result.length;i++,j++){
						html += '<tr>';
						html += '<td>'+j+'</td>';
						html += '<td>'+response.result[i].name+'</td>';
						html += '<td>'+response.result[i].email+'</td>';
						html += '<td>'+response.result[i].phonenumber+'</td>';
						html += '<td>'+response.result[i].address+'</td>';
						html += '<td>'+response.result[i].paypal_reciever_email+'</td>';
						html += '<td>'+response.result[i].paypal_sender_email+'</td>';
						html += '<td>'+response.result[i].qty+'</td>';
						html += '<td>'+response.result[i].payment+'</td>';
						html += '<td>'+response.result[i].coupon_code+'</td>';
						html += '<td>'+response.result[i].date_time+'</td>';
						html += '<td>'+response.result[i].payment_status+'</td>';
						html += '</tr>';
					}
				html += '</tbody>';
			html += '</table>';
			jQuery('.view_detials').html(html);
			jQuery('.event_maindetail_cls').fadeIn();
			jQuery('#singlevent_detail_tbl').DataTable();
		});
		
	});
	jQuery('.event_close').click(function(e){
		jQuery('.event_maindetail_cls').fadeOut();			
	});
	
});

function WPRemoveThumbnail(nonce){
	var post_ID = 0;
	var term_ID = 0;
	if( jQuery('#wpfifc_taxonomies_edit_post_ID_id').length > 0 ){
		post_ID = jQuery('#wpfifc_taxonomies_edit_post_ID_id').val();
	}
	if( jQuery('#wpfifc_taxonomies_edit_term_ID_id').length > 0 ){
		term_ID = jQuery('#wpfifc_taxonomies_edit_term_ID_id').val();
	}
	/*if( post_ID < 1 || term_ID < 1 ){
		return;
	}*/
	jQuery.post( jQuery('#rockon_ajaxurl').val(),
		{ action: "wpfifc-remove-image",
		  post_id: post_ID,
		  thumbnail_id: -1,
		  term_id: term_ID,
		  _ajax_nonce: nonce,
		  cookie: encodeURIComponent(document.cookie)
		},
		function(str){
			alert(str);
			if ( str.indexOf('ERROR') != '-1' ) {
				alert( "Remove featured image failed." );
			} else {
				jQuery('.inside', '#postimagediv').html(str);
			}
		}
	 );
}
