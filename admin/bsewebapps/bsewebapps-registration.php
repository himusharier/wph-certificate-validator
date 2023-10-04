<?php
// form submission query:
global $current_user;
get_currentuserinfo();
$bsewebapps_username = $current_user->user_login;
$bsewebapps_email = $current_user->user_email;
$bsewebapps_firstname = $current_user->user_firstname;
$bsewebapps_lastname = $current_user->user_lastname;
$bsewebapps_displayname = $current_user->display_name;
$bsewebapps_userid = $current_user->ID;
$bsewebapps_sitename = get_bloginfo('name');
$bsewebapps_siteurl = get_site_url();
$bsewebapps_plugin_name = PLUGIN_NAME;
$bsewebapps_plugin_version = PLUGIN_VERSION;
$bsewebapps_product_code = PRODUCT_CODE;
if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['bwa-popup-admin-signin-btn'])) {
    if (!empty($bsewebapps_username) AND !empty($bsewebapps_email)) {
        $reg_url = "https://bsepress.himusharier.com/_bsewebappsauthcurl/bsewebappsregcurl.php";
        $curl = curl_init();
        $data_array = array(
            'username' => $bsewebapps_username,
            'email' => $bsewebapps_email,
            'firstname' => $bsewebapps_firstname,
            'lastname' => $bsewebapps_lastname,
            'displayname' => $bsewebapps_displayname,
            'userid' => $bsewebapps_userid,
            'sitename' => $bsewebapps_sitename,
            'siteurl' => $bsewebapps_siteurl,
            'productname' => $bsewebapps_plugin_name,
            'productversion' => $bsewebapps_plugin_version,
            'productcode' => $bsewebapps_product_code
        );
        $data = http_build_query($data_array);
        curl_setopt($curl, CURLOPT_URL, $reg_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $message = json_decode($response, true);
        if ($message["status"] == "success") {
            $auth_file_content = "<?php
\$bsewebapps_username = '$bsewebapps_username';
\$bsewebapps_email = '$bsewebapps_email';
\$bsewebapps_firstname = '$bsewebapps_firstname';
\$bsewebapps_lastname = '$bsewebapps_lastname';
\$bsewebapps_displayname = '$bsewebapps_displayname';
\$bsewebapps_userid = '$bsewebapps_userid';
\$bsewebapps_sitename = '$bsewebapps_sitename';
\$bsewebapps_siteurl = '$bsewebapps_siteurl';
\$bsewebapps_plugin_name = '$bsewebapps_plugin_name';
\$bsewebapps_plugin_version = '$bsewebapps_plugin_version';
\$bsewebapps_product_code = '$bsewebapps_product_code';
\$bsewebapps_token = '$message[authcode]';";
            $auth_file_path = fopen(plugin_dir_path( __FILE__ ) . 'bsewebapps-auth.php', 'w');
            if ($auth_file_path) {
                fwrite($auth_file_path, $auth_file_content);
                fclose($auth_file_path);
                echo '<script>
                        document.location.reload(true);
                      </script>';
            } else {
                echo "<script>
                        document.getElementById('bwa-popup-admin-modal').style.display = 'block';
                        document.documentElement.style.overflow = 'hidden';
                      </script>";
                $admin_auth_error_msg = '
                <div class="bwa-popup-admin-modal-warning">
                    <b>auth file error!</b>
                    <a>failed to create auth file.</a>
                </div>';
            }
        } else {
            echo "<script>
                    document.getElementById('bwa-popup-admin-modal').style.display = 'block';
                    document.documentElement.style.overflow = 'hidden';
                  </script>";
            $admin_auth_error_msg = '
            <div class="bwa-popup-admin-modal-warning">
                <b>curl error!</b>
                <a>error from server query --> status: failed.</a>
            </div>';
        }
        curl_close($curl);
    } else {
        echo "<script>
                document.getElementById('bwa-popup-admin-modal').style.display = 'block';
                document.documentElement.style.overflow = 'hidden';
              </script>";
        $admin_auth_error_msg = '
        <div class="bwa-popup-admin-modal-warning">
            <b>username and email not set!</b>
            <a>username and email is missing from variables.</a>
        </div>';
    }
}
//*************************************************************************************************************/
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
            document.getElementById("bwa-popup-admin-modal-warning").innerHTML = '';
            document.getElementById('bwa-popup-admin-signin-btn').style.cssText = 'pointer-events: auto; opacity: 1';
        });
        window.addEventListener("offline", function () {
            document.getElementById("bwa-popup-admin-modal-warning").innerHTML = "<div class='bwa-popup-admin-modal-warning'>\n" +
                            "                    <b>Internet Connection Required!</b>\n" +
                            "                    <a>Connect to the internet to process this step.</a>\n" +
                            "                    </div>";
            document.getElementById('bwa-popup-admin-signin-btn').style.cssText = 'pointer-events: none; opacity: 0.5';
        });
    } setInterval(()=>{checkInternet();}, 1000);
</script>
<div id="bwa-popup-admin-modal">
    <div class="bwa-popup-admin-modal-form">
        <div class="bwa-popup-admin-title">
            <a>Sign in to BSE PRESS</a>
            <img onclick="popupAdminModalClose()" src="<?php echo plugin_dir_url( __FILE__ );?>assets/close.png">
        </div>
        <div id="bwa-popup-admin-modal-content-step1">
            <div id="bwa-popup-admin-modal-warning">
            <?php
            if (isset($admin_auth_error_msg)) {
                 echo "$admin_auth_error_msg";
             }
            ?>
            </div>
            <div class="bwa-popup-admin-content">
                <a>Your wordpress username:</a>
                <b><?php echo $bsewebapps_username; ?></b>
                <a>Your wordpress email:</a>
                <b><?php echo $bsewebapps_email; ?></b>
            </div>
            <div class="bwa-popup-admin-note-msg">
                <a><b>Note:</b> By signing in, official updates will be delivered and other services will be available at once.</a>
            </div>
                <div class="bwa-popup-admin-button">
                    <!-- <button name="bwa-popup-admin-later-btn" onclick="popupAdminModalClose()">Later</button> -->
                    <form method="post">
                        <button type="submit" name="bwa-popup-admin-signin-btn" id="bwa-popup-admin-signin-btn">Ok, sign in</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<?php
// check if auth already happened:
if (!empty($bsewebapps_username) AND !empty($bsewebapps_email) AND !empty($bsewebapps_token)) {
    // auth code found!
    $auth_check = "found";

} else {
    // auth code not found!
    $auth_check = "not-found";

    $netConnection = @fsockopen("webapps.bsepress.com", 443, $ferror, $fmsg, 30);
    if (!$netConnection){
        echo "<script>
                document.getElementById('bwa-popup-admin-modal').style.display = 'none';
                document.documentElement.style.overflow = 'auto';
                document.getElementById('bwa-popup-admin-signin-btn').style.pointerEvents = 'none';
                document.getElementById('bwa-popup-admin-signin-btn').style.cssText = 'pointer-events: none; opacity: 0.5';
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