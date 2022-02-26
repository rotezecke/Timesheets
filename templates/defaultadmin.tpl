
<script type="text/javascript">
$(document).ready(function()
{
 $('a.del_timesheet').click(function(){
 return confirm('{$mod->Lang('confirm_delete')}');
 })
} );
</script>
<div class="pageoptions">
 <a href="{cms_action_url action=edit_timesheet}">{admin_icon icon='newobject.gif'} {$mod->Lang('add_timesheet')}</a>
</div> 
{if !empty($timesheets)}
<table class="pagetable">
  <thead>
    <tr>
      <th>{$mod->Lang('name')}</th>
      <th>{$mod->Lang('date')}</th>
      <th class="pageicon">{* edit icon *}</th>
      <th class="pageicon">{* delete icon *}</th>
    </tr>
  </thead>
  <tbody>
  {foreach $timesheets as $timesheet}
    {cms_action_url action=edit_timesheet hid=$timesheet->id assign='edit_url'}

    <tr>
      <td><a href="{$edit_url}" title="{$mod->Lang('edit')}">{$timesheet->name}</a></td>
      <td>{$timesheet->the_date|date_format:'d-m-Y'}</td>
      <td><a href="{$edit_url}" title="{$mod->Lang('edit')}">{admin_icon icon='edit.gif'}</a></td>
      <td><a class="del_timesheet" href="{cms_action_url action=delete_timesheet hid=$timesheet->id}" title="{$mod->Lang('delete')}">{admin_icon icon='delete.gif'}</a></td>
    </tr>
  {/foreach}
  </tbody>
</table
{/if}
