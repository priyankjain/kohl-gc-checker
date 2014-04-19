<?php
	$html='';
	$config=array();
	$sock='';
	function curl($url = '', $var = '', $header = false, $nobody = false) {
	    global $config, $sock;
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_NOBODY, $header);
	    curl_setopt($curl, CURLOPT_HEADER, $nobody);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 20);
	    // curl_setopt($curl, CURLOPT_USERAGENT, random_uagent());
	    curl_setopt($curl, CURLOPT_REFERER, 'https://www.kohls.com/giftcard/gift_card_check_balance.jsp');
	    if ($var) {
	        curl_setopt($curl, CURLOPT_POST, true);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
	    }
	    curl_setopt($curl, CURLOPT_COOKIEFILE, $config['cookie_file']);
	    curl_setopt($curl, CURLOPT_COOKIEJAR, $config['cookie_file']);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $result = curl_exec($curl);
	    if(curl_errno($curl))
		{
		    echo 'error:' . curl_error($curl);
		}
	    curl_close($curl);
	    return $result;
	}
	function delete_cookies() {
	    global $config;
	    $fp = @fopen($config['cookie_file'], 'w');
	    @fclose($fp);
	}
	function fetch_value($str, $find_start, $find_end) {
	    $start = strpos($str, $find_start);
	    if ($start === false) {
	        retur*n "";
	    }
	    $length = strlen($find_start);
	    $end = strpos(substr($str, $start + $length), $find_end);
	    return trim(substr($str, $start + $length, $end));
	}
// $codes=explode("\n",$_POST['codes']);
		$dir = dirname(__FILE__);
		$html= '<table class="table table-bordered"><tr><th>Code</th><th>Status</th><th>First ReasonCode</th><th>Second ReasonCode</th></tr>';
		$config['cookie_file'] = $dir . '/cookies/' . 'cookie.txt';
			if (!file_exists($config['cookie_file'])) {
	    		$fp = @fopen($config['cookie_file'], 'w');
	    		@fclose($fp);
			}
			delete_cookies();
$response=curl('https://www.kohls.com/giftcard/gift_card_check_balance.jsp');
$dynsessconf=fetch_value($response,'<input name="_dynSessConf" value="','" type="hidden">');
// echo $dynsessconf;
$response=curl('https://www.kohls.com/giftcard/gift_card_check_balance.jsp','_dyncharset=UTF-8&_dynSessConf='.$dynsessconf.'&giftCardNumber=Gift Card Number&_D:giftCardNumber=6393052602352436003&/com/kohls/commerce/userprofiling/KLSBalanceInquiryFormHandler.giftCardSuccessURL=/giftcard/gift_card_check_balance.jsp&_D:/com/kohls/commerce/userprofiling/KLSBalanceInquiryFormHandler.giftCardSuccessURL= &/com/kohls/commerce/userprofiling/KLSBalanceInquiryFormHandler.giftCardFailureURL=/giftcard/gift_card_check_balance.jsp&_D:/com/kohls/commerce/userprofiling/KLSBalanceInquiryFormHandler.giftCardFailureURL= &/com/kohls/commerce/userprofiling/KLSBalanceInquiryFormHandler.checkGiftCardBalance=&_D:/com/kohls/commerce/userprofiling/KLSBalanceInquiryFormHandler.checkGiftCardBalance= &_DARGS=/giftcard/gift_card_check_balance.jsp.check_giftcard_bal_entry');
echo $response;
?>