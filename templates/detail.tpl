{if $timesheet}
  <fieldset>
    <legend>{$mod->Lang('timesheet_detail')}</legend>
    <div class="row">
      <p class="col-sm-2 text-right">{$mod->Lang('name')}:</p>
      <p class="col-sm-10">{$timesheet->name}</p>
    </div>
    <div class="row">
      <p class="col-sm-2 text-right">{$mod->Lang('date')}:</p>
      <p class="col-sm-10">{$timesheet->the_date|date_format:'d-m-Y'}</p>
    </div>
    <div class="row">
    {$timesheet->description}
    </div>
  </fieldset>
{else}
  <div class="alert alert-danger">{$mod->Lang('error_notfound')}</div>
{/if} 
