<?php

	$program = new program;  // instantiating the object
	
	// class is the schematic
	class program {
	
		function __construct() {
			$page = 'homepage';
			$arg = NULL;
			if(isset($_REQUEST['page'])) {
				$page = $_REQUEST['page'];
			} 
			if(isset($_REQUEST['arg'])) {
				$arg = $_REQUEST['arg'];
			}
			
			$page = new $page($arg);
		}
		
		function __destruct() {
			
			
		}

	}
	
	// This is an abstract class.  Cannot be instantiated.
	abstract class page {
		
		public $menu;
		public $content;
		
		function homepage() {
			$menu = '<a href="./colleges.php">Homepage</a>';
			
			return $menu;
		}
		
		function menu() {
			echo '<div>
					<h1>College Data</h1>
				 </div>';
			$menu = '<div>
						<ul>
							<li><a href="./colleges.php">Homepage</a></li>';  // links to the homepage
							
			$menu .= '		<li><a href="./colleges.php?page=question1">Question 1: Highest Enrollment</a></li>'; // links to the login page
							
			$menu .= ' 		<li><a href="./colleges.php?page=question2">Question 2: Highest Liability</a></li>'; // links to the register page
							
			$menu .= '		<li><a href="./colleges.php?page=question3">Question 3: Highest Assets</a></li>'; // links to the forgot password page
			$menu .= '		<li><a href="./colleges.php?page=question4">Question 4: Highest Revenue</a></li>'; // links to the table
			$menu .= '		<li><a href="./colleges.php?page=question5">Question 5: Highest Revenue per Student</a></li>';
			$menu .= '		<li><a href="./colleges.php?page=question6">Question 6: Highest Asset per Student</a></li>';
			$menu .= '		<li><a href="./colleges.php?page=question7">Question 7: Highest Liability per Student</a></li>';
			$menu .= '		<li><a href="./colleges.php?page=question8">Question 8: Top 5 Colleges</a></li>';
			$menu .= '		<li><a href="./colleges.php?page=question9">Question 9: Colleges by State</a></li>';
			$menu .= '		<li><a href="./colleges.php?page=question10">Question 10: Largest Increase in Liability</a></li>';
			$menu .= '		<li><a href="./colleges.php?page=question11">Question 11: Largest Increase in Enrollment</a></li>
						</ul>
					</div>'; 
			
			return $menu;
		}
		
		function __construct($arg = NULL) {
			if($_SERVER['REQUEST_METHOD'] == 'GET') { 
				$this->get();
			} else {
				$this->post();
			}
		}
		
		function get() {
						
			
			
		}
		
		function post() {
			
			
		} 
		
		function __destruct() {
			
			echo $this->content;
		}
	}
	
	class homepage extends page{
		function get() {
			
			$this->content .= $this->menu();
			
		}
	}
	
	class question1 extends page {
		function get() {
				
			$this->content .= $this->homepage();
			$this->content .= $this->question1();		
		}
		
		function question1() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, enrollment_merge.year FROM colleges JOIN enrollment_merge on colleges.id=enrollment_merge.id 
								   ORDER BY enrollment_merge.enroll_total DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that shows the colleges that have the highest enrollment.';
			echo '<br>';
			echo 'Total Enrollment: 2010';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Enrollment' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['enroll_total'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, enrollment_merge.year FROM colleges JOIN enrollment_merge on colleges.id=enrollment_merge.id 
								  WHERE enrollment_merge.year=merge ORDER BY enrollment_merge.enroll_total DESC LIMIT 10");
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Total Enrollment: 2011';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Enrollment' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['enroll_total'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}
	
	class question2 extends page {
		
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question2();
		}
		
		function question2() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, finance.total_liabilities, finance.year FROM colleges JOIN finance on colleges.id=finance.id 
								  WHERE finance.year=2010 ORDER BY finance.total_liabilities DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that that lists the colleges with the largest amount of total liabilities.';
			echo '<br>';
			echo 'Total Liability: 2010';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Liability' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_liabilities'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, finance.total_liabilities, finance.year FROM colleges JOIN finance on colleges.id=finance.id 
								  WHERE finance.year=2011 ORDER BY finance.total_liabilities DESC LIMIT 10");
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Total Liability: 2011';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Liability' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_liabilities'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}

	class question3 extends page {
		
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question3();
		}
		
		function question3() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, finance.total_assets, finance.year FROM colleges JOIN finance on colleges.id=finance.id 
								  WHERE finance.year=2010 ORDER BY finance.total_assets DESC LIMIT 18");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that lists the colleges with the largest amount of net assets.';
			echo '<br>';
			echo 'Total Assets: 2010';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Assets' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_assets'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, finance.total_assets, finance.year FROM colleges JOIN finance on colleges.id=finance.id 
								  WHERE finance.year=2011 ORDER BY finance.total_assets DESC LIMIT 18");
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Total Assets: 2011';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Assets' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_assets'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}		
	}
	
	class question4 extends page {
		
		function get() {
			//$session = new session();
			$this->content .= $this->homepage();
			$this->content .= $this->question4();
			
		}
		
		function question4() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, finance.total_revenues, finance.year FROM colleges JOIN finance on colleges.id=finance.id 
								  WHERE year=2010 ORDER BY total_revenues DESC LIMIT 18");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that lists the colleges with the largest amount of total revenues.';
			echo '<br>';
			echo 'Total Revenue: 2010';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Revenues' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_revenues'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, finance.total_revenues, finance.year FROM colleges JOIN finance on colleges.id=finance.id 
								  WHERE year=2011 ORDER BY total_revenues DESC LIMIT 18");
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Total Revenue: 2011';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Revenues' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_revenues'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}
	
	class question5 extends page {
		
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question5();
		}
		
		function question5() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_revenues, finance.year FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id 
									JOIN finance ON enrollment_merge.id=finance.id WHERE enrollment_merge.year=2010 and finance.year=2010 
									ORDER BY (finance.total_revenues/enrollment_merge.enroll_total ) DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that lists the colleges with the largest amount of total revenues per student.';
			echo '<br>';
			echo 'Total Revenue per Student: 2010';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Revenues' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_revenues'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_revenues, finance.year FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id 
									JOIN finance ON enrollment_merge.id=finance.id WHERE enrollment_merge.year=2011 and finance.year=2011 
									ORDER BY (finance.total_revenues/enrollment_merge.enroll_total) DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();

			echo 'Total Revenue per Student: 2011';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Revenues' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_revenues'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}
	
	class question6 extends page {
		
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question6();
		}
		
		function question6() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_assets, finance.year FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id 
									JOIN finance ON enrollment_merge.id=finance.id WHERE enrollment_merge.year=2010 and finance.year=2010 
									ORDER BY (finance.total_assets/enrollment_merge.enroll_total ) DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that lists the colleges with the largest amount of net assets per student.';
			echo '<br>';
			echo 'Total Assets per Student: 2010';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Assets' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_assets'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_assets, finance.year FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id 
									JOIN finance ON enrollment_merge.id=finance.id WHERE enrollment_merge.year=2011 and finance.year=2011 
									ORDER BY (finance.total_assets/enrollment_merge.enroll_total) DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Total Assets per Student: 2011';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Assets' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_assets'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
	}
	
	class question7 extends page {
	
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question7();
		}
		
		function question7() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_liabilities, finance.year FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id 
									JOIN finance ON enrollment_merge.id=finance.id WHERE enrollment_merge.year=2010 and finance.year=2010 
									ORDER BY (finance.total_liabilities/enrollment_merge.enroll_total ) DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that lists the colleges with the largest amount of total liabilities per student.';
			echo '<br>';
			echo 'Total Liabilities per Student: 2010';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Liabilities' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_liabilities'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_liabilities, finance.year FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id 
									JOIN finance ON enrollment_merge.id=finance.id WHERE enrollment_merge.year=2011 and finance.year=2011 
									ORDER BY (finance.total_liabilities/enrollment_merge.enroll_total) DESC LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Total Liabilities per Student: 2011';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Total Liabilties' . '</th>' . '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['total_liabilities'] . '</td>' . '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}
	
	class question8 extends page {
	
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question8();
		}
		
		function question8() {
			$choice = $_REQUEST['choice'];
			
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_liabilities, finance.total_assets, finance.total_revenues, finance.year 
									FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id JOIN finance ON colleges.id=finance.id 
									WHERE enrollment_merge.year=2010 and finance.year=2010 ORDER BY $choice DESC LIMIT 5");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a table that compares the top 5 colleges based on the statistics above. The columns should be the 5 colleges and the rows should be the statistics.';
			echo '<br>';
			echo '2010:';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'College' . '</th>' . 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=enrollment_merge.enroll_total>Total Enrollment</a>' . '</th>'. 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=finance.total_assets>Total Assets</a>' . '</th>' . 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=finance.total_revenues>Total Revenues</a>' . '</th>' . 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=finance.total_liabilities>Total Liabilities</a>' .
				 '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['name'] . '</td>' . 
					 '<td>' . $row['enroll_total'] . '</td>' . 
					 '<td>' . $row['total_assets'] . '</td>' . 
					 '<td>' . $row['total_revenues'] . '</td>' . 
					 '<td>' . $row['total_liabilities'] . '</td>' .
					 '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
			
			$results = $DBH->query("SELECT colleges.*, enrollment_merge.enroll_total, finance.total_liabilities, finance.total_assets, finance.total_revenues, finance.year 
									FROM colleges JOIN enrollment_merge ON colleges.id=enrollment_merge.id JOIN finance ON colleges.id=finance.id 
									WHERE enrollment_merge.year=2011 and finance.year=2011 ORDER BY $choice DESC LIMIT 5");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo '2011:';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'College' . '</th>' . 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=enrollment_merge.enroll_total>Total Enrollment</a>' . '</th>'. 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=finance.total_assets>Total Assets</a>' . '</th>' . 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=finance.total_revenues>Total Revenues</a>' . '</th>' . 
				 '<th>' . '<a href=./colleges.php?page=question8&choice=finance.total_liabilities>Total Liabilities</a>' .
				 '<th>' . 'Year' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['name'] . '</td>' . 
					 '<td>' . $row['enroll_total'] . '</td>' . 
					 '<td>' . $row['total_assets'] . '</td>' . 
					 '<td>' . $row['total_revenues'] . '</td>' . 
					 '<td>' . $row['total_liabilities'] . '</td>' .
					 '<td>' . $row['year'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}

	class question9 extends page {
	
		function question9() {
			echo $this->menu();
			echo 'Select State:';
			echo '<br>';
			echo '<form method="post" action="./colleges.php?page=question9">
					    <select name="state">
					    	<option value=""></option> 
					        <option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="DC">District Of Columbia</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>			          
					    </select>
					    <INPUT TYPE="submit" name="submit" /><br><br>
					   </form>';
			$choice = $_POST["state"];
			
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT * FROM colleges WHERE state='$choice' ORDER BY name");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that allows you to enter in a state abbreviation in a form field and then retrieve the colleges that are in that state.';
			echo '<br>';
			echo '<table border=1>';
			echo 'Table by State';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . 
				 '<th>' . 'College' . '</th>' . 
				 '<th>' . 'State' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . 
				 	 '<td>' . $row['name'] . '</td>' . 
				 	 '<td>' . $row['state'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}

	class question10 extends page {
	
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question7();
		}
		
		function question10() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, (
									((finance_2011.total_liabilities/finance_2010.total_liabilities)-1)*100
									) AS diff
									FROM colleges
									JOIN finance_2010 ON colleges.id = finance_2010.id
									JOIN finance_2011 ON finance_2010.id = finance_2011.id
									ORDER BY diff DESC 
									LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that shows the colleges with the largest percentage increase in total liabilities between 2011 and 2010.';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>' . '<th>' . 'Percentage Increase' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['diff'] . '%' . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
		}
	}

	class question11 extends page {
	
		function get() {
			$this->content .= $this->homepage();
			$this->content .= $this->question7();
		}
		
		function question11() {
			echo $this->menu();
			echo '<br>';
			try { 
				# MySQL with PDO_MYSQL
				$DBH = new PDO('mysql:host=sql.njit.edu;dbname=kl99', 'kl99', 'yemKM0MpN');
				} catch (PDOException $e) {
					echo $e->getMessage();
			}
		
			$results = $DBH->query("SELECT colleges.*, (
									((enrollment_2011.enroll_total/enrollment_2010.enroll_total)-1)*100
									) AS diff
									FROM colleges
									JOIN enrollment_2010 ON colleges.id = enrollment_2010.id
									JOIN enrollment_2011 ON enrollment_2010.id = enrollment_2011.id
									ORDER BY diff DESC 
									LIMIT 10");
								  
			//$sth->execute();

			//$results = $sth->fetchAll();
			
			echo 'Create a web page that shows the colleges with the largest percentage increase in enrollment between the years of 2011 and 2010.';
			echo '<br>';
			echo '<table border=1>';
			echo '<th>' . 'ID' . '</td>' . '<th>' . 'College' . '</th>' . '<th>' . 'State' . '</th>'. '<th>' . 'Percentage Increase' . '</th>';
			foreach($results as $row) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>' . '<td>' . $row['name'] . '</td>' . '<td>' . $row['state'] . '</td>' . '<td>' . $row['diff'] . '%' . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
		}
	}
	
?>
