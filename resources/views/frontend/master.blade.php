
<!DOCTYPE HTML>
<html>
<head>
<title>@yield('title')</title>
<!--css-->
@include('frontend.includes.style')
<!--css-->
@include('frontend.includes.meta')
@include('frontend.includes.script')
<!--//End-rate-->
</head>
<body>
	<!--header-->
		@include('frontend.includes.header')
		<!--header-->
		<!--banner-->
        @yield('content')
		<!--content-->
		<!---footer--->
		@include('frontend.includes.footer')
		<!---footer--->
		<!--copy-->
        @include('frontend.includes.modal')
					

</body>
</html>