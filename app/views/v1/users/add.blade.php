@section('header.includes')
	<link href="{{ url() }}/stylesheets/colorbox.css" rel="stylesheet">
	<script src="{{ url() }}/js/jquery.colorbox-min.js"></script>
	<style type="text/css">
		.rqrd{
			float: right;
			color: red;
			font-size: 11px;
		}
	</style>
@stop

@section('body')

	<div class="row defPad">
	    <div class="large-6 columns">
	        <h4>Add User</h4>
	    </div>
	    <div class="large-6 columns">
	        <div class="row collapse right">
	            <a href="/users" class="small button">Go back</a>
	            <a href="javascript:void(0)" onclick="$('form').trigger('submit')" class="small button success">Save</a>
	        </div>

	    </div>
	</div>

	<?php if(Session::get('message')!="") { ?>
<div class="row defPad">
	<div class="large-12 large-centered columns">
		<div data-alert="" class="alert-box">
			{{ Session::get('message') }}
			<a href="#" class="close">×</a>
		</div>
	</div>
</div>
<?php } ?>

	{{ Form::open(array('url' => 'users/process','method' => 'post','data-abide' => '', 'autocomplete'=>"off")) }}

		<div class="row">
			<!-- article fields -->
			<div class="columns">
				<fieldset>
					<legend>Fields</legend>
					<input type="hidden" name="id" value="0">
					<div class="<?php if($errors->first('username')!=''){ echo 'error'; } ?>">
						<label>Username
				    		<span class="f2 rqrd"><i>Required!</i></span>
					        {{ Form::text('username', Input::old('username'), array('required' => true, 'id' => 'username')) }}
					    </label>
					    <small class="error"><?php if($errors->first('username')!=''){ echo $errors->first('username'); } else { echo 'Username is required.'; } ?></small>
					</div>

					<div class="<?php if($errors->first('password')!=''){ echo 'error'; } ?> passwordDiv">
					    <label>Password
				    		<span class="f2 rqrd"><i>Required!</i></span>
				    		<a href="#" class="showHidePass">Show</a>
					        {{ Form::password('password', array('required' => true, 'class' => 'password', 'autocomplete'=>'new-password')) }}
					    </label>
					    <small class="error"><?php if($errors->first('password')!=''){ echo $errors->first('password'); } else { echo 'Password is required.'; } ?></small>
					</div>

					<label>Name
				        {{ Form::text('name', Input::old('name'), array('id' => 'name')) }}
				    </label>

				    <label>Email
				        {{ Form::text('email', Input::old('email'), array('id' => 'email')) }}
				    </label>

				    {{ Form::hidden('access_token', $accessToken, array('id' => 'access_token')) }}

				</fieldset>
			</div>

		</div>


	{{ Form::close() }}

@stop

@section('footer.javascripts')
<script type="text/javascript">

	$(".showHidePass").click(function(e){
		e.preventDefault();
		var target = $(this).parents('.passwordDiv').find('input.password'),
			type = target.attr('type');

		if(type == 'password'){
			target.attr('type', 'text');
			$(this).html('Hide');
		}else{
			target.attr('type', 'password');
			$(this).html('Show');
		}
	})
</script>
@stop