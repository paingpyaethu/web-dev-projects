jQuery('#formRegister').on('submit', function (e) {
   jQuery('.error_field').html('');
   jQuery('#form_msg').html('Please Wait...').addClass('alert alert-success');
   jQuery('#register_submit').attr('disabled', true);
   jQuery.ajax({
      url: frontUrl+'/register_submit',
      type: 'post',
      data: jQuery('#formRegister').serialize(),
      success: function (result) {
         jQuery('#form_msg').html('');
         jQuery('#register_submit').attr('disabled', false);

         let data=jQuery.parseJSON(result);
         if (data.status == 'error'){
            jQuery('#'+data.field).html(data.msg);
         }
         if (data.status == 'success'){
            jQuery('#'+data.field).html(data.msg);
            jQuery('#formRegister')[0].reset();
         }
      }
   });

   e.preventDefault();

});


/************* LOG IN ****************/

jQuery('#formLogin').on('submit', function (e) {
   jQuery('.error_field').html('');
   jQuery('#login_form_msg').addClass('fw-bold text-danger');
   jQuery('#login_submit').attr('disabled', true);
   jQuery.ajax({
      url: frontUrl+'/register_submit',
      type: 'post',
      data: jQuery('#formLogin').serialize(),
      success: function (result) {
         jQuery('#login_form_msg').html('');
         jQuery('#login_submit').attr('disabled', false);

         let data=jQuery.parseJSON(result);
         if (data.status === 'error'){
            jQuery('.alert_field').html(data.msg);
         }
         let is_checkout = jQuery('#is_checkout').val();
         if (is_checkout === 'yes') {
            window.location.href = 'checkout';
         }else if (data.status === 'success'){
            window.location.href = 'shop';
         }
      }
   });

   e.preventDefault();

});

/************* Forgot Password ****************/

jQuery('#formForgot').on('submit', function (e) {
   jQuery('#forgot_form_msg').html('Please Wait...').addClass('alert alert-success');
   jQuery.ajax({
      url: frontUrl+'/register_submit',
      type: 'post',
      data: jQuery('#formForgot').serialize(),
      success: function (result) {
         let data = jQuery.parseJSON(result);
         if (data.status === 'error'){
            jQuery('#forgot_form_msg').html(data.msg);
         }
         if (data.status === 'success'){
            jQuery('#forgot_form_msg').html(data.msg);
            jQuery('#formForgot')[0].reset();
         }
      }
   });
   e.preventDefault();
});

function set_checkbox(id){
   let cat_dish=jQuery('#cat_dish').val();
   let check=cat_dish.search(":"+id);
   if(check!='-1'){
      cat_dish=cat_dish.replace(":"+id,'');
   }else{
      cat_dish=cat_dish+":"+id;
   }
   jQuery('#cat_dish').val(cat_dish);
   jQuery('#formCate')[0].submit();
}

function setFoodType(type) {
   jQuery('#type').val(type);
   jQuery('#formCate')[0].submit();
}

