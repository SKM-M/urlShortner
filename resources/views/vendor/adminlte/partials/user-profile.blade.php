<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body">
				

				@if(isset($user))
				<table id="tbl" class="table table-bordered table-hover">
					<thead>
					<tr>
                    	<th>Name</th>
						<th>Email</th>
						<th>Provider</th>
					</tr>
					</thead>
					<tbody>
					
						<tr>
							<td>
								{{{$user['name']}}}
							</td>
							<td> {{{$user['email']}}}</td>
							<td> {{{$user['provider']}}}</td>
							
						</tr>
						
					</tbody>
				</table>
				@endif

				

			</div>
		</div>
	</div>
</div>
@section('adminlte_js')

@yield('js') @stop