<?php
function currencyConverter($fromCurrency,$toCurrency,$amount) {	
	$locale='en-US'; //browser or user locale
	$fmt = new NumberFormatter( $locale."@currency=$toCurrency", NumberFormatter::CURRENCY );
	$symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
	
	$fromCurrency = urlencode($fromCurrency);
	$toCurrency = urlencode($toCurrency);	
	$encode_amount = 1;
	$url  = "https://www.google.com/search?q=".$fromCurrency."+to+".$toCurrency;
	$get = file_get_contents($url);
	$data = preg_split('/\D\s(.*?)\s=\s/',$get);
	$exhangeRate = (float) substr($data[1],0,7);
	$convertedAmount = $amount*$exhangeRate;

	
	//header("Content-Type: text/html; charset=UTF-8;");

	$data = array( 'exhangeRate' => $exhangeRate, 'convertedAmount' =>$convertedAmount, 'fromCurrency' => strtoupper($fromCurrency), 'toCurrency' => strtoupper($toCurrency), 'symbol' => $symbol);
	echo json_encode( $data );	
}
?> 

