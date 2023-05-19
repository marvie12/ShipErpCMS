@section('body')

<div class="top-margin">
	<div class="row">
		<?php if(Session::get('error')!='' || Session::get('status')!=''){ ?>
		<div class="large-5 large-centered columns">
			<div data-alert="" class="alert-box">
				{{ Session::get('error') }}
				{{ Session::get('status') }}
				<a href="#" class="close">x</a>
			</div>
		</div>
		<?php } ?>
		<form action="{{ action('RemindersController@postRemind') }}" method="POST">
			<div class="large-5 large-centered columns">
				<label><h4>Forgot Password</h4>
		    		<input type="email" name="email" placeholder="enter your email here">
		    	</label>
		    </div>
		    <div class="large-5 large-centered columns">
            	<input type="submit" class="expand button" value="Send Reminder">
          	</div>
		</form>
	</div>
</div>
@stop