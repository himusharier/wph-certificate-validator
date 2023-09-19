<div class="wphcv-alpha-container">
    <p class="wphcv-form-heading">Enter Certificate ID:</p>
    <form class="wphcv-input-form">
	    <input placeholder="Certificate ID" type="text" id="certificateId" required>
	    <button type="submit" class="wphcv-submitButton" id="submitBtn">Validate</button>
	    <!-- <button type="submit" class="wphcv-submitButton" id="submitBtn">Validate &crarr;</button> -->
	</form>
	<div class="wphcv-certificate-details">
		<div class="wphcv-certificate-details-heading found">
			<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/verified.png">
			<span><p class="wphcv-certificate-details-heading-msg">Congratulations !</p><p>Your certificate is verified.<p></span>
		</div>
		<div class="wphcv-certificate-details-body">
			<p><b>Name:</b> Sharier Himu</p>
			<p><b>Issue Date:</b> 19-09-2023</p>
		</div>
		<!-- <div class="wphcv-certificate-details-heading error">
			<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/not-verified.png">
			<span><p class="wphcv-certificate-details-heading-msg">Not Found !</p><p>Invalid Certificate ID.<p></span>
		</div> -->
	</div>
</div>