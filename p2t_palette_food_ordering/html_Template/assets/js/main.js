(function ($) {
   /* Cart Currency Search toggle active */
   $(".header-cart a").on("click", function(e) {
      e.preventDefault();
      $(this).parent().find('.shopping-cart-content').slideToggle('medium');
   })
})(jQuery);

$(".navbar-toggler").on('click',function () {

    if($(".menu-icon").hasClass("fa-bars")){
        $(".menu-icon").removeClass("fa-bars").addClass("fa-times");
    }else{
        $(".menu-icon").removeClass("fa-times").addClass("fa-bars");
    }
});

