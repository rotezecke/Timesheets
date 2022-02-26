<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;

if (isset($params['cancel'])) $this->RedirectToAdminTab('customfields','','admin_settings');

$fdid = '';
if (isset($params['fdid'])) $fdid = $params['fdid'];

$name = '';
if (isset($params['name'])) $name = trim($params['name']);

$payroll_software_id = '';
if (isset($params['payroll_software_id'])) $payroll_software_id = $params['payroll_software_id'];

$origname = '';
if (isset($params['origname'])) $origname = $params['origname'];

$public = 0;
if( isset($params['public']) ) $public = (int)$params['public'];

if (isset($params['submit'])) {
  // @todo: sanitizing input
  $error = '';
  if ($name == '') $error = $this->Lang('nonamegiven');

  if( !$error ) {
    $query = 'SELECT id FROM '.CMS_DB_PREFIX.'mod_timesheets_typedefs WHERE name = ? AND id != ?';
    $tmp = $db->GetOne($query,array($name,$fdid));
    if( $tmp ) $error = $this->Lang('nameexists');
  }
  if( !$error ) {
    $query = 'SELECT id FROM '.CMS_DB_PREFIX.'mod_timesheets_typedefs WHERE payroll_software_id = ? AND id != ?';
    $tmp = $db->GetOne($query,array($payroll_software_id,$fdid));
    if( $tmp ) $error = $this->Lang('payroll_idexists');
  }	

  if( !$error ) {

    $query = 'UPDATE '.CMS_DB_PREFIX.'mod_timesheets_typedefs SET name = ?, payroll_software_id = ?, public = ? WHERE id = ?';
    $res = $db->Execute($query, array($name, $payroll_software_id, $public, $fdid));

    if( !$res ) die( $db->ErrorMsg() );
    // put mention into the admin log
    audit('', 'Timesheets: '.$name, $this->Lang('fielddefupdated'));
    $this->SetMessage($this->Lang('fielddefupdated'));
    $this->RedirectToAdminTab('customfields','','admin_settings');
  }
	if( $error ) echo $this->ShowErrors($error);
}
else {
   $query = 'SELECT * FROM '.CMS_DB_PREFIX.'mod_timesheets_typedefs WHERE id = ?';
   $row = $db->GetRow($query, array($fdid));

   if ($row) {
     $name = $row['name'];
     $payroll_software_id = $row['payroll_software_id'];
     $origname = $row['name'];
     $public = $row['public'];

   }
}

#Display template
$smarty->assign('title',$this->Lang('editfielddef'));
$smarty->assign('startform', $this->CreateFormStart($id, 'admin_editfielddef', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('nametext', $this->Lang('name'));
$smarty->assign('payroll_software_idtext', $this->Lang('payroll_software_id'));
$smarty->assign('info_payroll_software_id', $this->Lang('info_payroll_software_id'));
$smarty->assign('userviewtext',$this->Lang('public'));

$smarty->assign('name',$name);
$smarty->assign('payroll_software_id',$payroll_software_id);
$smarty->assign('public',$public);

$smarty->assign('mod',$this);
$smarty->assign('hidden',
		$this->CreateInputHidden($id, 'fdid', $fdid).
		$this->CreateInputHidden($id, 'origname', htmlspecialchars($origname)));
echo $this->ProcessTemplate('editfielddef.tpl');

// EOF