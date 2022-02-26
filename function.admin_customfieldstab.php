<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(Timesheets::MANAGE_PERM) ) return;

$entryarray = array();
$max = $db->GetOne("SELECT max(item_order) as max_item_order FROM ".CMS_DB_PREFIX."mod_timesheets_typedefs");

$query = "SELECT * FROM ".CMS_DB_PREFIX."mod_timesheets_typedefs ORDER BY item_order";
$dbresult = $db->Execute($query);
$admintheme = cms_utils::get_theme_object();
$rowclass = 'row1';

while ($dbresult && $row = $dbresult->FetchRow()) {
    $onerow = new stdClass();

    $onerow->id = $row['id'];
    $onerow->name = $this->CreateLink($id, 'admin_editfielddef', $returnid, htmlspecialchars($row['name']), array('fdid'=>$row['id']));
    $onerow->payroll_software_id = $row['payroll_software_id'];
    $onerow->item_order = $row['item_order'];

    if ($onerow->item_order > 1) {
        $onerow->uplink = $this->CreateLink($id, 'admin_movefielddef', $returnid, $admintheme->DisplayImage('icons/system/arrow-u.gif', $this->Lang('up'),'','','systemicon'), array('fdid'=>$row['id'], 'dir'=>'up'));
    }
    else {
        $onerow->uplink = '';
    }
    if ($max > $onerow->item_order) {
        $onerow->downlink = $this->CreateLink($id, 'admin_movefielddef', $returnid, $admintheme->DisplayImage('icons/system/arrow-d.gif', $this->Lang('down'),'','','systemicon'), array('fdid'=>$row['id'], 'dir'=>'down'));
    }
    else {
        $onerow->downlink = '';
    }

    $onerow->editlink = $this->CreateLink($id, 'admin_editfielddef', $returnid, $admintheme->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('fdid'=>$row['id']));

    $onerow->delete_url = $this->create_url($id, 'admin_deletefielddef', $returnid, array('fdid'=>$row['id']));

    $entryarray[] = $onerow;
    ($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
}

$smarty->assign('items', $entryarray);
$smarty->assign('itemcount', count($entryarray));

$smarty->assign('addurl', $this->create_url($id,'admin_addfielddef'));
$smarty->assign('addlink', $this->CreateLink($id, 'admin_addfielddef', $returnid, $admintheme->DisplayImage('icons/system/newfolder.gif', $this->Lang('addfielddef'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'admin_addfielddef', $returnid, $this->Lang('addfielddef'), array(), '', false, false, 'class="pageoptions"'));

$smarty->assign('fielddeftext', $this->Lang('fielddef'));
$smarty->assign('payroll_software_idtext', $this->Lang('payroll_software_id'));
#Display template
echo $this->ProcessTemplate('customfieldstab.tpl');

// EOF
?>
