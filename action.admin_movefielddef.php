<?php

if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;

$order = 1;
$fdid = $params['fdid'];

#Grab necessary info for fixing the item_order
$order = $db->GetOne("SELECT item_order FROM ".CMS_DB_PREFIX."mod_timesheets_typedefs WHERE id = ?", array($fdid));
$time = $db->DBTimeStamp(time());

if ($params['dir'] == "down")
  {
    $query = 'UPDATE '.CMS_DB_PREFIX.'mod_timesheets_typedefs SET item_order = (item_order - 1) WHERE item_order = ?';
    $db->Execute($query, array($order + 1));

    $query = 'UPDATE '.CMS_DB_PREFIX.'mod_timesheets_typedefs SET item_order = (item_order + 1) WHERE id = ?';
    $db->Execute($query, array($fdid));

  }
else if ($params['dir'] == "up")
  {
    $query = 'UPDATE '.CMS_DB_PREFIX.'mod_timesheets_typedefs SET item_order = (item_order + 1) WHERE item_order = ?';
    $db->Execute($query, array($order - 1));
    $query = 'UPDATE '.CMS_DB_PREFIX.'mod_timesheets_typedefs SET item_order = (item_order - 1) WHERE id = ?';
    $db->Execute($query, array($fdid));
  }

$this->RedirectToAdminTab('customfields','','admin_settings');
?>
