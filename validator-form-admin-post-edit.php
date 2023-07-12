<?php
if (empty($_POST['hidden-id'])) {
    //header("Location: admin.php?page=buradio-mp3-player-plugin-dashboard");
    //echo "<script type='text/javascript'> document.location = 'admin.php?page=validator-form-plugin-dashboard'; </script>";

    echo "certificate id input field";

} else {


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset( $_POST['aph-buradio-admin-details-submit-edit'])){

        global $wpdb;
        $tablename = $wpdb->prefix.'aph_mp3_buradio_playlist';

        $updateQuery = $wpdb->update($tablename, array(
        'schedule_date' => $_POST['schedule_date'], 
        'programe_name' => $_POST['programe_name'],
        'programe_host' => $_POST['programe_host'], 
        'file_url' => $_POST['file_url'] ),
        array( 'id' => $_POST['hidden-id'] ) 
        );

        //header("Location: admin.php?page=buradio-mp3-player-plugin-dashboard");
        echo "<script type='text/javascript'> document.location = 'admin.php?page=buradio-mp3-player-plugin-dashboard'; </script>";
        
    }
}


echo "<div class='aph-buradio-admin-main-wrapper'>";

$postId = $_POST["hidden-id"];

global $wpdb;
$table_name = $wpdb->prefix . "aph_mp3_buradio_playlist";
$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$postId");
foreach ($retrieve_data as $retrieved_data){
echo "
    <div class='aph-buradio-admin-modal-edit'>
        <div class='aph-buradio-admin-modal-form'>
            <div class='aph-buradio-admin-details'>
                <form action='' method='post'>
                    <h2 class='aph-buradio-admin-details-heading'>Edit Record</h2>
                    <label for='programe_name'>Programe Name</label>
                    <input type='text' name='programe_name' id='programe_name' value=' $retrieved_data->programe_name' required>
                    <label for='programe_host'>Host Name</label>
                    <input type='text' name='programe_host' id='programe_host' value=' $retrieved_data->programe_host' required>
                    <label for='schedule_date'>Schedule Date</label>
                    <input type='text' name='schedule_date' id='schedule_date' value=' $retrieved_data->schedule_date' required>
                    <label for='file_url'>File Link <i>(with .mp3 at the end)</i></label>
                    <textarea name='file_url' id='file_url' required>
                    $retrieved_data->file_url</textarea>
                    <br/>
                    <input type='hidden' name='hidden-id' value='$retrieved_data->id'>
                    <button class='aph-buradio-admin-details-save-btn' type='submit' name='aph-buradio-admin-details-submit-edit'>Update</button>
                </form>
            </div>
        </div>
    </div>
    
    ";
}
echo "</div>";

}