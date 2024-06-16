

(function ($) {
    "use strict";

    var $window = $(window),
    $body = $("body");
  
    $( ".banner" ).each(function() {
        var attr = $(this).attr('data-image-src');
        if (typeof attr !== typeof undefined && attr !== false) {
            $(this).css("background-image", "url("+attr+")");
        }
    });

    $("[data-bg-color]").each(function () {
        $(this).css("background-color", $(this).data("bg-color"));
    });


    $(document).ready(function() {
        var slide1 = new Swiper(".slide_1", {
            slidesPerView: 1,
            speed: 1000,
            loop: true,
            spaceBetween: 0,
            slidesPerGroup: 1,
            autoplay: true,
            navigation: {
                nextEl: ".swiper-button-next-custom-1",
                prevEl: ".swiper-button-prev-custom-1",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                1400: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },
                1200: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                992: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                768: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                576: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                0: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },
            },
        });
        var slide2 = new Swiper(".slide_2", {
            slidesPerView: 1,
            speed: 1000,
            loop: true,
            spaceBetween: 0,
            slidesPerGroup: 1,
            autoplay: true,
            navigation: {
                nextEl: ".swiper-button-next-custom-1",
                prevEl: ".swiper-button-prev-custom-1",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                1400: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },
                1200: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                992: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                768: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                576: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                0: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },
            },
        });
        var slide3 = new Swiper(".slide_3", {
            slidesPerView: 1,
            speed: 1000,
            loop: true,
            spaceBetween: 0,
            slidesPerGroup: 1,
            autoplay: true,
            breakpoints: {
                1400: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },
                1200: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                992: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                768: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                576: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },

                0: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                },
            },
        });
        var slideBanner = new Swiper(".slide_banner", {
            slidesPerView: 1,
            speed: 1000,
            loop: true,
            spaceBetween: 0,
            slidesPerGroup: 1,
            effect: "fade",
            autoplay: false,
            navigation: {
                nextEl: ".section_banner .swiper-button-next",
                prevEl: ".section_banner .swiper-button-prev",
            },
        });
        var slideProduct1 = new Swiper(".slide_product_1", {
            speed: 500,
            loop: true,
            spaceBetween: 10,
            slidesPerView: 7,
            slidesPerGroup: 7,
            touchRatio: 2,
            autoplay: false,
            navigation: {
                nextEl: ".slide_product_1 .swiper-button-next",
                prevEl: ".slide_product_1 .swiper-button-prev",
            },
            breakpoints: {
                992: {
                    slidesPerView: 7,
                    slidesPerGroup: 7,
                },
                0: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    pagination: {
                        el: ".slide_product_1 .swiper-pagination",
                        clickable: true,
                    },
                },
            },
        });

        var slideProduct2 = new Swiper(".slide_product_2", {
            speed: 500,
            loop: true,
            spaceBetween: 10,
            slidesPerView: 6,
            slidesPerGroup: 6,
            touchRatio: 2,
            autoplay: false,
            navigation: {
                nextEl: ".slide_product_2 .swiper-button-next",
                prevEl: ".slide_product_2 .swiper-button-prev",
            },
            breakpoints: {
                992: {
                    slidesPerView: 7,
                    slidesPerGroup: 7,
                },
                0: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    pagination: {
                        el: ".slide_product_2 .swiper-pagination",
                        clickable: true,
                    },
                },
            },
        });

        var swiperProductDetail = new Swiper('.swiper-product-detail', {
            spaceBetween: 0,
            slidesPerView: 1,
            slidesPerGroup: 1,
            thumbs: {
                swiper: {
                    el: '.swiper-container-thumbs',
                    slidesPerView: 4,
                    spaceBetween: 25,
                },
            },
        });



        // function setDivsHeight() {
        //     let divsInCurrentSlide = $('.item_product_nation');
        //     let maxHeight = 0;
        //     divsInCurrentSlide.each(function () {
        //         let divHeight = $(this).height();
        //         maxHeight = Math.max(maxHeight, divHeight);
        //     });
        //     divsInCurrentSlide.height(maxHeight);
        // }
    });
    function initSwiper() {
        var isMobile = window.innerWidth <= 991; // Giả sử độ rộng dưới 768px là mobile

        if (isMobile) {
            var slideProduct3 = new Swiper(".slide_product_3", {
                speed: 1000,
                loop: false,
                spaceBetween: 15,
                slidesPerView: 3,
                slidesPerGroup: 3,
                autoplay: false,
                navigation: {
                    nextEl: ".slide_product_3 .swiper-button-next",
                    prevEl: ".slide_product_3 .swiper-button-prev",
                },
                pagination: {
                    el: ".slide_product_3 .swiper-pagination",
                    clickable: true,
                },
            });
        } else {
            var slideProduct3 = new Swiper(".slide_product_3", {
                direction: 'vertical',
                speed: 1000,
                loop: false,
                spaceBetween: 10,
                slidesPerView: 4,
                slidesPerGroup: 4,
                mousewheel: true,
                autoplay: false,
                navigation: {
                    nextEl: ".slide_product_3 .swiper-button-next",
                    prevEl: ".slide_product_3 .swiper-button-prev",
                }
            });
        }
    }
    window.addEventListener('load', initSwiper);



    $(document).on('click', '.btn-sidebar', function(){
        $(this).toggleClass('open');
        $('.wrap_menu_fixed').toggleClass('active');
        $('.bg_backgdrop').toggleClass('active');
    });

    $(document).on('click', '.bg_backgdrop', function (){
        $(this).toggleClass('active');
        $('.btn-sidebar').toggleClass('open');
        $('.wrap_menu_fixed').toggleClass('active');
    });

    $(window).scroll(function () {
        var scrollPosition = $(window).scrollTop();
        if (scrollPosition > 2) {
            $(".header_top").addClass("active");
        } else {
            $(".header_top").removeClass("active");
        }
    });
    $(window).on("load", function () {
        AOS.init({
          easing: "ease", // default easing for AOS animations
          once: true, // whether animation should happen only once - while scrolling down
        });
    });

})(window.jQuery);
  