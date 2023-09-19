<div class="wphcv-alpha-container">
    <p class="wphcv-form-heading">Enter Certificate ID:</p>
    <form class="wphcv-input-form">
	    <input placeholder="Certificate ID" type="text" id="certificateId" required>
	    <button type="submit" class="wphcv-submitButton" id="submitBtn">Validate &crarr;</button>
	</form>
	<div class="wphcv-certificate-details">
		<div class="wphcv-certificate-details-heading found">
			<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/verified.png">
			<p><a style="font-weight: bolder;">Congratulations !</a><br/> You are verified.</p>
		</div>
		<div class="wphcv-certificate-details-body">
			<a><a style="font-weight: bolder;">Name:</a> Sharier Himu</a><br/>
			<a><a style="font-weight: bolder;">Issue Date:</a> 19-09-2023</a>
		</div>
		<!-- <div class="wphcv-certificate-details-heading error">
			<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/not-verified.png">
			<p><a style="font-weight: bolder;">Not Found !</a><br/> Invalid Certificate ID.</p>
		</div> -->
	</div>
</div>