<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;
if( isset($params['hid']) && $params['hid'] > 1) 
{
  $timesheet = TimesheetDay::load_by_id((int)$params['hid']);
  $timesheet->delete();
  $this->SetMessage($this->Lang('timesheet_deleted'));
  $this->RedirectToAdminTab();
}
?>
