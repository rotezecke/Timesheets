<div class="timesheetWrapper">
  {foreach $timesheets as $timesheet}
    <div class="timesheet">
      <div class="row">
        <div class="col-sm-6">
          <a href="{cms_action_url action='detail' hid=$timesheet->id  returnid=$detailpage}}">{$timesheet->name}</a>
        </div>
        <div class="col-sm-6 text-right">{$timesheet->the_date|date_format:'d-m-Y'}</div>
      </div>
    </div>
  {foreachelse}
    <div class=”alert alert-danger”>{$mod->Lang('sorry_notimesheets')}</div>
  {/foreach}
</div> 
