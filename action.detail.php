<?php
  if( !defined('CMS_VERSION') ) exit;
  if( !isset($params['hid']) ) return;
  $timesheet = TimesheetDay::load_by_id( (int) $params['hid'] );
  $tpl = $smarty->CreateTemplate($this->GetTemplateResource('detail.tpl'),null,null,$smarty);
  $tpl->assign('timesheet',$timesheet );
  $tpl->display();
?>
