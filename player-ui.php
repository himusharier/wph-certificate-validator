<div class="wp-radio-player-himu-main-wrapper">
    <div class="wp-radio-player-himu-playlist-wrapper">
        <div class="wp-radio-player-himu-playlist-wrapper-header-body">
            <div class="wp-radio-player-himu-modal-title wp-radio-player-himu-playlist-wrapper-header">
                <div class="wp-radio-player-himu-playlist-wrapper-header">
                    <i class="material-icons">queue_music</i>
                    <span>Playlist</span>
                </div>
                <i id="close-playlist" class="material-icons wp-radio-player-himu-close-btn">close</i>
            </div>
        </div>
        <ul class="wp-radio-player-himu-playlist-items">

<?php
global $wpdb;
$table_name = $wpdb->prefix . "aph_mp3_buradio_playlist";
$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");
$sl = 0;
foreach ($retrieve_data as $retrieved_data){
?>
            <li data-src="<?php echo $retrieved_data->file_url; ?>"
                data-name="<?php echo $retrieved_data->programe_name; ?>" data-host="<?php echo $retrieved_data->programe_host; ?>" data-index="<?php echo $sl++; ?>">
                <span><?php echo $retrieved_data->programe_name; ?><br />
                    <span style="font-size: 12px;"><?php echo $retrieved_data->programe_host; ?></span>
                </span>
                <span style="font-size: 12px;"><?php echo $retrieved_data->schedule_date; ?></span>
            </li>
<?php 
}
?>

        </ul>
    </div>

    <div class="wp-radio-player-himu-audio-box-wrapper">
        <div class="wp-radio-player-himu-audio-box-body">
            <div class="wp-radio-player-himu-audio-box-play-btn">
                <i class="material-icons">play_arrow</i>
            </div>
            <div class="wp-radio-player-himu-audio-box-play-name">
                <span class="wp-radio-player-himu-audio-box-play-name-item"></span>
                <span class="wp-radio-player-himu-audio-box-play-name-host"></span>
            </div>
            <div class="wp-radio-player-himu-audio-box-play-list">
                <i id="more-music" class="material-icons">queue_music</i>
            </div>
        </div>
        <div class="wp-radio-player-himu-audio-box-play-bar-area">
            <div class="wp-radio-player-himu-audio-box-play-bar-length"></div>
        </div>
        <div class="wp-radio-player-himu-audio-box-play-length-timer">
            <a class="current">0:00</a>
            <a class="duration"></a>
        </div>
        <audio src="" id="main-audio"></audio>
    </div>
</div>