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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
<link rel="stylesheet" href="{{asset('assets/frontend')}}/asset/font/fontawesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="{{asset('assets/frontend')}}/asset/css/owl.carousel.min.css">
  <link rel="stylesheet" href="{{asset('assets/frontend')}}/asset/css/owl.theme.default.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/asset/css/video-popup.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/asset/css/reset.css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/asset/css/animate.css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/asset/css/aos.css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/asset/css/styles.css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend')}}/asset/css/app.css" />
<style>
.font50{
    font-size:40px !important;
}
.black{
color:#000;
}
.owl-carousel .nav-btn{
  height: 47px;
  position: absolute;
  width: 26px;
  cursor: pointer;
  top: 50% !important;
}

.owl-carousel .owl-prev.disabled,
.owl-carousel .owl-next.disabled{
pointer-events: none;
opacity: 0.2;
}

.owl-carousel .prev-slide{
  background: url(/assets/frontend/asset/images/nav-icon.png) no-repeat scroll 0 0;
  left: 33px;
}
.owl-carousel .next-slide{
  background: url(/assets/frontend/asset/images/nav-icon.png) no-repeat scroll -24px 0px;
  right: 33px;
}
.owl-carousel .prev-slide:hover{
 background-position: 0px -53px;
}
.owl-carousel .next-slide:hover{
background-position: -24px -53px;
}   
</style>
@endsection

@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="{{asset('assets/frontend')}}/asset/js/video.popup.js"></script>
  
  <!--=== Plugin Collection Js ===-->
  <script src="{{asset('assets/frontend')}}/asset/js/plugincollection.js"></script>

  <!--=== modal video Js ===-->
<script src="{{asset('assets/frontend')}}/asset/js/owl.carousel.min.js"></script>
  <!--=== Custom Js ===-->
  <script src="{{asset('assets/frontend')}}/asset/js/app.js"></script>
<script>
$(document).ready(function(){
	
});
</script>
@endsection

