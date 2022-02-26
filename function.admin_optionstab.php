<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;

  // CreateFormStart sets up a proper form tag that will cause the submit to
  // return control to this module for processing.
$smarty->assign('startform', $this->CreateFormStart ($id, 'updateoptions', $returnid));
$smarty->assign('endform', $this->CreateFormEnd ());


/*
$smarty->assign('title_allowed_upload_types',$this->Lang('allowed_upload_types'));
$smarty->assign('allowed_upload_types',$this->GetPreference('allowed_upload_types'));



$smarty->assign('title_fesubmit_status',$this->Lang('fesubmit_status'));
$statusdropdown = array();
$statusdropdown[$this->Lang('disabled')] = 'disabled';
$statusdropdown[$this->Lang('enabled')] = 'enabled';
$smarty->assign('statuses',array_flip($statusdropdown));
$smarty->assign('fesubmit_status',$this->GetPreference('fesubmit_status'));
$smarty->assign('input_fesubmit_status',
		$this->CreateInputDropdown($id,'fesubmit_status',$statusdropdown,-1,$this->GetPreference('fesubmit_status','enabled')));
*/

// Display the populated template
echo $this->ProcessTemplate ('adminprefs.tpl');

?>