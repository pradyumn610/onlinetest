<?php
require_once("includeom.php");
class ApiApp{
	  
		  var $paramVar1;
		  
		  var $securitykey = '1el$r4tErT5!1dFrK0Phg4{64hFr565959d}_*1y%^&aen|7byu';
		  function __Construct()
		  {
			  //session_start();
		   $paramVar1 = 1;
		   $paramVar2 = 21;
			
			//session_destroy();
		  // print_r($_SESSION);
           
		  
		   
		  }

 /*
      Name:  forgetPassword
	  Operation: It will  give user password  .
	  @param:  $paramArr  $arrRec['eamil_id'] from the user which user is logged in
	           $arrRec['session_id']  the id of the current session.
    
	  return :the array of the records for the chat log.
       Created On: 28/11/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/
	protected function forgetPassword($arrRec)
	{


					$objCon = new MySqlData();
						/* $parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }*/

				$sql = "select userpassword
		           from coordinator 
				   where coordinator.status='1' and coordinator.email_id='".$arrRec['email_id']."'" ;
			//echo $sql;die;
			 $recArr  = $objCon->getRecords($sql);

			 //print_r($recArr);

			if(count($recArr))
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>1,
				'errTxt'=>''
				)		;
			}else
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>0,
				'errTxt'=>'No record found with supplied email , kindly check and resend'
				)		;
			
			}

			return $returnArr;

    }

   /*
      Name:  getUserProfile
	  Operation: It will  give user profile .
	  @param:  $paramArr  $arrRec['role_id'] from the user which user is logged in
	           $arrRec['session_id']  the id of the current session.
    
	  return :the array of the records for the chat log.
       Created On: 28/11/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/
	protected function getUserProfile($arrRec)
	{


					$objCon = new MySqlData();
						 $parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }

		$sql = "select coordinator.name,coordinator.email_id,coordinator.mobile_no,
		         roles.role_name
		           from coordinator left join roles on 
				   coordinator.role_id = roles.Id
				   where coordinator.status='1' and coordinator.Id=".(int)$arrRec['user_id'];  ;
			//echo $sql;die;
			 $recArr  = $objCon->getRecords($sql);

			 //print_r($recArr);

			if(count($recArr))
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>1,
				'errTxt'=>''
				)		;
			}else
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>0,
				'errTxt'=>'No record found with supplied information , kindly check and resend'
				)		;
			
			}

			return $returnArr;

    }


		/*
			Name:  editStudent
			Operation: It will  edit the student .
			@param:  $paramArr  $arrRec['role_id'] from the user which user is logged in
			$arrRec['session_id']  the id of the current session.

			return :the array of the records for the school.
			Created On: 28-11-2017
			Created By: parakiya bhav das
			Modified by   -:
			What Modified -:
		*/ 

			protected function editStudent($arrRec)
			{
						// echo '<pre>';
						 //print_r($arrRec);die;
						/*(
						[student_name] => prakhar
						[session_id] => 9h4uqjc2d11bgfqr39hq1d6on4q
						[dob_date] => 06-04-1983
						prefer_lang
						[email_id] => ee#kkk1
						[father_name] => sekhar singh
						[mobile_no] => 9087
						[class] => 5
						[section] => A
						[school_id] => 2  //this you will get from the
						[device_id] => 1234
						[oprType] => registerStudent
						)*/
						 $parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }
						//echo 'main';die;
						$objCon = new MySqlData();
						//$objMysql = $objCon->getConnection();
						
						$errArray = array();
                        
						//validate record_id 
						$reurnArrRecordId = $this->validateItems(array('record_id'=>$arrRec['record_id']),'studentrecord_id');

						if($reurnArrRecordId['errFlag'])
						{

						$errTxt = $this->getErrText($reurnArrRecordId['errTxt']);	 
						$errArray[] = $errTxt ; 
						}
						
						 //validate email
						 if(!empty($arrRec['email_id']))
						 {


							$reurnArrEmail = $this->validateItems(array('email_id'=>$arrRec['email_id'],'record_id'=>$arrRec['record_id']),'studentemail_idedit');

							if($reurnArrEmail['errFlag'])
							{

								$errTxt = $this->getErrText($reurnArrEmail['errTxt']);	 
								$errArray[] = $errTxt ; 
							}
						 }
					  //validate date 
						$reurnArrDate = $this->validateItems(array('dob_date'=>$arrRec['dob_date']),'dob_date');
					 
						if($reurnArrDate['errFlag'])
						{
						   
							$errTxt = $this->getErrText($reurnArrDate['errTxt']);	 
							$errArray[] = $errTxt ; 
						}

						
						//validate school_id 
						$reurnArrRole = $this->validateItems(array('school_id'=>$arrRec['school_id']),'school_id');
						if($reurnArrRole['errFlag'])
						{
							$errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
							$errArray[] = $errTxt ; 
						}

                        //validate mobile no.

						 if(!empty($arrRec['mobile_no']))
						 {
							$reurnArrMob = $this->validateItems(array('mobile_no'=>$arrRec['mobile_no']),'mobile_no');
							if($reurnArrMob['errFlag'])
							{
							  $errTxt = $this->getErrText($reurnArrMob['errTxt']);	 
							  $errArray[] = $errTxt ; 
							}
						 }
                        //validate Class 
						$reurnClass = $this->validateItems(array('class'=>$arrRec['class']),'class');
						if($reurnClass['errFlag'])
						{
						  $errTxt = $this->getErrText($reurnClass['errTxt']);	 
						  $errArray[] = $errTxt ; 
						}
						//print_r($errArray);die;
						//validate relation ship ids.
						//[representative_id] => 123 [coordinator_id] => 1233 [volunteer_id] => 1223
								
						
						//validation for name .
							$reurnArrname = $this->validateItems(array('name'=>$arrRec['student_name']),'name');
							if($reurnArrname['errFlag'])
							{
								$errTxt = $this->getErrText($reurnArrname['errTxt']);	 
								$errArray[] = $errTxt;
									
							}
						
						//validate fatherName

							$reurnFatherName = $this->validateItems(array('father_name'=>$arrRec['father_name']),'father_name');
							if($reurnFatherName['errFlag'])
							{
								$errTxt = $this->getErrText($reurnFatherName['errTxt']);	 
								$errArray[] = $errTxt;
									
							}

				//validation for devcie id.
				$reurnArrDevice = $this->validateItems(array('device_id'=>$arrRec['device_id']),'device_id');
				if($reurnArrDevice['errFlag'])
				{
					$errTxt = $this->getErrText($reurnArrDevice['errTxt']);	 
					$errArray[] = $errTxt;
						
				}

				

						//if error found then need to update the 
						if(count($errArray))
						{

							
						   
							$strErrTxt = implode(' , ',$errArray);
							//echo $strErrTxt;die;
							// error text .
							$returnArr = array(
												'InforArr'=>array(),
												'Success'=>0,
												'errTxt'=>$strErrTxt
											  )		; 

						}else
						{
						
							/*[student_name] => prakhar
							[session_id] => 9h4uqjc2d11bgfqr39hq1d6on4q
							[dob] => 06-04-1983
							[email_id] => ee#kkk1
							[father_name] => sekhar singh
							[mobile_no] => 9087
							[class] => 5
							[section] => A
							[school_id] => 2  //this you will get from the
							[device_id] => 1234
							[oprType] => registerStudent*/
							//insert in the student table.
							
							if(empty($arrRec['prefer_lang']) || $arrRec['prefer_lang']!='HI' )
							{
							   $preferLanguage = 'EN';
							}else if($arrRec['prefer_lang']=='HI')
							{
							     $preferLanguage = 'HI';
							
							}

							//select record from DB .
							 
								//echo $sqlC;die;
								$nDatedob =  date('Y-m-d',strtotime($arrRec['dob_date'])) ;
							
								 $sql = "UPDATE students
									   SET 
									   	name ='".$arrRec['student_name']."',
									   email_id='".$arrRec['email_id']."',
									   dob='".$nDatedob."',
									   prefer_lang='".$preferLanguage."',
									   mobile_no='".$arrRec['mobile_no']."',
									   school_id ='".$arrRec['school_id']."',
									   device_id ='".$arrRec['device_id']."',
									   class='".addslashes($arrRec['class'])."',
									   section='".addslashes($arrRec['section'])."',
									   father_name='".addslashes($arrRec['father_name'])."',
									   modified_on = now(),
									   modified_by = '".$arrRet['InforArr'][0]['recId']."'
									   WHERE ID = ".(int)$arrRec['record_id'];

									  // echo $sql;die;
										 $insrtid = $objCon->insertUpdtRecords('update', $sql);
										$returnArr = array(
												'InforArr'=>array('student_name'=>$arrRec['student_name']),
												'Success'=>1,
												'errTxt'=>'Student Updated '
											  )		; 
							 

								

						   
							//echo  'rrrr--',$insrtid;die;
						  

							 
						}
					   
							//$returnArr ;
						return $returnArr;
					
			}


