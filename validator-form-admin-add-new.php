
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset( $_POST['aph-buradio-admin-delete-submit'])){

        global $wpdb;
        $tablename = $wpdb->prefix.'aph_mp3_buradio_playlist';

        $id = $_POST['aph-buradio-admin-delete-submit'];
        $wpdb->delete($tablename, array( 'id' => $id ));

        //header("Refresh:0");
    }

    if (isset( $_POST['aph-buradio-admin-details-submit'])){

        global $wpdb;
        $tablename = $wpdb->prefix.'aph_mp3_buradio_playlist';

        $wpdb->insert($tablename, array(
        'schedule_date' => $_POST['schedule_date'], 
        'programe_name' => $_POST['programe_name'],
        'programe_host' => $_POST['programe_host'], 
        'file_url' => $_POST['file_url'] ),
        array( '%s', '%s', '%s', '%s' ) 
        );

        //header("Refresh:0");
    }
}
?>


<div class="aph-buradio-admin-main-wrapper">
    <p class="aph-buradio-admin-heading">FH Certificate Validator</p>
    <button class="aph-buradio-admin-addnew-btn">+ ADD A RECORD</button>
    <a class="aph-buradio-admin-howto-btn" href="https://plugins.himusharier.xyz" target="_blank">[How to use][Update][News]</a>
    <br/>
    <h2>Record List:</h2>
</div>