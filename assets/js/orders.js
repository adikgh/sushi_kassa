// start jquery
$(document).ready(function() {

	// btn_return_sn
	$('.btn_return_sn').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?return_sn",
         type: "POST",
         dataType: "html",
         data: ({ id: btn.data('id'), }),
         success: function(data){ 
            if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})



	// 
	$('.on_delete').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?delete",
         type: "POST",
         dataType: "html",
         data: ({ id: btn.data('id'), }),
         success: function(data){ 
            if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


   // 
	$('.on_staff').on('change', function () {
      // id = $(this).children('option:selected').attr('data-id')
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?change_staff",
         type: "POST",
         dataType: "html",
         data: ({ 
            id: btn.children('option:selected').attr('data-id'),
            order_id: btn.attr('data-order-id'),
         }),
         success: function(data){ 
            // if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


   // 
	$('.on_status').on('change', function () {
      // id = $(this).children('option:selected').attr('data-id')
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?change_status",
         type: "POST",
         dataType: "html",
         data: ({ 
            id: btn.children('option:selected').attr('data-id'),
            order_id: btn.attr('data-order-id'),
         }),
         success: function(data){ 
            // if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})
   
   
   
   // 
	$('.on_sort_status').on('change', function () {
      var val = $(this).children('option:selected').attr('data-id');
      const url = new URL(window.location);
      url.searchParams.set('status', val); 
      history.pushState(null, null, url);
      location.reload();
	})
   
   // 
	$('.on_sort_staff').on('change', function () {
      var val = $(this).children('option:selected').attr('data-id');
      const url = new URL(window.location);
      url.searchParams.set('staff', val); 
      history.pushState(null, null, url);
      location.reload();
	})



















	$('.on_print').on('click', function () {
      window.open("/orders/" + "order_print.php?" + "&orderID=" + $(this).attr('data-id'), "mywin","width=570,height=570,left=250,top=50");
	})
	// $('.on_print').on('click', function () {

	// })







   // cashbox_pay
	$('.on_info').click(function(){
		$('.on_info_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');

      $.ajax({
         url: "/orders/info.php",
         type: "POST",
         dataType: "html",
         data: ({ 
            id: $(this).attr('data-id'),
         }),
         success: function(data){
            $('.osigoi').html(data)
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})
	$('.on_info_back').click(function(){
		$('.on_info_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})














	// cashbox_pay
	$('.cashbox_pay').click(function(){
		$('.cashbox_pay_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.cashbox_pay_back').click(function(){
		$('.cashbox_pay_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

   // cashbox_pay
	$('.cashbox_pay2').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?cashbox_pay",
         type: "POST",
         dataType: "html",
         data: ({ 
            number: $('.order_number_sel').attr('data-val'),
            total: $('.btype_totol').attr('data-val'),
            delivery: $('.btype_delivery').attr('data-val'),
            qr: $('.btype_qr').attr('data-val'),
            branch: btn.attr('data-branch'),
         }),
         success: function(data){
            if (btn.attr('data-type') == 'check') {
               
            } else {
               if (data == 'yes') location.reload();
               else if (data == 0) mess('Вам необходимо заполнить все поля')
            }
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


}) // end jquery