<?php 
  if( !defined('CMS_VERSION') ) exit;
  if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;
  //$query = new TimesheetQuery;
  //$timesheets = $query->GetMatches();
  //$tpl = $smarty->CreateTemplate($this->GetTemplateResource('defaultadmin.tpl'),null,null,$smarty);
  //$tpl->assign('timesheets',$timesheets);
  //$tpl->display();
	include(dirname(__FILE__).'/action.admin_settings.php');
?>
