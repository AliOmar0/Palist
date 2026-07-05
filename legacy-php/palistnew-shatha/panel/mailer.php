<?php
//$finish='<div id="footer">#legioncms_by# <a href="#legioncms_link#" title="#legioncms_name#"><img src="#legioncms_logo_small#" alt="#legioncms_name#"/></a></div>';

//.l('This email was sent automatically by the system by an action related to your account. Kindly, do not reply to this email, you can contact the website owner or admin for further inquiries <>هذا بريد صدر اوتوماتيكيا من الظام بناءاً على فعل او تحديث مرتبط بحسابك. لطفاً، لا ترد على هذا البريد، بامكانك التواصل مع مالك الموقع او مدير النظام لاستفساراتك او متابعة معينة.')


$__mailer_finish='</div><div id="footer">'.l('powered by<>تطوير').' <a href="https://provision.ps" title="'.l('ProVision<>بروفجن').'"><img width="72" src="https://legioncms.com/resources/logo/provision_logo_medium.png" alt="'.l('ProVision<>بروفجن').'"/></a></div>';

$__mailer_extra='<div class="tip_for_reply">'
	.'<div>'.l('The information contained in this e-mail and any files transmitted with it are confidential and may be privileged. Access to this e-mail by anyone other than the intended is unauthorized. If you are not the intended recipient (or responsible for delivery of the message to such person), you may not use, copy, distribute or deliver to anyone this message (or any part of its contents) or take any action in reliance on it. In such case, you should destroy this message, and notify us immediately. If you have received this email in error, please notify us immediately by e-mail or telephone and delete the e-mail from any computer. If you or your employer does not consent to internet e-mail messages of this kind, please notify us immediately. All reasonable precautions have been taken to ensure no viruses are present in this e-mail. As our company cannot accept responsibility for any loss or damage arising from the use of this e-mail or attachments we recommend that you subject these to your virus checking procedures prior to use. The views, opinions, conclusions and other information expressed in this electronic mail are not given or endorsed by the company unless otherwise indicated by an authorized representative independent of this message<>
ملاحظة إلى المتسلمين: أن المعلومات المضمنة في هذه الرسالة والمرفقة بها قد تكون سرية، وخاضعة للحصانة القانونية، أو محمية من الإفشاء، وهي مقصود بها أن يستخدمها المستلم أو المستلمين المعتزمين. فإن كنت لست المستلم المقصود لهذه الرسالة، أرجو شطبها وإتلاف كل نسخها الموجودة بحوزتك، وأخطار المرسل بأنك تلقيت هذه الرسالة عن طريق الخطأ، ويرجى الملاحظة أن أي إطلاع على هذه الرسالة أو نشر لها أو اتخاذ إجراء استناداً إليها ممنوع منعاً باتاً.
 
إن الرسائل الالكترونية قد تحتوي على فيروسات كمبيوتر أو عيوب أخرى وقد لا يمكن تكرارها بدقة على أنظمة أخرى، أو قد يمكن اعتراضها، أو شطبها أو التدخل بها دون علم المرسل أو المتلقي المقصود. إن '.l($settings['site_name']).' لا تعرض أية ضمانات فيما يتصل بهذه الأمور. ونرجو الملاحظة أن '.l($settings['site_name']).' تحتفظ بحقها في اعتراض ومراقبة وحجز الرسائل الالكترونية المرسلة إلى أو من أنظمتها وفق ما هو مسموح به قانوناً. وإن كنت لا تشعر بالراحة من المخاطر المتصلة بالرسائل الالكترونية، فلك الحق أن تقرر عدم استخدام البريد الالكتروني في التراسل مع '.l($settings['site_name']).'.
').'</div></div>';



// d($__mailer);
$hash_array=NULL;
$__mailer_hash_resp=db("hash_words_1507402735");
	for($__ih=0;$__ih<count($__mailer_hash_resp);$__ih++){
		$hash_array["{$__mailer_hash_resp[$__ih]['hash']}"]=$__mailer_hash_resp[$__ih]['php_variable'];
	}
$glo=get_defined_vars();


//$fmi == force_mailer_id
if(!isset($fmi))
	$module_id_for_mailer=db('modules',"WHERE module_prefix='$module'",NULL,'LIMIT 1','id');
if(isset($fmi) || ($module_id_for_mailer!=0 && $module_id_for_mailer!=1)){
	if(!isset($fmi)){
		$module_id_for_mailer=$module_id_for_mailer[0]['id'];
		$module_action_id=db('module_actions',"WHERE module_id='$module_id_for_mailer' AND type='".e('action')."'",NULL,'LIMIT 1','id');
	}
	
	
	if(isset($fmi) || ($module_action_id!=0 && $module_action_id!=1)){
		if(isset($fmi)){
			$__mailer=o('mailer_1565894237',$fmi);
		}
		else{
			$module_action_id=$module_action_id[0]['id'];
			$__mailer=db('mailer_1565894237',"WHERE module_id='$module_id_for_mailer' AND module_action='$module_action_id'",NULL,'LIMIT 1');
		}
		
		if($__mailer!=0 && $__mailer!=1){
			
			$__mailer=$__mailer[0];
			$__mailer_start='<html dir="'.l('ltr<>rtl').'" style="direction:'.l('ltr<>rtl').'"><body>
			<div id="email">
				<div id="header">
					<img class="mid" src="#website_logo#" alt="#website_name#"/>
					';
					if($__mailer['include_site_name'])
						$__mailer_start.='<div class="site_name mid" style="color:'.$settings['main_color'].'">'.l($settings['site_short_name']).'</div>';
					$__mailer_start.='
				</div>
				<div class="content">';
			$__mailer_to=isset($force_email) && $force_email!=NULL?$force_email:filter_code($__mailer['to_email']);
			$__mailer_boundary = md5(uniqid(time()));
			$__mailer_headers= "MIME-Version: 1.0\r\n";
			$__mailer_headers .= "Content-Type: multipart/alternative;charset=UTF-8;boundary=".$__mailer_boundary."\r\n";
			$__mailer_headers .= "Reply-To: ".l($settings['site_short_name'])." <".($__mailer['reply_email']==NULL?$settings['default_from']:$__mailer['reply_email']).">\r\n";
			$__mailer_headers .= "Return-Path: ".l($settings['site_short_name'])." <".($__mailer['reply_email']==NULL?$settings['default_from']:$__mailer['reply_email']).">\r\n";
  			$__mailer_headers .= "From: ".l($settings['site_short_name'])." <".($__mailer['from_email']==NULL?$settings['default_from']:filter_code($__mailer['from_email'])).">\r\n";
  			$__mailer_headers .= "Cc: ".filter_code($__mailer['cc_email'])."\r\n";
  			$__mailer_headers .= "Bcc: ".filter_code($__mailer['bcc_email'])."\r\n";
			$__mailer_headers .= "X-Priority: 3\r\n";
  			$__mailer_headers .= "X-Mailer: PHP". phpversion() ."\r\n";
			$__mailer_headers .= "X-Sender: ".l($settings['site_short_name'])." <".$settings['default_from'].">\n";
			$__mailer_headers .= "To: ".$__mailer_to."\r\n";
		    
    
			// Content body
			$__mailer_msg = "This is a MIME encoded message.";
			$__mailer_msg .= "\r\n\r\n--" . $__mailer_boundary . "\r\n";
			$__mailer_msg .= "Content-type: text/plain;charset=utf-8\r\n\r\n";

			// Plain text body
			$__mailer_msg .= strip_tags(l(filter_code($__mailer['content']))).'\r\n\r\n'.$__mailer_extra;
			$__mailer_msg .= "\r\n\r\n--" . $__mailer_boundary . "\r\n";
			$__mailer_msg .= "Content-type: text/html;charset=utf-8\r\n\r\n";

			// Html body
			$__mailer_msg .= filter_code($__mailer_start).l(filter_code($__mailer['content'])).$__mailer_finish.$__mailer_extra.'<style>'.file_get_contents(pres_dir.'css/mailer.css').$__mailer['extra_css'].'</style></body></html>';
			$__mailer_msg .= "\r\n\r\n--" . $__mailer_boundary . "--";


			$__mail=@mail(
				$__mailer_to,
				l(filter_code($__mailer['email_title'])),
				$__mailer_msg,
				$__mailer_headers,
				'-f '.$settings['default_from']
			);
		
		}
	}
}