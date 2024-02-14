
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<title>LIC Team Project</title>
      <!-- Styles -->

</head>

<body class="bg-lock-screen">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center">
			<div class="card shadow-none bg-transparent">
				<div class="card-body p-md-5 text-center">
					<h5 class="text-white">@php
                        echo "Today".' - '.date("Y-m-d");
                    @endphp</h5>
                    <h2 class="text-white">@php
                        date_default_timezone_set('Asia/Dhaka');
                         $date = new DateTime('now');
                       echo $date->format('H:i:s a')
                    @endphp</h2>
					<div class="">
						<img src="{{ asset('assets/images/user.png') }}" class="mt-5" width="120" alt="" />
					</div>
					<p class="mt-2 text-white">wellcome</p>
                        <div>
                            <a class="text-white fs-5 btn btn-primary mx-1" href="{{ route('register') }}">Register</a>

                            <a class="text-white fs-5 btn btn-primary" href="{{ route('login') }}">Login</a>
                        </div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>
</html>



