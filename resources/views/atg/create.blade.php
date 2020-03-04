<!DOCTYPE html>
<html>
<head>
	<title>Add User | ATG</title>
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
	@include('partials._nav')
	<div class="card">
		<div class="head">
			Add User
		</div>
		<div class="body">
			{{-- Check Session for any success message --}}
			@if(session()->has('success'))
				<div class="success-message">
					{{ session('success') }}
				</div>
			@endif
			<form action="{{ route('atg.store') }}" method="POST">
				@csrf
				<div class="form-label">
					<label for="name">Name:</label>
				</div>
				<div class="form-input">
					<input type="text" name="name" id="name" placeholder="John Doe" required="" value="{{ old('name') }}"><br>
				</div>
				{{-- check error bag for any validation errors --}}
				@if($errors->has('name'))
					<small class="error">{{ $errors->first('name') }}</small>
				@endif
				<div class="form-label">
					<label for="email">Email:</label>
				</div>
				<div class="form-input">
					<input type="email" name="email" id="email" placeholder="johndoe@xyz.com" required="" value="{{ old('email') }}"><br>
				</div>
				{{-- check error bag for any validation errors --}}
				@if($errors->has('email'))
					<small class="error">{{ $errors->first('email') }}</small>
				@endif
				<div class="form-label">
					<label for="pincode">Pin code:</label>
				</div>
				<div class="form-input">
					<input type="text" name="pincode" id="pincode" placeholder="XXXXXX" required="" value="{{ old('pincode') }}">
				</div>
				{{-- check error bag for any validation errors --}}
				@if($errors->has('pincode'))
					<small class="error">{{ $errors->first('pincode') }}</small>
				@endif
				<div class="form-submit">
					<button type="submit">SUBMIT</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>