<?php

include_once 'class.RodEngineAPI.php';

$RodEngineAPI = new RodEngineAPI;
$getPrices = $RodEngineAPI->getPrices();


foreach ($getPrices as $pair => $price)
{
	$rsi = $RodEngineAPI->indicator($pair, '3h', 'rsi', [14]);
	
	echo $pair.': '.$price.' => RSI: '.$rsi;
	echo '<br>';
}
