
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
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@include('layouts.styles')
	@include('layouts.scripts')

</head>

<body class="bg-lock-screen">
	<!-- wrapper -->

	<div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center row">
			<div class="col-7">
				
				<div class="card">
					<div class="card-body">
						<form method="GET" action="{{ route('welcome') }}" class="row">
							<div class="form-group col-3">
								<label for="tags">Tags:</label>
								<select name="tags[]" class="form-control select2" multiple="multiple">
									@foreach($tags as $tag)
										<option value="{{ $tag->id }}">{{ $tag->name }}</option>
									@endforeach
								</select>
							</div>
							
							<div class="form-group col-6">
								<label for="salary">Salary Range:</label>
								<div class="input-group">
									<input type="number" name="salary_min" class="form-control" placeholder="Min Salary">
									<div class="input-group-prepend input-group-append">
										<span class="input-group-text">to</span>
									</div>
									<input type="number" name="salary_max" class="form-control" placeholder="Max Salary">
								</div>
							</div>
							
							<div class="form-group col-3">
								<label for="location">Location:</label>
								<input type="text" name="location" class="form-control" placeholder="Enter location">
							</div>
							
							<button type="submit" class="btn btn-primary">Filter</button>
						</form>
					</div>
				</div>
				<div class="card-header">
					<h4 class="text-green-100">Available Jobs</h4>
				</div>s
                <div class="card-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr class="bg-cyan-950 text-green-100">
                                <th>Company</th>
                                <th>Location</th>
                                <th>Title</th>
                                <th>Post</th>
                                <th>Salary</th>
                                <th>Experience</th>
                                <th>Vacancy</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs  as $job)
                                <tr class="bg-gray-800 text-green-200">
                                    <td>{{ $job->company->name }}</td>
                                    <td>{{ $job->company->companyInfo->location }}</td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->post }}</td>
                                    <td>{{ $job->salary_min }} - {{ $job->salary_max }}</td>
                                    <td>{{ $job->experience }} years</td>
                                    <td>{{ $job->vacancy }}</td>
                                    <td>
										<a href="{{$job->link}}" class="btn btn-primary">Apply</a>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

			</div>
			<div class="col-5">
				<div class="card shadow-none bg-transparent">
					<div class="card-body p-md-5 text-center">
						<h5 class="text-white">@php
							echo "Today".' - '.date("Y-m-d");
						@endphp</h5>
						<h2 class="text-white">
							@php
								date_default_timezone_set('Asia/Dhaka');
								$date = new DateTime('now');
								echo $date->format('H:i:s a')
							@endphp
						</h2>
						<div class="">
							<img src="{{ asset('assets/images/user.png') }}" class="mt-5" width="120" alt="" />
						</div>
						<p class="mt-2 text-white">Welcome</p>
						<div>
							<a class="text-white fs-5 btn btn-primary mx-1" href="{{ route('register') }}">Register</a>
							<a class="text-white fs-5 btn btn-primary" href="{{ route('login') }}">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>
</html>


<script>
    $(function() {
        $('input[name="ends_at"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $('.select2').select2()
    });
</script>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: darkcyan;
    }
</style>

