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
	        <h4>Edit Provider</h4>
	    </div>
	    <div class="large-6 columns">
	        <div class="row collapse right">
	            <a href="/provider" class="small button">Go back</a>
	            <a href="javascript:void(0)" class="small button success provider_save">Save</a>
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

	{{ Form::open(array('url' => 'provider/process','method' => 'post','data-abide' => '')) }}
		<div class="row">
			<!-- article fields -->
			<div class="columns">
				<fieldset>
					<legend>Fields</legend>
					<input type="hidden" name="id" value="{{ $id }}">
					<div class="<?php if($errors->first('name')!=''){ echo 'error'; } ?>">
						<label>Provider Name
				    		<span class="f2 rqrd"><i>Required!</i></span>
					        {{ Form::text('name', $name, array('required' => true, 'id' => 'name')) }}
					    </label>
					    <small class="error"><?php if($errors->first('name')!=''){ echo $errors->first('name'); } else { echo 'Provider Name is required.'; } ?></small>
					</div>
					
					<div class="<?php if($errors->first('url')!=''){ echo 'error'; } ?>">
						<label>Provider URL
				    		<span class="f2 rqrd"><i>Required!</i></span>
					        {{ Form::text('url', $url, array('required' => true, 'id' => 'url')) }}
					    </label>
					    <small class="error"><?php if($errors->first('url')!=''){ echo $errors->first('url'); } else { echo 'Provider URL is required.'; } ?></small>
					</div>
				</fieldset>
			</div>
		</div>
	{{ Form::close() }}

@stop

@section('footer.javascripts')
@stop