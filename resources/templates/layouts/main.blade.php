<!doctype html>
<html {{ get_language_attributes() }} class="no-js">

	<head>
		<meta charset="{{ get_bloginfo('charset') }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=1">
		<title>{{ wp_title('') }}</title>
		@wphead
	</head>

	<body itemscope itemtype="http://schema.org/WebPage" class="{{ implode(' ', get_body_class()) }}">
		
		@include('partials.navigation')

		<div class="container" >
			<div class="row">

				<main class="col-lg-8" role="main" itemscope itemprop="mainContentOfPage">
					@yield('main')
				</main>

				<aside class="col-lg-4" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
					@section('sidebar')
			            @sidebar('sidebar-blog')
			        @show
				</aside>

			</div>
		</div>

		@include('partials.footer')

		{{-- Output the wp_footer content - scripts and the admin bar if shown. --}}
		@wpfooter

	</body>
</html>