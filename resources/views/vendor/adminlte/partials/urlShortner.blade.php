<form action="{{url('urlShortner')}}" method="POST" role="">
	{{ csrf_field() }}
	<div class="input-group">
		<input type="text" class="form-control" name="url" id="url" required="true" placeholder="Enter Url Here">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>
</form>
