<?php
$__comment_config=this_comment_config();?>


<div class="latest_comments pad10px">
        <div class="sub_sec_title l_mb10"><?=l('Comments<>تعليقات')?></div>
        
    
<form class="latest_comment makeNewComment"  id="comments" autocomplete="off" action="" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
    <input type="hidden" value="" name="e"/>
    <input type="hidden" name="module" value="comments"/> 
    <input type="hidden" name="action" value="add"/> 
    <input type="hidden" name="comment_form" value="true"/> 
    <input type="hidden" name="force_refresh" value="true"/>
    <input type="hidden" name="module_prefix" value="<?=mid($__comment_config['mother_module'])?>"/> 
    <input type="hidden" name="__add_comment" value="true"/>
    <?php if(isset($__comment_config['custom_input'])){?>
        <input type="hidden" name="<?=$__comment_config['custom_input']?>" value="true"/>
    <?php }?>
    <input type="hidden" name="related_id" value="<?=$__comment_config['mother_id'];?>"/> 

        
        <div class="comment_user mid">
            <?php 
            $__commenter=o(dim($_SESSION['module_id']),$_SESSION['user_id'])[0];
            if(isset($__commenter['photo'])){
                pic($__commenter['photo'],36,100,NULL,true,NULL,'admin_pic mid');
            }?>
            <div class="admin_name mid"><?php
            if(isset($__comment_config['user_modules'][dim($_SESSION['module_id'])]['name_field']))
                echo l($__commenter[$__comment_config['user_modules'][dim($_SESSION['module_id'])]['name_field']]);
            
            else
               echo isset($__commenter['username'])?$__commenter['username']:'NA';
            ?></div>
        </div> 
        
        <textarea name="comment" class="comment_text mid w60"></textarea>
        <input type="file" name="files[]" />
        <input type="submit" value="<?=l('Send<>أرسل')?>" class="l_btn"/>
        
</form>
        
        
    <?php 
            $__comments=db('comments','WHERE deleted=0 AND module_prefix='.mid($__comment_config['mother_module']).' AND related_id='.$__comment_config['mother_id'],NULL);
        if($__comments!=1 && $__comments!=0){
                for($__c=0;$__c<count($__comments);$__c++){
                    $__comment_user=o(dim($__comments[$__c]['commenter_module']),$__comments[$__c]['commenter_id'])[0];
        ?>
                <div class="latest_comment">
                    <div class="comment_user mid">
                            <?php 
                            if(isset($__comment_user['photo']))
                                pic($__comment_user['photo'],36,100,NULL,true,NULL,'admin_pic mid');?>
                            <div class="admin_name mid">
                                <?=l($__comment_user[$__comment_config['user_modules'][dim($__comments[$__c]['commenter_module'])]['name_field']]);?>
                            </div>
                        </div> 
                        
                        <div class="comment_text mid width60"><?=$__comments[$__c]['comment'];?></div>

                        <?php if($__comments[$__c]['files']!=''){
                            ?>
                            <div class="comment_files mid">
                                <?php 
                                if(isset($post))$___tmp=$post;
                                $post=[];
                                $post['files']=$__comments[$__c]['files'];
                                include cms_dir.'legion_files.php';
                                if(isset($post))$post=$___tmp;?>
                            </div>
                        <?php }?>
                        

                        <div class="comment_stamp mid l_f10 l_lava_c"><?php
                            $datetime = new DateTime($__comments[$__c]['date_created']);
                            $formatted_date = $datetime->format('Y-m-d h:i:s A'); 
                            echo $formatted_date;
                            
                             
                        // elapse($__comments[$__c]['time_stamp']);
                        
                        ?></div>
                                <div class="comment_details mid l_f10 l_lava_c"><?php
                                $stat_flow='';
                                $resp_st=db('avg_status_loan_865426','WHERE !deleted AND loan_id="'.$__comments[$__c]['related_id'].'" AND fund_institutions="'.$__comments[$__c]['commenter_id'].'"','ORDER By date_created ASC');
                                // d($resp_st);
                                if($resp_st!=1){
                                for($x=0;$x<count($resp_st);$x++){
                                    if($resp_st[$x]['status_id']== 3){
                                        $stat_flow.=' '.l(detail('loan_status_1630833661','title','id',$resp_st[$x]['status_id'])).' بسبب '.l(detail('reason_for_rejection_865145','title','id',$resp_st[$x]['reason_for_rejection'])) .'['.$resp_st[$x]['date_created'].']';
                                    }else{
                                        $stat_flow.=' '.l(detail('loan_status_1630833661','title','id',$resp_st[$x]['status_id'])) .'['.$resp_st[$x]['date_created'].']';   
                                        }
                                        if(!($x+1 >= count($resp_st))){
                                            $stat_flow.=" <i>arrow_back_ios_new</i> ";
                                        }
                                        }
                                    }
                                    echo $stat_flow;
                             
                        // elapse($__comments[$__c]['time_stamp']);
                        
                        ?></div>
                        
                                

                </div>
                    <?php }?>
                    <?php }?>
                <div class="comment_details "><?php
