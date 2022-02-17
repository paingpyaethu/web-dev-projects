// $(".show-sidebar-btn").click(function () {
//     $(".aside").animate({marginLeft:0});
// });
// $(".hide-sidebar-btn").click(function () {
//     $(".aside").animate({marginLeft:"-100%"});
// });
//
//
// $(".full-screen-btn").click(function () {
//     let current = $(this).closest(".card");
//     current.toggleClass("full-screen-card");
//     if(current.hasClass("full-screen-card")){
//         $(this).html(`<i class="fas fa-compress"></i>`);
//     }else{
//         $(this).html(`<i class="fas fa-expand"></i>`);
//     }
// });

/* Cart Currency Search toggle active */
$(".header-cart a").on("click", function(e) {
    e.preventDefault();
    $(this).parent().find('.shopping-cart-content').slideToggle('medium');
})

/*----------------------------------
Menu Sticky
-----------------------------------*/
let header = $('.transparent-bar');
let win = $(window);

win.on('scroll', function() {
    let scroll = win.scrollTop();
    if (scroll < 30) {
        header.removeClass('stick');
    } else {
        header.addClass('stick');
    }
});

/************** Menu Icon **************/

$(".navbar-toggler").on('click',function () {

    if($(".menu-icon").hasClass("fa-bars")){
        $(".menu-icon").removeClass("fa-bars").addClass("fa-times");
    }else{
        $(".menu-icon").removeClass("fa-times").addClass("fa-bars");
    }
});


/* Slider active */
$('.slider-active').owlCarousel({
    loop: true,
    nav: true,
    autoplay: false,
    autoplayTimeout: 5000,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    item: 1,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});

/*----------------------------
       Cart Plus Minus Button
   ------------------------------ */
let CartPlusMinus = $('.cart-plus-minus');
CartPlusMinus.prepend('<div class="dec qty_button">-</div>');
CartPlusMinus.append('<div class="inc qty_button">+</div>');
$(".qty_button").on("click", function() {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.text() === "+") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
        }
    }
    $button.parent().find("input").val(newVal);
});





