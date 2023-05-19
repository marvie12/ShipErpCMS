@section('body')

<div class="top-margin">
	<div class="row">
		@if($errors)
			<div data-alert class="alert-box">
			  <!-- Your content goes here -->
			  Something went wrong, please try again.
			  <a href="#" class="close">&times;</a>
			</div>
		@endif
		<form action="{{ action('RemindersController@postReset') }}" method="POST">
		    <input type="hidden" name="token" value="{{ $token }}">
		    <div class="large-5 large-centered columns">
		    	<h4>Reset Password</h4>
				<label>Email
		    		<input type="email" name="email" placeholder="enter your email here">
		    	</label>
		    	<label>New Password
		    		<input type="password" name="password">
		    	</label>
		    	<label>Confirm New Password
		    		<input type="password" name="password_confirmation">
		    	</label>
		    </div>
		    <div class="large-5 large-centered columns">
            	<input type="submit" class="expand button" value="Reset Password">
          	</div>
		</form>
	</div>
</div>
@stop