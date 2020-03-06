<!DOCTYPE html>
<html>
<head>
	<title>Add User(AJAX) | ATG</title>
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
</head>
<body>
	@include('partials._nav')
	<div class="loader-parent">
		<div class="loader"></div>
	</div>
	<div class="card">
		<div class="head">
			Add User (AJAX)
		</div>
		<div class="body">
			{{-- div for ajax success message --}}
			<div id="success-message">
				
			</div>
			<form action="{{ route('api.atg.store') }}" method="POST" id="userForm">
				<div class="form-label">
					<label for="name">Name:</label>
				</div>
				<div class="form-input">
					<input type="text" name="name" id="name" placeholder="John Doe" required="" value="{{ old('name') }}"><br>
				</div>
				{{-- div for any ajax validation errors --}}
				<div class="name-error">
					
				</div>
				@if($errors->has('name'))
					<small class="error">{{ $errors->first('name') }}</small>
				@endif
				<div class="form-label">
					<label for="email">Email:</label>
				</div>
				<div class="form-input">
					<input type="email" name="email" id="email" placeholder="johndoe@xyz.com" required="" value="{{ old('email') }}"><br>
				</div>
				<div class="email-error">
					
				</div>
				{{-- div for any ajax validation errors --}}
				@if($errors->has('email'))
					<small class="error">{{ $errors->first('email') }}</small>
				@endif
				<div class="form-label">
					<label for="pincode">Pin code:</label>
				</div>
				<div class="form-input">
					<input type="text" name="pincode" id="pincode" placeholder="XXXXXX" required="" value="{{ old('pincode') }}">
				</div>
				<div class="pincode-error">
					
				</div>
				{{-- div for any ajax validation errors --}}
				@if($errors->has('pincode'))
					<small class="error">{{ $errors->first('pincode') }}</small>
				@endif
				<div class="form-submit">
					<button type="submit" disabled="disabled" id="submit">SUBMIT</button>
				</div>
			</form>
		</div>
	</div>
	<script src="{{ asset('js/createAjax.js') }}"></script>
</body>
</html>