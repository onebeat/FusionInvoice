<script type="text/javascript">
$(function() {
    
    $('#emailSmtpPassword').val('');

    updateEmailOptions();

    $('#emailSendMethod').change(function() {

        updateEmailOptions();

    });

    function updateEmailOptions() {

        $('.email-option').hide();

        emailSendMethod = $('#emailSendMethod').val();

        if (emailSendMethod == 'smtp') {

            $('.smtp-option').show();

        }
        else if (emailSendMethod == 'sendmail') {

            $('.sendmail-option').show();

        }
    }

});
</script>

<div class="tab-info">

	<div class="control-group">
		<label class="control-label">{{ trans('fi.email_send_method') }}: </label>
		<div class="controls">
            {{ Form::select('setting_emailSendMethod', $emailSendMethods, Config::get('fi.emailSendMethod'), ['id' => 'emailSendMethod']) }}
		</div>
	</div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_host_address') }}: </label>
        <div class="controls">
            {{ Form::text('setting_emailSmtpHostAddress', Config::get('fi.emailSmtpHostAddress')) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_host_port') }}: </label>
        <div class="controls">
            {{ Form::text('setting_emailSmtpHostPort', Config::get('fi.emailSmtpHostPort')) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_username') }}: </label>
        <div class="controls">
            {{ Form::text('setting_emailSmtpUsername', Config::get('fi.emailSmtpUsername')) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_password') }}: </label>
        <div class="controls">
            {{ Form::password('setting_emailSmtpPassword', ['id' => 'emailSmtpPassword']) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_encryption_type') }}: </label>
        <div class="controls">
            {{ Form::select('setting_emailSmtpEncryption', $emailEncryptions, Config::get('fi.emailSmtpEncryption')) }}
        </div>
    </div>

    <div class="control-group sendmail-option email-option">
        <label class="control-label">{{ trans('fi.sendmail_path') }}: </label>
        <div class="controls">
            {{ Form::text('setting_emailSendmailPath', Config::get('fi.emailSendmailPath')) }}
        </div>
    </div>    

</div>