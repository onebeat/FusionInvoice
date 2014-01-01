<script type="text/javascript">
$(function() {
    
    $('#mailPassword').val('');

    updateEmailOptions();

    $('#mailDriver').change(function() {

        updateEmailOptions();

    });

    function updateEmailOptions() {

        $('.email-option').hide();

        mailDriver = $('#mailDriver').val();

        if (mailDriver == 'smtp') {

            $('.smtp-option').show();

        }
        else if (mailDriver == 'sendmail') {

            $('.sendmail-option').show();

        }
    }

});
</script>

<div class="tab-info">

	<div class="control-group">
		<label class="control-label">{{ trans('fi.email_send_method') }}: </label>
		<div class="controls">
            {{ Form::select('setting_mailDriver', $emailSendMethods, Config::get('fi.mailDriver'), array('id' => 'mailDriver')) }}
		</div>
	</div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_host_address') }}: </label>
        <div class="controls">
            {{ Form::text('setting_mailHost', Config::get('fi.mailHost')) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_host_port') }}: </label>
        <div class="controls">
            {{ Form::text('setting_mailPort', Config::get('fi.mailPort')) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_username') }}: </label>
        <div class="controls">
            {{ Form::text('setting_mailUsername', Config::get('fi.mailUsername')) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_password') }}: </label>
        <div class="controls">
            {{ Form::password('setting_mailPassword', array('id' => 'mailPassword')) }}
        </div>
    </div>

    <div class="control-group smtp-option email-option">
        <label class="control-label">{{ trans('fi.smtp_encryption_type') }}: </label>
        <div class="controls">
            {{ Form::select('setting_mailEncryption', $emailEncryptions, Config::get('fi.mailEncryption')) }}
        </div>
    </div>

    <div class="control-group sendmail-option email-option">
        <label class="control-label">{{ trans('fi.sendmail_path') }}: </label>
        <div class="controls">
            {{ Form::text('setting_mailSendmail', Config::get('fi.mailSendmail')) }}
        </div>
    </div>    

</div>