//-----JS for Price Range slider-----

$(function() {
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 900,
        values: [ 0, 300 ],
        slide: function( event, ui ) {
            $( "#amount" ).val("SAR " + ui.values[ 0 ] + "k" + " - " + ui.values[ 1 ] + "k");
        }
    });
    $( "#amount" ).val("SAR " + $( "#slider-range" ).slider( "values", 0 ) + "k" + " - " + $( "#slider-range" ).slider( "values", 1 ) + "k");
});



$(function() {
    $( "#year-range" ).slider({
        range: true,
        min: 2006,
        max: 2040,
        values: [ 0, 2023 ],
        slide: function( event, ui ) {
            $( "#year" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
        }
    });
    $( "#year" ).val($( "#year-range" ).slider( "values", 0 ) + " - " + $( "#year-range" ).slider( "values", 1 ));
});


$(function() {
    $( "#ratings-range" ).slider({
        range: true,
        min: 0,
        max: 10,
        values: [ 0, 5 ],
        slide: function( event, ui ) {
            $( "#ratings" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
        }
    });
    $( "#ratings" ).val($( "#ratings-range" ).slider( "values", 0 ) + " - " + $( "#ratings-range" ).slider( "values", 1 ));
});

$(function() {
    $( "#slider-incamount" ).slider({
        range: true,
        min: 10,
        max: 1200,
        values: [500, 1200],
        slide: function( event, ui ) {
            $( "#incamount" ).val("SAR " + ui.values[ 0 ]);
        }
    });
    $( "#amount" ).val("SAR " + $( "#slider-incamount" ).slider( "values", 0 ));
});


$(".btn-filter").click(function(){
    $(".filter").toggleClass("show-opt");
});

$(".int-box .place-bid-blue").click(function(){
    $(".bid-model").toggleClass("show-footeer");
});

$(document).ready(function() {
    $('.testimonial-slider').slick({
        autoplay: true,
        autoplaySpeed: 50000,
        speed: 1000,
        draggable: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});

$(function () {
    $(document).scroll(function () {
        var $nav = $(".main-nav");
        $nav.toggleClass('scrollpage', $(this).scrollTop() > $nav.height());
    });
});

if($(".product-left").length){
    var productSlider = new Swiper('.product-slider', {
        spaceBetween: 0,
        centeredSlides: false,
        loop:true,
        direction: 'horizontal',
        loopedSlides: 3,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        resizeObserver:true,
    });
    var productThumbs = new Swiper('.product-thumbs', {
        spaceBetween: 0,
        centeredSlides: true,
        loop: true,
        slideToClickedSlide: true,
        direction: 'horizontal',
        slidesPerView: 3,
        loopedSlides: 3,
    });
    productSlider.controller.control = productThumbs;
    productThumbs.controller.control = productSlider;
};
