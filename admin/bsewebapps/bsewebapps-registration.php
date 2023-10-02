<script>
    function checkInternet() {
        window.addEventListener("online", function () {
            document.getElementById('bwa-popup-admin-modal').style.display = 'block';
            document.documentElement.style.overflow = 'hidden';
        });
        window.addEventListener("offline", function () {
            document.getElementById('bwa-popup-admin-modal').style.display = 'none';
            document.documentElement.style.overflow = 'auto';
        });
    } setInterval(()=>{checkInternet();}, 1000);
</script>
<div id="bwa-popup-admin-modal">
    <div class="bwa-popup-admin-modal-form">
        <a>pop-up</a>
        <?php
        global $current_user;
        get_currentuserinfo();
        echo '<input type="text" value="' . $current_user->user_login . '">';
        echo '<input type="email" value="' . $current_user->user_email . '">';
        ?>
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
    }else{
        echo "<script>
                document.getElementById('bwa-popup-admin-modal').style.display = 'block';
                document.documentElement.style.overflow = 'hidden';
              </script>";
        fclose($netConnection);
    }
}