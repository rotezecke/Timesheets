 
<h3>{$mod->Lang('add_timesheet')}</h3>
{form_start hid=$timesheet->id}
<div class="pageoverflow">
 <p class="pageinput">
 <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
 <input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
 </p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$mod->Lang('name')}:</p>
 <p class="pageinput">
 <input type="text" name="{$actionid}name" value="{$timesheet->name}"/>
 </p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$mod->Lang('date')}:</p>
 <p class="pageinput">
 <input type="date" name="{$actionid}the_date" value="{$timesheet->the_date|date_format:'%Y-%m-%d'}"/>
 </p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$mod->Lang('published')}:</p>
 <p class="pageinput">
 <select name="{$actionid}published">
 {cms_yesno selected=$timesheet->published}
 </select>
 </p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$mod->Lang('description')}:</p>
 <p class="pageinput">
 {cms_textarea prefix=$actionid name=description value=$timesheet->description enablewysiwyg=false}
 </p>
</div>
{form_end}