function addToCart(id,type) {
   let qty = jQuery('#qty'+id).val();
   let attr = jQuery('input[name="Radio_'+id+'"]:checked').val();
   let is_attr_checked='';
   if(typeof attr=== 'undefined'){
      is_attr_checked='no';
   }

   if (qty != 0 && is_attr_checked!='no'){
      jQuery.ajax({
         url: frontUrl+'/manage_cart',
         type: 'post',
         data: 'qty='+qty+'&attr='+attr+'&type='+type,
         success: function (result) {
            let data = jQuery.parseJSON(result);
            Swal.fire(
               'Congratulations!',
               'Dish added successfully!',
               'success'
            );
            jQuery('#shop_added_msg_'+attr).html('( Added - '+qty+' )');
            jQuery('#totalCartDish').html(data.totalCartDish);
            jQuery('#dollarSign').html(data.dollarSign);
            jQuery('#totalPrice').html(data.totalPrice);

            let totalPrice_2 = data.totalPrice;

            if (data.totalCartDish == 1){
               let totalPrice_1 = qty * data.price;
               let html =
               '<div class="shopping-cart-content">' +
                  '<ul id="cart_ul">' +
                     '<li id="attr_'+attr+'">' +
                        '<div class="shopping-cart-img">' +
                           '<a href="javascript:void(0)"><img src="'+SITE_DISH_IMAGE+data.image+'" alt="" class="img-fluid"></a>' + // SITE_DISH_IMAGE = from footer.js
                        '</div>' +
                        '<div class="shopping-cart-title">' +
                           '<h4 class="fw-bold fs-6 text-main"><a href="javascript:void(0)" class=""></a>'+data.toShort+'</h4>' +
                           '<h6>Qty: '+qty+'</h6>' +
                           '<span>$'+totalPrice_1+'</span>' +
                        '</div>' +
                        '<div class="shopping-cart-delete">' +
                           '<a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="fas fa-times-circle text-danger fs-5"></i></a>' +
                        '</div>' +
                     '</li>' +
                  '</ul>' +
                  '<div class="shopping-cart-total">' +
                     '<h4>Total : <span class="shop-total" id="shop-total">$'+totalPrice_1+'</span></h4>' +
                  '</div>' +
                  '<div class="shopping-cart-btn">' +
                     '<a href="cart">view cart</a>' +
                     '<a href="checkout">check out</a>' +
                  '</div>' +
               '</div>';
               jQuery('.header-cart').append(html);
            } else {
               let totalPrice_1 = qty * data.price;
               jQuery('#attr_'+attr).remove();
               let html =
                  '<li id="attr_'+attr+'">' +
                     '<div class="shopping-cart-img">' +
                        '<a href="javascript:void(0)"><img src="'+SITE_DISH_IMAGE+data.image+'" alt="" class="img-fluid"></a>' + // SITE_DISH_IMAGE = from footer.js
                     '</div>' +
                     '<div class="shopping-cart-title">' +
                        '<h4 class="fw-bold fs-6 text-main"><a href="javascript:void(0)" class=""></a>'+data.toShort+'</h4>' +
                        '<h6>Qty: '+qty+'</h6>' +
                        '<span>$'+totalPrice_1+'</span>' +
                     '</div>' +
                     '<div class="shopping-cart-delete">' +
                        '<a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="fas fa-times-circle text-danger fs-5"></i></a>' +
                     '</div>' +
                  '</li>';
               jQuery('#cart_ul').append(html);
               jQuery('#shop-total').html('$'+totalPrice_2);
            }
         }
      });
   }else {
      Swal.fire(
         'Error!',
         'Please Select Qty & Dish Item!',
         'error'
      );
   }
}

function delete_cart(id, is_type) {
   jQuery.ajax({
      url: frontUrl + '/manage_cart',
      type: 'post',
      data: '&attr=' + id + '&type=delete',
      success: function (result) {
         if (is_type === 'load'){
             window.location.href = window.location.href;
         }else {
            let data = jQuery.parseJSON(result);

            jQuery('#totalCartDish').html(data.totalCartDish);
            jQuery('#shop_added_msg_' + id).html('');

            if (data.totalCartDish == 0) {
               jQuery('.shopping-cart-content').remove();
               jQuery('#dollarSign').html('');
               jQuery('#totalPrice').html('');
            } else {
               let totalPrice_2 = data.totalPrice;
               jQuery('#dollarSign').html(data.dollarSign);
               jQuery('#totalPrice').html(data.totalPrice);
               jQuery('#shop-total').html('$' + totalPrice_2);
               jQuery('#attr_' + id).remove();
            }
         }
      }
   });
}

/************* Update User Profile ****************/

jQuery('#formProfile').on('submit', function (e) {
   // jQuery('.error_field').html('');
   jQuery('#form_msg').html('Please Wait...').addClass('alert alert-success');
   jQuery('#profile_submit').attr('disabled', true);
   jQuery.ajax({
      url: frontUrl+'/update_profile',
      type: 'post',
      data: jQuery('#formProfile').serialize(),
      success: function (result) {
         jQuery('#form_msg').html('');
         jQuery('#profile_submit').attr('disabled', false);

         let data=jQuery.parseJSON(result);
         if (data.status == 'success'){
            jQuery('#user_top_name').html(jQuery('#userName').val());
            jQuery('#form_msg').html(data.msg);
         }
      }
   });

   e.preventDefault();

});


/************* Change User Profile Password ****************/

jQuery('#formPassword').on('submit', function (e) {
   // jQuery('.error_field').html('');
   jQuery('#password_form_msg').addClass('fw-bold text-danger');
   jQuery('#password_submit').attr('disabled', true);
   jQuery.ajax({
      url: frontUrl+'/update_profile',
      type: 'post',
      data: jQuery('#formPassword').serialize(),
      success: function (result) {
         jQuery('#password_form_msg').html('');
         jQuery('#password_submit').attr('disabled', false);

         let data=jQuery.parseJSON(result);
         if (data.status == 'error'){
            Swal.fire(
               'Error Message',
               data.msg,
               'error'
            );
         }
         if (data.status == 'success'){
            Swal.fire(
               'Success Message',
               data.msg,
               'success'
            );
         }
      }
   });

   e.preventDefault();

});