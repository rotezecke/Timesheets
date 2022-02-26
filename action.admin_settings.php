<?php

if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;

echo $this->StartTabHeaders();

echo $this->SetTabHeader('customfields',$this->Lang('customfields'));
echo $this->SetTabHeader('options',$this->Lang('options'));
echo $this->EndTabHeaders();

echo $this->StartTabContent();

echo $this->StartTab('customfields', $params);
include(dirname(__FILE__).'/function.admin_customfieldstab.php');
echo $this->EndTab();

echo $this->StartTab('options', $params);
include(dirname(__FILE__).'/function.admin_optionstab.php');
echo $this->EndTab();

echo $this->EndTabContent();

?>
