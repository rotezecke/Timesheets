<?php

if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;

$fdid = '';
if (isset($params['fdid']))	$fdid = $params['fdid'];

// Get the category details
$query = 'SELECT * FROM '.CMS_DB_PREFIX.'mod_timesheets_typedefs WHERE id = ?';
$row = $db->GetRow($query, array($fdid));

//Now remove the category
$query = "DELETE FROM ".CMS_DB_PREFIX."mod_timesheets_typedefs WHERE id = ?";
$db->Execute($query, array($fdid));

//And remove it from any entries
//$query = "DELETE FROM ".CMS_DB_PREFIX."module_news_fieldvals WHERE fielddef_id = ?";
//$db->Execute($query, array($fdid));

$db->Execute('UPDATE '.CMS_DB_PREFIX.'mod_timesheets_typedefs SET item_order = (item_order - 1) WHERE item_order > ?', array($row['item_order']));

$params = array('tab_message'=> 'fielddefdeleted', 'active_tab' => 'customfields'); //Why?
// put mention into the admin log
audit('', 'Timesheets: '.$row['name'], $this->Lang('fielddefdeleted'));

$this->Setmessage($this->Lang('fielddefdeleted'));
$this->RedirectToAdminTab('customfields','','admin_settings');
