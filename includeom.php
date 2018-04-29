<?php


class MySqlData
{
   var $host = 'myiyfnoidacom.ipagemysql.com';
   var $username = 'api';
   var $password = 'api!@#Api';
   var $dbName = 'laravel';

	//connection function
	function   getConnection()
		{
			// echo $this->host,$this->username,$this->password;
           
            return mysqli_connect( $this->host,$this->username,$this->password,$this->dbName);

			 if(mysqli_error())
				 echo mysqli_error();


		}

		//selection of the DB.
		function selectDb()
		{

			//echo $this->dbName;
			 $recAs = $this->getConnection();
			 @mysqli_select_db($this->dbName) ;

			 if(mysqli_error($recAs))
				 echo mysqli_error($recAs);


				return  $recAs;

			//return 1;
		
		}


		function getRecords($sql)
		{
             
			//$this->getConnection();
			$objCon = $this->selectDb();
			//echo $sql;
		    $recHandle = @mysqli_query($objCon,$sql);
		//	echo 'ggghgg12';echo mysqli_error($objCon);
			 if(mysqli_error($objCon))
				 echo mysqli_error($objCon);

			$recordArray  = array();

  			while($custRow= mysqli_fetch_assoc($recHandle))
			{

				$recordArray[] = $custRow ;
				
			}

			return($recordArray);
		}


function insertUpdtRecords($opTyp,$queryString)
	{


	$objCon = $this->selectDb();
	if($opTyp=='insert')
	  {
			//echo $queryString;die;
			$exCustquery = @mysqli_query($objCon,$queryString);
		
			if(mysqli_error($objCon)){
				echo mysqli_error($objCon);die;
				
				}

			return  mysqli_insert_id($objCon) ;

	  }else{
	  
				$exCustquery = @mysqli_query($objCon,$queryString);
				if(mysqli_error($objCon)){
				echo mysqli_error($objCon);die;

				}
	  
		   return 'success';
	  
		}

	}


}



?>