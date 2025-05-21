@extends("frontend.hometemplate")


@section("title")
    {{App\Models\CommonModel::get_lang('setting_website_title')}}
@endsection
@section("desc")
    {{App\Models\CommonModel::get_lang('setting_website_desc')}}
@endsection
@section("keyword")
    {{App\Models\CommonModel::get_lang('setting_website_keyword')}}
@endsection

@section("facebooktag")
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{App\Models\CommonModel::get_lang('setting_website_title')}}" />
    <meta property="og:description" content="{{App\Models\CommonModel::get_lang('setting_website_desc')}}" />
    <meta property="og:image" content="{{asset(App\Models\CommonModel::get_setting('website_logo'))}}" />
@endsection

@section("css")
    <link href="{{asset('assets/frontend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/plugin-collection.css">
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/icofont.min.css">
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/swiper.min.css">
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/assets/css/app.css?v={{ time() }}">

@endsection

@section("js")
    <script src="{{asset('assets/frontend')}}/assets/js/jquery-main.js"></script>
    <script src="{{asset('assets/frontend')}}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/frontend')}}/assets/js/jquery-migrate.js"></script>
    <script src="{{asset('assets/frontend')}}/assets/js/jquery-ui.min.js"></script>
    <script src="{{asset('assets/frontend')}}/assets/js/plugincollection.js"></script>
    <script src="{{asset('assets/frontend')}}/assets/js/app.js?v={{ time() }}"></script>
    <script>
        $(document).on("click",'.modal_digital', function () {
            $("#exampleModalLabel").text($(this).data('title'));
            $(".modal-body").html($(this).data('content'));
        });
        $(document).on("click",'.select_partner', function () {
            $(".select_partner").removeClass('active');
            $(this).addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('load_section_click')}}",
                type: 'POST',
                dataType: 'html',
                data:{partner_id:$(this).data('id'),id:$(this).data('layout')},
                success: function (data, textStatus, jqXHR) {
                    $(".load_section_click").html(data);
                    AOS.init({
                        easing: "ease",
                        once: true,
                    });
                    slide();
                }
            });
        });
        function calculateSpaceBetween() {
            let width = window.innerWidth;
            if (width > 1440) {
                return 32;
            } else if (width >= 992) {
                return width * 0.0222; // 0.83333333333%
            } else {
                return width * 0.032; // 3.2%
            }
        }
        function load_section(position){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('load_section')}}",
                type: 'POST',
                dataType: 'html',
                data:{position:position,page:'home'},
                success: function (data, textStatus, jqXHR) {
                    $(".load_section_"+position).html(data);
                    AOS.init({
                        easing: "ease",
                        once: true,
                    });
                    slide();
                }
            });
        }
        function slide(){
            var spaceBetweenVW = calculateSpaceBetween();
            // Initialize the brand name slider with auto width
            var cooperateSlider = new Swiper(".wrap_slider_cooperate", {
                centeredSlides: true,
                slideToClickedSlide: true,
                speed: 500,
                loop: true,
                spaceBetween: spaceBetweenVW,
                slidesPerView: 5,
                touchRatio: 2,
                loopAdditionalSlides: 3,
                loopFillGroupWithBlank: true,
                watchSlidesProgress: true,
                observer: true,
                observeParents: true,
                // autoplay: {
                //     delay: 3000,
                //     disableOnInteraction: false
                // },
                navigation: {
                    nextEl: ".wrap_slider_cooperate .swiper-button-next",
                    prevEl: ".wrap_slider_cooperate .swiper-button-prev",
                },
                breakpoints: {
                    1921: {
                        slidesPerView: 5
                    },
                    992: {
                        slidesPerView: 5,
                    },
                    575: {
                        slidesPerView: 4,
                    },
                    0: {
                        slidesPerView: 3,
                    },
                },
                on: {
                    init: function() {
                        // Store reference to the Swiper instance
                        const swiper = this;
                        setTimeout(function() {
                            swiper.update();
                        }, 200);
                    }
                }
            });

            // Initialize the images slider
            var imagesSlider = new Swiper(".images_slider_main", {
                slidesPerView: 1,
                allowTouchMove: false,
                speed: 500
            });

            // Initialize the content slider
            var infoSlider = new Swiper(".wrap_info_slider", {
                slidesPerView: 1,
                allowTouchMove: false,
                speed: 500
            });

            // Connect the sliders - fixing the synchronization
            cooperateSlider.on('slideChange', function () {
                // Get real index for looped slider
                let realIndex = cooperateSlider.realIndex;
                imagesSlider.slideTo(realIndex);
                infoSlider.slideTo(realIndex);
            });

            // When clicking on a slide
            cooperateSlider.on('click', function (swiper, event) {
                setTimeout(function() {
                    // Force update to handle loop slides properly
                    cooperateSlider.update();

                    // After update, sync the other sliders using realIndex
                    let realIndex = cooperateSlider.realIndex;
                    imagesSlider.slideTo(realIndex);
                    infoSlider.slideTo(realIndex);

                    // For edge cases (3rd from beginning/end)
                    if (cooperateSlider.clickedIndex !== undefined) {
                        // If clicking on a clone slide (3rd from beginning/end)
                        let clickedIndex = cooperateSlider.clickedIndex;
                        let slideCount = cooperateSlider.slides.length - cooperateSlider.loopedSlides * 2;

                        // Determine if we're in the edge area (3rd from start or end)
                        if (clickedIndex < 2 || clickedIndex >= slideCount - 2) {
                            cooperateSlider.updateSlides();
                            cooperateSlider.updateProgress();
                            cooperateSlider.updateSlidesClasses();
                        }
                    }
                }, 200);
            });


            var slideCooperate = new Swiper(".slide_cooperate", {
                slidesPerView: 1,
                speed: 1000,
                loop: true,
                spaceBetween: 0,
                slidesPerGroup: 1,
                effect: "fade",
                autoplay: false,
                navigation: {
                    nextEl: ".section_cooperate .swiper-button-next",
                    prevEl: ".section_cooperate .swiper-button-prev",
                },
                pagination: {
                    clickable: true,
                    el: '.section_cooperate .swiper-pagination',
                },
            });
            var swiperProductDetail = new Swiper('.swiper-detail', {
                loop: true,
                spaceBetween: 0,
                slidesPerView: 1,
                slidesPerGroup: 1,
                effect: "fade",
                thumbs: {
                    swiper: {
                        el: '.swiper-container-thumbs',
                        loop: true,
                        slidesPerView: 4,
                        spaceBetween: 32,
                        freeMode: true,
                        watchSlidesProgress: true,
                    },
                },
            });
            var slidePartner = new Swiper(".slide_partner", {
                speed: 200,
                loop: false,
                spaceBetween: 32,
                slidesPerView: 6,
                touchRatio: 2,
                autoplay: false,
                navigation: {
                    nextEl: ".slide_partner .swiper-button-next",
                    prevEl: ".slide_partner .swiper-button-prev",
                },
                breakpoints: {
                    1921: {
                        slidesPerView: 6,
                        spaceBetween: 32,
                    },
                    992: {
                        slidesPerView: 6,
                        spaceBetween: 32,
                    },
                    575: {
                        slidesPerView: 3,
                        spaceBetween: 12,
                    },
                    0: {
                        slidesPerView: 2,
                        spaceBetween: 12,
                    },
                },
            });

            var slideProduct = new Swiper(".slide_product", {
                speed: 500,
                loop: true,
                spaceBetween: 32,
                slidesPerView: 6,
                slidesPerGroup: 6,
                touchRatio: 2,
                autoplay: false,
                navigation: {
                    nextEl: ".slide_product .swiper-button-next",
                    prevEl: ".slide_product .swiper-button-prev",
                },
                breakpoints: {
                    1921: {
                        slidesPerView: 6,
                        slidesPerGroup: 6,
                        spaceBetween: 32,
                    },
                    992: {
                        slidesPerView: 6,
                        slidesPerGroup: 6,
                        spaceBetween: 32,
                    },
                    575: {
                        slidesPerView: 3,
                        slidesPerGroup: 3,
                        spaceBetween: 12,
                    },
                    0: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                        spaceBetween: 12,
                    },
                },
            });
        }
        load_section(1);
        load_section(2);
        load_section(3);
        load_section(5);
        load_section(4);
    </script>
