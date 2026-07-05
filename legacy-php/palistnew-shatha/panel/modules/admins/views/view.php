<?php 
$id=check_get_id();
$_form_resp=db('admins','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
$noPermission = isset($noPermission) ? $noPermission : l('No Permission<>لا يوجد إذن');
if(!privilege('admins','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="admins_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="admins">
    <!--

		-->
    <div class="view_box  admins_view_username  ontwo in ">
        <div class="view_label view_label_username"><?=l('Username<>اسم المستخدم')?></div>
        <div class="viewValue  "><?=l($_form_resp[0]['username'])?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_password  ontwo in ">
        <div class="view_label view_label_password"><?=l('Password<>الكلمة السرية')?></div>
        <div class="viewValue  ">*****</div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_email  ontwo in ">
        <div class="view_label view_label_email"><?=l('Email<>البريد الالكتروني')?></div>
        <div class="viewValue  "><?=l($_form_resp[0]['email'])?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_phone  ontwo in ">
        <div class="view_label view_label_phone"><?=l('Phone<>الخلوي')?></div>
        <div class="viewValue  "><?=l($_form_resp[0]['phone'])?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_first_name  ontwo in ">
        <div class="view_label view_label_first_name"><?=l('First Name<>الاسم الأوّل')?></div>
        <div class="viewValue  "><?=l($_form_resp[0]['first_name'])?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_last_name  ontwo in ">
        <div class="view_label view_label_last_name"><?=l('Last Name<>اسم العائلة')?></div>
        <div class="viewValue  "><?=l($_form_resp[0]['last_name'])?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_position  ontwo in ">
        <div class="view_label view_label_position"><?=l('Position<>المنصب')?></div>
        <div class="viewValue  "><?=l($_form_resp[0]['position'])?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_language_id  ontwo in ">
        <div class="view_label view_label_language_id"><?=l('Language<>اللّغة')?></div>
        <div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('languages_1557157519',"WHERE deleted=0  AND id='".$_form_resp[0]['language_id']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='language_name';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[0][$x[$e]]); 
                        }
                        }
                        ?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_country  ontwo in ">
        <div class="view_label view_label_country"><?=l('Country<>الدولة')?></div>
        <div class="viewValue  "><?php 
$addition_where='AND active';
$sub_resp=db('countries_1556139283',"WHERE deleted=0  AND id='".$_form_resp[0]['country']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='title';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[0][$x[$e]]); 
                        }
                        }
                        ?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_menu_style  ontwo in ">
        <div class="view_label view_label_menu_style"><?=l('Menu Style<>شكل القائمة')?></div>
        <div class="viewValue  "><?=l($_form_resp[0]['menu_style'])?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_photo  onfour in ">
        <div class="view_label view_label_photo"><?=l('Photo<>صورة شخصية')?></div>
        <div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
    </div>
    <!--

		-->
    <div class="view_box  admins_view_dark_mode  onfour in ">
        <div class="view_label view_label_dark_mode"><?=l('Dark Mode<>')?></div>
        <div class="viewValue  checkboxView "><i><?=$_form_resp[0]['dark_mode']?'done':'close'?></i></div>
    </div>
    <!--

-->
</div>
<?php } ?>