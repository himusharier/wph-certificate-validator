<?php
if ($connection_error == false) {
    $check_table = $_POST['db-prefix'].'admin'; //existing table name
    if(mysqli_num_rows(mysqli_query($check_connection,"SHOW TABLES LIKE '$check_table'"))) {
        //echo "DB EXIST";
        $error_head = "Table Prefix Used Before!";
        $error_text = "Your database already using this table prefix. Pick a different one.";
    } else {
        //echo "DB Not Exist";
        $db_name = clean_inputs($_POST['db-name']);
        $db_user = clean_inputs($_POST['db-user']);
        $db_pass = clean_inputs($_POST['db-pass']);
        $db_host = clean_inputs($_POST['db-host']);
        $db_prefix = clean_inputs($_POST['db-prefix']);

        global $current_user;
        get_currentuserinfo();
        $bsewebapps_username = $current_user->user_login;
        $bsewebapps_email = $current_user->user_email;
        $bsewebapps_firstname = $current_user->user_firstname;
        $bsewebapps_lastname = $current_user->user_lastname;
        $bsewebapps_displayname = $current_user->display_name;
        $bsewebapps_userid = $current_user->ID;
        $bsewebapps_sitename = get_site_url();
        $bsewebapps_siteurl = get_bloginfo('name');

        $db_config_file = "<?php
$bsewebapps_username = '$bsewebapps_username';
$bsewebapps_email = '$bsewebapps_email';
$bsewebapps_firstname = '$bsewebapps_firstname';
$bsewebapps_lastname = '$bsewebapps_lastname';
$bsewebapps_displayname = '$bsewebapps_displayname';
$bsewebapps_userid = '$bsewebapps_userid';
$bsewebapps_sitename = '$bsewebapps_sitename';
$bsewebapps_siteurl = '$bsewebapps_siteurl';
$bsewebapps_token = '';
        ";

        $file_name = fopen('configs/database-connection.php', 'wb');
        if (fwrite($file_name, $db_config_file)) {
            header("location: ./"); // refresh page
                                // problem found in reloading on live server. page should be hard refresh.
            echo '<script type="text/javascript">location.reload(true);</script>';
        } else {
            $error_head = "Something Went Wrong!";
            $error_text = "Sorry, could not set the database configurations right now. Try again later.";
        }
        fclose($file_name);

    }
}