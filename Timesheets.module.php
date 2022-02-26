<?php

class Timesheets extends CMSModule
{
  const MANAGE_PERM = 'manage_timesheets';
  
  public  function GetName()
  {
    return 'Timesheets';
  }
  public function GetVersion() { return '0.1.2'; }
  public function GetFriendlyName() { return $this->Lang('friendlyname'); }   
  public function GetAdminDescription() { return $this->Lang('admindescription'); }   
  public function IsPluginModule() { return TRUE; }   
  public function HasAdmin() { return TRUE; }   
  public function VisibleToAdminUser() { return $this->CheckPermission(self::MANAGE_PERM); }
  public function GetAuthor() { return 'Mario Santini'; }   
  public function GetAuthorEmail() { return 'rotezecke@web.de'; }
  public function LazyLoadAdmin() { return TRUE; }
	public function LazyLoadFrontend() { return TRUE; }
  public function MinimumCMSVersion()
  {
    return "2.2.15";
  }
  public function UninstallPreMessage() 
	{ 
		return $this->Lang('ask_uninstall'); 
	}
	
  function InstallPostMessage()
	{ 
		return $this->Lang('postinstallmessage'); 
	}
	
  public function InitializeFrontend() 
  {
    $this->SetParameterType('hid',CLEAN_INT);
    $this->SetParameterType('pagelimit',CLEAN_INT);
    $this->SetParameterType('detailpage',CLEAN_STRING);    
  }
	
  public function InitializeAdmin() 
  {
		//not needed?
    $this->CreateParameter('hid',null,$this->Lang('param_hid'));
    $this->CreateParameter('pagelimit',1000,$this->Lang('param_pagelimit'));
    $this->CreateParameter('detailpage',null,$this->Lang('param_detailpage'));    
  }
	
  public function GetDependencies() 
  {
    return array(
                  'MAMS' => '1.0'
                );
  }
	public function IsAdminOnly() 
  {
    return false;
  }
	
	function GetAdminSection() 
  {
    //main || content || layout || usersgroups || extensions || siteadmin || viewsite || logout 
		return 'extensions';
  }
}


?>
