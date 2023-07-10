
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
    <div class="aph-buradio-admin-playlist-table">
        <table class="aph-buradio-admin-playlist-table-responstable">
            <tbody>
                <tr>
                    <th style="width: 20px;">SL</th>
                    <th>DETAILS</th>
                    <th style="width: 100px;">DATE</th>
                    <th style="width: 100px;">ACTION</th>
                </tr>

<?php
global $wpdb;
$table_name = $wpdb->prefix . "aph_mp3_buradio_playlist";
$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name");
foreach ($retrieve_data as $retrieved_data){
?>
                <tr>
                    <td><?php echo @$snr += 1; ?></td>
                    <td class="aph-buradio-admin-playlist-details">
                        <p class="aph-buradio-admin-playlist-details-name"><?php echo $retrieved_data->programe_name; ?></p>
                        <p class="aph-buradio-admin-playlist-details-host"><?php echo $retrieved_data->programe_host; ?></p>
                        <p class="aph-buradio-admin-playlist-details-link"><?php echo $retrieved_data->file_url; ?></p>
                    </td>
                    <td><?php echo $retrieved_data->schedule_date; ?></td>
                    <td>
                        <form action="admin.php?page=fhcv-plugin-admin-post-edit" method="post">
                            <input type="hidden" name="hidden-id" value="<?php echo $retrieved_data->id; ?>">
                            <button class="aph-buradio-admin-edit-btn" type="submit">Edit</button>
                        </form>
                        <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                            <button value="<?php echo $retrieved_data->id; ?>" type="submit" name="aph-buradio-admin-delete-submit" class="aph-buradio-admin-delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
<?php 
}
if (empty($retrieve_data)) {
    echo "<tr>
    <td></td>
    <td align='center' style='padding:25px;font-size:16px;font-style:italic;'>No Record Found!</td>
    <td></td>
    <td></td>
    </tr>";
}
?>

                <tr>
                    <td>SL</td>
                    <td>DETAILS</td>
                    <td>DATE</td>
                    <td>ACTION</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="aph-buradio-admin-modal">
        <div class="aph-buradio-admin-modal-form">
            <div class="aph-buradio-admin-close-btn">X</div>
            <div class="aph-buradio-admin-details">
                <form action="" method="post">
                    <h2 class="aph-buradio-admin-details-heading">Add New Record</h2>
                    <label for="programe_name">Programe Name</label>
                    <input type="text" name="programe_name" id="programe_name" required>
                    <label for="programe_host">Host Name</label>
                    <input type="text" name="programe_host" id="programe_host" required>
                    <label for="schedule_date">Schedule Date</label>
                    <input type="date" name="schedule_date" id="schedule_date" required>
                    <label for="file_url">File Link <i>(with .mp3 at the end)</i></label>
                    <textarea name="file_url" id="file_url" required></textarea>
                    <br/>
                    <button class="aph-buradio-admin-details-save-btn" type="submit" name="aph-buradio-admin-details-submit">Save</button>
                    <button class="aph-buradio-admin-details-cancel-btn">Cancel</button>
                </form>
            </div>
        </div>
    </div>

</div>