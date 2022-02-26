<script type="text/javascript">
function handle_change(){
  var val = $('#fld_type').val();
  
}
$(document).ready(function(){
  handle_change();
  $('#fld_type').change(handle_change);
  $('#{$actionid}cancel').click(function(){
    $(this).closest('form').attr('novalidate','novalidate');
  });
});
</script>

<h3>{$title}</h3>
{$startform}{$hidden|default:''}
	<div class="pageoverflow">
		<p class="pagetext"><label for="fld_name">*{$nametext}:</label> {cms_help key='help_fielddef_name' title=$nametext}</p>
		<p class="pageinput">
                  <input type="text" id="fld_name" name="{$actionid}name" value="{$name|cms_escape}" size="30" maxlength="255" required/>
                </p>
	</div>


	<div class="pageoverflow">
		<p class="pagetext"><label for="fld_payroll_software_id">{$payroll_software_idtext}:</label> {cms_help key='help_fielddef_software_id' title=$payroll_software_idtext}</p>
		<p class="pageinput">
                  <input type="number" max="99999" id="fld_payroll_software_id" name="{$actionid}payroll_software_id" value="{$payroll_software_id}" /><br/>{$info_payroll_software_id}
                </p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext"><label for="fld_public">{$userviewtext}:</label> </p>
		<p class="pageinput">
                  <input type="hidden" name="{$actionid}public" value="0"/>
                  <input type="checkbox" id="fld_public" name="{$actionid}public" value="1" {if $public == 1}checked="checked"{/if}/>
                </p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">
                  <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
                  <input type="submit" id="{$actionid}cancel" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
                </p>
	</div>
{$endform}