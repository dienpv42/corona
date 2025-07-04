/***************************************************

 ==================== JS INDEX ======================

 ****************************************************

 01. PreLoader Js

 02. Info Bar Js

 03. Data-Background Js

 04. Sticky Header Js

 05. Mobile Menu Js

 06. Scroll To Top Js

 07. Hero Slider Js

 08. Case Slider Js

 09. Client Slider Js

 10. Testimonial Slider Js

 11. Testimonial Slider 2 Js

 12. Testimonial Slider 3 Js

 13. Award Slider Js

 14. Team Achivement Slider Js

 15. Project Slider Js

 16. Post Box Slider Js

 17. Masonary Js

 18. Nice Select Js

 19. WoW Js

 20. Counter Js

 ****************************************************/
(function ($) {
  "use strict";

  ////////////////////////////////////////////////////

  // 01. PreLoader Js

  $(window).on("load", function () {
    $("#loading").fadeOut(500);
  });

  ////////////////////////////////////////////////////

  // 02. Info Bar Js

  $(".info-toggle-btn").on("click", function () {
    $(".info__area").addClass("info-opened");

    $(".body-overlay").addClass("opened");
  });

  $(".info-close-btn").on("click", function () {
    $(".info__area").removeClass("info-opened");

    $(".body-overlay").removeClass("opened");
  });

  $(".body-overlay").on("click", function () {
    $(".info__area").removeClass("info-opened");

    $(".body-overlay").removeClass("opened");
  });

  ////////////////////////////////////////////////////

  // 03. Sticky Header Js

  $(window).on("scroll", function () {
    const scroll = $(window).scrollTop();
    const header = $("#header-sticky");
    const logo = header.find(".logo img"); // Lấy phần tử <img> bên trong .logo

    if (scroll > 100) {
      header.addClass("sticky");
      logo.attr("src", logo.attr("data-src-sticky-color")); // Đổi ảnh sang logo sticky
    } else {
      header.removeClass("sticky");
      logo.attr("src", logo.attr("data-src-sticky-w")); // Đổi về ảnh gốc
    }
  });
  //menu news
  $(window).on("scroll", function () {
    const scroll = $(window).scrollTop();
    const header = $(".section-menu2");

    if (scroll > 350) {
      header.addClass("sticky-menu2");
    } else {
      header.removeClass("sticky-menu2");
    }
  });
  //menu fixed-menu
  $(window).on("scroll", function () {
    const scroll = $(window).scrollTop();
    const header = $(".fixed-menu");

    if (scroll > 350) {
      header.addClass("sticky-fixed-menu");
    } else {
      header.removeClass("sticky-fixed-menu");
    }
  });

  ////////////////////////////////////////////////////

  // 04. Data-Background Js

  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url( " + $(this).attr("data-background") + "  )"
    );
  });

  ////////////////////////////////////////////////////

  // 05. Mobile Menu Js

  // Kích hoạt metisMenu nếu cần
  $("#mobile-menu-active").metisMenu();

  $(".side-mobile-menu ul li.has-dropdown > a").on("click", function (e) {
    const linkWidth = this.clientWidth; // Chiều rộng của thẻ <a>
    const clickPosition = e.offsetX; // Vị trí click bên trong thẻ <a>
    const isAfterClick = clickPosition > linkWidth - 30; // Kiểm tra nếu click gần phải (gần mũi tên)

    if (isAfterClick) {
        e.preventDefault(); // Ngăn chuyển hướng khi click vào ::after
        const $this = $(this); // Chuyển sang jQuery object để dễ thao tác
        const isExpanded = $this.attr("aria-expanded") === "true";
        const submenu = $this.siblings(".submenu");

        if (isExpanded) {
            submenu.stop(true, true).slideUp(300, function () {
                $(this).css("height", ""); // Xóa style height sau khi ẩn
            });
            $this.attr("aria-expanded", "false");
        } else {
            submenu.stop(true, true).slideDown(300, function () {
                $(this).css("height", ""); // Xóa style height sau khi hiển thị
            });
            $this.attr("aria-expanded", "true");
        }
    }
});

  ////////////////////////////////////////////////////

  // 06. Scroll To Top Js

  function smoothSctollTop() {
    $(".smooth-scroll a").on("click", function (event) {
      var target = $(this.getAttribute("href"));

      if (target.length) {
        event.preventDefault();

        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: target.offset().top - 0,
            },
            500
          );
      }
    });
  }

  smoothSctollTop();

  // Show or hide the sticky footer button

  $(window).on("scroll", function (event) {
    if ($(this).scrollTop() > 600) {
      $("#scroll").fadeIn(200);
    } else {
      $("#scroll").fadeOut(200);
    }
  });

  // $(".smooth-scroll-down").on("click", function (event) {
  //   var target = $(this.getAttribute("href"));
  //
  //   if (target.length) {
  //     event.preventDefault();
  //
  //     $("html, body").animate(
  //         {
  //           scrollTop: target.offset().top - 70,
  //         },
  //         {
  //           duration: 400,
  //           easing: 'swing'
  //         }
  //     );
  //   }
  // });

  $('.smooth-scroll-down').on('click', function(e) {

    var target = $(this).attr('href').split('#')[1];

    if(target) {
      var targetElement = $('#' + target);
      var targetOffset = targetElement.offset().top;

      // Cuộn đến vị trí phần tử, trừ đi 70px
      $('html, body').animate({
        scrollTop: targetOffset - 70
      }, 200);
    }
  });


  //Animate the scroll to yop

  $("#scroll").on("click", function (event) {
    event.preventDefault();
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      100
    );
  });

  ////////////////////////////////////////////////////

  // 07. Hero Slider Js

  function mainSlider() {
    var BasicSlider = $(".slider-active");

    BasicSlider.on("init", function (e, slick) {
      var $firstAnimatingElements = $(".single-slider:first-child").find(
        "[data-animation]"
      );

      doAnimations($firstAnimatingElements);
    });

    BasicSlider.on(
      "beforeChange",
      function (e, slick, currentSlide, nextSlide) {
        var $animatingElements = $(
          '.single-slider[data-slick-index="' + nextSlide + '"]'
        ).find("[data-animation]");

        doAnimations($animatingElements);
      }
    );

    BasicSlider.slick({
      autoplay: true,

      autoplaySpeed: 8000,

      dots: true,

      fade: true,

      arrows: true,

      prevArrow:
        '<button type="button" class="slick-prev"><i class="fal fa-angle-left"></i></button>',

      nextArrow:
        '<button type="button" class="slick-next"><i class="fal fa-angle-right"></i></button>',

      responsive: [
        {
          breakpoint: 767,

          settings: {
            dots: false,

            arrows: false,
          },
        },
      ],
    });

    function doAnimations(elements) {
      var animationEndEvents =
        "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";

      elements.each(function () {
        var $this = $(this);

        var $animationDelay = $this.data("delay");

        var $animationType = "animated " + $this.data("animation");

        $this.css({
          "animation-delay": $animationDelay,

          "-webkit-animation-delay": $animationDelay,
        });

        $this.addClass($animationType).one(animationEndEvents, function () {
          $this.removeClass($animationType);
        });
      });
    }
  }

  mainSlider();

  ////////////////////////////////////////////////////

  // 08. Case Slider Js

  $(".case__slider-active").slick({
    centerMode: true,

    centerPadding: "0px",

    dots: false,

    arrows: false,

    infinite: true,

    speed: 700,

    slidesToShow: 3,

    slidesToScroll: 1,

    autoplay: false,

    responsive: [
      {
        breakpoint: 1024,

        settings: {
          slidesToShow: 3,

          slidesToScroll: 1,

          infinite: true,
        },
      },

      {
        breakpoint: 991,

        settings: {
          slidesToShow: 2,

          slidesToScroll: 1,

          infinite: true,
        },
      },

      {
        breakpoint: 767,

        settings: {
          slidesToShow: 1,

          slidesToScroll: 1,
        },
      },

      {
        breakpoint: 576,

        settings: {
          slidesToShow: 1,

          slidesToScroll: 1,
        },
      },
    ],
  });

  ////////////////////////////////////////////////////

  // 09. Client Slider Js

  $(".client__slider-active").owlCarousel({
    loop: true,

    margin: 30,

    autoplay: false,

    autoplayTimeout: 3000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><i class="fa fa-angle-left"></i>PREV</button>',
      '<button>NEXT<i class="fa fa-angle-right"></i></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,
      },

      767: {
        items: 2,
      },

      992: {
        items: 3,
      },

      1200: {
        items: 4,
      },

      1600: {
        items: 5,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 10. Testimonial Slider Js

  $(".testimonial__slider").owlCarousel({
    loop: true,

    margin: 30,

    autoplay: true,

    autoplayTimeout: 5000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><i class="far fa-angle-left"></i></button>',
      '<button><i class="far fa-angle-right"></i></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 4,
      },

      767: {
        items: 4,
      },

      992: {
        items: 4,
      },

      1200: {
        items: 6,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 11. Testimonial Slider 2 Js

  $(".testimonial__slider-2-active").owlCarousel({
    loop: true,

    margin: 30,

    autoplay: true,

    autoplayTimeout: 5000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><i class="fas fa-angle-left"></i></button>',
      '<button><i class="fas fa-angle-right"></i></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 3,
      },

      767: {
        items: 4,
      },

      992: {
        items: 5,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 12. Testimonial Slider 3 Js

  $(".testimonial__slider-3").owlCarousel({
    loop: true,

    margin: 0,

    autoplay: false,

    autoplayTimeout: 3000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><i class="fal fa-long-arrow-left"></i></button>',
      '<button><i class="fal fa-long-arrow-right"></i></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,
      },

      767: {
        items: 1,
      },

      992: {
        items: 1,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 13. Award Slider Js

  $(".award__slider-active").owlCarousel({
    loop: true,

    margin: 30,

    autoplay: false,

    autoplayTimeout: 3000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><span class="owl-arrow prev-arrow"></span></button>',
      '<button><span class="owl-arrow next-arrow"></span></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 2,
      },

      767: {
        items: 3,
      },

      992: {
        items: 3,
      },

      1200: {
        items: 3,
      },

      1600: {
        items: 5,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 14. Team Achivement Slider Js

  $(".team__achivement-slider").owlCarousel({
    loop: true,

    margin: 30,

    autoplay: false,

    autoplayTimeout: 3000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><span class="owl-arrow prev-arrow"></span></button>',
      '<button><span class="owl-arrow next-arrow"></span></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 2,
      },

      767: {
        items: 3,
      },

      992: {
        items: 3,
      },

      1200: {
        items: 5,
      },

      1600: {
        items: 5,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 15. Project Slider Js

  $(".project__slider-active").owlCarousel({
    loop: true,

    margin: 20,

    autoplay: true,

    autoplayTimeout: 2000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><i class="fal fa-angle-left"></i></button>',
      '<button><i class="fal fa-angle-right"></i></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,
      },

      767: {
        items: 2,
      },

      992: {
        items: 2,
      },

      1200: {
        items: 3,
      },

      1600: {
        items: 4,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 16. Post Box Slider Js

  $(".postbox__gallery").owlCarousel({
    loop: true,

    margin: 0,

    autoplay: false,

    autoplayTimeout: 3000,

    smartSpeed: 500,

    items: 6,

    navText: [
      '<button><i class="far fa-arrow-left"></i></button>',
      '<button><i class="far fa-arrow-right"></i></button>',
    ],

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,
      },

      767: {
        items: 1,
      },

      992: {
        items: 1,
      },
    },
  });

  ////////////////////////////////////////////////////

  // 17. Masonary Js

  $(".grid").imagesLoaded(function () {
    // init Isotope

    var $grid = $(".grid").isotope({
      itemSelector: ".grid-item",

      percentPosition: true,

      masonry: {
        // use outer width of grid-sizer for columnWidth

        columnWidth: ".grid-item",
      },
    });

    // filter items on button click

    $(".masonary-menu").on("click", "button", function () {
      var filterValue = $(this).attr("data-filter");

      $grid.isotope({
        filter: filterValue,
      });
    });

    //for menu active class

    $(".masonary-menu button").on("click", function (event) {
      $(this).siblings(".active").removeClass("active");

      $(this).addClass("active");

      event.preventDefault();
    });
  });

  ////////////////////////////////////////////////////

  // 18. Nice Select Js

  $("select").niceSelect();

  ////////////////////////////////////////////////////

  // 19. WoW Js

  new WOW().init();

  ////////////////////////////////////////////////////

  // 20. Counter Js

  $(".counter").counterUp({
    delay: 10,

    time: 1000,
  });

  document.querySelectorAll(".vii-home-banner").forEach((wrapper) => {
    const slider = wrapper.querySelector(".vii-home-banner__slider-inner");
    const flickity = new FlickityExtend(slider, {
      contain: !0,
      pageDots: !0,
      prevNextButtons: !1,
      groupCells: "100%",
      fade: !0,
      pauseAutoPlayOnHover: !1,
      autoPlay: parseFloat(wrapper.getAttribute("data-autoplay")) * 1000,
      wrapAround: wrapper.classList.contains("is-loop"),
    });
    wrapper
      .querySelector(".vii-home-banner__scroll-down button")
      .addEventListener("click", () => {
        VIIVUE.scrollTo(document.querySelector(".site-content"), -20);
      });
  });

  //cursor
  $(document).ready(function () {
    const $cursor = $(".cursor");
    const $cursorInner = $(".cursor-inner");
    const $links = $("a");

    $(document).on("mousemove", function (e) {
      const x = e.clientX;
      const y = e.clientY;
      $cursor.css(
        "transform",
        `translate3d(calc(${x}px - 50%), calc(${y}px - 50%), 0)`
      );
    });

    $(document).on("mousemove", function (e) {
      const x = e.clientX;
      const y = e.clientY;
      $cursorInner.css({
        left: `${x}px`,
        top: `${y}px`,
      });
    });

    $(document).on("mousedown", function () {
      $cursor.addClass("click");
      $cursorInner.addClass("cursorinnerhover");
    });

    $(document).on("mouseup", function () {
      $cursor.removeClass("click");
      $cursorInner.removeClass("cursorinnerhover");
    });

    $links.on("mouseover", function () {
      $cursor.addClass("hover");
    });

    $links.on("mouseleave", function () {
      $cursor.removeClass("hover");
    });
  });
  // accordion
  $(document).ready(function () {
    // Khi bấm vào nút accordion
    $(".accordion .faq-accordion-btn").on("click", function () {
      // Đóng tất cả các collapse trừ mục hiện tại
      $("#accordion .collapse").not($(this).data("target")).collapse("hide");

      // Mở hoặc đóng mục hiện tại
      $($(this).data("target")).collapse("toggle");
    });

    // Cập nhật trạng thái nút khi collapse được đóng hoặc mở
    $(".accordion .collapse").on("shown.bs.collapse", function () {
      $(this)
        .prev(".card-header")
        .find(".faq-accordion-btn")
        .removeClass("collapsed")
        .attr("aria-expanded", "true");
    });

    $(".accordion .collapse").on("hidden.bs.collapse", function () {
      $(this)
        .prev(".card-header")
        .find(".faq-accordion-btn")
        .addClass("collapsed")
        .attr("aria-expanded", "false");
    });
  });
  //
  $(document).ready(function () {
    const spaceBetweenVW = 20; // Định nghĩa giá trị `spaceBetweenVW` nếu cần
    const slideMember = new Swiper(".slide_member", {
      speed: 500,
      spaceBetween: spaceBetweenVW,
      slidesPerView: 6,
      grid: {
        rows: 2,
      },
      autoplay: true,
      navigation: {
        nextEl: ".section_member .swiper-button-next",
        prevEl: ".section_member .swiper-button-prev",
      },
      pagination: {
        el: ".section_member .swiper-pagination",
        type: "fraction",
      },
      breakpoints: {
        1280: {
          slidesPerView: 6,
          grid: {
            rows: 2,
          },
        },
        992: {
          slidesPerView: 5,
          grid: {
            rows: 2,
          },
        },
        0: {
          spaceBetween: spaceBetweenVW,
          slidesPerView: 4,
          grid: {
            rows: 2,
          },
        },
      },
    });
    $(".slide_member").removeClass("hide");
  });
  //
  $(document).ready(function () {
    const spaceBetweenVW = 20; // Khoảng cách giữa các slide (đơn vị VW)

    const slideMember = new Swiper(".slide_library", {
      speed: 1500,
      spaceBetween: spaceBetweenVW,
      slidesPerView: 3,
      grid: {
        rows: 1,
      },
      autoplay: true,
      navigation: {
        nextEl: ".section-library .swiper-button-next",
        prevEl: ".section-library .swiper-button-prev",
      },
      pagination: {
        el: ".section-library .swiper-pagination",
        type: "fraction",
      },
      breakpoints: {
        1280: {
          slidesPerView: 3,
        },
        992: {
          slidesPerView: 2,
        },
        0: {
          slidesPerView: 1,
          spaceBetween: spaceBetweenVW,
        },
      },
    });

    $(".slide_library").removeClass("hide");
  });

  //search
  $(".search").on("click", function (event) {
    $(".section-search").addClass("show-search");
  });
  $(".close-search").on("click", function (event) {
    $(".section-search").removeClass("show-search");
  });
  // quyền
  $(".section__content div.btn-see-more1.btn-see-more2").on("click", function (event) {
    $(this).closest(".section__content").removeClass("active");
    $(this).css("display", "none");
  });

  $(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get("page");

    if (page && parseInt(page) >= 2) {
      const targetSection = $("#target-section");
      if (targetSection.length) {
        // Thay đổi giá trị offset nếu cần
        const offset = targetSection.offset().top - 100;
        $("html, body").stop().animate(
            {
              scrollTop: offset
            },
            200,
            "swing"
        );
      }
    }
  });
})(jQuery);
