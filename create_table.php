<?php 

	ini_set("display_errors","1");
	ini_set("memory_limit", "-1");
	error_reporting(E_ALL);
	

		//*************Connection to MySQL********************
					
		//print "Connected to MySQL <br>";
	
	//$filename = 'colleges.csv';
	//$filename = 'enrollment2010.csv';
	//$filename = 'enrollment2011.csv';
	//$filename = 'finance2010.csv';
 	$filename = 'finance2011.csv';
	//$file = new file();
	//$file->read_csv($filename);
	
	class file {
	
		public function read_csv($filename) {
			$first_run=TRUE;
			if (($handle = fopen($filename, "r")) !== FALSE) {
				while(($data = fgetcsv($handle, 0, ",")) !== FALSE) {
					if($first_run == TRUE) {
						$field_name = $this->create_field_names($data);
						//$records[] = $this->create_record($data, $field_name);
						$first_run = FALSE;
					} else {
						$records[] = $this->create_record($data, $field_name);
					}
				}
				fclose($handle);
				//create_tables::create_colleges($records);
				//create_tables::create_enrollments($records);
				//create_tables::create_enrollments_merge($records);
				create_tables::create_finance($records);
			}
		}
	
		public function create_field_names($data) {
			return $data;
		}
	
		public function create_record($data, $field_names) {
			$data = array_combine($field_names, $data);
			return $data;
		}
		
		
	
	}
	
	class create_tables {
	
		public static function create_colleges($data) {
			$hostname  =  "sql.njit.edu";
			$username  =  "kl99";
			$password  =  "yemKM0MpN";
			$project   =  "kl99";
			( $dbh = mysql_connect ( $hostname, $username, $password ) )
			        or    die ( "Unable to connect to MySQL database" );
		
			mysql_select_db( $project )  or die ("Incorrect database name"); 
			
			foreach($data as $key => $row) {
				foreach($row as $key2 => $row2) {
					
					if($key2=='UNITID'){
						$id = $row2;
						echo $id;
						echo ' ';
					}
					if($key2=='INSTNM') {
						$name = $row2;
						echo $name;
						echo ' ';
					}
					if($key2=='STABBR') {
						$state = $row2;
						echo $state;
						echo '<br>';
					}					
				}
				//$dbh->exec("INSERT INTO colleges(id, name, state) VALUES('$id', '$name', '$state')");
				$insert_colleges = mysql_query("INSERT INTO colleges(id, name, state) VALUES('$id', '$name', '$state')");
			}
			
		}
		
		public static function create_enrollments($data) {
				
			$hostname  =  "sql.njit.edu";
			$username  =  "kl99";
			$password  =  "yemKM0MpN";
			$project   =  "kl99";
			( $dbh = mysql_connect ( $hostname, $username, $password ) )
			        or    die ( "Unable to connect to MySQL database" );
		
			mysql_select_db( $project )  or die ("Incorrect database name");
				
			//$year=2010;
			$year=2011;
			foreach($data as $key => $row) {
				foreach($row as $key2 => $row2) {
					
					if($key2=='UNITID'){
						$id = $row2;
						echo $id;
						echo ' ';
					}
					if($key2=='EFFYLEV') {
						$enroll_level = $row2;
						echo $enroll_level;
						echo ' ';
					}
					if($key2=='EFYTOTLT') {
						$enroll_num = $row2;
						echo $enroll_num;
						echo ' ';
						echo '<br>';
					}			
				}
				$enroll_total;
				//mysql_query("INSERT INTO enrollment(id, enroll_level, enroll_num, year) VALUES('$id', '$enroll_level', '$enroll_num', '$year')");
				mysql_query("INSERT INTO enrollment_merge(id, enroll_num, year) VALUES('$id', '$enroll_total', '$year')");
			}
		}

		public static function create_enrollments_merge($data) {
				
			$hostname  =  "sql.njit.edu";
			$username  =  "kl99";
			$password  =  "yemKM0MpN";
			$project   =  "kl99";
			( $dbh = mysql_connect ( $hostname, $username, $password ) )
			        or    die ( "Unable to connect to MySQL database" );
		
			mysql_select_db( $project )  or die ("Incorrect database name");
				
			//$year=2010;
			$year=2011;
			$id = $data[0]['UNITID'];
			$last_element = key(array_slice($data,-1,1,true));
			$enroll_total = 0;
			$i=0;
			
			for($i; $i<$last_element; $i++) {
				$enroll_num = $data[$i]['EFYTOTLT'];
				
				if($id!=$data[$i]['UNITID']) {
					//mysql_query("INSERT INTO enrollment_merge(id, enroll_total, year) VALUES('$id', '$enroll_total', '$year')");
					mysql_query("INSERT INTO enrollment_2011(id, enroll_total) VALUES('$id', '$enroll_total')");
					echo 'Total: ' . $enroll_total;
					echo '<br><br>';
					$id = $data[$i]['UNITID'];
					$enroll_total = 0;
				} 
				if($id==$data[$i]['UNITID']) {
					echo 'Current ID: ' . $id;
					echo '<br>';
					echo 'Current Enroll: ' . $enroll_num;
					echo '<br>';
					$enroll_total += $enroll_num;
					continue;
				}
			}
			$id = $data[$i]['UNITID'];
			$enroll_num = $data[$i]['EFYTOTLT'];
			echo 'Current ID: ' . $id;
			echo '<br>';
			echo 'Current Enroll: ' . $enroll_num;
			echo '<br>';
			$enroll_total += $enroll_num;
			echo 'Total: ' . $enroll_total;
			echo '<br><br>';
			//mysql_query("INSERT INTO enrollment_merge(id, enroll_total, year) VALUES('$id', '$enroll_total', '$year')");
			mysql_query("INSERT INTO enrollment_2011(id, enroll_total) VALUES('$id', '$enroll_total')");
		}
		
		public static function create_finance($data) {
		
			$hostname  =  "sql.njit.edu";
			$username  =  "kl99";
			$password  =  "yemKM0MpN";
			$project   =  "kl99";
			( $dbh = mysql_connect ( $hostname, $username, $password ) )
			        or    die ( "Unable to connect to MySQL database" );
		
			mysql_select_db( $project )  or die ("Incorrect database name");
		
			//$year=2010;
			$year=2011;
			foreach($data as $key => $row) {
				foreach($row as $key2 => $row2) {
						
					if($key2=='UNITID'){
						$id = $row2;
						echo $id;
						echo ' ';
					}
					if($key2=='F1A06') {
						$total_assets = $row2;
						echo $total_assets;
						echo ' ';
					}
					if($key2=='F1A13') {
						$total_liabilities = $row2;
						echo $total_liabilities;
						echo ' ';
					}
					if($key2=='F1D01') {
						$total_revenues = $row2;
						echo $total_revenues;
						echo ' ';
						echo '<br>';
					}
				}
				//mysql_query("INSERT INTO finance(id, total_assets, total_revenues, total_liabilities, year) VALUES('$id', '$total_assets', '$total_revenues', '$total_liabilities', '$year')");
				mysql_query("INSERT INTO finance_2011(id, total_assets, total_revenues, total_liabilities) VALUES('$id', '$total_assets', '$total_revenues', '$total_liabilities')");
			}
		
		}
	}
		
?>