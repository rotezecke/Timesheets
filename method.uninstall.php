<?php
if( !defined('CMS_VERSION') ) exit;
$this->RemovePermission(Timesheets::MANAGE_PERM);

$db = $this->GetDb();
$dict = NewDataDictionary( $db );

$d = $dict->DropTableSQL(CMS_DB_PREFIX . "mod_timesheets_payruns");
$dict->ExecuteSQLArray($d);

$d = $dict->DropTableSQL(CMS_DB_PREFIX . "mod_timesheets_sheets");
$dict->ExecuteSQLArray($d);

$d = $dict->DropTableSQL(CMS_DB_PREFIX . "mod_timesheets_items");
$dict->ExecuteSQLArray($d);

$d = $dict->DropTableSQL(CMS_DB_PREFIX . "mod_timesheets_typedefs");
$dict->ExecuteSQLArray($d);

#Remove the sequence
$db->DropSequence(CMS_DB_PREFIX . "mod_timesheets_payruns_seq" );

$db->DropSequence(CMS_DB_PREFIX . "mod_timesheets_sheets_seq" );

// Remove all preferences for this module
$this->RemovePreference();

// And all Templates
$this->DeleteTemplate();

// remove templates
// and template types.
try {
  $types = CmsLayoutTemplateType::load_all_by_originator($this->Lang('friendlyname'));
  if( is_array($types) && count($types) ) 
	{
    foreach( $types as $type ) 
		{
      $templates = $type->get_template_list();
      if( is_array($templates) && count($templates) ) 
			{
				foreach( $templates as $template ) 
				{
					$template->delete();
				}
      }
      $type->delete();
    }
  }
	$this->Audit('', $this->Lang('friendlyname'), $this->Lang('uninstalled'));
}
catch( Exception $e ) 
{
  // log it
  audit('',$this->Lang('friendlyname'),'Uninstall Error: '.$e->GetMessage());
}

?>
