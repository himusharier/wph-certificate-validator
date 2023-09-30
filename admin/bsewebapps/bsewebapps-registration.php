<?php
// check if auth already happened:
include ("bsewebapps-auth.php");
if (!empty($bsewebapps_username) AND !empty($bsewebapps_email) AND !empty($bsewebapps_token)) {
    $auth_check = "found";
    echo "ok<br/>";
} else {
    $auth_check = "error";
    echo "confirmation pop-up<br/>";

    $netConnection = @fsockopen("webapps.bsepress.com", 443);
    if ($netConnection){
        $is_connected = "true"; //connected
        $connection_Msg =  "connected!";
        ?>
        <section>
<!--            <button class="show-modal">Show Modal</button>-->
            <span class="overlay"></span>
            <div class="modal-box">
                <i class="fa-regular fa-circle-check"></i>
                <h2>Completed</h2>
                <h3>You have sucessfully downloaded all the source code files.</h3>
                <div class="buttons">
                    <button class="close-btn">Ok, Close</button>
                    <button>Open File</button>
                </div>
            </div>
        </section>
        <?php
        fclose($netConnection);
    }else{
        $is_connected = "false"; //connection failure
        $connection_Msg =  "not connected!";
    }
    ?>
    <script>
        function checkInternet() {
            window.addEventListener("online", function () {
                document.getElementById("connectionStatus").innerHTML = "connected";
                // document.getElementById('submit-btn').style.display = 'inline-block';
            });
            window.addEventListener("offline", function () {
                // document.getElementById('submit-btn').style.display = 'none';
                document.getElementById("connectionStatus").innerHTML = "internet-required";
            });
        }
        setInterval(()=>{
            checkInternet();
        }, 1000);
    </script>
    <div id='connectionStatus'>
        <?php
        if (isset($connection_Msg)) {
            echo $connection_Msg;
        }
        ?>
    </div>


<?php
}











//if ($connection_error == false) {
//    $check_table = $_POST['db-prefix'].'admin'; //existing table name
//    if(mysqli_num_rows(mysqli_query($check_connection,"SHOW TABLES LIKE '$check_table'"))) {
//        //echo "DB EXIST";
//        $error_head = "Table Prefix Used Before!";
//        $error_text = "Your database already using this table prefix. Pick a different one.";
//    } else {
//        //echo "DB Not Exist";
//        $db_name = clean_inputs($_POST['db-name']);
//        $db_user = clean_inputs($_POST['db-user']);
//        $db_pass = clean_inputs($_POST['db-pass']);
//        $db_host = clean_inputs($_POST['db-host']);
//        $db_prefix = clean_inputs($_POST['db-prefix']);
//
//        global $current_user;
//        get_currentuserinfo();
//        $bsewebapps_username = $current_user->user_login;
//        $bsewebapps_email = $current_user->user_email;
//        $bsewebapps_firstname = $current_user->user_firstname;
//        $bsewebapps_lastname = $current_user->user_lastname;
//        $bsewebapps_displayname = $current_user->display_name;
//        $bsewebapps_userid = $current_user->ID;
//        $bsewebapps_sitename = get_site_url();
//        $bsewebapps_siteurl = get_bloginfo('name');
//
//        $db_config_file = "<?php
//$bsewebapps_username = '$bsewebapps_username';
//$bsewebapps_email = '$bsewebapps_email';
//$bsewebapps_firstname = '$bsewebapps_firstname';
//$bsewebapps_lastname = '$bsewebapps_lastname';
//$bsewebapps_displayname = '$bsewebapps_displayname';
//$bsewebapps_userid = '$bsewebapps_userid';
//$bsewebapps_sitename = '$bsewebapps_sitename';
//$bsewebapps_siteurl = '$bsewebapps_siteurl';
//$bsewebapps_token = '';
//        ";
//
//        $file_name = fopen('configs/database-connection.php', 'wb');
//        if (fwrite($file_name, $db_config_file)) {
//            header("location: ./"); // refresh page
//                                // problem found in reloading on live server. page should be hard refresh.
//            echo '<script type="text/javascript">location.reload(true);</script>';
//        } else {
//            $error_head = "Something Went Wrong!";
//            $error_text = "Sorry, could not set the database configurations right now. Try again later.";
//        }
//        fclose($file_name);
//
//    }
//}