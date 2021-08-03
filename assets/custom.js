jQuery(document).ready(function($) {























   $(document).on('click', '.ajax_add_to_cart, .single_add_to_cart_button', function(e){

      if($(window).width() < 1025) return;

      var img = $(e.currentTarget).closest('.elementor').find('img');
      var img_src = img.attr('src');
      var img_x = Math.round(img.offset().left);
      var img_y = Math.round(Math.abs($(window).scrollTop() - img.offset().top));
      var img_width = Math.round(img.outerWidth());
      var img_height = Math.round(img.outerHeight());

      var cart = $('#desktop_mini_cart');
      console.log('cart', cart);
      var cart_x = Math.round(cart.offset().left);
      var cart_y = Math.round(Math.abs($(window).scrollTop() - cart.offset().top));
      console.log('cart_y', cart_y);
      var cart_width = Math.round(cart.outerWidth());
      var cart_height = Math.round(cart.outerHeight());

      var animation_speed = 400;

      var style = '<style>@keyframes flyToCart{from{transform:translate('+img_x+'px, '+img_y+'px);width:'+img_width+'px;height:'+img_height+'px;opacity: 1;}to{transform:translate('+cart_x+'px, '+cart_y+'px);width:'+cart_width+'px;height:'+cart_height+'px;opacity: 1;}}.fly-to-cart-canvas .flying-product{animation: '+animation_speed+'ms flyToCart ease-in;}</style>';
      var element = '<div class="fly-to-cart-canvas">'+style+'<img class="flying-product" src="'+img_src+'"></div>';

      $('body').append(element);

      setTimeout(function(){
         $('.fly-to-cart-canvas').remove();
      },animation_speed + 50);

   });


});