/*
      Name:  getActivityBySchool
	  Operation: It will  register the student .
	  @param:  $paramArr  $arrRec['role_id'] from the user which user is logged in
	           $arrRec['session_id']  the id of the current session.
    
	  return :the array of the records for the chat log.
       Created On: 26/11/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/
	protected function getActivityBySchool($arrRec)
	{


					$objCon = new MySqlData();
						 $parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }

		$sql = "select school.school_name,
					   school.Id as school_id,
					   school_chat_log.chat_text,
					DATE_FORMAT(CONVERT_TZ( school_chat_log.created_on , '+00:00','+10:30') ,\"%d-%m-%Y %H:%i:%s\") as actvity_registered,
					coordinator.name as whoCreated 
					from school_chat_log  
					left join coordinator on coordinator.Id = school_chat_log.created_by 
					left join school on school.Id= school_chat_log.school_id 
					where school.status='1' and school_chat_log.school_id = '".$arrRec['school_id']."' order by school_chat_log.created_on desc    "  ;
			//echo $sql;die;
			 $recArr  = $objCon->getRecords($sql);

			 //print_r($recArr);

			if(count($recArr))
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>1,
				'errTxt'=>''
				)		;
			}else
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>0,
				'errTxt'=>'No record found with supplied information , kindly check and resend'
				)		;
			
			}

			return $returnArr;

    }

/*
      Name:  activityInfoLog
	  Operation: It will  register the student .
	  @param:  $paramArr  $arrRec['role_id'] from the user which user is logged in
	           $arrRec['session_id']  the id of the current session.
    
	  return :the array of the records for the chat log.
       Created On: 26/11/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 

			protected function activityInfoLog($arrRec)
			{
						// echo '<pre>';
						 //print_r($arrRec);die;
						/*(
						[student_name] => prakhar
						[session_id] => 9h4uqjc2d11bgfqr39hq1d6on4q
						[dob_date] => 06-04-1983
						[email_id] => ee#kkk1
						[father_name] => sekhar singh
						[mobile_no] => 9087
						[class] => 5
						[section] => A
						[school_id] => 2  //this you will get from the
						[device_id] => 1234
						[oprType] => registerStudent
						)*/
						 $parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }
						//echo 'main';die;
						$objCon = new MySqlData();
						//$objMysql = $objCon->getConnection();
						
						$errArray = array();

						
						//validate school_id 
						$reurnArrRole = $this->validateItems(array('school_id'=>$arrRec['school_id']),'school_id');
						if($reurnArrRole['errFlag'])
						{
							$errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
							$errArray[] = $errTxt ; 
						}

						if(empty($arrRec['activity_text']))
						{
						    $errArray[] = 'Empty activity text' ;
						
						}

						if(strlen($arrRec['activity_text'])>350)
						{
						    $errArray[] = 'Text is too long' ;
						
						}
					

						//if error found then need to update the 
						if(count($errArray))
						{

							
						   
							$strErrTxt = implode(' , ',$errArray);
							//echo $strErrTxt;die;
							// error text .
							$returnArr = array(
												'InforArr'=>array(),
												'Success'=>0,
												'errTxt'=>$strErrTxt
											  )		; 

						}else
						{
						
							/*[student_name] => prakhar
							[session_id] => 9h4uqjc2d11bgfqr39hq1d6on4q
							[dob] => 06-04-1983
							[email_id] => ee#kkk1
							[father_name] => sekhar singh
							[mobile_no] => 9087
							[class] => 5
							[section] => A
							[school_id] => 2  //this you will get from the
							[device_id] => 1234
							[oprType] => registerStudent*/
							//insert in the student table.
							
							
								//echo $sqlC;die;
								$nDatedob =  date('Y-m-d',strtotime($arrRec['dob_date'])) ;
							
								$sql = "Insert Into  school_chat_log
								SET 
								school_id ='".$arrRec['school_id']."',
								device_id ='".$arrRec['device_id']."',
								chat_text='".addslashes($arrRec['activity_text'])."',
								created_on = now(),
								created_by = '".$arrRet['InforArr'][0]['recId']."'
								";

								// echo $sql;die;
								$insrtid = $objCon->insertUpdtRecords('insert', $sql);
								$returnArr = array(
								'InforArr'=>array(),
								'Success'=>1,
								'errTxt'=>'Activity registered.'
								)		; 
							 
						   
							//echo  'rrrr--',$insrtid;die;
						  

							 
						}
					   
							//$returnArr ;
						return $returnArr;
					
			}


