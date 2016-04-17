<?php
//conversion function with the use of Yahoo finance API
function currencyConverter($from,$to,$amount){
    $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$from.$to.'")';
    $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
    $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
    $yql_session = file_get_contents($yql_query_url);
    $yql_json =  json_decode($yql_session,true);
    $response = (float) $amount*$yql_json['query']['results']['rate']['Rate'];

    return $response;
}

 $amount = $_REQUEST['amount'];
 $from = $_REQUEST['from'];
 $to = $_REQUEST['to'];
 $currency = currencyConverter($from,$to,$amount);

 //echo $amount;
 //echo $amount.' '.$from.' = '.$currency.' '.$to;
 echo $currency;
?>