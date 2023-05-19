@section('body')

    <div class="top-margin">
        {{ Form::open(array('url' => 'login','method' => 'post','data-abide' => '','onsubmit'=>'return  createCookie("visitorType",true,360) ')) }}
        {{ Form::hidden('r', Input::get('r', 'provider')) }}
        <div class="row">
          <?php if(Session::get('message')!="") { ?>
          <div class="row">
            <div data-alert="" class="alert-box">
              {{ Session::get('message') }}
              <a href="#" class="close">×</a>
            </div>
          </div>
          <?php } ?>
          <div class="large-5 large-centered columns <?php if($errors->first('username')!=''){ echo 'error'; } ?>">
            <label>Username
              {{ Form::text('username', Input::old('username'), array('required' => true, 'id' => 'username')) }}
            </label>
            <small class="error"><?php if($errors->first('username')!=''){ echo $errors->first('username'); } else { echo 'Username is required.'; } ?></small>
          </div>
          <div class="large-5 large-centered columns <?php if($errors->first('password')!=''){ echo 'error'; } ?>">
            <label>Password
              {{ Form::password('password', array('required' => true, 'id' => 'password')) }}
            </label>
            <small class="error"><?php if($errors->first('password')!=''){ echo $errors->first('password'); } else { echo 'Password is required.'; } ?></small>
          </div>
          <div class="large-5 large-centered columns">
            <input type="submit" class="expand button" value="LOGIN">
          </div>
          <div class="large-5 large-centered columns">
            <a href="{{ url('/password/remind') }}">Forgot password?</a>
          </div>
        </div>
      {{ Form::close() }}
    </div>

@stop

