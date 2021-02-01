<?php 

if(!empty($server_ip) && !empty($server_port)){
	function fetch_server_info($ip, $port){
		$socket = fsockopen($ip, $port, $errno, $errstr,0.5);

		if($socket === false){
			return false;
		}

		fwrite($socket, "\xfe");

		$data = fread($socket, 256);

		$data = explode("§", mb_convert_encoding(substr($data, 3),'UTF8', 'UCS-2'));

		return array(
			'motd' => $data[0],
			'players' => intval($data[1]),
			'max_players' => intval($data[2])
		);
	}
}

?>