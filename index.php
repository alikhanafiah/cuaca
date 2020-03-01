<?php
require 'vendor/autoload.php';
date_default_timezone_set('Asia/jakarta'); //set timezone to GMT+7

use Carbon\Carbon;

//$date = Carbon\Carbon::createFromDate(1945, 8, 17); //17 agustus 1945
//printf("Kapan Indonesia merdeka ? %s\n", $date->diffForHumans());

$api = new RestClient([
        'base_url'=> "https://ibnux.github.io/BMKG-importer",
        'format'=> "json"
]);
$result = $api->get("cuaca/501320");
$data = $result->decode_response();

foreach( (array) $data as $item) {
	$date = Carbon::createFromFormat('Y-m-d H:i:s', @$item->jamCuaca);
        printf("Cuaca kota singkawang tanggal %s, adalah %s dengan suhu %s derajat celcius. \n", $date->format('l'), $date->format('d M Y'), 
	@$date->format('H:i'), $item->tempC );
		//$item-jamCuaca, $item->cuaca, $item->tempC );
}

