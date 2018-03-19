<?php 
@session_start();
	define('limelight_api_username','www.vxproducts.com');
	define('limelight_api_password','7XcsMFf3QJ9Sj');
	define('limelight_crm_instance','vxproducts.limelightcrm.com');
	$today = date('m/d/Y');
	date_default_timezone_set('America/New_York');
	$date = date('Y-m-d, H:m:s');
	
	$time = strtotime($date);

	$time1 = $time-(50*60);

	$fields = array(
					 'username'=>limelight_api_username,
					  'password'=>limelight_api_password,
					  'campaign_id'=>all,
					  'start_date'=>'10/01/2017',
					  'end_date'=>'10/04/2017',
					  /*'start_time' => '00:00:00',
					  'end_time' => '23:59:59',*/
					  'criteria'=>'email=smb4961@gmail.com',
					  'return_type'=>'customer_view',
					  'search_type' =>'all',
					  'method' => customer_find,
		);
		$data = array();
		$Curl_Session = curl_init();
		curl_setopt($Curl_Session,CURLOPT_URL,'https://'.limelight_crm_instance.'/admin/membership.php');
		curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
		curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($Curl_Session);
		$header = curl_getinfo($Curl_Session);
		//print_r($content);
		if ($content != '') {
			$ret = explode('&', $content);
			echo $ret['3'];
			foreach ($ret as $key => $value) {
				$ret1 = @explode('=', $value);
			
				$data[$ret1[0]]=$ret1[1];
				
			}
		}
		$data1 = $data['order_ids'];
		echo $data1;
		/*$data2= explode(',', $data1);
		$data1 = count($data2);
		for ($i=0; $i < 10; $i++) { 
			
			$fields1 = array(
					'username'=>limelight_api_username,
					'password'=>limelight_api_password,
					'order_id' => $data2[$i],
					'method' => 'order_view'
				);
			$data = array();
		$Curl_Session = curl_init();
		curl_setopt($Curl_Session,CURLOPT_URL,'https://'.limelight_crm_instance.'/admin/membership.php');
		curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields1));
		curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($Curl_Session);
		$header = curl_getinfo($Curl_Session);
		if ( !empty($content)) {
			$ret = explode('&', $content);
			//print_r($ret);
			foreach ($ret as $key => $value) {
				$newValues = @explode('=', $value);
				$data[$newValues[0]] = $newValues[1];

				
				
				
			}
		}?>
			 <div class="item" id='showdiv<?php echo $i;?>' <?php if($i!=0){?>style="display:none;"<?php } ?>> 
				<?php echo 'Firstname:'.$data['billing_first_name'];
				echo '<br/>';
				echo  'lastname:'.$data['billing_last_name'];
				echo '<br/>';
				/*echo  'Gender:'.getGender($data['billing_first_name']);;
				echo '<br/>';*/
				
				?>




