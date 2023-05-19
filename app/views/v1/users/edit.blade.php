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
	        <h4>Edit Account</h4>
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

	{{ Form::open(array('url' => 'users/process','method' => 'post','data-abide' => '')) }}

		<div class="row">
			<!-- article fields -->
			<div class="columns">
				<fieldset>
					<legend>User</legend>
					<input type="hidden" name="id" value="{{ $id }}">
					<div class="<?php if($errors->first('username')!=''){ echo 'error'; } ?>">
						<label>Username
				    		<span class="f2 rqrd"><i>Required!</i></span>
					        {{ Form::text('username', $username, array('required' => true, 'id' => 'username')) }}
					    </label>
					    <small class="error"><?php if($errors->first('username')!=''){ echo $errors->first('username'); } else { echo 'Username is required.'; } ?></small>
					</div>

					<fieldset>
						<legend>
							<div class="switch round small left">
								{{ Form::checkbox('update_password', false, false, ['id'=>'update_password']) }}
								<label for="update_password"></label>
							</div>
							Change Password
						</legend>

						@if(Auth::user()->id == $id)
							<div class="passwordDiv">
							    <label>Old Password <a href="#" class="right showHidePass">Show</a>
							        {{ Form::password('old_password', array('class' => 'password', 'disabled')) }}
							    </label>
							    <small class="error">Old password is required.</small>
							</div>
						@endif

						<div class="passwordDiv">
						    <label>New Password <a href="#" class="right showHidePass">Show</a>
						        {{ Form::password('password', array('class' => 'password', 'disabled')) }}
						    </label>
						    <small class="error">New password is required.</small>
						</div>
					</fieldset>

					<label>Name
				        {{ Form::text('name', $name, array('id' => 'name')) }}
				    </label>

				    <label>Email
				        {{ Form::text('email', $email, array('id' => 'email')) }}
				    </label>

				    {{ Form::hidden('access_token', $accessToken, array('id' => 'access_token')) }}

				</fieldset>
			</div>

		</div>


	{{ Form::close() }}

@stop

@section('footer.javascripts')
<script type="text/javascript">
	$("#update_password").click(function(){
		var parentContainer = $(this).parents('fieldset');
		parentContainer.find('input.password').prop('required', this.checked).prop('disabled', this.checked ? false : true);

		if(!this.checked) $(".passwordDiv").removeClass('error');
	});

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