<?php

$LIGHT_THRESHOLD = 100;

$json_data = file_get_contents('https://api.xively.com/v2/feeds/1196670234?key=B9ducgI1uRVKVufiyyPKwh847fZ82BU5Y7qMzSuPV1qCWbGW');

if (isset($json_data)) {

	$json_data = json_decode($json_data, true);

	if (array_key_exists('datastreams', $json_data) && count($json_data['datastreams'] > 0)) {

		$feed_datasets = $json_data['datastreams'];

		$feed_data = array_pop($feed_datasets);

		if ($feed_data['id'] == 'Light') {

			$string_light_message = 'The lights at the Generator are currently: ';

			if ($feed_data['current_value'] > $LIGHT_THRESHOLD) {
				$string_light_message .='<strong>ON</strong>';
			} else {
				$string_light_message .='<strong>OFF</strong>';
			}

			$string_light_status = $feed_data['id'].' level: '.$feed_data['current_value'].' at '.date('h:ia', strtotime($feed_data['at']));

			echo $string_light_message;

			echo '<br /><br />';

			echo '<small>'.$string_light_status.'</small>';
		} else {
			//Not light data
		}
	} else {
		//Data error
	}
} else {
	//API error
}
?>