@endsection

@section("content")
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
    @if(isset($layout_banner) && !empty($layout_banner))
        <section class="section_banner section-padding-bottom-50">
            <div class="wrapper position-relative">
                <div class="slide_banner swiper-container position-relative">
                    <div class="swiper-wrapper">
                        @if(isset($banner) && count($banner)>0)
                            @foreach($banner as $item)
                                <div class="swiper-slide">
                                    <a href="{{$item->url}}" class="item-banner">
                                        <img src="{{$item->value}}" alt="banner">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="wrap_swiper-button-prev">
                        <div class="swiper-button-prev">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="group-hover:text-white text-[#D0D5DD] h-[30px] translate-x-[-1px]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"></path></svg>
                        </div>
                        <div class="swiper-button-next">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="group-hover:text-white text-[#D0D5DD] h-[30px] translate-x-[1px]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination"></div>

            </div>
        </section>
    @endif
    <div class="load_section_1">

    </div>
    <div class="load_section_2">

    </div>
    <div class="load_section_3">

    </div>
    <div class="load_section_4">

    </div>
    <div class="load_section_5">

    </div>


    <!-- section contact -->
    <section class="section_contact section-padding-50 d-none">
        <div class="container-main">
            <div class="section_title">
                <div class="title">
                    <h2>{{App\Models\CommonModel::get_lang('setting_home13')}}</h2>
                </div>
            </div>
            <div class="section_content">
                <div class="wrap_form">
                    <form action="">
                        <div class="group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{App\Models\CommonModel::get_lang('setting_user4')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="6"></textarea>
                            </div>
                            <div class="form-group justify-content-end mb-0">
                                <button type="submit" class="btn">
                                    {{App\Models\CommonModel::get_lang('setting_send')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection