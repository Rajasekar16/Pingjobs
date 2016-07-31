<?php
class Dashboard_model extends CI_Model
{
    /**
     * Get all users whose activated status is 1.
     * @return array
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_dashboard()
    {   
		$sql = 'SELECT 
				(SELECT COUNT(*) FROM employee) AS employeecount,
				(SELECT COUNT(*) FROM employer) AS employercount,
				(SELECT COUNT(*) FROM job) AS jobcount
				FROM dual';
        $query=$this->db->query($sql);
        $result=$query->row_array();
        return $result;
    }
	
    public function get_dashboard_by_date($data)
    {
		$start_date = date('Y-m-d H:m:s', strtotime('-130 days'));
		
		switch($data['type'])
		{
			case "date":
				$sql ='SELECT  date(created_date) AS y, count(*) AS a FROM employee WHERE created_date>= "'.$start_date.'"  GROUP BY  date(created_date)  ';
			break;
			case "location":
				$sql ='SELECT  date(created_date) AS y, count(*) AS a FROM employee WHERE created_date>= "'.$start_date.'"  and LOWER(employee_city)="'.strtolower($data['location_name']).'" GROUP BY  date(created_date), LOWER(employee_city) ';
			break;
			case "location_combain":
				//$sql ='SELECT  date(created_date) AS y, count(*) AS a FROM employee WHERE created_date>= "'.$start_date.'"  and LOWER(employee_city)="'.strtolower($data['location_name']).'" GROUP BY  date(created_date), LOWER(employee_city) ';
				$sql ='SELECT  y, sum(driver.a) AS  a,sum(driver.b)  AS b,sum(driver.c) AS c  FROM
				( 
				(SELECT date(created_date) AS y, count(*) AS a ,0 AS b,0 AS c FROM employee WHERE created_date>= "'.$start_date.'" and LOWER(employee_city)="bangalore" GROUP BY date(created_date))
				UNION 
				(SELECT date(created_date) AS y, 0 AS a, count(*) AS b,0 AS c FROM employee WHERE created_date>= "'.$start_date.'" and LOWER(employee_city)="chennai" GROUP BY date(created_date))
				UNION
				(SELECT date(created_date) AS y, 0 AS a,0 AS b,count(*) AS b FROM employee WHERE created_date>= "'.$start_date.'" and LOWER(employee_city)="hyderabad" GROUP BY date(created_date))
				) AS driver  GROUP BY y';
			break;
			case "skill_combain":
				//$sql ='SELECT  date(created_date) AS y, count(*) AS a FROM employee WHERE created_date>= "'.$start_date.'"  and LOWER(employee_city)="'.strtolower($data['location_name']).'" GROUP BY  date(created_date), LOWER(employee_city) ';
				$sql =' SELECT  y, sum(driver.a) AS  a,sum(driver.b)  AS b,sum(driver.c) AS c,sum(driver.d) AS d  FROM
				( 
				(SELECT date(created_date) AS y, count(*) AS a ,0 AS b,0 AS c ,0 AS d FROM employee WHERE created_date>= "'.$start_date.'" and employee_skills like"%testing%" GROUP BY date(created_date))
				UNION 
				(SELECT date(created_date) AS y, 0 AS a, count(*) AS b,0 AS c,0 AS d FROM employee WHERE created_date>= "'.$start_date.'" and  employee_skills like"%java%" GROUP BY date(created_date))
				UNION
				(SELECT date(created_date) AS y, 0 AS a,0 AS b,count(*) AS b,0 AS d FROM employee WHERE created_date>= "'.$start_date.'" and  employee_skills like"%net%" GROUP BY date(created_date))
				UNION
				(SELECT date(created_date) AS y, 0 AS a,0 AS b,0 AS b,count(*) AS d FROM employee WHERE created_date>= "'.$start_date.'" and  employee_skills like"%php%" GROUP BY date(created_date))
				) AS driver  GROUP BY y';
			break;
			case "exprience":
				$sql ='SELECT  CONCAT(employee_exp_year, " Year of Experience")  AS label,count(*) AS value FROM employee  GROUP BY employee_exp_year';
			break;
		}

        $query=$this->db->query($sql);
        $result=$query->result_array();
		/*if($data['type'] =='location')
		{
			echo $this->db->last_query(); die();
		}
		print_r($result);die();
		$result=$query->result_array();*/
        return $result;
    }
}
?>