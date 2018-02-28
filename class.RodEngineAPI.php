<?php

/**
*	
*	RodEngine Trade Bot API
*	Documentation: https://api.rodengine.com/
*	Github: https://github.com/rewoke/rodengine
*	API: https://www.rodengine.com/auth/register
* 
*/

class RodEngineAPI
{
	private $url = 'https://api.rodengine.com/api';
	private $key = 'APIKEY';

	public function get($data)
	{
		$geturl = $this->url.'/'.$data;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $geturl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('X-APIKEY' => $this->key)));

		$exec = curl_exec($ch);
		curl_close($ch);

		return $exec;
	}

	public function indicator($pair, $period, $indicator, $data, $all = false)
	{
		$allV = '';
		if ($all === true)
		{
			$allV .= '?all=true';
		}

		$data = 'indicator/'.$pair.'/'.$period.'/'.$indicator.'/'.urlencode(json_encode($data)).'/'.$allV;
		$data = $this->get($data);
		$data = json_decode($data, true);

		if (isset($data['err']))
		{
			return $data['err'];
		}

		return $data;
	}

	public function rawdata($pair, $period)
	{
		$data = 'rawdata/'.$pair.'/'.$period;
		$data = $this->get($data);
		$data = json_decode($data, true);

		if (isset($data['err']))
		{
			return $data['err'];
		}

		return $data;
	}

	public function getPrices()
	{
		$data = 'getprices';
		$data = $this->get($data);
		$data = json_decode($data, true);
		$data = html_entity_decode($data);
		$data = json_decode($data, true);

		return $data;
	}
}


