<div class="row">
	<div class="col-xs-12">
		<div class="box">
			@include('adminlte::partials.users-search')
			<div class="box-body">
				<div id="msg"></div>
				<div class="text-left">
					@if(isset($message))
					<p>
						<strong>{{ $message }}</strong>
					</p>
					@endif
				</div>

				@if(isset($users))
				<table id="tbl" class="table table-bordered table-hover">
					<thead>
						<th>Fisrt Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>DOB</th>
						<th>Gender</th>
						<th>Last Login Time</th>
						<th>Last Login IP</th>
						<th>Resend Signup Email</th>
						</tr>
					</thead>
					<tbody>

						@foreach($users as $usr)
						<tr>
							<td>
								{{$usr->first_name}}
							</td>
							<td>
								{{$usr->last_name}}
							</td>
							<td> {{$usr->email}}</td>
							<td>
								{{$usr->dob}}
							</td>
							<td>
								{{$usr->gender}}
							</td>
							<td>{{$usr->last_login_time}}</td>
							<td>
								{{$usr->last_login_ip}}
							</td>
							<td>
								<button type="button" class="btn btn-sm btn-primary" onclick="resendSignupEmail('{{$usr->email}}','{{ env('API_URL').'/users/resend/email' }}')">Send</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="text-right">
					{!! $users->appends(Request::only('q'))->links() !!}@endif
				</div>

			</div>
		</div>
	</div>
</div>
@section('adminlte_js')
<script src="{{asset('js/users.js')}}"></script>
@yield('js') @stop