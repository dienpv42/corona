(function ($) {
    "use strict";

    var $window = $(window),
        $body = $("body");

    var slideProduct1, slideProduct2; // Declare variables at the top level

    $(document).ready(function() {
        // Set background image from data attribute
        $(".banner").each(function() {
            var attr = $(this).attr('data-image-src');
            if (attr) {
                $(this).css("background-image", "url(" + attr + ")");
            }
        });

        // Set background color from data attribute
        $("[data-bg-color]").each(function() {
            $(this).css("background-color", $(this).data("bg-color"));
        });

        function calculateSpaceBetween() {
            var width = window.innerWidth;
            if (width > 1921) {
                return 16;
            } else if (width >= 992) {
                return width * 0.0083333333333; // 0.83333333333%
            } else if (width >= 575) {
                return width * 0.012;
            } else {
                return width * 0.032; // 3.2%
            }
        }

        var spaceBetweenVW = calculateSpaceBetween();

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

        var adsBannerSlider = new Swiper(".ads_banner_slider", {
            slidesPerView: 2.1,
            speed: 500,
            loop: true,
            spaceBetween: spaceBetweenVW,
            slidesPerGroup: 2,
            autoplay: false,
            breakpoints: {
                576: {
                    slidesPerView: 2.1,
                    slidesPerGroup: 2,
                },
                0: {
                    slidesPerView: 1.1,
                    slidesPerGroup: 1,
                },
            },
        });

        slideProduct1 = new Swiper(".slide_product_1", {
            speed: 500,
            loop: true,
            spaceBetween: spaceBetweenVW,
            slidesPerView: 7,
            slidesPerGroup: 7,
            touchRatio: 2,
            autoplay: false,
            navigation: {
                nextEl: ".slide_product_1 .swiper-button-next",
                prevEl: ".slide_product_1 .swiper-button-prev",
            },
            breakpoints: {
                1921: {
                    slidesPerView: 7,
                    slidesPerGroup: 7,
                    spaceBetween: 16,
                },
                992: {
                    slidesPerView: 7,
                    slidesPerGroup: 7,
                    spaceBetween: window.innerWidth * 0.0083333333333,
                },
                575: {
                    slidesPerView: 4.2,
                    slidesPerGroup: 4,
                    spaceBetween: window.innerWidth * 0.012,
                },
                0: {
                    slidesPerView: 2.1,
                    slidesPerGroup: 2,
                    spaceBetween: window.innerWidth * 0.032,
                },
            },
        });

        slideProduct2 = new Swiper(".slide_product_2", {
            speed: 500,
            loop: true,
            spaceBetween: spaceBetweenVW,
            slidesPerView: 6,
            slidesPerGroup: 6,
            touchRatio: 2,
            autoplay: false,
            navigation: {
                nextEl: ".slide_product_2 .swiper-button-next",
                prevEl: ".slide_product_2 .swiper-button-prev",
            },
            breakpoints: {
                1921: {
                    slidesPerView: 6,
                    slidesPerGroup: 6,
                    spaceBetween: 16,
                },
                992: {
                    slidesPerView: 6,
                    slidesPerGroup: 6,
                    spaceBetween: window.innerWidth * 0.0083333333333,
                },
                575: {
                    slidesPerView: 4.2,
                    slidesPerGroup: 4,
                    spaceBetween: window.innerWidth * 0.012,
                },
                0: {
                    slidesPerView: 2.1,
                    slidesPerGroup: 2,
                    spaceBetween: window.innerWidth * 0.032,
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
                    breakpoints: {
                        1921: {
                            spaceBetween: 25,

                        },
                        992: {
                            spaceBetween: 25,
                        },
                        575: {
                            spaceBetween: window.innerWidth * 0.012,
                        },
                        0: {
                            slidesPerView: 2.1,
                            slidesPerGroup: 2,
                            spaceBetween: window.innerWidth * 0.032,
                        },
                    },
                },
            },
        });

        // window.addEventListener('resize', function() {
        //     var newSpaceBetweenVW = calculateSpaceBetween();
        //
        //     if (slideProduct1) {
        //         slideProduct1.params.spaceBetween = newSpaceBetweenVW;
        //         slideProduct1.update();
        //     } else {
        //         console.error('slideProduct1 is undefined');
        //     }
        //
        //     if (slideProduct2) {
        //         slideProduct2.params.spaceBetween = newSpaceBetweenVW;
        //         slideProduct2.update();
        //     } else {
        //         console.error('slideProduct2 is undefined');
        //     }
        // });

        // Check scroll position on page load
        function checkScrollPosition() {
            var scrollPosition = $window.scrollTop();
            $(".header, .header_top").toggleClass("active", scrollPosition > 2);
        }

        // Check scroll position on page load and scroll
        $window.on('scroll', checkScrollPosition);
        checkScrollPosition();
    });

    function initSwiper() {
        var isMobile = window.innerWidth <= 991;

        if (isMobile) {
            new Swiper(".slide_product_3", {
                speed: 1000,
                loop: true,
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
            new Swiper(".slide_product_d", {
                speed: 1000,
                loop: true,
                spaceBetween: 10,
                slidesPerView: 4,
                slidesPerGroup: 4,
                autoplay: false,
                breakpoints: {
                    992: {
                        slidesPerView: 4,
                        navigation: false,
                        slidesPerGroup: 4,
                    },
                    575: {
                        slidesPerView: 4.2,
                        slidesPerGroup: 4,
                        spaceBetween: window.innerWidth * 0.012,
                    },
                    0: {
                        slidesPerView: 2.1,
                        slidesPerGroup: 2,
                        spaceBetween: window.innerWidth * 0.032,
                    },
                },
            });
        } else {
            new Swiper(".slide_product_3", {
                direction: 'vertical',
                speed: 1000,
                loop: true,
                spaceBetween: 10,
                slidesPerView: 4,
                slidesPerGroup: 4,
                mousewheel: true,
                autoplay: false,
                navigation: {
                    nextEl: ".slide_product_3 .swiper-button-next",
                    prevEl: ".slide_product_3 .swiper-button-prev",
                },
            });
            new Swiper(".slide_product_d", {
                direction: 'vertical',
                speed: 1000,
                loop: true,
                slidesPerView: 4,
                slidesPerGroup: 4,
                mousewheel: true,
                autoplay: false,
                navigation: {
                    nextEl: ".swiper-button-next-d",
                    prevEl: ".swiper-button-prev-d",
                },
            });
        }
    }

    window.addEventListener('load', initSwiper);

    $(document).on('click', '.btn-sidebar', function() {
        $(this).toggleClass('open');
        $('.wrap_menu_fixed, .bg_backgdrop').toggleClass('active');
    });

    $('.btn-show-categories').on('click', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
        $('.wrap_more_categories').toggleClass('active');
    });


    $(document).on('click', '.bg_backgdrop', function() {
        $(this).toggleClass('active');
        $('.btn-sidebar, .wrap_menu_fixed').toggleClass('active');
    });

    $window.on("load", function() {
        AOS.init({
            easing: "ease",
            once: true,
        });
    });

})(window.jQuery);