@section("content")
<div class="home-slider">
    <div class="home-slider__item">
		<div class="home-slider__image owl-carousel owl-theme">
			@if(isset($slide) && count($slide)>0)
			@foreach($slide as $item)
			<a href="{{$item->url}}"><img src="{{$item->avatar}}" alt="slider" /></a>
			@endforeach
			@endif
		</div>
      <div class="home-slider__wrap">
		<div class="container container_home">
          <div class="home-slider__content">
            <div class="home-slider__title">
              {!!App\Models\CommonModel::get_lang('setting_home3_section1')!!}
            </div>
            <div class="home-slider__desc">
              {{App\Models\CommonModel::get_lang('setting_home4_section1')}}
            </div>
          </div>
        </div>
      </div>
    </div>
	<div class="home-slider__box">
      <div class="container container_home">
        <div class="row">
          <div class="col-12 col-lg-6"  data-aos="fade-right" data-aos-duration="1000">
            <div class="wrap-box">
              <a href="{{App\Models\CommonModel::get_lang('setting_home6_section2')}}"><img src="{{App\Models\CommonModel::get_lang('setting_home3_section2')}}" alt=""></a>
              <div class="content">
                <div class="title">
                  {{App\Models\CommonModel::get_lang('setting_home1_section2')}}
                </div>
                <div class="desc">
                  {!!App\Models\CommonModel::get_lang('setting_home2_section2')!!}
                </div>
                <a href="{{App\Models\CommonModel::get_lang('setting_home6_section2')}}">{{App\Models\CommonModel::get_lang('setting_home5_section2')}}</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6"  data-aos="fade-left" data-aos-duration="1000">
            <div class="wrap-box">
              <a href="{{App\Models\CommonModel::get_lang('setting_home10_section2')}}"><img src="{{App\Models\CommonModel::get_lang('setting_home11_section2')}}" alt=""></a>
              <div class="content">
                <div class="title">
                  {{App\Models\CommonModel::get_lang('setting_home7_section2')}}
                </div>
                <div class="desc">
                 {!!App\Models\CommonModel::get_lang('setting_home8_section2')!!}
                </div>
                <a href="{{App\Models\CommonModel::get_lang('setting_home10_section2')}}">{{App\Models\CommonModel::get_lang('setting_home9_section2')}}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<div class="home-tab home_new"  data-aos="fade-up" data-aos-duration="1000">
    <div class="container container_home">
		<div class="section-title text-center font50">{!!App\Models\CommonModel::get_lang('setting_home1_section3')!!}</div>
	  @if(isset($product) && count($product)>0)
		  <?php $i=0;$j=0; ?>
      <div class="home-tab-heading">
		@foreach($product as $item)
        <a href="javascript:;" class="home-tab-title @if($i==0)active @endif" data-id="tab-{{$item->product_id}}">{{$item->name}}</a>
		<?php $i++; ?>
		@endforeach
      </div>
      <div class="home-tab-contents">
		@foreach($product as $item)
        <div class="home-tab-content @if($j==0)active @endif" data-id="tab-{{$item->product_id}}">
          <div class="wrap">
            <div class="left left_home">
				<div class="top">
					@if(isset($step[$j]) && count($step[$j])>0)
						<?php $a=0; ?>
					@foreach($step[$j] as $i_step)
					<div class="item @if($a==0)active @endif">
						<span class="number">{{$a+1}}</span>
						<div class="title">{{$i_step->name}}</div>
						<div class="desc">{{$i_step->content}}</div>
					</div>
					<?php $a++; ?>
					@endforeach
					@endif
				</div>
				 <div class="btn-wrap">
					<a href="{{App\Models\CommonModel::get_lang('setting_home5_section3')}}" class="btn bg-gradient-2 fontsize19">{{App\Models\CommonModel::get_lang('setting_home4_section3')}}</a>
				  </div>
            </div>
            <div class="right right_home">
              <div class="image">
                <img src="{{$item->avatar}}" alt="{{$item->name}}">
              </div>
			     <div class="support">
					<div class="support-item">
					  <img src="{{asset('assets/frontend')}}/asset/images/1x/call.png" alt="">
					  <span>{{App\Models\CommonModel::get_lang('setting_home2_section3')}} <a href="tel:{{App\Models\CommonModel::get_setting('setting_phone')}}">{{App\Models\CommonModel::get_setting('setting_phone')}}</a></span>
					</div>
					<div class="support-item">
					  <img src="{{asset('assets/frontend')}}/asset/images/1x/mail.png" alt="">
					  <span>{{App\Models\CommonModel::get_lang('setting_home3_section3')}}<a href="mailto:{{App\Models\CommonModel::get_setting('setting_email')}}"> {{App\Models\CommonModel::get_setting('setting_email')}}</a></span>
					</div>
				  </div>
            </div>
            
          </div>
        </div>
		<?php $j++; ?>
		@endforeach
      </div>
	  @endif
    </div>
