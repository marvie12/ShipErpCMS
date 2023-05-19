<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>{{ config('web.title') }}</title>
		<link rel="stylesheet" href="{{ url() }}/stylesheets/app.css" />
		<link rel="stylesheet" href="{{ url() }}/bower_components/foundation/foundation-icons/foundation-icons.css" />
		<script src="{{ url() }}/bower_components/modernizr/modernizr.js"></script>
		<script src="{{ url() }}/bower_components/jquery/dist/jquery.min.js"></script>
  	    <script type="text/javascript" src="{{ url() }}/js/serializeObject.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">

		@yield('header.includes')

	</head>
	<body>
		@if(!Input::has('shortcode'))
		<!-- data-options="is_hover: false" -->
		<nav class="top-bar" data-topbar="" role="navigation">
			<ul class="title-area">
				<!-- Title Area -->
				<li class="name">
					<h1><a href="{{url('/provider')}}">{{ config::get('web.app.display_name') }}</a></h1>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>
			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="right">
					<li class="divider hide-for-small"></li>
					<li class="has-dropdown"><a>Menu</a>
						<ul class="dropdown">
							<li class="title back js-generated"><h5><a href="javascript:void(0)">Back</a></h5></li>
							<li><label>Provider</label></li>
							<li class="has-dropdown">
								<a href="{{ url('provider') }}">Provider</a>
								<ul class="dropdown">
									<li><a href="{{ url('provider') }}">Dashboard</a>
									<li><a href="{{ route('add.provider') }}">New Provider</a></li>
								</ul>
							</li>
							<li><a href="{{ url('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</nav>

		<div class="row" style="padding:30px 0;">
			<div class="columns small-6 text-left" style="font-size: 14px;">
			Welcome <strong>{{  Auth::user()->name }}</strong>!
			</div>
			<div class="columns small-6 text-right" style="font-size: 14px;">
				<b>Server Time:</b> <span id="servertime"></span>
			</div>
		</div>
		@endif

		@yield('body')

		@yield('footer.javascripts')

		<script src="{{ url() }}/bower_components/foundation/js/foundation.min.js"></script>

		<script src="{{ url() }}/js/app.js"></script>
	</body>
</html>


@if(!Input::has('shortcode'))
<script type="text/javascript">

var currenttime = '{{ date("F d, Y H:i:s", time()) }}',
montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December"),
serverdate=new Date(currenttime);

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
document.getElementById("servertime").innerHTML= serverdate.toLocaleString() //datestring+" "+timestring
}

window.onload=function(){
setInterval("displaytime()", 1000)
}

</script>
@endif
