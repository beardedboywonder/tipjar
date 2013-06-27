<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName'])) {
		// $nameError = ' (Required!)';
		// $hasError = true;
		$name = trim($_POST['contactName']);
	} else {
		$name = trim($_POST['contactName']);
	}
	if(trim($_POST['email']) === '') {
		$emailError = ' (Required!)';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = ': This must not have been the email you were looking for...';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	$TipApp = Trim(stripslashes($_POST['onoffswitch']));
	// $tel = trim($_POST['tel']);
	if(trim($_POST['Message']) === '') {
		$commentError = ' (Required!)';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$Message = stripslashes(trim($_POST['Message']));
		} else {
			$Message = trim($_POST['Message']);
		}
	}
	if(!isset($hasError)) {
		$emailTo = "redbeardthepirate19@gmail.com";
		$subject = '[ TipJar - Contact ] via '.$name;
		$body = "Name: $name \nEmail: $email \nApp: $TipApp \n\nThe Message:\n$Message";
		$headers = 'From: '.$name.' <'.$email.'>' . "\n" . 'Reply-To: ' . $email;
		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
} ?>


<?php if(isset($emailSent) && $emailSent == true) { ?>
<h2 id="form">Thanks yo!</h2>
<p class="success">Your tip has been sent!</p>
<p class="success">Tip me baby one more time?</p>
<?php } else { ?>
<h2><?php if ( isset($hasError) ) { echo 'Whoops!'; } else { echo "Got a tip, and want to submit?"; } ?></h2>
<p style="width: 960px;margin: 0 auto;">I take pride in knowing lots of hotkeys and workflow tips, but I can't possibly know them all. Have you found something that has helped to increase your workflow in a specific app? Do me solid and submit your tip below? I would be super grateful, not to mention you could get credited in future updates to the site!</p>
<form action="/contact/#form" method="post" >
	<div id="switches"><a name="submit"></a>
		<div class="onoffswitch">
			<input type="radio" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" value="Photoshop" data-tip-app="Photoshop" checked>
			<label class="onoffswitch-label" for="myonoffswitch">
				<div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
		<div class="onoffswitch">
			<input type="radio" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch2" value="After Effects" data-tip-app="After Effects">
			<label class="onoffswitch-label-2" for="myonoffswitch2">
				<div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
		<div class="onoffswitch">
			<input type="radio" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch3" value="Illustrator" data-tip-app="Illustrator">
			<label class="onoffswitch-label-3" for="myonoffswitch3">
				<div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
		<div class="onoffswitch">
			<input type="radio" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch4" value="InDesign" data-tip-app="InDesign">
			<label class="onoffswitch-label-4" for="myonoffswitch4">
				<div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
		<div class="onoffswitch">
			<input type="radio" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch5" value="Flash" data-tip-app="Flash">
			<label class="onoffswitch-label-5" for="myonoffswitch5">
				<div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
		<div class="onoffswitch">
			<input type="radio" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch6" value="Dreamweaver" data-tip-app="Dreamweaver">
			<label class="onoffswitch-label-6" for="myonoffswitch6">
				<div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
		<div class="onoffswitch">
			<input type="radio" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch7" value="Sublime Text" data-tip-app="Sublime Text">
			<label class="onoffswitch-label-7" for="myonoffswitch7">
				<div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
	</div>
	<p class="none-selected js-selected-category">Choose a category</p>

	<textarea<?php if ( isset($commentError) ) { echo ' class="error"'; } ?> name="Message" id="MessageText" rows="8" cols="50" placeholder="Show me your tips!<?php if ( isset($commentError) ) { echo $commentError; } ?>" ><?php if ( isset($hasError) ) { echo trim($_POST['Message']); } ?></textarea>
	<br>
	<input<?php if ( isset($nameError) ) { echo ' class="error"'; } ?> type="text" name="contactName" id="contactName" value="<?php if ( isset($hasError) ) { echo trim($_POST['contactName']); } ?>" placeholder="Name<?php if ( isset($nameError) ) { echo $nameError; } ?>" />
	<br>	
	<input<?php if ( isset($emailError) ) { echo ' class="error"'; } ?> type="email" name="email" id="email" value="<?php if ( isset($hasError) && (!isset($emailError) ) ) { echo trim($_POST['email']); } ?>" placeholder="Email<?php if ( isset($emailError) ) { echo $emailError; } ?>" />
	<br>
	<div id="finalsubmit"><button type="submit">Submit</button></div>
	<input type="hidden" name="submitted" id="submitted" value="true" />
</form>
<?php } ?>
