<?php 
	$limelight_api_username = '201Clicks3';
	$limelight_api_password = 'uaAkgksK88pCt';
	$limelight_crm_instance = 'globalhealthsecure.limelightcrm.com';

	function SendRequestLimelightMembership($data= array()){
    global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
 	$data1 = array('username'=>$limelight_api_username,
				   'password'=>$limelight_api_password
				   );
	$fields = array_merge($data, $data1);
	/*echo "<pre>".print_r($fields,true)."</pre>"; */
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/membership.php');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	return $content = curl_exec($Curl_Session);
	$header = curl_getinfo($Curl_Session);
}
	function OrderView_With_OrderId_Limelight_custom($orderid) {
	global $limelight_api_username,$limelight_api_password;
	$fields =   array('method'=>'order_view',
					  'order_id'=>$orderid
					  );
	$data = array();
	$content = SendRequestLimelightMembership($fields);
	if(!empty($content)) {
		$ret=explode('&',$content);
		foreach($ret AS $key => $value){
 			$newValues = @explode('=',$value);
 			$data[$newValues[0]] = $newValues[1];
		}
	}
	return $data;
}

$order = OrderView_With_OrderId_Limelight_custom('8520713');
print_r($order); // Array output
//echo $order['order_total'];

 ?>