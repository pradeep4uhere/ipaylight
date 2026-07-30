<!DOCTYPE html>
<!--
Author: Pradeep Kumar 
Website: http://www.pradeeptechnical.com
Contact: pradeep@pradeeptechnical.com
-->
<html lang="en">
	<head>
    <base href="../../../">
		<title>Email</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{env('APP_URL')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{env('APP_URL')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="bg-body">
        @yield('content')
		<script>var hostUrl = "assets/";</script>
		<script src="{{env('APP_URL')}}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{env('APP_URL')}}/assets/js/scripts.bundle.js"></script>
		<script src="{{env('APP_URL')}}/assets/js/custom/authentication/sign-in/general.js"></script>
	</body>
</html>