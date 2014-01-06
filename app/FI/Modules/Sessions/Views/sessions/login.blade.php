<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

        <script type="text/javascript" src="{{ asset('assets/js/libs/jquery-1.7.1.min.js') }}"></script>

		<style>
			body {
				padding-top: 60px;
			}
		</style>

		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        
        <script type="text/javascript">
            $(function() { $('#email').focus(); });
        </script>

	</head>

	<body>

	<div id="login">
        
		<h1>{{ trans('fi.login') }}</h1>
		
		{{ Form::open(array('route' => 'session.login', 'class' => 'form-horizontal')) }}

			<div class="control-group">
				<label class="control-label">{{ trans('fi.email') }}</label>
				<div class="controls">
					{{ Form::text('email', null, array('id' => 'email', 'placeholder' => trans('fi.email'))) }}
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">{{ trans('fi.password') }}</label>
				<div class="controls">
					{{ Form::password('password', array('id' => 'password', 'placeholder' => trans('fi.password'))) }}
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					{{ Form::submit(trans('fi.login'), array('class' => 'btn btn-primary')) }}
				</div>
			</div>

		</form>

	</div>

	</body>
</html>