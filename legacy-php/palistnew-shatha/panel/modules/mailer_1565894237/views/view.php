<?php 
$id=check_get_id();
$_form_resp=db('mailer_1565894237','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('mailer_1565894237','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="mailer_1565894237_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="mailer_1565894237"><!--

		--><div class="view_box  mailer_1565894237_view_email_title  ">
<div class="view_label view_label_email_title"><?=l('Email Title<>عنوان البريد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['email_title'])?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_module_id  ontwo in ">
<div class="view_label view_label_module_id"><?=l('Module ID<>رقم البرمجيّة')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_id']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('mailer_1565894237','module_id',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_module_action  ontwo in ">
<div class="view_label view_label_module_action"><?=l('Module Action<>مهمّة البرمجية')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_actions',"WHERE deleted=0  AND id='".$_form_resp[0]['module_action']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('mailer_1565894237','module_action',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_from_email  takeThree in ">
<div class="view_label view_label_from_email"><?=l('From Email<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['from_email'])?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_include_site_name  onfour in ">
<div class="view_label view_label_include_site_name"><?=l('Include Site Name<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['include_site_name']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_to_email  onfour in ">
<div class="view_label view_label_to_email"><?=l('To Email<>الى البريد الالكتروني')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['to_email'])?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_cc_email  onfour in ">
<div class="view_label view_label_cc_email"><?=l('CC Email<>نسخة الى البريد الالكتروني')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['cc_email'])?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_bcc_email  onfour in ">
<div class="view_label view_label_bcc_email"><?=l('BCC Email<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['bcc_email'])?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_reply_email  onfour in ">
<div class="view_label view_label_reply_email"><?=l('Reply Email<>البريد الالكتروني للرد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['reply_email'])?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>المحتوى')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  mailer_1565894237_view_extra_css  ">
<div class="view_label view_label_extra_css"><?=l('Extra CSS<>تخصيص الشكل')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['extra_css'])?></div>
</div><!--

--></div>
<?php } ?>