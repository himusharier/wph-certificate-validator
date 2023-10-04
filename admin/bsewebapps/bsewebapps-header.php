<?php
include ("bsewebapps-auth.php");
include ("bsewebapps-registration.php");
?>
<div class="bwa-header-main-container">
    <div class="bwa-header-div-left-element">
        <a href="https://webapps.bsepress.com" target="_blank">
            <img src="<?php echo plugin_dir_url( __FILE__ );?>assets/bse-site-logo.png">
        </a>
    </div>
    <div class="bwa-header-div-right-element">
        <div class="bwa-header-div-menu">
            <a href="https://webapps.bsepress.com" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/apps.png">Apps</a>
            <a href="admin.php?page=certificate-validator-plugin-update"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/update.png">Updates
                <!-- <div class="bwa-header-div-dot">
                    <div class="bwa-header-div-dot-div"></div>
                </div> -->
            </a>
            <a class="bwa-header-account-div" onclick="accountMenu()"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/account.png"><?php if ($auth_check == "found"){echo $bsewebapps_username;}else{echo "Account";} ?></a>
            <div class="bwa-header-account-container">
                <div class="bwa-header-account-div-content" id="accountMenuItems">
                    <?php
                    if ($auth_check == "found") {
                    ?>
                    <a>
                        <span>
                            <?php
                            echo '<b>' . $bsewebapps_email . "</b><br/>" . $bsewebapps_username;
                            ?>
                        </span>
                    </a>
                    <a href="#"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/account.png">Profile</a>
                    <a href="admin.php?page=certificate-validator-plugin-settings"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/settings.png">Settings</a>
<!--                    <a href="#"><img src="--><?php //echo plugin_dir_url( __FILE__ );?><!--assets/logout.png">Logout</a>-->
                    <?php
                    }
                    ?>
                    <?php
                    if ($auth_check == "not-found") {
                    ?>
                    <a>
                        <span>
                            <button class="bwa-header-account-signin-btn" name="bwa-signin-btn" onclick="popupAdminModalView()"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/login.png">Sign in</button>
                        </span>
                    </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>