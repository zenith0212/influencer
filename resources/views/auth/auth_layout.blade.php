<html lang="en">
	<!--begin::Head-->
	<head>
		<title>Influencer MarketPlace</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{!! asset('assets/media/logos/topfavicon.png') !!}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{!! asset('assets/plugins/global/plugins.bundle.css') !!}" rel="stylesheet" type="text/css" />
		<link href="{!! asset('assets/css/style.bundle.css') !!}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<style>
			.custom-error{
				margin-top : -70px !important;
			}

			.login_main{
				/*background: linear-gradient(291deg, #403c3c 0%, black 67%);*/
				background: linear-gradient(346deg, #f64f6b2e 0%, #f96d5900 100%);
    			position: relative;
			}

			.login_main:after {
			    position: absolute;
			    background-size: 100% !important;
			    content: "";
			    left: 0px;
			    right: 0px;
			    bottom: 0px;
			    top: 0;
			    background-image: url(https://themesdesign.in/tydek/layouts/images/img-wave-2.png);
			    background-repeat: no-repeat;
			    background-position: bottom;
			}

			.login_left h1 {
			    color: #0B0B0B;
			}

			.login_inner {
			    color: #000000;
			}

			.login_inner a {
			    color: #f96c59;
			}

			.login_right_inner {
/*			    background: linear-gradient(346deg, #F64F6B 0%, #F96D59 100%);*/
				background: #fff;
    			box-shadow: 0px 2px 16px 0px #00000021;
			}

			/*.login_right_inner .form-control,
			.login_right_inner .form-control::placeholder {
			    color: #fff;
			}*/


			.login_right_inner .btn-primary {
/*			    background: linear-gradient(291deg, #403c3c 0%, black 67%);*/
				background: linear-gradient(346deg, #F64F6B 0%, #F96D59 100%);
			    border-radius: 50px;
			    transition: all 0.5s;
			    border: 2px solid #403c3c;
			    color: #fff;
			}

			.login_main .login_right_inner .btn-primary:hover {
			    box-shadow: 0px 3px 10px 0px #0000003d !important;
			    background: linear-gradient(346deg, #F64F6B 0%, #F96D59 100%);
/*			    background-color: #fff !important;*/
/*			    background: #fff;*/
/*			    color: #403c3c;*/
			}

			.signup_member a {
			    color: #f96c5a;
			}

			.signup_member a:hover{
				color: #000000 !important;
			}

			.forgot_txt a{
				color: #f96c59;
			}

			.forgot_txt:hover a {
				color: #403c3c !important;
			}

			.zindex-1{
				z-index: 1;
			}

			@media screen and (max-width:991px){
				.login_row{
					height: auto !important;
				}
			}
			.custom-logout-btn{
			    padding: 0;
			    outline: none;
			    background: transparent;
			    font-size: 12px;
			    border: 0;
			    border-bottom: 1px solid transparent;
			}

			.custom-logout-btn:hover{
			   color: #f96c59;
			   border-color:#f96c59;
			}

		</style>
	</head>
	 <!-- @yield('content-body') -->
	<!-- </body>
</html> -->