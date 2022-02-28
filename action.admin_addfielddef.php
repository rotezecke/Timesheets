<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;

if (isset($params['cancel'])) $this->RedirectToAdminTab('customfields','','admin_settings');

$name = '';
if (isset($params['name'])) $name = trim($params['name']);

$payroll_software_id = '';
if (isset($params['payroll_software_id'])) $payroll_software_id = (int)$params['payroll_software_id'];

$public = 1;
if( isset($params['public']) ) $public = (int)$params['public'];

$userid = get_userid();


if (isset($params['submit'])) {
    $error = false;
    if ($name == '') $error = $this->Lang('nonamegiven');

    if( !$error ) {
        $query = 'SELECT id FROM '.CMS_DB_PREFIX.'mod_timesheets_typedefs WHERE name = ?';
        $exists = $db->GetOne($query,array($name));
        if( $exists ) $error = $this->Lang('nameexists');
    }
		if( !$error ) {
			$query = 'SELECT id FROM '.CMS_DB_PREFIX.'mod_timesheets_typedefs WHERE payroll_software_id = ?';
			$exists = $db->GetOne($query,array($payroll_software_id));
			if( $exists ) $error = $this->Lang('payroll_idexists');
		}
    if( !$error ) {
        $max = $db->GetOne('SELECT max(item_order) + 1 FROM ' . CMS_DB_PREFIX . 'mod_timesheets_typedefs');
        if( $max == null ) $max = 1;

        $query = 'INSERT INTO '.CMS_DB_PREFIX.'mod_timesheets_typedefs (name, payroll_software_id, item_order, public) VALUES (?,?,?,?)';
        $parms = array($name, $payroll_software_id, $max, $public);
        $res = $db->Execute($query, $parms );

				if( !$res )
				{
					audit('', 'Timesheets error: '.$name, $db->ErrorMsg());
				}
				else
				{
					audit('', 'Timesheets: '.$name, $this->Lang('fielddefadded'));
				}

        // done.
        $params = array('tab_message'=> 'fielddefadded', 'active_tab' => 'customfields');
        $this->SetMessage($this->Lang('fielddefadded'));
        $this->RedirectToAdminTab('customfields','','admin_settings');
    }

    if( $error ) echo $this->ShowErrors($error);
}

#Display template
$smarty->assign('title',$this->Lang('addfielddef'));
$smarty->assign('startform', $this->CreateFormStart($id, 'admin_addfielddef', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('nametext', $this->Lang('name'));
$smarty->assign('payroll_software_idtext', $this->Lang('payroll_software_id'));
$smarty->assign('info_payroll_software_id', $this->Lang('info_payroll_software_id'));
//$smarty->assign('showinputtype', true);

$smarty->assign('userviewtext',$this->Lang('public'));

$smarty->assign('name',$name);
$smarty->assign('payroll_software_id',$payroll_software_id);
$smarty->assign('public',$public);


$smarty->assign('mod',$this);
echo $this->ProcessTemplate('editfielddef.tpl');

// EOF