/*
		  Name:  searchSchool
		  Operation: It will  register the student .
		  @param:  $arrRec  consist of all parameter

				name:  prakhar
				student_school: krishnabalram 
				Id:  1
				school_id:  3
				session_id:  vo360freg11jar8qsrdkssc6v1
				mobile_no:  9087909009
				father_name:  sekhar 
				class:  5
				section:  A
				student_eMail:  student1@gmail.com
				whoCreatedemail:  gss@gs.gd
				whoCreatedId:  2
				whoCreated:pradyumn
				created_on:22-10-2017
				dob:06-04-1983
				oprType:  searchStudent
				From:1  
				To:20
		  return :the array of the records for the school.
		   Created On: 11/1/2017
		   Created By: parakiya bhav das
		   Modified by   -:
		   What Modified -:
		*/ 

		protected function searchStudent($arrRec)
		{


						$parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }

			$objCon = new MySqlData();
			$SearchArr=$arrRec;
              
             $where= array() ; 
			 $where[] = 1;

			 $tableOne = "students" ;
			 $tableSecond = " coordinator" ;
			// build the query string .
			foreach($SearchArr as $key=>$valData)
			 {
                 if($key!='From' && $key!='To' && !empty($valData) && $key!='session_id' && $key!='oprType')
				 {
                     if($key=='school_id' || $key=='father_name' || $key=='name' || $key=='class' || $key=='section' )
					 {
						$where[] = " $tableOne.$key  like '%".addslashes($valData)."%'"  ;
					 }else if($key=='student_school' )
					 {
						$where[] = " school.school_name  like '%".addslashes($valData)."%'"  ;
					 }else if($key=='created_on') 
					 {

						 //DATE_FORMAT(transaction_masters.release_request_date, "%d-%m-%Y")
					    $CreatedDate = date('d-m-Y',strtotime($valData))     ;
						$where[] = "  DATE_FORMAT($tableOne.created_on,\"%d-%m-%Y\") =  '".$valData."'"  ;
					 }else if($key=='dob') 
					 {

						 //DATE_FORMAT(transaction_masters.release_request_date, "%d-%m-%Y")
					    $CreatedDate = date('d-m-Y',strtotime($valData))     ;
						$where[] = "  DATE_FORMAT($tableOne.dob, \"%d-%m-%Y\") =  '".$valData."'"  ;
					 }else if($key=='student_eMail') 
					 {
					    
						$where[] = " $tableOne.email_id =  '".$valData."'"  ;
					 }else if($key=='whoCreatedemail') 
					 {
					    
						$where[] = " $tableSecond.email_id =  '".$valData."'"  ;
					 }else if($key=='whoCreated')
					 {
						$where[] = " $tableSecond.name =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='whoCreatedId')
					 {
						$where[] = " $tableOne.created_by =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='representativeId')
					 {
						$where[] = " Repscoordinator.Id =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='volunteerId')
					 {
						$where[] = " Volcoordinator.Id =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='coordinator_id')
					 {
						$where[] = " Ucoordinator.Id =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }		 
					 else{
					 
						 $where[] = " $tableOne.$key =  '".$valData."'"  ;
					 }
				 }
		     }



			if(!empty($arrRec['From']) && !empty($arrRec['To']))
			{

				$from = $arrRec['From']-1;
				$To = $arrRec['To']-1;
				$limit = " limit ".$from." , ".$To;
			}
			else
			$limit = " ";

			$whereString = 	implode(' and ', $where);
			$sql = "select students.Id as recId,students.name ,
			students.mobile_no,
			students.email_id,
			students.prefer_lang,
			students.class,
			students.section,
			DATE_FORMAT(students.dob, \"%d-%m-%Y\") as Dob,
			DATE_FORMAT(students.created_on, \"%d-%m-%Y\") as created_on,
			students.father_name,
			school.school_name,
			school.Id as school_id,
			coordinator.name as whoCreated ,
			students.created_by
			from students 
			left join coordinator on coordinator.Id= students.created_by 
			left join school on students.school_id= school.Id 
			where students.status='1' and  $whereString  $limit  "  ;
			//echo $sql;die;
			 $recArr  = $objCon->getRecords($sql);

			if(count($recArr))
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>1,
				'errTxt'=>''
				)		;
			}else
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>0,
				'errTxt'=>'No record found with supplied information , kindly check and resend'
				)		;
			
			}
               


			   return $returnArr;
			

	    }
	  

 /*
      Name:  registerStudent
	  Operation: It will  register the student .
	  @param:  $paramArr  $arrRec['role_id'] from the user which user is logged in
	           $arrRec['session_id']  the id of the current session.
    
	  return :the array of the records for the school.
       Created On: 10/25/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 

			protected function registerStudent($arrRec)
			{
						 //echo '<pre>';
						 //print_r($arrRec);die;
						/*(
						[student_name] => prakhar
						[session_id] => 9h4uqjc2d11bgfqr39hq1d6on4q
						[dob_date] => 06-04-1983
						prefer_lang
						[email_id] => ee#kkk1
						[father_name] => sekhar singh
						[mobile_no] => 9087
						[class] => 5
						[section] => A
						[school_id] => 2  //this you will get from the
						[device_id] => 1234
						[oprType] => registerStudent
						)*/
						 $parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }
						//echo 'main';die;
						$objCon = new MySqlData();
						//$objMysql = $objCon->getConnection();
						
						$errArray = array();

						
						 //validate email
						 if(!empty($arrRec['email_id']))
						 {
							$reurnArrEmail = $this->validateItems(array('email_id'=>$arrRec['email_id']),'studentemail_id');

							if($reurnArrEmail['errFlag'])
							{

								$errTxt = $this->getErrText($reurnArrEmail['errTxt']);	 
								$errArray[] = $errTxt ; 
							}
						 }
					  //validate date 
						$reurnArrDate = $this->validateItems(array('dob_date'=>$arrRec['dob_date']),'dob_date');
					 
						if($reurnArrDate['errFlag'])
						{
						   
							$errTxt = $this->getErrText($reurnArrDate['errTxt']);	 
							$errArray[] = $errTxt ; 
						}

						
						//validate school_id 
						$reurnArrRole = $this->validateItems(array('school_id'=>$arrRec['school_id']),'school_id');
						if($reurnArrRole['errFlag'])
						{
							$errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
							$errArray[] = $errTxt ; 
						}

                        //validate mobile no.

						 if(!empty($arrRec['mobile_no']))
						 {
							$reurnArrMob = $this->validateItems(array('mobile_no'=>$arrRec['mobile_no']),'mobile_no');
							if($reurnArrMob['errFlag'])
							{
							  $errTxt = $this->getErrText($reurnArrMob['errTxt']);	 
							  $errArray[] = $errTxt ; 
							}
						 }
                        //validate Class 
						$reurnClass = $this->validateItems(array('class'=>$arrRec['class']),'class');
						if($reurnClass['errFlag'])
						{
						  $errTxt = $this->getErrText($reurnClass['errTxt']);	 
						  $errArray[] = $errTxt ; 
						}
						//print_r($errArray);die;
						//validate relation ship ids.
						//[representative_id] => 123 [coordinator_id] => 1233 [volunteer_id] => 1223
								
						
						//validation for name .
							$reurnArrname = $this->validateItems(array('name'=>$arrRec['student_name']),'name');
							if($reurnArrname['errFlag'])
							{
								$errTxt = $this->getErrText($reurnArrname['errTxt']);	 
								$errArray[] = $errTxt;
									
							}
						
						//validate fatherName

							$reurnFatherName = $this->validateItems(array('father_name'=>$arrRec['father_name']),'father_name');
							if($reurnFatherName['errFlag'])
							{
								$errTxt = $this->getErrText($reurnFatherName['errTxt']);	 
								$errArray[] = $errTxt;
									
							}

				//validation for devcie id.
				$reurnArrDevice = $this->validateItems(array('device_id'=>$arrRec['device_id']),'device_id');
				if($reurnArrDevice['errFlag'])
				{
					$errTxt = $this->getErrText($reurnArrDevice['errTxt']);	 
					$errArray[] = $errTxt;
						
				}

						//if error found then need to update the 
						if(count($errArray))
						{

							
						   
							$strErrTxt = implode(' , ',$errArray);
							//echo $strErrTxt;die;
							// error text .
							$returnArr = array(
												'InforArr'=>array(),
												'Success'=>0,
												'errTxt'=>$strErrTxt
											  )		; 

						}else
						{
						
							/*[student_name] => prakhar
							[session_id] => 9h4uqjc2d11bgfqr39hq1d6on4q
							[dob] => 06-04-1983
							[email_id] => ee#kkk1
							[father_name] => sekhar singh
							[mobile_no] => 9087
							[class] => 5
							[section] => A
							[school_id] => 2  //this you will get from the
							[device_id] => 1234
							[oprType] => registerStudent*/
							//insert in the student table.
							
							if(empty($arrRec['prefer_lang']) || $arrRec['prefer_lang']!='HI' )
							{
							   $preferLanguage = 'EN';
							}else if($arrRec['prefer_lang']=='HI')
							{
							     $preferLanguage = 'HI';
							
							}
								//echo $sqlC;die;
								$nDatedob =  date('Y-m-d',strtotime($arrRec['dob_date'])) ;
							
								 $sql = "Insert Into  students
									   SET 
									   	name ='".$arrRec['student_name']."',
									   email_id='".$arrRec['email_id']."',
									   dob='".$nDatedob."',
									   prefer_lang='".$preferLanguage."',
									   mobile_no='".$arrRec['mobile_no']."',
									   school_id ='".$arrRec['school_id']."',
									   device_id ='".$arrRec['device_id']."',
									   class='".addslashes($arrRec['class'])."',
									   section='".addslashes($arrRec['section'])."',
									   father_name='".addslashes($arrRec['father_name'])."',
									   created_on = now(),
									   created_by = '".$arrRet['InforArr'][0]['recId']."'
									   ";

									  // echo $sql;die;
										 $insrtid = $objCon->insertUpdtRecords('insert', $sql);
										$returnArr = array(
												'InforArr'=>array('student_name'=>$arrRec['student_name']),
												'Success'=>1,
												'errTxt'=>'Student registered.'
											  )		; 
							 

								

						   
							//echo  'rrrr--',$insrtid;die;
						  

							 
						}
					   
							//$returnArr ;
						return $returnArr;
					
			}

 /*
      Name:  getSchools
	  Operation: It will give the list of registered school.
	  @param:  $paramArr  $paramArr['role_id'] from the user which user is logged in
	            $paramArr['session_id']  the id of the current session.
    
	  return :the array of the records for the school.
       Created On: 10/25/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 
	// it will get the users for making registration for school and student.
	 function getSchools($paramArr)
   	 {

		 //print_r($paramArr);die;

		   $school_id        =  $paramArr['school_id']   ;
		   $parmSessionid    =  $paramArr['session_id']   ;
		   if(!empty($school_id ))
		   {
			  $Conschool_id  =  " and school_id=  ".$school_id  ;
		   }
		  //DB initation .
	      $objCon = new MySqlData();
	      $arrRet = $this->isLogin($parmSessionid);
		if($arrRet['Success']==1)
		 {
		       $sql = "SELECT Id,school_name FROM school WHERE status='1' and $Conschool_id " ;
			   $recArr  = $objCon->getRecords($sql);
			  

			     $returnArr  = array('InforArr'=>$recArr,
										      'Success'=>1,
										      'errTxt'=>''
								             )		; 


				return $returnArr;

         }else
		 {
			 return  $arrRet;
		  
		 }
	 	
	 
	 
	 }

	 /*
      Name:getStoreSessionArra
	  Operation: It will check the session is is set or not for all loggedin functions
	  @param: parmSessionid  the id of the current session.
    
	  return :true-1/ 0-false in the array if the session is set or not set .
       Created On: 10/21/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 

    function  getStoreSessionArray($parmSessionid)
	{

		  $objCon = new MySqlData();

			$select = " select * from session where status='1' and token= '".trim($parmSessionid)."'";
		    $recSessionArr  = $objCon->getRecords($select);

            //$varArr  = unserialize( $recSessionArr['strData']); 
			return  $recSessionArr[0];

	
	}

	/*
      Name:isLogin
	  Operation: It will check the session is is set or not for all loggedin functions
	  @param: parmSessionid  the id of the current session.
    
	  return :true-1/ 0-false in the array if the session is set or not set .
       Created On: 10/21/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 

     function  isLogin($parmSessionid)
	 {
			

			  $objCon = new MySqlData();

			$nArrSesson = $this->getStoreSessionArray($parmSessionid);

			 //print_r($nArrSesson);die;
			//$sqlTimeDiff=	" SELECT TIMEDIFF('".$nArrSesson['modified_on']."',now())";


		if(empty($nArrSesson['Id']))
		 {
				 $id =  '';
		 }else
		{
		 

			$sqlTimeDiff=	" SELECT TIMEDIFF(now(),'".$nArrSesson['modified_on']."') as TimeSEl";
			$recTimeDiff  = $objCon->getRecords($sqlTimeDiff);
			$ArrTime =  explode(":",$recTimeDiff[0]['TimeSEl']);

			//print_r($ArrTime);die;
			 $strtimeMin = (int)$ArrTime[1];
			 $strtimeHour = (int)$ArrTime[0];

			 if($strtimeMin <=21 && empty($strtimeHour ))
				 {

				    $id =  $nArrSesson['token'];
					$sqlup = "UPDATE  session SET modified_on =now() where Id=".(int)$nArrSesson['Id']  ;
					$objCon->insertUpdtRecords('update',$sqlup);
					
				 }else
				 {

					 $id =  '';
					 
				 }
			 
		 
		 }

			//echo  $id,'--ooo--',$sqlup;
			//print_r($ArrTime);
			// print_r($recTimeDiff);die;
		 
	        //$id = session_id();
			//print_r($_SESSION);
			//print_r($_SESSION);
			//die;
			if($id != $parmSessionid )
		    {

					if(!empty($nArrSesson['Id']))
					{
						$sqlDel =  "UPDATE  session SET modified_on =now() , status ='2' where Id=".(int)$nArrSesson['Id']  ;
						$objCon->insertUpdtRecords('update',$sqlDel);
					}
			  return $returnArr = array(
										'InforArr'=>array(),
										'Success'=>0,
										'errTxt'=>'Some error is there in login token ,Please login to get this action done'
								       )		; 
			}else
			{
						  $resultArr  = 	unserialize($nArrSesson['strData']);
			               
						  return $returnArr = array(
										      'InforArr'=>array($resultArr),
										    'Success'=>1,
										    'errTxt'=>''
								          )		; 
			}


	 }

	/*
      Name:  isLogout
	  Operation: It will destroy the legitimate session.
	  @param: parmSessionid  the id of the current session.
    
	  return :true-1/ 0-false in the array if the session is destroyed or not .
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 
	 function isLogout($paraArr)
	 {

			 $objCon = new MySqlData();
			// print_r($_SESSION);

			//$arrSeeion = $_SESSION;
			
			//print_r($paraArr);die;
			//echo $id = session_id();
			 $id = $paraArr['session_id'];
			 $arrSeeion['sessionId']=  $id ;
			if(!empty($id))
			 {
					
				 $sqlDel =  "UPDATE  session SET modified_on=now() , status ='2' where token='".$id."'" ;
				$objCon->insertUpdtRecords('update',$sqlDel);
				return $returnArr = array(
				'InforArr'=>array($arrSeeion),
				'Success'=>1,
				'errTxt'=>'Logged-out Successfully'
				)		; 
			 }else
			 {
				 return $returnArr = array(
				'InforArr'=>$arrSeeion,
				'Success'=>0,
				'errTxt'=>'Some problem in session param or you already logged out'
				)		; 
			 
			 }

	 }


 /*
      Name:  getUserByRoleIdDetail
	  Operation: It will destroy the legitimate session.
	  @param:  $paramArr  $paramArr['role_id'] from the user which user is logged in
	            $paramArr['session_id']  the id of the current session.
    
	  return :the array of the records weather they are Co-ordinator , Volunteer or Represantative.
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 
	// it will get the users for making registration for school and student.
	 function getUserByRoleIdDetail($paramArr)
   	 {

		 //print_r($paramArr);die;

		   $roleId        =  $paramArr['role_id']   ;
		   $parmSessionid =  $paramArr['session_id']   ;
		  //DB initation .
	      $objCon = new MySqlData();
	      $arrRet = $this->isLogin($parmSessionid);
		if($arrRet['Success']==1)
		 {
				$sql = "SELECT coordinator.Id,coordinator.name ,
				school.school_name
				from coordinator 
				left join school on coordinator.Id= school.created_by 
				WHERE  coordinator.status='1' and coordinator.role_id=".(int)$roleId ;
			   $recArr  = $objCon->getRecords($sql);
			  

			     $returnArr  = array('InforArr'=>$recArr,
										      'Success'=>1,
										      'errTxt'=>''
								             )		; 


				return $returnArr;

         }else
		 {
			 return  $arrRet;
		  
		 }
	 	
	 
	 
	 }

	 /*
      Name:  getUserByRoleId
	  Operation: It will destroy the legitimate session.
	  @param:  $paramArr  $paramArr['role_id'] from the user which user is logged in
	            $paramArr['session_id']  the id of the current session.
    
	  return :the array of the records weather they are Co-ordinator , Volunteer or Represantative.
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 
	// it will get the users for making registration for school and student.
	 function getUserByRoleId($paramArr)
   	 {

		 //print_r($paramArr);die;

		   $roleId        =  $paramArr['role_id']   ;
		   $parmSessionid =  $paramArr['session_id']   ;
		  //DB initation .
	      $objCon = new MySqlData();
	      $arrRet = $this->isLogin($parmSessionid);
		if($arrRet['Success']==1)
		 {
		       $sql = "SELECT Id,name FROM coordinator WHERE status='1' and role_id= ".(int)$roleId ;
			   $recArr  = $objCon->getRecords($sql);
			  

			     $returnArr  = array('InforArr'=>$recArr,
										      'Success'=>1,
										      'errTxt'=>''
								             )		; 


				return $returnArr;

         }else
		 {
			 return  $arrRet;
		  
		 }
	 	
	 
	 
	 }



 /*
		  Name:  searchSchool
		  Operation: It will  register the student .
		  @param:  $arrRec  consist of all parameter

						school_name:  krishna
						school_address3:  193 B/@3kl drf
						session_id:  02906cd059552305cc45f9eb823adb78
						phone_no:  7513200000
						school_eMail:  testschool1212@gmail.com
						whoCreatedemail:  gss@gs.gd
						whoCreatedId:  2
						whoCreated:mangal
						created_on:29-10-2017
						oprType:  searchSchool
						From:1  
						To:20
		  return :the array of the records for the school.
		   Created On: 11/1/2017
		   Created By: parakiya bhav das
		   Modified by   -:
		   What Modified -:
		*/ 

		protected function searchSchool($arrRec)
		{


			$objCon = new MySqlData();
			$SearchArr=$arrRec;
              
			   $parmSessionid = $arrRec['session_id'];
						 $arrRet = $this->isLogin($parmSessionid);

						 //print_R($arrRet);
						//echo  $arrRet['InforArr'][0]['recId'];die;
						 if(!$arrRet['Success'])
						 {
							 return $arrRet;
						 
						 }
             $where= array() ; 
			 $where[] = 1;

			 $tableOne = "school" ;
			 $tableSecond = " coordinator" ;
			// build the query string .
			foreach($SearchArr as $key=>$valData)
			 {
                 if($key!='From' && $key!='To' && !empty($valData) && $key!='session_id' && $key!='oprType')
				 {
                     if($key=='school_name' || $key=='school_address' || $key=='school_address3' || $key=='school_address2' )
					 {
						$where[] = " $tableOne.$key  like '%".addslashes($valData)."%'"  ;
					 }else if($key=='created_on') 
					 {

						 //DATE_FORMAT(transaction_masters.release_request_date, "%d-%m-%Y")
					    $CreatedDate = date('d-m-Y',strtotime($valData))     ;
						$where[] = "  DATE_FORMAT($tableOne.created_on, \"%d-%m-%Y\") =  '".$valData."'"  ;
					 }else if($key=='school_eMail') 
					 {
					    
						$where[] = " $tableOne.email_id =  '".$valData."'"  ;
					 }else if($key=='whoCreatedemail') 
					 {
					    
						$where[] = " $tableSecond.email_id =  '".$valData."'"  ;
					 }else if($key=='whoCreated')
					 {
						$where[] = " $tableSecond.name =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='whoCreatedId')
					 {
						$where[] = " $tableOne.created_by =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='representativeId')
					 {
						$where[] = " Repscoordinator.Id =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='volunteerId')
					 {
						$where[] = " Volcoordinator.Id =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }else if($key=='coordinator_id')
					 {
						$where[] = " Ucoordinator.Id =  '".$valData."'"  ;
					    //|| $key=='whoCreatedId')
					 
					 }		 
					 else{
					 
						 $where[] = " $tableOne.$key =  '".$valData."'"  ;
					 }
				 }
		     }



			if(!empty($arrRec['From']) && !empty($arrRec['To']))
			{

				$from = $arrRec['From']-1;
				$To = $arrRec['To']-1;
				$limit = " limit ".$from." , ".$To;
			}
			else
			$limit = " ";


			$whereString = 	implode(' and ', $where);
			 $sql = "select school.Id as recId,school.school_name,school.phone_no,school.email_id,school.school_address,school.school_address2,school.school_address3,
			school.school_address3,school.school_address3,coordinator.name as whoCreated ,
			Ucoordinator.Id as CoordinatorId,
			Ucoordinator.name as coordinatorName,
			Repscoordinator.Id as representativeId,
			Repscoordinator.name as representativeName,
			Volcoordinator.Id as volunteerId,
			Volcoordinator.name as volunteerName,
			school.created_on,school.created_by
			from school 
			left join coordinator on coordinator.Id= school.created_by 
			left join group_relation on school.group_relation_id = group_relation.Id
			left join coordinator as Ucoordinator on Ucoordinator.Id = group_relation.coordinator_id
			left join coordinator as Repscoordinator on Repscoordinator.Id = group_relation.representative_id
			left join coordinator as Volcoordinator on Volcoordinator.Id = group_relation.volunteer_id 
			where school.status='1' and  $whereString  $limit  "  ;
			
			//echo  $sql;die;
			 $recArr  = $objCon->getRecords($sql);

			if(count($recArr))
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>1,
				'errTxt'=>''
				)		;
			}else
			{
				$returnArr  = array('InforArr'=>$recArr,
				'Success'=>0,
				'errTxt'=>'No record found with supplied information , kindly check and resend'
				)		;
			
			}
               


			   return $returnArr;
			

	    }
   	/*
      Name:  editSchool
	  Operation: It will create schoolin the DB with all the checks.
	  @param:  $arrRec
				
			school_name:  krishna
			school_address:  193 B/@3kl drf11
			school_address1:  193 B/@3kl drf11
			school_address2:  193 B/@3kl drf11
			session_id:  02906cd059552305cc45f9eb823adb78
			phone_no:  7513200000
			record_id:2
			representative_id: 5     // u will get this id by calling oprType = getUserByRoles see below 
			coordinator_id:  4
			volunteer_id:  3
			email_id:  testschool122@gmail.com
			role_id:  2
			oprType:  editSchool
	   return : if school registered success-fully Success=1 else 0
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 
       protected function editSchool($arrRec)
		{
			 //echo '<pre>';
			 //print_r($arrRec);die;
			 $parmSessionid = $arrRec['session_id'];
			 $arrRet = $this->isLogin($parmSessionid);
			 if(!$arrRet['Success'])
			 {
				 return $arrRet;
			 
			 }
			//echo 'main';die;
			$objCon = new MySqlData();
			//$objMysql = $objCon->getConnection();
			
			$errArray = array();

            //validate record_id 
			$reurnArrRecordId = $this->validateItems(array('record_id'=>$arrRec['record_id']),'record_id');
             
			if($reurnArrRecordId['errFlag'])
			{
			   
			    $errTxt = $this->getErrText($reurnArrRecordId['errTxt']);	 
				$errArray[] = $errTxt ; 
			}

             //validate email 
			$reurnArrEmail = $this->validateItems(array('email_id'=>$arrRec['email_id'],'record_id'=>$arrRec['record_id']),'schoolemail_idedit');
             
			if($reurnArrEmail['errFlag'])
			{
			   
			    $errTxt = $this->getErrText($reurnArrEmail['errTxt']);	 
				$errArray[] = $errTxt ; 
			}

		  //validate address 
			$reurnArrAddress = $this->validateItems(array('school_address'=>$arrRec['school_address'],'school_address2'=>$arrRec['school_address2'],'school_address3'=>$arrRec['school_address3']),'school_address');
         
			if($reurnArrAddress['errFlag'])
			{
			   
			    $errTxt = $this->getErrText($reurnArrAddress['errTxt']);	 
				$errArray[] = $errTxt ; 
			}



			//validation for devcie id.
				$reurnArrDevice = $this->validateItems(array('session_id'=>$arrRec['session_id']),'session_id');

				//print_r($reurnArrDevice);die;
				if($reurnArrDevice['errFlag'])
				{
					
					//print_r($reurnArrDevice);die;

					$errTxt = $this->getErrText($reurnArrDevice['errTxt']);	 
					$errArray[] = $errTxt;
						
				}

            //validate role id 
			$reurnArrRole = $this->validateItems(array('role_id'=>$arrRec['role_id']),'addrole_id');
			if($reurnArrRole['errFlag'])
			{
			    $errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
				$errArray[] = $errTxt ; 
			}
            //validate role id 
			$reurnArrRole = $this->validateItems(array('role_id'=>$arrRec['role_id']),'role_id');
			if($reurnArrRole['errFlag'])
			{
			    $errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
				$errArray[] = $errTxt ; 
			}


        
            //validate phone_no  
			$reurnArrMob = $this->validateItems(array('phone_no'=>$arrRec['phone_no']),'phone_no');
			if($reurnArrMob['errFlag'])
			{
				$errTxt = $this->getErrText($reurnArrMob['errTxt']);	 
				$errArray[] = $errTxt ; 
			}

            //print_r($errArray);die;
			//validate relation ship ids.
			//[representative_id] => 123 [coordinator_id] => 1233 [volunteer_id] => 1223
			$reurnArrrelation = $this->validateItems(array('representative_id'=>$arrRec['representative_id'],'coordinator_id'=>$arrRec['coordinator_id'],'email_id'=>$arrRec['email_id'],'volunteer_id'=>$arrRec['volunteer_id'],'record_id'=>$arrRec['record_id']),'update_relation_id');
			if($reurnArrrelation['errFlag'])
			{

				$reterrArray = explode(",",$reurnArrrelation['errTxt']) ;
				if(count($reterrArray))
				{
				   foreach($reterrArray as $key=>$valm)
					{
					  // echo $valm;
				      $errArray[]= $this->getErrText($valm);	
				   
				    }
				}else{
				//InvalidRepresentative,InvalidVolnteer,InvalidCoordinator
			     $errArray[] =  $this->getErrText($reurnArrrelation['errTxt']);	 
				}


				//$errArray[] = $errTxt ; 
			}			
			
			//validation for name .
				$reurnArrname = $this->validateItems(array('name'=>$arrRec['school_name']),'name');
				if($reurnArrname['errFlag'])
				{
					$errTxt = $this->getErrText($reurnArrname['errTxt']);	 
					$errArray[] = $errTxt;
						
				}
			

			//if error found then need to update the 
			if(count($errArray))
			{

				
			   
                $strErrTxt = implode(' , ',$errArray);
				//echo $strErrTxt;die;
                // error text .
				$returnArr = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>$strErrTxt
								  )		; 

			}else
			{
			
				/*[representative_id] => 123 [coordinator_id] => 1233 [volunteer_id] => 1223
				school_name
				email_id
				phone_no
				device_id
				representative_id	
				coordinator_id
				volunteer_id
				created_on
				created_by*/
				//insert in the relationship table.
				$sqlget  = " Select school.* ,group_relation.coordinator_id,group_relation.representative_id,group_relation.volunteer_id  from school 
				inner  join group_relation on group_relation.Id = school.group_relation_id
				Where school.Id=".(int)$arrRec['record_id'];

			    $recArrget  = $objCon->getRecords($sqlget);
				//print_r($recArrget);die;
				//check co-ordinator
				if(empty($arrRec['coordinator_id']))
				{
				  $coordinator_id = $recArrget[0]['coordinator_id'];
				}else
				{

				  $coordinator_id = $arrRec['coordinator_id'];
				
				}
				//check volunteer
				if(empty($arrRec['volunteer_id']))
				{
				  $volunteer_id = $recArrget[0]['volunteer_id'];
				}else
				{

				  $volunteer_id = $arrRec['volunteer_id'];
				
				}

				//check representative
				if(empty($arrRec['representative_id']))
				{
				  $representative_id = $recArrget[0]['representative_id'];
				}else
				{

				  $representative_id = $arrRec['representative_id'];
				
				}
				
				 $sqlC = "update group_relation
						 SET 
						 representative_id ='".$representative_id."',
						 coordinator_id='".$coordinator_id."',
						 volunteer_id='".$volunteer_id."',
						 modified_on = now(),
						 modified_by = '".$arrRet['InforArr'][0]['recId']."'
						 where Id= '". $recArrget[0]['group_relation_id']."'";
					///echo $sqlC;die;
					//echo $sqlC;
			     $objCon->insertUpdtRecords('update', $sqlC);
				 $insrtidC = $recArrget[0]['group_relation_id'];
				 if(!empty($recArrget[0]['Id']))
				 {

						//check school_name
						if(empty($arrRec['school_name']))
						{
							$school_name = $recArrget[0]['school_name'];
						}else
						{

							$school_name = $arrRec['school_name'];

						}
						//check email_id
						if(empty($arrRec['email_id']))
						{
							$email_id = $recArrget[0]['email_id'];
						}else
						{

							$email_id = $arrRec['email_id'];

						}
						//check phone_no
						if(empty($arrRec['phone_no']))
						{
							$phone_no = $recArrget[0]['phone_no'];
						}else
						{

							$phone_no = $arrRec['phone_no'];

						}

					 $sql = "Update  school
						   SET 
						   school_name ='".$school_name."',
						   email_id='".$email_id."',
						   phone_no='".$phone_no."',
						   group_relation_id ='".$insrtidC."',
						   school_address='".addslashes($arrRec['school_address'])."',
						   school_address2='".addslashes($arrRec['school_address1'])."',
						   school_address3='".addslashes($arrRec['school_address2'])."',
						   modified_on = now(),
						   modified_by = '".$arrRet['InforArr'][0]['recId']."'
						   where Id= '".$recArrget[0]['Id']."'";
						   

						 //  echo $sql;die;

					     $insrtid = $objCon->insertUpdtRecords('update', $sql);
						    $returnArr = array(
									'InforArr'=>array('school_name'=>$arrRec['school_name']),
									'Success'=>1,
									'errTxt'=>'School modified successfully.'
								  )		; 
				 }else
				 {
				 
				    $returnArr = array(
									'InforArr'=>array('school_name'=>$arrRec['school_name']),
									'Success'=>0,
									'errTxt'=>'Network issue'
								  )		; 
				 
				 }

					

			   
				//echo  'rrrr--',$insrtid;die;
			  

				 
			}
           
				//$returnArr ;
			return $returnArr;
		
		}


	/*
      Name:  registerSchool
	  Operation: It will create schoolin the DB with all the checks.
	  @param:  $arrRec
				
				Array ( [school_name] => krishna [session_id] => 6m7hfq4t8331b9vg3uvbo1n044 [phone_no] => 34456678 [representative_id] => 123 [coordinator_id] => 1233 [volunteer_id] => 1223 [name] => pradyumn [email_id] => [device_id] => [userpassword] => [confirmpassword] => [mobile_no] => [role_id] => [oprType] => registerSchool [secretKey] => [button] => Post 
			   
	  return : if school registered success-fully Success=1 else 0
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 

	protected function registerSchool($arrRec)
		{
			 //echo '<pre>';
			 //print_r($arrRec);die;
			 $parmSessionid = $arrRec['session_id'];
			 $arrRet = $this->isLogin($parmSessionid);
			 if(!$arrRet['Success'])
			 {
				 return $arrRet;
			 
			 }
			//echo 'main';die;
			$objCon = new MySqlData();
			//$objMysql = $objCon->getConnection();
			
			$errArray = array();
             //validate email 
			$reurnArrEmail = $this->validateItems(array('email_id'=>$arrRec['email_id']),'schoolemail_id');
             
			if($reurnArrEmail['errFlag'])
			{
			   
			    $errTxt = $this->getErrText($reurnArrEmail['errTxt']);	 
				$errArray[] = $errTxt ; 
			}

		  //validate address 
			$reurnArrAddress = $this->validateItems(array('school_address'=>$arrRec['school_address'],'school_address2'=>$arrRec['school_address2'],'school_address3'=>$arrRec['school_address3']),'school_address');
         
			if($reurnArrAddress['errFlag'])
			{
			   
			    $errTxt = $this->getErrText($reurnArrAddress['errTxt']);	 
				$errArray[] = $errTxt ; 
			}



			//validation for devcie id.
				$reurnArrDevice = $this->validateItems(array('session_id'=>$arrRec['session_id']),'session_id');

				//print_r($reurnArrDevice);die;
				if($reurnArrDevice['errFlag'])
				{
					
					//print_r($reurnArrDevice);die;

					$errTxt = $this->getErrText($reurnArrDevice['errTxt']);	 
					$errArray[] = $errTxt;
						
				}

            //validate role id 
			$reurnArrRole = $this->validateItems(array('role_id'=>$arrRec['role_id']),'addrole_id');
			if($reurnArrRole['errFlag'])
			{
			    $errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
				$errArray[] = $errTxt ; 
			}
            //validate role id 
			$reurnArrRole = $this->validateItems(array('role_id'=>$arrRec['role_id']),'role_id');
			if($reurnArrRole['errFlag'])
			{
			    $errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
				$errArray[] = $errTxt ; 
			}


        
            //validate phone_no  
			$reurnArrMob = $this->validateItems(array('phone_no'=>$arrRec['phone_no']),'phone_no');
			if($reurnArrMob['errFlag'])
			{
				$errTxt = $this->getErrText($reurnArrMob['errTxt']);	 
				$errArray[] = $errTxt ; 
			}

            //print_r($errArray);die;
			//validate relation ship ids.
			//[representative_id] => 123 [coordinator_id] => 1233 [volunteer_id] => 1223
			$reurnArrrelation = $this->validateItems(array('representative_id'=>$arrRec['representative_id'],'coordinator_id'=>$arrRec['coordinator_id'],'email_id'=>$arrRec['email_id'],'volunteer_id'=>$arrRec['volunteer_id']),'relation_id');
			if($reurnArrrelation['errFlag'])
			{

				$reterrArray = explode(",",$reurnArrrelation['errTxt']) ;
				if(count($reterrArray))
				{
				   foreach($reterrArray as $key=>$valm)
					{
					  // echo $valm;
				      $errArray[]= $this->getErrText($valm);	
				   
				    }
				}else{
				//InvalidRepresentative,InvalidVolnteer,InvalidCoordinator
			     $errArray[] =  $this->getErrText($reurnArrrelation['errTxt']);	 
				}


				//$errArray[] = $errTxt ; 
			}			
			
			//validation for name .
				$reurnArrname = $this->validateItems(array('name'=>$arrRec['school_name']),'name');
				if($reurnArrname['errFlag'])
				{
					$errTxt = $this->getErrText($reurnArrname['errTxt']);	 
					$errArray[] = $errTxt;
						
				}
			

			//if error found then need to update the 
			if(count($errArray))
			{

				
			   
                $strErrTxt = implode(' , ',$errArray);
				//echo $strErrTxt;die;
                // error text .
				$returnArr = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>$strErrTxt
								  )		; 

			}else
			{
			
				/*[representative_id] => 123 [coordinator_id] => 1233 [volunteer_id] => 1223
				school_name
				email_id
				phone_no
				device_id
				representative_id	
				coordinator_id
				volunteer_id
				created_on
				created_by*/
				//insert in the relationship table.
				
				 $sqlC = "Insert Into group_relation
					   SET 
						 representative_id ='".$arrRec['representative_id']."',
						 coordinator_id='".$arrRec['coordinator_id']."',
						 volunteer_id='".$arrRec['volunteer_id']."',
						 created_on = now(),
						 created_by = '".$arrRet['InforArr'][0]['recId']."'
			           ";
					//echo $sqlC;die;
			     $insrtidC = $objCon->insertUpdtRecords('insert', $sqlC);
				 if(!empty($insrtidC))
				 {
					 $sql = "Insert Into school
						   SET 
						   school_name ='".$arrRec['school_name']."',
						   email_id='".$arrRec['email_id']."',
						   phone_no='".$arrRec['phone_no']."',
						   group_relation_id ='".$insrtidC."',
						   school_address='".addslashes($arrRec['school_address'])."',
						   school_address2='".addslashes($arrRec['school_address1'])."',
						   school_address3='".addslashes($arrRec['school_address2'])."',
						   created_on = now(),
						   created_by = '".$arrRet['InforArr'][0]['recId']."'
						   ";

						   //echo $sql;die;

					     $insrtid = $objCon->insertUpdtRecords('insert', $sql);
						    $returnArr = array(
									'InforArr'=>array('school_name'=>$arrRec['school_name']),
									'Success'=>1,
									'errTxt'=>'school registered.'
								  )		; 
				 }else
				 {
				 
				    $returnArr = array(
									'InforArr'=>array('school_name'=>$arrRec['school_name']),
									'Success'=>0,
									'errTxt'=>'Network issue'
								  )		; 
				 
				 }

					

			   
				//echo  'rrrr--',$insrtid;die;
			  

				 
			}
           
				//$returnArr ;
			return $returnArr;
		
		}
	 
	/*
      Name:getLogin
	  Operation: It will check login creidentials.
	  @param: email /password
    
	  return : session id and other information .
	            last login :
				username 
				emailid
       Created On: 29/09/2017
	   Created By: pbd
	   Modified by   -:
	   What Modified -:
      

	*/                

	protected  function getLogin($email,$password)
		{

			//Id,email_id,mobile_no,name
			$objCon = new MySqlData();
		
			 $sql =  " SELECT Id as recId,role_id,email_id,mobile_no,name from coordinator where email_id=  '".$email."'
			          and BINARY userpassword	= '".$password."' and status='1'" ;

			
			$recArr = $objCon->getRecords($sql);
			$recArr = $recArr[0];
			//print_r($recArr);die;

			if(!empty($recArr['recId']))
			{
				//session_start();
				//$id= session_id();
				//$p = new OAuthProvider();

				//$id= $t = $p->generateToken(16);
				$token = openssl_random_pseudo_bytes(16);//will generate the token for session.
 
				//Convert the binary data into hexadecimal representation.
				 $id = $token = bin2hex($token);


				//echo $id.'kkkk';die;
				//$_SESSION["user_id"]       = $recArr['recId'];
				///$_SESSION["user_email"]    = $recArr['email_id'];
				//$_SESSION["user_role_id"]  = $recArr['role_id'];

				//store this info in db for time stamp. 2/8/2018
					$sqlInsert = " Insert Into session
					SET 
					token ='".$id."',
					strData='".serialize($recArr)."',
					created_on = now(),
					modified_on	 = now(),
					created_by = '".$recArr['recId']."' ";

					$insrtid = $objCon->insertUpdtRecords('insert', $sqlInsert);
				//store this info in db for time stamp. 2/8/2018
                $returnArr = array(
									'InforArr'=>array('recId'=>$recArr['recId'],'mobile_no'=>$recArr['mobile_no'],'name'=>$recArr['name'],'email_id'=>$recArr['email_id'],'session_id'=>$id,'role_id'=>$recArr['role_id']),
									'Success'=>1,
									'errTxt'=>$errTxt
								   )		; 
													
			   
			}else
			{

				$errTxt = $this->getErrText('invalidCrenditials');

                $returnArr = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>$errTxt
								   )		; 

			
			}
			return $returnArr;
		
		
		}

	/*
      Name:getErrText
	  Operation: It will error messages.
	  @param: $asskey
    
	  return : the message of the error.
       Created On: 29/09/2017
	   Created By: pbd
	   Modified by   -:
	   What Modified -:
      

	*/ 
