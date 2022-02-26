<?php 

if( !defined('CMS_VERSION') ) exit;
$this->CreatePermission(Timesheets::MANAGE_PERM,'Manage Timesheets');
$db = $this->GetDb();
$dict = NewDataDictionary($db);
//$taboptarray = array('mysql' => 'TYPE=MyISAM');
$taboptarray = array('mysql' => 'ENGINE=InnoDB'); //better for big tables?

	#Table schema descriptions
$table_definitions = array(
	'payruns' => "
		id I PRIMARY,
		from_date D,
		to_date D,
		locked I1 NOTNULL DEFAULT 0,
		locked_time I,
		locked_by C(5)
	",
	'sheets' => "
		id I PRIMARY,
		payrun_id I NOTNULL DEFAULT 0,
		employee_payroll_id I NOTNULL,
		employee_mams_gid I NOTNULL,
		employee_mams_initials C(5) NOTNULL,
		employee_submit_time I DEFAULT NULL,
		employee_comments X,
		approve_by C(5) DEFAULT NULL,
		approve_time I DEFAULT NULL,
		approve_comments X,
		locked I1 DEFAULT 0
	",
	'items' => "
		id I KEY AUTO NOTNULL,
		sheets_id I NOTNULL DEFAULT 0,
		date D, 
		amount F(4,2),
		type I
	",
	'typedefs' => "
		id I KEY AUTO NOTNULL,
		name C(255),
		payroll_software_id I,
		item_order I,
    public I
	"	
);
try
{
	foreach($table_definitions as $name => $definition) 
	{
		$table_name = CMS_DB_PREFIX . "mod_timesheets_"	. $name;
		
		#Create the table
		$c = $dict->CreateTableSQL(
																$table_name, 
																$definition, 
																$table_options
															);
															
		$return = $dict->ExecuteSQLArray($c);
				
		if($return < 2)
    {
			throw new Exception('Error ' . $c[0] . ' creating table ' . $tablename . '! ' . $db->ErrorMsg() );
    }
		if($name != 'items' && $name != 'typedefs')
		{
			#Create a sequence, not for items and typefefs though
			$return = $db->CreateSequence(CMS_DB_PREFIX . 'mod_timesheets_' . $name . '_seq');
			
			if(!$return)
			{
				throw new Exception('Error creating Sequence mod_timesheets_' . $name . '_seq! ' . $db->ErrorMsg() );
			}		
		}

	}
	
	$this->Audit(
							0, 
							$this->Lang('friendlyname'), 
							$this->Lang(
														'installed', 
														$this->GetVersion()
													)
						);
}
catch (Exception $e)
{
	return $e->getMessage();
}
?>