</div>
<div class="home-services">
    <div class="container container_home">
      <div class="section-title text-center font50"  data-aos="fade-up" data-aos-duration="1000">{{App\Models\CommonModel::get_lang('setting_home1_section5')}}</div>
      <div class="row">
        <div class="col-6 col-md-3 col-5-item"  data-aos="fade-up" data-aos-duration="1000">
          <div class="item">
            <div class="icon">
              <img src="{{App\Models\CommonModel::get_lang('setting_home2_section5')}}" />
            </div>
            <div class="title"><a class="black" href="{{App\Models\CommonModel::get_lang('setting_home5_section5')}}">{{App\Models\CommonModel::get_lang('setting_home3_section5')}}</a></div>
            <div class="desc">{{App\Models\CommonModel::get_lang('setting_home4_section5')}}</div>
           
          </div>
        </div>
        <div class="col-6 col-md-3 col-5-item"  data-aos="fade-up" data-aos-duration="1000">
          <div class="item">
            <div class="icon">
              <img src="{{App\Models\CommonModel::get_lang('setting_home6_section5')}}" />
            </div>
            <div class="title"><a class="black" href="{{App\Models\CommonModel::get_lang('setting_home9_section5')}}">{{App\Models\CommonModel::get_lang('setting_home7_section5')}}</a></div>
            <div class="desc">{{App\Models\CommonModel::get_lang('setting_home8_section5')}}</div>
          
          </div>
        </div>
        <div class="col-6 col-md-3 col-5-item"  data-aos="fade-up" data-aos-duration="1000">
          <div class="item">
            <div class="icon">
              <img src="{{App\Models\CommonModel::get_lang('setting_home10_section5')}}" />
            </div>
            <div class="title"><a class="black" href="{{App\Models\CommonModel::get_lang('setting_home13_section5')}}">{{App\Models\CommonModel::get_lang('setting_home11_section5')}}</a></div>
            <div class="desc">{{App\Models\CommonModel::get_lang('setting_home12_section5')}}</div>
           
          </div>
        </div>
        <div class="col-6 col-md-3 col-5-item"  data-aos="fade-up" data-aos-duration="1000">
          <div class="item">
            <div class="icon">
              <img src="{{App\Models\CommonModel::get_lang('setting_home14_section5')}}" />
            </div>
            <div class="title"><a class="black" href="{{App\Models\CommonModel::get_lang('setting_home17_section5')}}">{{App\Models\CommonModel::get_lang('setting_home15_section5')}}</a></div>
            <div class="desc">{{App\Models\CommonModel::get_lang('setting_home16_section5')}}</div>
        
          </div>
        </div>
        <div class="col-6 col-md-3 col-5-item"  data-aos="fade-up" data-aos-duration="1000">
          <div class="item">
            <div class="icon">
              <img src="{{App\Models\CommonModel::get_lang('setting_home18_section5')}}" />
            </div>
            <div class="title"><a class="black" href="{{App\Models\CommonModel::get_lang('setting_home21_section5')}}">{{App\Models\CommonModel::get_lang('setting_home19_section5')}}</a></div>
            <div class="desc">{{App\Models\CommonModel::get_lang('setting_home20_section5')}}</div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="home-app">
    <div class="home-app__inner">
      <div class="home-app__image">
        <img src="{{App\Models\CommonModel::get_lang('setting_home10_section6')}}" alt="bg" />
      </div>
      <div class="home-app__wrap">
        <div class="container container_home">
          <div class="home-app__content">
            <div class="home-app__subtitle">
              <span>{{App\Models\CommonModel::get_lang('setting_home1_section6')}}</span>
              <span>{{App\Models\CommonModel::get_lang('setting_home2_section6')}}</span>
            </div>
            <div class="home-app__title"  data-aos="fade-up" data-aos-duration="1000">
              <span>{{App\Models\CommonModel::get_lang('setting_home3_section6')}}</span>
              <img src="{{asset('assets/frontend')}}/asset/images/app/4.png" alt="" />
            </div>
            <div class="home-app__info"  data-aos="fade-up" data-aos-duration="1000">
              <div class="home-app__item">
                <div class="icon"><span class="icon-download"></span></div>
                <div class="text">{{App\Models\CommonModel::get_lang('setting_home4_section6')}}</div>
              </div>
              <div class="home-app__item">
                <div class="icon"><span class="icon-mobile"></span></div>
                <div class="text">{{App\Models\CommonModel::get_lang('setting_home5_section6')}}</div>
              </div>
              <div class="home-app__item">
                <div class="icon"><span class="icon-user"></span></div>
                <div class="text">{{App\Models\CommonModel::get_lang('setting_home6_section6')}}</div>
              </div>
            </div>
            <div class="home-app__footer"  data-aos="fade-up" data-aos-duration="1000">
              <div class="first">
                <a href="{{App\Models\CommonModel::get_lang('setting_home8_section6')}}" class="btn bg-gradient-2 fontsize19">{{App\Models\CommonModel::get_lang('setting_home7_section6')}} <i class="fal fa-arrow-right"></i></a>
                <div class="app">
                  <a href="{{App\Models\CommonModel::get_setting('setting_website_ios')}}" class="btn-app"><img src="{{asset('assets/frontend')}}/asset/images/app/1.png" alt="" /></a>
                  <a href="{{App\Models\CommonModel::get_setting('setting_website_android')}}" class="btn-app"><img src="{{asset('assets/frontend')}}/asset/images/app/2.png" alt="" /></a>
                </div>
              </div>
              <div class="last">
                <img src="{{App\Models\CommonModel::get_lang('setting_home9_section6')}}" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<section class="testimonials">
    <div class="container container_home">
      <div class="inner">
        <div class="section-title text-center"  data-aos="fade-up" data-aos-duration="1000">
          <span class="font50">
           {!!App\Models\CommonModel::get_lang('setting_home1_section8')!!}
          </span>
          <img src="{{asset('assets/frontend')}}/asset/images/testi/0.png" />
        </div>
        <div class="row"  data-aos="fade-up" data-aos-duration="1000">
          <div class="col-12 col-md-6">
				<div class="content">
					@if(isset($testimonial[0]))
					  <div class="star">
							<img src="{{asset('assets/frontend')}}/asset/images/1x/star.png" alt="">
						  </div>
					  <div class="desc">
						{{$testimonial[0]->content}}
					  </div>
					  <div class="name">
						{{$testimonial[0]->name}}
					  </div>
					  <div class="btn-wrap">
						<a href="{{App\Models\CommonModel::get_lang('setting_home9_section8')}}" class="btn fontsize19">{{App\Models\CommonModel::get_lang('setting_home8_section8')}}</a>
					  </div>
					  <div class="under d-flex flex-wrap">
						<div class="item">
						  <div class="image">
							<img src="{{asset('assets/frontend')}}/asset/images/1x/icon_u_1_1.png" alt="">
						  </div>
						  <div class="number">
							{{App\Models\CommonModel::get_lang('setting_home4_section8')}}
						  </div>
						  <div class="info">
							{{App\Models\CommonModel::get_lang('setting_home2_section8')}}
						  </div>
						</div>
						<div class="item">
						  <div class="image">
							<img src="{{asset('assets/frontend')}}/asset/images/1x/icon_u_2.png" alt="">
						  </div>
						  <div class="number">
							{{App\Models\CommonModel::get_lang('setting_home6_section8')}}
						  </div>
						  <div class="info">
							{{App\Models\CommonModel::get_lang('setting_home5_section8')}}
						  </div>
						</div>
						<div class="item">
						  <div class="image">
							<img src="{{App\Models\CommonModel::get_lang('setting_home3_section8')}}" alt="">
						  </div>
						  <div class="number">
							<img src="{{asset('assets/frontend')}}/asset/images/1x/star_2.png" alt="">
						  </div>
						  <div class="info">
							{{App\Models\CommonModel::get_lang('setting_home7_section8')}}
						  </div>
						</div>
					  </div>
				  @endif
				</div>
          </div>
          <div class="col-12 col-md-6">
			@if(isset($testimonial[0]))
			<div class="image_avt">
              <img src="{{$testimonial[0]->avatar}}" alt="">
            </div>
			
			@endif
          
          </div>
        </div>
      </div>
    </div>
  </section>
<section class="open_app_new">
    <div class="wrap">
      <div class="title text-center"  data-aos="fade-up" data-aos-duration="1000">
        {{App\Models\CommonModel::get_lang('setting_home1_section9')}} <br> <span>{{App\Models\CommonModel::get_lang('setting_home2_section9')}}</span>
      </div>
      <div class="wrap_btn wrap_btn justify-content-center d-flex"  data-aos="fade-up" data-aos-duration="1000">
        <a href="{{App\Models\CommonModel::get_lang('setting_home6_section9')}}" class="btn d-flex flex-row align-items-center">
          <span>{{App\Models\CommonModel::get_lang('setting_home5_section9')}}</span>
          <img src="{{asset('assets/frontend')}}/asset/images/1x/arr-r.png" alt="">
        </a>
      </div>
    </div>
    <img src="{{App\Models\CommonModel::get_lang('setting_home3_section9')}}" alt="">
  </section>
@endsection