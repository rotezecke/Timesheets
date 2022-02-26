<?php
  if( !defined('CMS_VERSION') ) exit;
  if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;
  $timesheet = new TimesheetDay();
  if( isset($params['hid']) && $params['hid'] > 1) 
  {
    $timesheet = TimesheetDay::load_by_id((int)$params['hid']);
  }
  if( isset($params['cancel']) ) 
  {
    $this->RedirectToAdminTab();
  }
  else if( isset($params['submit']) ) 
  {
    $timesheet->name = trim($params['name']);
    $timesheet->published = cms_to_bool($params['published']);
    $timesheet->the_date = strtotime($params['the_date']);
    $timesheet->description = $params['description'];
    $timesheet->save();
    $this->SetMessage($this->Lang('timesheet_saved'));
    $this->RedirectToAdminTab();
  }
  $tpl = $smarty->CreateTemplate($this->GetTemplateResource('edit_timesheet.tpl'),null,null,$smarty);
  $tpl->assign('timesheet',$timesheet);
  $tpl->display();
?>
