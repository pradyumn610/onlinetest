<?php
	require_once("includeom.php");
	require_once("apiClass.php");
	//echo '<pre>';
	$objApi     = new getMethods()  ;
	
	//$arraRecds  = $objApi->appOpration('getroles',array());
	//print_r($_POST);die;
	//print_r($_REUEST);die;
//echo  json_encode($_REQUEST);die;


	if(isset($_REQUEST) && !empty($_REQUEST['oprType']))
	{

            //to register all the call from different ips.
			$objApi->appOpration('log',$_POST);
            
            if(!empty($_REQUEST['session_id']) && !empty($_REQUEST['oprType']))
			{
			   //6m7hfq4t8331b9vg3uvbo1n044 session_id
                $mthosdType = $_REQUEST['oprType'] ;
				//registerSchool
			   
			  switch($mthosdType)
					{



						case 'forgetPassword':
						$arraRecds  = $objApi->appOpration('forgetPassword',$_POST);
						break;
						case 'getUserProfile':
						$arraRecds  = $objApi->appOpration('getUserProfile',$_POST);
						break;
						case 'editStudent':
						$arraRecds  = $objApi->appOpration('editStudent',$_POST);
						break;
						case 'getActivityBySchool':
						$arraRecds  = $objApi->appOpration('getActivityBySchool',$_POST);
						break;
						case 'activityInfoLog':
						$arraRecds  = $objApi->appOpration('activityInfoLog',$_POST);
						break;
						case 'getSchools':
						
						$arraRecds  = $objApi->appOpration('getSchools',$_POST);
						break;
						case 'searchStudent':
						$arraRecds  = $objApi->appOpration('searchStudent',$_POST);
						break;


					   case 'registerStudent':
						
						$arraRecds  = $objApi->appOpration('registerStudent',$_POST);
						break;
					  case 'searchSchool':
						
						$arraRecds  = $objApi->appOpration('searchSchool',$_POST);
						break;


					  case 'editSchool':
						
						$arraRecds  = $objApi->appOpration('editSchool',$_POST);
						break;
					  case 'isLogout':
						$arraRecds  = $objApi->appOpration('isLogout',$_POST);
						break;
						case 'getUserByRoles':
						$arraRecds  = $objApi->appOpration('UserByRoles',$_POST);
						break;
     
	 					case 'getUserByRoleIdDetail':
						$arraRecds  = $objApi->appOpration('getUserByRoleIdDetail',$_POST);
						break;

						case 'registerSchool':
						 //print_r($_POST);die;
						//6m7hfq4t8331b9vg3uvbo1n044
						//appOpration($typOpr,$paraArr)
						$arraRecds  = $objApi->appOpration('regschool',$_POST);

						break;
                             
						default:
						$arraRecds = array(
						'InforArr'=>array(),
						'Success'=>0,
						'errTxt'=>'There is some error. Please select proper operation.'
						)		;
	                  echo  json_encode($arraRecds);die;
					}

			
			}else if($_REQUEST['oprType']=='getroles' || $_REQUEST['oprType']=='registercordinator' || $_REQUEST['oprType']=='login')
			{
                //if the operation type is getroles.
                if($_REQUEST['oprType']=='getroles')
				{
					$arraRecds  = $objApi->appOpration('keycomp',array('secretkey'=>$_REQUEST['secretKey']));

						if(!$arraRecds['Success'])
						{
						
							$arraRecds;
						
						}else 
						{
							

							$arraRecds  = $objApi->appOpration($_REQUEST['oprType'],array());
						
						   
					   }

				}else if($_REQUEST['oprType']=='registercordinator')
				{
				        //echo '<pre>'; 
						//print_r($_POST);die;
						$arraRecds  = $objApi->appOpration('keycomp',array('secretkey'=>$_REQUEST['secretKey']));

						if(!$arraRecds['Success'])//if failed the give message on the spot.
						{
						
							echo  json_encode($arraRecds);die;
						
						}

						$arraRecds  = $objApi->appOpration('reguser',$_POST);
						//echo 'ggggggggggg';
						//print_r($arraRecds);die;

						if($arraRecds['Success'])
						{
						
							$arraRecds;
						
						}else if($arraRecds['Success']==0)
						{
						
							$arraRecds;
						}
						else
						{
							

							$arraRecds = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>'No operation selected'
								  )		;
						
						   
					   }
				
				}else if($_REQUEST['oprType']=='login')
				{
				
				    
						$arraRecds  = $objApi->appOpration('keycomp',array('secretkey'=>$_REQUEST['secretKey']));
						if(!$arraRecds['Success'])//if failed the give message on the spot.
						{
						
							echo  json_encode($arraRecds);die;
						
						}
                        //print_r($_POST);die;
						$arraRecds  = $objApi->appOpration('login',$_POST);
						//echo 'ggggggggggg';
						//print_r($arraRecds);die;

						if($arraRecds['Success'])
						{
						
							$arraRecds;
						
						}else if($arraRecds['Success']==0)
						{
						
							$arraRecds;
						}else 
						{
							

							$arraRecds = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>'No operation selected'
								  )		;
						
						   
					   }
				

				
				}
				 
			}else{
			
			
			$arraRecds = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>'No operation or method has been selected , please check what oprType param you  have sent.'
								  )		;
	              echo  json_encode($arraRecds);die;
			
			
			}
			

			echo  json_encode($arraRecds);die;

	}else if(isset($_REQUEST) && !empty($_REQUEST['oprType'])){


            //         echo 'gggggggggg';die;

					$arraRecds = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>'No operation or method has been selected , please check what oprType u have sent.'
								  )		;
	              echo  json_encode($arraRecds);die;
	}





?>

