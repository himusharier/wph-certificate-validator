<script>
    function checkInternet() {
        window.addEventListener("online", function () {
            document.getElementById("connectionStatus").innerHTML = "connected";
            // document.getElementById('submit-btn').style.display = 'inline-block';
            document.getElementById('aph-buradio-admin-modal').style.display = 'block';
        });
        window.addEventListener("offline", function () {
            // document.getElementById('submit-btn').style.display = 'none';
            document.getElementById("connectionStatus").innerHTML = "internet-required";
            document.getElementById('aph-buradio-admin-modal').style.display = 'none';
        });
    } setInterval(()=>{checkInternet();}, 1000);
</script>

<div id="connectionStatus"></div>

<div id="aph-buradio-admin-modal">
    <div class="aph-buradio-admin-modal-form">
        <div class="aph-buradio-admin-details">
            <p>pop-up</p>
        </div>
    </div>
</div>


<?php
// check if auth already happened:
include ("bsewebapps-auth.php");
if (!empty($bsewebapps_username) AND !empty($bsewebapps_email) AND !empty($bsewebapps_token)) {
    $auth_check = "found";

} else {
    $auth_check = "error";

    $netConnection = @fsockopen("webapps.bsepress.com", 443, $ferror, $fmsg, 30);
    if (!$netConnection){
//        $is_connected = "false"; //connection failure
//        $connection_Msg =  "not connected!";
        echo "<script>document.getElementById('aph-buradio-admin-modal').style.display = 'none';</script>";
    }else{
//        $is_connected = "true"; //connected
//        $connection_Msg =  "connected!";
        echo "<script>document.getElementById('aph-buradio-admin-modal').style.display = 'block';</script>";
        fclose($netConnection);
    }
}
