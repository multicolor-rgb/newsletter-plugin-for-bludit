<link rel="stylesheet" type="text/css" href="/bl-plugins/tinymce/css/tinymce_toolbar.css">
<script src="/bl-plugins/tinymce/tinymce/tinymce.min.js?version=5.10.5"></script>

<div class="col-md-12 my-3  p-0 d-flex justify-content-between align-items-center">
<h4>Newsletter Settings</h4>

<script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#e02841', 'I3I2RHQZS');kofiwidget2.draw();</script> 

</div>

<div class="text-light bg-primary d-flex align-items-center justify-content-center p-3">


	<p class="m-0"> Put code to your template if you want invitate new user &#60;?php Theme::plugins('newsletter');?&#62; </p>


</div>


<div class="p-3 border bg-light mt-3">

	<label for="mb-2">Option Send</label>
	<select name="mailoption" class="mailoption" id="">
		<option value="smtp" <?php if ($this->getValue('mailoption') == 'smtp') {
									echo 'selected';
								}; ?>>SMTP</option>
		<option value="mail" <?php if ($this->getValue('mailoption') == 'mail') {
									echo 'selected';
								}; ?>>Mail</option>
	</select>

	<div class="smtp-options">

		<label class="mb-2">Sender's User Name:</label>

		<input type="text" name="sendername" value="<?php echo $this->getValue('sendername'); ?>" class="sendername form-control">

		<label class="mb-2">Sender's Email Address:</label>
		<input type="email" value="<?php echo $this->getValue('sender'); ?>" name="sender" class="form-control">

		<label class="mb-2">SMTP User Password: (only on smtp)</label>
		<input type="password" class="form-control" name="passwordsmtp" value="<?php echo $this->getValue('passwordsmtp'); ?>">


		<label class="mb-2">SMTP Server Address: (only on smtp)</label>
		<input type="text" name="smtpserver" value="<?php echo $this->getValue('smtpserver'); ?>" class="form-control">


		<label>SMTP Port: (only on smtp)</label>
		<input type="text" name="port" value="<?php echo $this->getValue('port'); ?>">

		<label class="mb-2">Requires Authorization? (only on smtp)</label>
		<select class="form-select" name="auth">
			<option <?php if ($this->getValue('auth') == 'true') {
						echo 'selected';
					}; ?> value="true">Yes</option>
			<option <?php if ($this->getValue('auth') == 'false') {
						echo 'selected';
					}; ?> value="false">No</option>
		</select>


		<label>Uses SSL? (only on smtp)</label>
		<select class="form-select" name="ssl">
			<option <?php if ($this->getValue('ssl') == 'true') {
						echo 'selected';
					}; ?> value="true">Yes</option>
			<option <?php if ($this->getValue('ssl') == 'false') {
						echo 'selected';
					}; ?> value="false">No</option>
		</select>

	</div>
</div>




<div class=" border mt-4 p-3 bg-light col-md-12">

	<label>Newsletter Recipients: <span class="text-muted">(Addresses are comma separated. <b>don't delete last comma after end last email!</b>)</span></label>
	<textarea name="maillist" class="form-control mt-2" style="height:300px;"><?php echo file_get_contents($this->phpPath() . 'security/emails') ?></textarea>

	<label class="mb-2">Newsletter's Form Subscribe Text:</label>
	<textarea name="messagenewsletter" id="post-content"><?php echo file_get_contents($this->phpPath() . 'security/info'); ?></textarea>

	<label class="mb-2">Subscribe newsletter button</label>
	<input type="text" name="subscribebtn" class="form-control" value="<?php echo $this->getValue('subscribebtn'); ?>">


	<label class="mb-2">Success send message info</label>
	<input type="text" name="successmsg" class="form-control" value="<?php echo $this->getValue('successmsg'); ?>">

	<label class="mb-2">Error send message info</label>
	<input type="text" name="errormsg" class="form-control" value="<?php echo $this->getValue('errormsg'); ?>">




</div>

<script>
	tinymce.init({
		selector: "#post-content",
		auto_focus: "post-content",
		element_format: "html",
		entity_encoding: "raw",
		skin: "oxide",
		schema: "html5",
		statusbar: false,
		menubar: false,
		branding: false,
		browser_spellcheck: true,
		pagebreak_separator: PAGE_BREAK,
		paste_as_text: true,
		remove_script_host: false,
		convert_urls: true,
		relative_urls: false,
		valid_elements: "*[*]",
		cache_suffix: "?version=5.10.5",

		plugins: ["code autolink image link pagebreak advlist lists textpattern table"],
		toolbar1: "formatselect bold italic forecolor backcolor removeformat | bullist numlist table | blockquote alignleft aligncenter alignright | link unlink pagebreak image code",
		toolbar2: "",
		language: "en",
		content_css: "/bl-plugins/tinymce/css/tinymce_content.css",
		codesample_languages: [],
	});
</script>


