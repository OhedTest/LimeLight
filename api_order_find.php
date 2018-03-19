<?php 


 $limelight_api_username = 'codeclouds_api';
 $limelight_api_password = 'XTKNzmBvb9ZsZb';
$limelight_crm_instance = 'anmorders.limelightcrm.com';


 $fields =   array('username'        =>$limelight_api_username,
                            'password'  =>$limelight_api_password,
                            'method'    => 'order_find',
                            
                            'start_date' => date('m/d/Y', strtotime('-1 day')),
                            'end_date' => date('m/d/Y'),
                            'campaign_id' => '256',
                            'criteria' => 'new',
                            'search_type' => 'all',
                            'return_type' => 'order_view'//order_view

   );
        /*if (!empty($criteria['criteria']))
        {
            $fields['criteria'] = $criteria['criteria'];
        }

        if (!empty($criteria['product_ids']))
        {
            $fields['product_ids'] = $criteria['product_ids'];
        }*/
        
        

     
 $data = array();     

 $Curl_Session = curl_init();

 curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/membership.php');

 curl_setopt($Curl_Session, CURLOPT_POST, 1);

 curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);

 curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));

 curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);

 $content = curl_exec($Curl_Session);

 $header = curl_getinfo($Curl_Session);
        curl_close($Curl_Session);
        
    //return $content;

        echo '<pre>';
        print_r(parse_url($content));
        echo '</pre>';
        
     

       


    
      