// d(!logged(mid('partners_account_1625433382')) && !(logged(mid($_profile)) ));
            if(!logged(mid('partners_account_1625433382')) && !(logged(mid($_profile)) ) )
            {
                $stat_flow='';
                $resp_st=db('avg_status_loan_865426','WHERE !deleted AND loan_id="'.$__comment_config['mother_id'].'"','ORDER By time_stamp ASC');
                // d($resp_st);$owned || 
                if($resp_st!=1){
                for($x=0;$x<count($resp_st);$x++){
                    $duration='';
                    if($x>0){

                                // Convert the date-time strings into DateTime objects
                                if (!empty($resp_st[$x]['date_created']) && !empty($resp_st[$x-1]['date_created'])) {
                                $date1 = new DateTime($resp_st[$x]['date_created']);
                                $date2 = new DateTime($resp_st[$x-1]['date_created']);
                                    // Calculate the difference between the two DateTime objects
                                    $interval = $date1->diff($date2);
                                }
                            

                                
                                
                                // Print the difference in a human-readable format
                                $duration.= "<pre class=' bidi'>";
                                // echo "Difference: ";
                                if($interval->y >0)
                                    $duration.= $interval->y . " years, ";
                                if($interval->m >0)
                                    $duration.= $interval->m . " months, ";
                                if($interval->d >0)
                                    $duration.= $interval->d . " days, ";
                                if($interval->h >0)
                                    $duration.= $interval->h . " hours, ";
                                if($interval->i >0)
                                    $duration.= $interval->i . " minutes, ";
                                if($interval->s >0)
                                    $duration.= $interval->s . " seconds";
                                $duration.= "</pre>";
                        // d($duration);
                    }
                    if($resp_st[$x]['status_id']== 3){
                        $stat_flow.=' <div class="stat_box in"><div class="statbox_line1 bidi"><span class="stat_det">'.l('Status:<> الحالة').':</span>'.l(detail('loan_status_1630833661','title','id',$resp_st[$x]['status_id'])).' بسبب '.l(detail('reason_for_rejection_865145','title','id',$resp_st[$x]['reason_for_rejection'])) .'</div> <div class="statbox_line2"><i class="stat_det">email</i>'.l(detail('fund_institutions_8367','email','id',$resp_st[$x]['fund_institutions'])).'</div> <div class="statbox_line3"><i class="stat_det">schedule</i>['.$resp_st[$x]['date_created'].']</div>';
                        if($duration!='') 
                            $stat_flow.='<div class="statbox_line4 bidi">'.$duration.'</div>';
                        $stat_flow.='</div>';
                    }else{
                        $stat_flow.=' <div class="stat_box in"><div class="statbox_line1 bidi"><span class="stat_det">'.l('Status:<> الحالة').':</span>'.l(detail('loan_status_1630833661','title','id',$resp_st[$x]['status_id'])).'</div> <div class="statbox_line2"><i class="stat_det" >email</i>'.l(detail('fund_institutions_8367','email','id',$resp_st[$x]['fund_institutions'])).'</div> <div class="statbox_line3"><i class="stat_det" >schedule</i>['.$resp_st[$x]['date_created'].']</div>';
                        if($duration!='') 
                            $stat_flow.='<div class="statbox_line4 bidi">'.$duration.'</div>';
                        $stat_flow.='</div>';
                        }
                        
                        }
                    }
                    echo $stat_flow;

                // elapse($__comments[$__c]['time_stamp']);AND fund_institutions="'.$__comments[$__c]['commenter_id'].'"
                }
                ?></div>

    </div>