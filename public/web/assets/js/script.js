// $("#flexSwitchCheckDefault").change(function() {
    $('body').toggleClass("rtl");
// });

//-----JS for Price Range slider-----

$(function () {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 900,
        values: [0, 300],
        slide: function (event, ui) {
            $("#amount").val("SAR " + ui.values[0] + "k" + " - " + ui.values[1] + "k");
        }
    });
    $("#amount").val("SAR " + $("#slider-range").slider("values", 0) + "k" + " - " + $("#slider-range").slider("values", 1) + "k");
});

$("#min_amount").val(parseInt(min));
$("#max_amount").val(parseInt(max));
$("#min_ratting").val(parseInt(min_ratting));
$("#max_ratting").val(parseInt(max_ratting));
$(function () {
    $("#slider-range-price").slider({
        range: true,
        min: parseInt(min),
        max: parseInt(max),
        values: [parseInt(min), parseInt(max)],
        slide: function (event, ui) {
            console.log(ui)
            $("#min_amount").val(ui.values[0]);
            $("#max_amount").val(ui.values[1]);
            $("#amount").val("SAR " + ui.values[0] + "  " + "k" + " - " + ui.values[1] + "  " + "k");
        }
})
    ;
    $("#amount").val("SAR " + $("#slider-range-price").slider("values", 0) + "k" + " - " + $("#slider-range").slider("values", 1) + "k");
});


$(function () {
    $("#year-range").slider({
        range: true,
        min: 2006,
        max: 2040,
        values: [0, 2023],
        slide: function (event, ui) {
            $("#year").val(ui.values[0] + " - " + ui.values[1]);
        }
    });
    $("#year").val($("#year-range").slider("values", 0) + " - " + $("#year-range").slider("values", 1));
});


$(function () {
    $("#ratings-range").slider({
        range: true,
        min: parseInt(min_ratting),
        max: parseInt(max_ratting),
        values: [min_ratting, max_ratting],
        slide: function (event, ui) {
            $("#ratings").val(ui.values[0] + " - " + ui.values[1]);
            $("#min_ratting").val(ui.values[0]);
            $("#max_ratting").val(ui.values[1]);
        }
    });
    $("#ratings").val($("#ratings-range").slider("values", 0) + " - " + $("#ratings-range").slider("values", 1));
});

$(function () {
    $("#slider-incamount").slider({
        range: true,
        min: parseInt(min),
        max: parseInt(max),
        values: [parseInt(min), parseInt(max)],
        slide: function (event, ui) {
            $("#incamount").val("SAR " + ui.values[0]);
        }
    });
    $("#amount").val("SAR " + $("#slider-incamount").slider("values", 0));
});


$(".btn-filter").click(function () {
    $(".filter").toggleClass("show-opt");
});

$(".close-filter").click(function () {
    $(".filter").toggleClass("show-opt");
});

$(".int-box .place-bid-blue").click(function () {
    $(".bid-model").toggleClass("show-footeer");
});

$(document).ready(function () {
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

// if($(".product-left").length){
// 		var productSlider = new Swiper('.product-slider', {
// 				spaceBetween: 0,
// 				centeredSlides: false,
// 				loop:true,
// 				direction: 'horizontal',
// 				loopedSlides: 3,
// 				navigation: {
// 						nextEl: ".swiper-button-next",
// 						prevEl: ".swiper-button-prev",
// 				},
// 				resizeObserver:true,
// 		});
// 		var productThumbs = new Swiper('.product-thumbs', {
// 				spaceBetween: 0,
// 				centeredSlides: true,
// 				loop: true,
// 				slideToClickedSlide: true,
// 				direction: 'horizontal',
// 				slidesPerView: 3,
// 				loopedSlides: 3,
// 		});
// 		productSlider.controller.control = productThumbs;
// 		productThumbs.controller.control = productSlider;
// };


$(".update-bid").click(function () {
    $(".bid-model").addClass("show-footeer");
});


function Rating(classname) {
    // Selecting rating container based on class added in functions parameter
    const rating_container = document.querySelector("." + classname);
    // if condition to check if that exists to eleminate console errors
    if (rating_container) {
        // Selecting all rating values
        const ratingNumbers = rating_container.querySelectorAll(".rating");
        // Selecting the input of the rating value
        const ratingValue = rating_container.querySelector("input.ratingvalue");
        // Looping in Rating values
        ratingNumbers.forEach((rating, index) => {
            // Selecting each rating value and bind a onclick event
            rating.addEventListener("click", () => {
                // Checking and removing active class from all unsed values
                for (let j = index + 1; j < ratingNumbers.length; j++) {
                    ratingNumbers[j].classList.remove("active");
                }
                // Checking and adding active class from all needed ratings
                for (let i = 0; i <= index; i++) {
                    ratingNumbers[i].classList.add("active");
                }
                ratingValue.value = index + 1;
            }); // each rating event closing
        }); // rating number foreach loop closing
    } //If condition closing
} // Function Closing

// Calling function with secondary as parameter
Rating("secondary");


function updateList() {

    var input = document.getElementById('file');
    // Create list or array
    var list = [];
    for (var i = 0, len = input.files.length; i < len; ++i) {
        list.push(input.files.item(i));
    }
    // Output file list
    outputList(list);
}

function outputList(list) {

    var output = document.getElementById('fileList');
    while (output.hasChildNodes()) {
        output.removeChild(output.lastChild);
    }

    var nodes = document.createElement('ul');
    for (var i = 0, len = list.length; i < len; ++i) (function (i) {

        var node = document.createElement('li');
        var filename = document.createTextNode(list[i].name);

        var removeLink = document.createElement('a');

        removeLink.href = 'javascript:void(0)';
        removeLink.innerHTML = '<i class="las la-trash-alt"></i>';
        removeLink.onclick = function () {
            // Remove item
            list.splice(i, 1);
            outputList(list);
        }

        node.appendChild(filename);
        node.appendChild(removeLink);
        nodes.appendChild(node);
    })(i);

    output.appendChild(nodes);
}


function updateList1() {

    var input = document.getElementById('file1');
    // Create list or array
    var list = [];
    for (var i = 0, len = input.files.length; i < len; ++i) {
        list.push(input.files.item(i));
    }
    // Output file list
    outputList1(list);
}

function outputList1(list) {

    var output = document.getElementById('fileList1');
    while (output.hasChildNodes()) {
        output.removeChild(output.lastChild);
    }

    var nodes = document.createElement('ul');
    for (var i = 0, len = list.length; i < len; ++i) (function (i) {

        var node = document.createElement('li');
        var filename = document.createTextNode(list[i].name);

        var removeLink = document.createElement('a');

        removeLink.href = 'javascript:void(0)';
        removeLink.innerHTML = '<i class="las la-trash-alt"></i>';
        removeLink.onclick = function () {
            // Remove item
            list.splice(i, 1);
            outputList1(list);
        }

        node.appendChild(filename);
        node.appendChild(removeLink);
        nodes.appendChild(node);
    })(i);

    output.appendChild(nodes);
}
