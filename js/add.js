 // Add New Address
 function add_address() {

     var fname = $('#firstName').val();
     var lname = $('#lastName').val();
     var address1 = $('#address1').val();
     var address2 = $('#address2').val();
     var mobile = $('#mobile').val();
     var email = $('#email').val();
     var city = $('#city').val();
     var state = $('#state').val();
     var country = $('#country').val();
     var pin = $('#pin').val();
     var is_error = '';
     var address_id = $('#Address_id').val();


     if (fname == '' && lname == '' && address1 == '' && mobile == '' && email == '' && city == '' && state == '' && country == '' && state == '' && pin == '') {
         $(".name_error").html("Please enter require * field");
         is_error = 'yes';
     } else {
         $.ajax({
             url: 'manage_checkout.php',
             type: 'post',
             data: {

                 fname: fname,
                 lname: lname,
                 address1: address1,
                 address2: address2,
                 mobile: mobile,
                 email: email,
                 city: city,
                 state: state,
                 country: country,
                 pin: pin,
                 address_id: address_id,

             },
             success: function(data, result) {
                 if (address_id != '') {
                     window.location.href = 'checkout.php';
                     alert(data);
                 } else {
                     alert(data, result);
                 }

             }
         });
     }
 }

 // remove item from cart and checkout
 function remove(p_id) {
     var pid = $("#" + p_id + "pid").val();

     $.ajax({
         url: 'manage_cart.php',
         type: 'post',
         data: {
             remove_product2: 'yes',
             product_id: pid
         },
         success: function(data, status) {
             window.location.href = 'checkout.php';
         }
     });
 }

 //  update order status by admin
 function updateOrderStatus() {
     var order_status_id = $('#order_status_id').val();
     var order_id = $('#order_id').val();
     console.log(order_id);
     $.ajax({
         url: '../place_order.php',
         type: 'post',
         data: {
             order_status_id: order_status_id,
             order_id: order_id,
         },
         success: function(status) {

         }
     })
 }

 //  product add to cart by index page
 function addToCart(pid) {
     var quantity = $('#quantity' + pid).val();
     $.ajax({
         url: 'manage_cart.php',
         type: 'post',
         data: {
             add_to_cart: 1,
             product_id: pid,
             quantity: quantity,
         },
         success: function(data) {
             alert(data);
             window.location.href = 'index.php';
         }
     });
 }