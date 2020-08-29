<!-- 
 * PHP Rapid
 * https://github.com/Shaxadhere/phprapid
 *
 * Tested on PHP 7.4
 *
 * Copyright Shehzad Ahmed 
 * https://shaxad.com
 * https://github.com/Shaxadhere

 * Released under the MIT license
 * 
 *
 * Date: 2020-08-23
  -->

  <?php

/**
 * cleans input from user as a plain text
 *
 * @param String   $string  expects string
 * 
 * @return String cleaned string
 */ 
function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

/**
 * generates random string of given length
 *
 * @param Integer   $length_of_string  expects length of string in numbers
 * 
 * @return String random string with length of given length
 */ 
function random_strings ($length_of_string) 
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
	return substr(str_shuffle($str_result),0, $length_of_string); 
} 

/**
 * provides dates of days after present date
 *
 * @param Integer   $number_of_days  expects number of days
 * 
 * @return Array array of dates of days after present date with the length provided in params
 */ 
function getNextDays($number_of_days){
    $days   = [];
    $period = new DatePeriod(
    new DateTime(), // Start date of the period
    new DateInterval('P1D'), // Define the intervals as Periods of 1 Day
    $number_of_days // Apply the interval 6 times on top of the starting date
    );

    foreach ($period as $day)
    {
        $days[] = $day->format('Y-m-d H:i:s');
    }
    return $days;
}

//this method calculates months between two dates//
/**
 * calculates months between two dates
 *
 * @param Date   $start_date  expects start date
 * @param Date   $end_date  expects end date
 * 
 * @return Integer number of days between dates provided in params
 */ 
function calcMonths($start_date, $end_date){
    $ts1 = strtotime($start_date);
    $ts2 = strtotime($end_date);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff;
}


/**
 * verifies if email is true and valid without sending a mail
 * api requests are limited, for personal free api token 
 * sign up at https://mailboxlayer.com/signup?plan=71
 * and modify the method by entering your access_key
 *
 * @param Email   $email  expects email in string
 * 
 * @return Array array(valid_format, smtp_check)
 */ 
function verify_email($email){

    // set API Access Key
    $access_key = 'b5cde034b87fed8ef71669277e2dfb5a';

    // Initialize CURL:
    $ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email.'');  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response:
    $res = json_decode($json, true);

    // Access and use your preferred validation result objects
    $res['format_valid'];
    $res['smtp_check'];

    $val = array(
        "valid_format" => $res['format_valid'],
        "smtp_check" => $res['smtp_check']
    );

    return $val;
}

?>