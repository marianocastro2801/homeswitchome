<!DOCTYPE html>
<html>
	<head>
    </style>
		<title>homeswitchHome</title>
		<link rel="stylesheet" href="/css/app.css">
		<style type="text/css">
			footer {
				    padding: 20px;
				    margin-top: 10px;
				    color: #fff;
				    background: #333;
					}
		</style>
		<link rel="shortcut icon" type="image/x-icon" href="images/Logo.png" />
	</head>
	<body>
		@include('inc.navbar')
		@yield('content')
		@include('inc.footer')
	</body>

</html>