function getErrText($asskey)
		{


				$arrayErrMsg = array(  
				'secKeyErr'=> 'Invalid security Key',
				'secNotMatch'=> 'Sorry Key Does not match',
				'notValidMail'=> 'Invalid e-mail selection',
				'roleNotexist'=>'We do not found this role in the system',
				'invalidMobno'=>'Invalid mobile number',
				'invalidPhoneno'=>'Invalid phone number',
				'mailexist'=>'We already found this email in our system',
				'passConfirmNotmatch'=>'Password and confirmpassword does not match',
				'passMust6to18char'=>'Password must be between 6 to 18 character ',
				'nameNotempty'=>'Please supply a valid name ',
				'invalidCrenditials'=>'Invalid credential ',
				'InvalidRepresentative'=>'Invalid Representative or we did not found this in our system ',
				'InvalidVolnteer'=>'Invalid Volnteer or we did not found this in our system ',
				'InvalidCoordinator'=>'Invalid Coordinator or we did not found this in our system',
				'duplicateSchoolEntry'=>'Duplicate School Entry  ',
				'roleCannotAddSchool'=>'Not allowed to add school',
				'mobExist'=>'We already found this mobile-no in our system',
				'invalidSessionid'=>'Problem in the session',
				'addNotempty'=>'Please select one of the Address',
				'classNotempty'=>'Please select class',
				'invalidSchool'=>'Invalid school or we do not find it in our system',
				'invalidDate'=>'Not a valid date for DOB(Date of Birth)',
				'fatherNotempty'=>'Please select father name',
				'recordDoesnotFound'=>'Sorry invalid  record ',
				'deviceidNotFnd'=>'Device id  not found '

				);

				if(empty($arrayErrMsg[$asskey]))
				{
				 return 'Some err found in the operation' ;
				}else
				{
				   return $arrayErrMsg[$asskey];
				
				}

				

		}

	/*
      Name:compareSecurityKey
	  Operation: It will check login creidentials.
	  @param: secureKey
    
	  return : true false
       Created On: 02/10/2017
	   Created By: pbd
	   Modified by   -:
	   What Modified -:
      

	*/   
		protected function compareSecurityKey($secureKey)
				{

					if($secureKey==$this->securitykey)
					{
					   $returnArr = array
									(
									   'InforArr'=>array('secureKey'=>$this->securitykey),
									   'Success'=>1,
									   'errTxt'=>''
									 );
					}else
					{
						$errTxt = $this->getErrText('secNotMatch');	 
						$returnArr = array
									(
									'InforArr'=>array('secureKey'=>$secureKey),
									'Success'=>0,
									'errTxt'=>$errTxt
								    )		; 
														 
					}

					return $returnArr;

				}

   /*
      Name:  getRoles
	  Operation: It will give  roles in the system .
	  @param:  
				
	   return : return array of the  roles in the system.
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 

		protected function getRoles($param=1)
		{
			$objCon = new MySqlData();
		    $objMysql = $objCon->getConnection();
			
			$sql =  " SELECT Id,role_name from roles " ;
			$recArr = $objCon->getRecords($sql);


			return $recArr;

		}

	/*
      Name:  registerCoordinator
	  Operation: It will create user in the system.
	  @param:  $arrRec
				
				Array ( [name] => pradyumn [email_id] => pbd.lok@gmail.com [userpassword] => 123huii [confirmpassword] => 1234355 [mobile_no] => 890765757 [role_id] => 1 [school_id] => 12 [oprType] => registercordinator [secretKey] =>
				[device_id]=>
				1el$r4tErT5!1dFrK0Phg4{64hFr565959d}_*1y%^&aen|7byu [Submit] => Submit )
			
			   
		return : if school user registered success-fully Success=1 else 0
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 


		protected function registerCoordinator($arrRec)
		{


			$objCon = new MySqlData();
			//$objMysql = $objCon->getConnection();

			/*
				Array ( [name] => pradyumn [email_id] => pbd.lok@gmail.com [userpassword] => 123huii [confirmpassword] => 1234355 [mobile_no] => 890765757 [role_id] => 1 [school_id] => 12 [oprType] => registercordinator [secretKey] =>
				[device_id]=>
				1el$r4tErT5!1dFrK0Phg4{64hFr565959d}_*1y%^&aen|7byu [Submit] => Submit )
			*/
			
			$errArray = array();
             //validate email 
			$reurnArrEmail = $this->validateItems(array('email_id'=>$arrRec['email_id']),'email_id');
             
			if($reurnArrEmail['errFlag'])
			{
			   
			    $errTxt = $this->getErrText($reurnArrEmail['errTxt']);	 
				$errArray[] = $errTxt ; 
			}
            //validate role id 
			$reurnArrRole = $this->validateItems(array('role_id'=>$arrRec['role_id']),'role_id');
			if($reurnArrRole['errFlag'])
			{
			    $errTxt = $this->getErrText($reurnArrRole['errTxt']);	 
				$errArray[] = $errTxt ; 
			}

            //validate mobile_no  
			$reurnArrMob = $this->validateItems(array('mobile_no'=>$arrRec['mobile_no']),'mobile_no');
			if($reurnArrMob['errFlag'])
			{
				$errTxt = $this->getErrText($reurnArrMob['errTxt']);	 
				$errArray[] = $errTxt ; 
			}

			//validate password  
			$reurnArrpass = $this->validateItems(array('confirmpassword'=>$arrRec['confirmpassword'],'userpassword'=>$arrRec['userpassword']),'pass');
		    if($reurnArrpass['errFlag'])
			{

			   $errTxt = $this->getErrText($reurnArrpass['errTxt']);	 
			   $errArray[] = $errTxt;
			   			
			}

			//validation for devcie id.
				$reurnArrDevice = $this->validateItems(array('device_id'=>$arrRec['device_id']),'device_id');
				if($reurnArrDevice['errFlag'])
				{
					$errTxt = $this->getErrText($reurnArrDevice['errTxt']);	 
					$errArray[] = $errTxt;
						
				}

			//validation for name .
				$reurnArrname = $this->validateItems(array('name'=>$arrRec['name']),'name');
				if($reurnArrname['errFlag'])
				{
					$errTxt = $this->getErrText($reurnArrname['errTxt']);	 
					$errArray[] = $errTxt;
						
				}
			

			//if error found then need to update the 
			if(count($errArray))
			{

				
			   
                $strErrTxt = implode(' , ',$errArray);
				//echo $strErrTxt;die;
                // error text .
				$returnArr = array(
									'InforArr'=>array(),
									'Success'=>0,
									'errTxt'=>$strErrTxt
								  )		; 

			}else
			{
			


			   $sql = "Insert Into coordinator
					   SET 
			           name ='".$arrRec['name']."',
					   email_id='".$arrRec['email_id']."',
					   userpassword='".$arrRec['userpassword']."',
					   mobile_no='".$arrRec['mobile_no']."',
					   device_id='".$arrRec['device_id']."',
					   role_id='".$arrRec['role_id']."',
					   created_on = now()
			           ";

					//echo $sql;die;

			     $insrtid = $objCon->insertUpdtRecords('insert', $sql);
				//echo  'rrrr--',$insrtid;die;
			     $returnArr = array(
									'InforArr'=>array('email_id'=>$arrRec['email_id'],'userpassword'=>$arrRec['userpassword']),
									'Success'=>1,
									'errTxt'=>$strErrTxt
								  )		; 

				 
			}
           
				//$returnArr ;
			return $returnArr;
		
		}


	/*
      Name:  validateItems
	  Operation: It will create schoolin the DB with all the checks.
	  @param:  $paramArr-> the field value we need to test.,$case -> what need to validate 
				
			   
	  return : message that is appropaite for  the user.
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 
	  protected function validateItems($paramArr,$case)
		{

			$objCon = new MySqlData();
		
		    //fetching the values of the 
			$email_id         = trim($paramArr['email_id']);
			$role_id          = trim($paramArr['role_id']);
			$mobile_no        = trim($paramArr['mobile_no']);
			$phone_no         = trim($paramArr['phone_no']);
			$userpassword     = trim($paramArr['userpassword']);
			$confirmpassword  = trim($paramArr['confirmpassword']);
			$device_id        = trim($paramArr['device_id']);
			$name             = trim($paramArr['name']);
			$class             = trim($paramArr['class']);
			$school_id             = trim($paramArr['school_id']);

			$paramsession_id             = trim($paramArr['session_id']);
//school_address
		   // $value = trim($paramArr['email']);
			switch ($case)
			{


					case 'studentrecord_id':
			      //check in D.B
					$sql =  " SELECT  Id from students where Id= '".(int)$paramArr['record_id']."'" ;
					$recArr = $objCon->getRecords($sql);
					if(empty($recArr[0]['Id']))
					{
					  return array('errFlag'=>true,'errTxt'=>'recordDoesnotFound') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;
				case 'studentemail_idedit':
			      
				   //validate mail ids.
				  if(!filter_var($email_id, FILTER_VALIDATE_EMAIL))
					{
						return array('errFlag'=>true,'errTxt'=>'notValidMail') ; 
					}


					//check in D.B
					$sql =  " SELECT  email_id from students where email_id= '".$email_id."' and Id!= '".$paramArr['record_id']."'" ;
					$recArr = $objCon->getRecords($sql);
					if(!empty($recArr[0]['email_id']))
					{
					  return array('errFlag'=>true,'errTxt'=>'mailexist') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;

					break ;

				case 'record_id':
			      
					//check in D.B
					$sql =  " SELECT  Id from school where Id= '".(int)$paramArr['record_id']."'" ;
					$recArr = $objCon->getRecords($sql);
					if(empty($recArr[0]['Id']))
					{
					  return array('errFlag'=>true,'errTxt'=>'recordDoesnotFound') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;

				case 'schoolemail_idedit':
			      
				   //validate mail ids.
				  if(!filter_var($email_id, FILTER_VALIDATE_EMAIL))
					{
						return array('errFlag'=>true,'errTxt'=>'notValidMail') ; 
					}

					//check in D.B
					$sql =  " SELECT  email_id from school where email_id= '".$email_id."' and Id!= '".$paramArr['record_id']."'" ;
					$recArr = $objCon->getRecords($sql);
					if(!empty($recArr[0]['email_id']))
					{
					  return array('errFlag'=>true,'errTxt'=>'mailexist') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;

					break ;

				case 'schoolemail_id':
			      
				   //validate mail ids.
				  if(!filter_var($email_id, FILTER_VALIDATE_EMAIL))
					{
						return array('errFlag'=>true,'errTxt'=>'notValidMail') ; 
					}

					//check in D.B
					$sql =  " SELECT  email_id from school where email_id= '".$email_id."'" ;
					$recArr = $objCon->getRecords($sql);
					if(!empty($recArr[0]['email_id']))
					{
					  return array('errFlag'=>true,'errTxt'=>'mailexist') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;

					break ;
				case 'update_relation_id':
			
				    // validation weather the id is passed correctly .
					/*$paramArr['representative_id']
					$paramArr['coordinator_id']
					$paramArr['volunteer_id']
					$paramArr['record_id']
					*/
					//check for the representative_id

					 if(!empty($paramArr['representative_id']))
					{
						$sql =  " SELECT  Id  from coordinator where status='1' and Id= '".(int)$paramArr['representative_id']."' and role_id=4" ;

						$recArrResprst = $objCon->getRecords($sql);
						$errTxtC = array();

						if(empty($recArrResprst[0]['Id']))
						{
							//return array('errFlag'=>true,'errTxt'=>'InvalidRepresentative') ;
							$errTxtC[] = 'InvalidRepresentative'   ;
						}
					}

					//check for the volunteer_id
					 if(!empty($paramArr['volunteer_id']))
					  {
							$sql =  " SELECT  Id  from coordinator where status='1' and Id= '".(int)$paramArr['volunteer_id']."' and role_id=3" ;

							$recArrVolnteer = $objCon->getRecords($sql);

							if(empty($recArrVolnteer[0]['Id']))
							{
								//return array('errFlag'=>true,'errTxt'=>'InvalidRepresentative') ;
								$errTxtC[] = 'InvalidVolnteer'   ;
							}
				     }
					//check for the coordinator

				    $sql =  " SELECT  Id  from coordinator where status='1' and Id= '".(int)$paramArr['coordinator_id']."' and role_id=2" ;

					$recArrCordinator = $objCon->getRecords($sql);

					if(empty($recArrCordinator[0]['Id']))
					{
						//return array('errFlag'=>true,'errTxt'=>'InvalidRepresentative') ;
						$errTxtC[] = 'InvalidCoordinator'   ;
					}
                    // error catch and make it readable.
                    if(count($errTxtC))
					{
					
					   $concatErrtxt =   implode(",",$errTxtC);
					}else
					{
					   $concatErrtxt =   '';
					}

					//echo $concatErrtxt;die;
					if(!empty( $concatErrtxt)) //return multipile errors .
					{
					
						return array('errFlag'=>true,'errTxt'=>$concatErrtxt) ;
					
					    
					}

					//check the duplicate for the three.
					  $whereArrDup =  array();
					  //

                      if(!empty($paramArr['representative_id']))
					  {
                         $whereArrDup[] = "representative_id= '".(int)$paramArr['representative_id']."'";
					  
					  }

					 if(!empty($paramArr['volunteer_id']))
					  {
                         $whereArrDup[] = "volunteer_id= '".(int)$paramArr['volunteer_id']."'";
					  
					  }

					 $whereArrDup[] = " school.Id != '".(int)$paramArr['record_id']."'";

					   $whereArrDup[] = 1;
						// print_r($whereArrDup);
                      $whereCondition =   implode(" and ",$whereArrDup);

					 // echo  $whereCondition;die;

					 


					$sql =  " SELECT  group_relation.Id  , 
					school.phone_no,
					school.email_id
					from school
					left join group_relation 
					on school.group_relation_id = group_relation.Id
					where school.status='1' and school.email_id='".$paramArr['email_id']."' and
					coordinator_id= '".(int)$paramArr['coordinator_id']."' and $whereCondition     ";
					//echo $sql;die;
					$recArrs = $objCon->getRecords($sql);
					
					if(!empty($recArrs[0]['Id']))
					{
						return array('errFlag'=>true,'errTxt'=>'duplicateSchoolEntry') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;

				case 'father_name':

					if(strlen($paramArr['father_name'])==0)
					{
						return array('errFlag'=>true,'errTxt'=>'fatherNotempty') ;
					}

				return array('errFlag'=>false,'errTxt'=>'') ;
				break ;
				case 'dob_date':
					//-----format lik  dd-mm-yyyy ---> 06-04-2002

					$explodeArr =  explode("-",$paramArr['dob_date']);
					//print_r($explodeArr);die;
					$flagVal    = checkdate ( $explodeArr[1] , $explodeArr[0] ,$explodeArr[2] );

					if(!$flagVal)
					{
						return array('errFlag'=>true,'errTxt'=>'invalidDate') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
				break ;
				case 'school_id':
					$sql =  " SELECT  Id  from school where status='1' and Id= '".(int)$school_id."' " ;
					$recArrschool = $objCon->getRecords($sql);

					if(empty($recArrschool[0][Id]))
					{
						return array('errFlag'=>true,'errTxt'=>'invalidSchool') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
				break ;


				case 'class':

					if(strlen($class)==0)
					{
						return array('errFlag'=>true,'errTxt'=>'classNotempty') ;
					}

				return array('errFlag'=>false,'errTxt'=>'') ;
				break ;

				case 'school_address':

					if(empty($paramArr['school_address']) && empty($paramArr['school_address2']) && empty($paramArr['school_address3']))
					{
						return array('errFlag'=>true,'errTxt'=>'addNotempty') ;
					}

				return array('errFlag'=>false,'errTxt'=>'') ;
				break ;

				case 'session_id':
					//coordinator where status='1'
					// $sql =  " SELECT  role_id from coordinator where Id= '".$role_id."'" ;
					//$recArr = $objCon->getRecords($sql);
					$session_id = session_id() ; 
					if($session_id != $paramsession_id)
					{
						//return array('errFlag'=>true,'errTxt'=>'invalidSessionid') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;

				case 'relation_id':
			
				    // validation weather the id is passed correctly .
					/*$paramArr['representative_id']
					$paramArr['coordinator_id']
					$paramArr['volunteer_id']*/
					//check for the representative_id

					 if(!empty($paramArr['representative_id']))
					{
						$sql =  " SELECT  Id  from coordinator where status='1' and Id= '".(int)$paramArr['representative_id']."' and role_id=4" ;

						$recArrResprst = $objCon->getRecords($sql);
						$errTxtC = array();

						if(empty($recArrResprst[0]['Id']))
						{
							//return array('errFlag'=>true,'errTxt'=>'InvalidRepresentative') ;
							$errTxtC[] = 'InvalidRepresentative'   ;
						}
					}

					//check for the volunteer_id
					 if(!empty($paramArr['volunteer_id']))
					  {
							$sql =  " SELECT  Id  from coordinator where status='1' and Id= '".(int)$paramArr['volunteer_id']."' and role_id=3" ;

							$recArrVolnteer = $objCon->getRecords($sql);

							if(empty($recArrVolnteer[0]['Id']))
							{
								//return array('errFlag'=>true,'errTxt'=>'InvalidRepresentative') ;
								$errTxtC[] = 'InvalidVolnteer'   ;
							}
				     }
					//check for the coordinator

				    $sql =  " SELECT  Id  from coordinator where status='1' and Id= '".(int)$paramArr['coordinator_id']."' and role_id=2" ;

					$recArrCordinator = $objCon->getRecords($sql);

					if(empty($recArrCordinator[0]['Id']))
					{
						//return array('errFlag'=>true,'errTxt'=>'InvalidRepresentative') ;
						$errTxtC[] = 'InvalidCoordinator'   ;
					}
                    // error catch and make it readable.
                    if(count($errTxtC))
					{
					
					   $concatErrtxt =   implode(",",$errTxtC);
					}else
					{
					   $concatErrtxt =   '';
					}

					//echo $concatErrtxt;die;
					if(!empty( $concatErrtxt)) //return multipile errors .
					{
					
						return array('errFlag'=>true,'errTxt'=>$concatErrtxt) ;
					
					    
					}

					//check the duplicate for the three.
					  $whereArrDup =  array();
					  //

                      if(!empty($paramArr['representative_id']))
					  {
                         $whereArrDup[] = "representative_id= '".(int)$paramArr['representative_id']."'";
					  
					  }

					 if(!empty($paramArr['volunteer_id']))
					  {
                         $whereArrDup[] = "volunteer_id= '".(int)$paramArr['volunteer_id']."'";
					  
					  }

					   $whereArrDup[] = 1;
						// print_r($whereArrDup);
                      $whereCondition =   implode(" and ",$whereArrDup);

					 // echo  $whereCondition;die;

					 


					$sql =  " SELECT  group_relation.Id  , 
					school.phone_no,
					school.email_id
					from school
					left join group_relation 
					on school.group_relation_id = group_relation.Id
					where school.status='1' and school.email_id='".$paramArr['email_id']."' and
					coordinator_id= '".(int)$paramArr['coordinator_id']."' and $whereCondition     ";
					// $sql;die;
					$recArrs = $objCon->getRecords($sql);
					
					if(!empty($recArrs[0]['Id']))
					{
						return array('errFlag'=>true,'errTxt'=>'duplicateSchoolEntry') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;

					case 'addrole_id':
					//coordinator where status='1'
					// $sql =  " SELECT  role_id from coordinator where Id= '".$role_id."'" ;
					//$recArr = $objCon->getRecords($sql);
					if($recArr[0]['role_id']==4  )
					{
						return array('errFlag'=>true,'errTxt'=>'roleCannotAddSchool') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;
				case 'name':
			
					if(empty($name))
					{
					return array('errFlag'=>true,'errTxt'=>'nameNotempty') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;
				case 'email_id':
			      
				   //validate mail ids.
				  if(!filter_var($email_id, FILTER_VALIDATE_EMAIL))
					{
						return array('errFlag'=>true,'errTxt'=>'notValidMail') ; 
					}

					//check in D.B
					$sql =  " SELECT  email_id from coordinator where email_id= '".$email_id."'" ;
					$recArr = $objCon->getRecords($sql);
					if(!empty($recArr[0]['email_id']))
					{
					  return array('errFlag'=>true,'errTxt'=>'mailexist') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;

					break ;
				case 'studentemail_id':
			      
				   //validate mail ids.
				  if(!filter_var($email_id, FILTER_VALIDATE_EMAIL))
					{
						return array('errFlag'=>true,'errTxt'=>'notValidMail') ; 
					}

					//check in D.B
					$sql =  " SELECT  email_id from students where email_id= '".$email_id."'" ;
					$recArr = $objCon->getRecords($sql);
					if(!empty($recArr[0]['email_id']))
					{
					  return array('errFlag'=>true,'errTxt'=>'mailexist') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;

					break ;
					case 'phone_no':
						//\+?\d[\d -]{8,12}\d
						$regularExprsn =  '/\+?\d[\d -]{8,12}\d/' ;
						//echo $phone_n;die;
					    if(!preg_match($regularExprsn,$phone_no))
						{
					      
						   return array('errFlag'=>true,'errTxt'=>'invalidPhoneno') ;
					   
					    }

						return array('errFlag'=>false,'errTxt'=>'') ;

				   case 'mobile_no':
						/*^(7|8|9)\d{9}$
						-----
						^        #Match the beginning of the string
						(7|8|9)  #Match a 7, 8 or 9 digit
						\d       #Match a digit (0-9 and anything else that is a "digit")
						{9}      #Repeat the previous "\d" 9 times (9 digits)
						$        #Match the end of the string*/
						$length = 	strlen($mobile_no);
						//preg_match($re, $str, $matches, PREG_SET_ORDER, 0);
						$regularExprsn =  '/^[789]\d{9}$/' ;
					    if(!preg_match($regularExprsn,$mobile_no))
						{
					      
						   return array('errFlag'=>true,'errTxt'=>'invalidMobno') ;
					   
					    }
					//check in D.B
					$sql =  " SELECT  mobile_no from coordinator where mobile_no= '".$mobile_no."'" ;
					$recArr = $objCon->getRecords($sql);
					if(!empty($recArr[0]['mobile_no']))
					{
					  return array('errFlag'=>true,'errTxt'=>'mobExist') ;
					}
						return array('errFlag'=>false,'errTxt'=>'') ;
					
					break ;

				case 'role_id':
			


				    $sql =  " SELECT  Id as role_id from roles where Id= '".$role_id."'" ;

					$recArr = $objCon->getRecords($sql);
					
					if(empty($recArr[0]['role_id']))
					{
						return array('errFlag'=>true,'errTxt'=>'roleNotexist') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;

				case 'device_id':
			
					if(empty($device_id))
					{
					 return array('errFlag'=>true,'errTxt'=>'deviceidNotFnd') ;
					}

					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;

				case 'pass':
				//	echo $userpassword,'==',$confirmpassword;die;
					if (strlen($userpassword) < 6 || strlen($userpassword) >18)
					{
						return array('errFlag'=>true,'errTxt'=>'passMust6to18char') ;

					}else if($userpassword!==$confirmpassword)
					{
						return array('errFlag'=>true,'errTxt'=>'passConfirmNotmatch') ;
					}
				
					return array('errFlag'=>false,'errTxt'=>'') ;
					break ;
					
					
				default:
				return 1;


		    }
		
		}


	
	/*
      Name:  serviceCallLog
	  Operation: It will create log for the calling service.
	  @param:  $paramArr oprType ,REMOTE_ADDR , HTTP_USER_AGENT
				
	  return : if school registered success-fully Success=1 else 0
       Created On: 10/19/2017
	   Created By: parakiya bhav das
	   Modified by   -:
	   What Modified -:
	*/ 
		protected function serviceCallLog($paramArr)
		{

			$objCon = new MySqlData();
			//echo '<pre>'; 
		     //print_R($_SERVER);
			 //die;
			 $sql = "Insert Into callLog
					   SET 
			           methodname ='".$paramArr['oprType']."',
					   ipAddr='".$_SERVER['REMOTE_ADDR']."',
					   devcieName='".$_SERVER['HTTP_USER_AGENT']."',
					   created_on = now()
			         ";
			 $insrtid = $objCon->insertUpdtRecords('insert', $sql);
		
		}

	
	  
   }


//calling Api 
Class getMethods extends ApiApp
{

    function __construct() { }


	function buildInput($paraArr)
	{
	   
	    $arrayBuild = array();
	    foreach($paraArr as $key=>$valT)
		{
	         $arrayBuild[$key] = htmlspecialchars(trim($valT));
	    }

		return  $arrayBuild ; 
	
	}

	function appOpration($typOpr,$paraArr)
	{

		$objApi = new ApiApp();
	   
	   switch ($typOpr)
		{



			case 'forgetPassword':

			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->forgetPassword($paraArr);
			break;

			case 'getUserProfile':

			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->getUserProfile($paraArr);
			break;
			case 'editStudent':

			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->editStudent($paraArr);
			break;
			case 'getActivityBySchool':

			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->getActivityBySchool($paraArr);
			break;

			case 'activityInfoLog':

			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->activityInfoLog($paraArr);
			break;

			case 'getSchools':
			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->getSchools($paraArr);
             break;
			case 'searchStudent':
			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->searchStudent($paraArr);
             break;
			case 'registerStudent':
			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->registerStudent($paraArr);
             break;
			case 'searchSchool':
			$paraArr   = $this->buildInput($paraArr);
			$arraRecds =$objApi->searchSchool($paraArr);
			////print_r($arraRecds);
			return	$arraRecds ;
             break;
			case 'editSchool':

			$paraArr['edit'] =   1;
			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->editSchool($paraArr);
			break;
			case 'isLogout':

			$paraArr   = $this->buildInput($paraArr);
			return	$arraRecds =$objApi->isLogout($paraArr);
			break;
			case 'getUserByRoleIdDetail':

				//print_r($paraArr);echo 'ttty';die;
				$paraArr   = $this->buildInput($paraArr);
				return	$arraRecds =$objApi->getUserByRoleIdDetail($paraArr);

				$returnArr = array
						 (
						   'InforArr'=>$arraRecds,
						   'Success'=>1,
						   'errTxt'=>''
						 );
				break;

			case 'UserByRoles':

				//print_r($paraArr);echo 'ttty';die;
				$paraArr   = $this->buildInput($paraArr);
				return	$arraRecds =$objApi->getUserByRoleId($paraArr);

				$returnArr = array
						 (
						   'InforArr'=>$arraRecds,
						   'Success'=>1,
						   'errTxt'=>''
						 );
				break;
			case 'regschool':

				//print_r($paraArr);echo 'ttty';die;
				$paraArr   = $this->buildInput($paraArr);
				return	$arraRecds =$objApi->registerSchool($paraArr);
				break;
		   case 'log':

			   $arraRecds =$objApi->serviceCallLog($paraArr);
				break;
			case 'login':

				$paraArr   = $this->buildInput($paraArr);
				return	$arraRecds =$objApi->getLogin($paraArr['email_id'],$paraArr['userpassword']);

			break ;
           
			case 'keycomp':

		    return	$arraRecds = $objApi->compareSecurityKey($paraArr['secretkey']);
			break;
			case 'reguser':

			$paraArr   = $this->buildInput($paraArr);
			$arraRecds = $objApi->registerCoordinator($paraArr);
			//print_r($arraRecds);die;
			return $arraRecds;
			break;
			case 'getroles':

			$arraRecds  = $objApi->getRoles();
			$returnArr = array
						 (
						   'InforArr'=>$arraRecds,
						   'Success'=>1,
						   'errTxt'=>''
						 );
			return $returnArr;
			break;

			default:
			return 1;


		}


	}//operation will be ended here.

	


}



//$objApi     = new getMethods()  ;
//$arraRecds  = $objApi->appOpration('getroles',array());



//print_r($arraRecds);die;  

?>
