<?php
$netConnection = @fsockopen("webapps.bsepress.com", 443, $ferror, $fmsg, 30);
    if (!$netConnection){
        $admin_auth_error_msg = '
        <div class="bwa-popup-admin-modal-warning">
            <b>Internet Connection Required!</b>
            <a>Connect to the internet to process this step.</a>
        </div>';
    }else{
        fclose($netConnection);
    }
?>
<script>
    function checkInternet() {
        window.addEventListener("online", function () {
            // document.getElementById('bwa-popup-admin-modal').style.display = 'block';
            // document.documentElement.style.overflow = 'hidden';
            document.getElementById("bwa-popup-admin-modal-warning").innerHTML = '';
        });
        window.addEventListener("offline", function () {
            // document.getElementById('bwa-popup-admin-modal').style.display = 'none';
            // document.documentElement.style.overflow = 'auto';
            document.getElementById("bwa-popup-admin-modal-warning").innerHTML = "<div class='bwa-popup-admin-modal-warning'>\n" +
                            "                    <b>Internet Connection Required!</b>\n" +
                            "                    <a>Connect to the internet to process this step.</a>\n" +
                            "                    </div>";
        });
    } setInterval(()=>{checkInternet();}, 1000);
</script>
<div id="bwa-popup-admin-modal">
    <div class="bwa-popup-admin-modal-form">
        <div class="bwa-popup-admin-title">
            <a>Sign in to BSE PRESS</a>
            <span id="bwa-popup-admin-modal-close">
                <img src="<?php echo plugin_dir_url( __FILE__ );?>assets/close.png">
            </span>
        </div>
        <div id="bwa-popup-admin-modal-warning">
        <?php
        if (isset($admin_auth_error_msg)) {
             echo "$admin_auth_error_msg";
         }
        ?>
        </div>
        <div class="bwa-popup-admin-content">
            <?php
            global $current_user;
            get_currentuserinfo();
            echo '<a>Your wordpress username:</a>';
            echo '<b>' . $current_user->user_login . '</b>';
            // echo '<input type="text" value="' . $current_user->user_login . '">';
            echo '<a>Your wordpress email:</a>';
            echo '<b>' . $current_user->user_email . '</b>';
            // echo '<input type="email" value="' . $current_user->user_email . '">';
            ?>
        </div>
        <div class="bwa-popup-admin-button">
            <button class="" name="" id="bwa-popup-admin-later-btn">Later</button>
            <button class="" name="" id="">Sign in</button>
        </div>
    </div>
</div>
<?php
// check if auth already happened:
if (!empty($bsewebapps_username) AND !empty($bsewebapps_email) AND !empty($bsewebapps_token)) {
    // auth code found!
    $auth_code_check = "found";

} else {
    // auth code not found!
    $auth_code_check = "not-found";

    $netConnection = @fsockopen("webapps.bsepress.com", 443, $ferror, $fmsg, 30);
    if (!$netConnection){
        echo "<script>
                document.getElementById('bwa-popup-admin-modal').style.display = 'none';
                document.documentElement.style.overflow = 'auto';
              </script>";
        $admin_auth_error_msg = '
        <div class="bwa-popup-admin-modal-warning">
            <b>Internet Connection Required!</b>
            <a>Connect to the internet to processed this step.</a>
        </div>';
    }else{
        echo "<script>
                document.getElementById('bwa-popup-admin-modal').style.display = 'block';
                document.documentElement.style.overflow = 'hidden';
              </script>";
        fclose($netConnection);
    }
}