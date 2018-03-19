<?php 
	
	$limelight_api_username = '201clicks';
	$limelight_api_password = 'vduN9uc4BQtuSD';
	$limelight_crm_instance = 'blbionics.limelightcrm.com';


		function new_order_with_cardonfile($order_id,$forceGatewayId){
   			global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
 			$data1 = array('username'=>$limelight_api_username,
				   'password'=>$limelight_api_password,
				   'method' => NewOrderCardOnFile,
				   'shippingId' => '4',
				   'productId' => '48',
				   'campaignId' => '63',
				   'previousOrderId' => $order_id,
				   'forceGatewayId' => $forceGatewayId,
				   'preserve_force_gateway' => '1',
				   'notes' => 'ForceReprocess',
				   );
			$fields = $data1;
			//echo "<pre>".print_r($fields,true)."</pre>"; exit();
			$Curl_Session = curl_init();
			curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/transact.php');
			curl_setopt($Curl_Session, CURLOPT_POST, 1);
			curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
			curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
			 $content = curl_exec($Curl_Session);
			$header = curl_getinfo($Curl_Session);
				if(!empty($content)) {
					$ret=explode('&',$content);
					foreach($ret AS $key => $value){
 					$newValues = @explode('=',$value);
 					$data[$newValues[0]] = $newValues[1];
					}
				}
				return $data;
		}

		//$order_id = Array(8394975,8394315,8394278);
		$order_id = Array();
	
		foreach ($order_id as $order => $value) {
			$old_order = $value;
			if ($order%2 == 0) {
				$result = new_order_with_cardonfile($value,6);
				print_r($result);
				$orderId = $result['orderId'];
				$gatewayId = $result['gatewayId'];
				$responseCode = $result['responseCode'];
				if ($responseCode == '100'){ 
					$resp_msg = 'Approved';
				}else{
					$resp_msg = urldecode($result['errorMessage']);
				}
				
				
			}
			else{
					$result = new_order_with_cardonfile($value,2);
					print_r($result);
					$orderId = $result['orderId'];
					$gatewayId = $result['gatewayId'];
					$responseCode = $result['responseCode'];
				if ($responseCode == '100'){ 
					$resp_msg = 'Approved';
				}else{
					$resp_msg = urldecode($result['errorMessage']);
				}
						
			}
				// Update the report to CSV file
				$csv_file_name = 'Order_details.csv';

				if (!file_exists($csv_file_name)) {
				    $contents = fopen($csv_file_name, 'w');
				    chmod($csv_file_name, 0777);
				   fputcsv($contents, ['Old_Order_id','New_order_id', 'Response_code','errorMessage','gatewayId']);
				    fclose($contents);
				}

				$contents = fopen($csv_file_name, 'a');
				$fields=array($old_order,$orderId,$responseCode,$resp_msg,$gatewayId);

				if (!empty($responseCode)) {
				  fputcsv($contents, $fields);

				}

				fclose($contents);
		}

 ?>