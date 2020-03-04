<!DOCTYPE html>
<html>
<head>
	<title>All Users | ATG</title>
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
	@include('partials._nav')
	<div class="card" style="width: 800px;">
		<div class="head">
			All Users
		</div>	
		<div class="body">
			{{-- Check Session for any success message --}}
			@if(session()->has('success'))
				<div class="success-message">
					{{ session('success') }}
				</div>
			@endif
			@if(count($users))
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Pincode</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->pincode }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			<small>No users addedd</small>
			@endif
		</div>
	</div>
</body>
</html>