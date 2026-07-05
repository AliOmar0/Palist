<link rel="stylesheet" type="text/css" href="<?= pres;?>css/meepo.css<?php clearCache();?>"/>
<script src="<?= pres?>js/meepo.js<?php clearCache();?>"></script>

<link rel="stylesheet" type="text/css" href="<?= pres;?>css/colorpicker.css<?php clearCache();?>"/>

<script src="<?= pres?>js/colorpicker.min.js<?php clearCache();?>"></script>

<script src="<?= pres?>js/jscolor.js<?php clearCache();?>"></script>

<link rel="stylesheet" type="text/css" href="<?= pres;?>css/gradX.css<?php clearCache();?>"/>
<script src="<?= pres?>js/gradX.js<?php clearCache();?>"></script>

<form id="meepo_1646265283" autocomplete="off" action="" onsubmit="meepoSave();return submitter(this,'<?=urlPanel?>');" method="post" enctype="multipart/form-data">
	<input type="hidden" value="" name="e">
	<input type="hidden" name="module" value="meepo_1646265283"> 
	<input type="hidden" name="action" value="add"> 
	<input type="hidden" name="id" value="0"> 
	<textarea name="html" class="hidden mceNoEditor"></textarea>
    <input type="hidden" name="js" value="meepoSaved"/>
    <input type="hidden" name="last_id" value="true"/>
    
</form>

<?php 
// $resp=detail('meepo_1646265283','html','id',1);
$me_sides=['top','right','bottom','left'];
$me_border_radius=['top-left','top-right','bottom-right','bottom-left'];
$me_grid_gap=['0','5','10','15','20','25','50','100'];
?>
	  
    <div id="meepo">

            <!-- <div class="meTool mid">
                <div class="meToolLabel mid">Background Color</div>
                <input class="l_reset_input l_niceinput mid" id="meBtnBgColorEdit" type="color"/>
            </div> -->
        <div id="meFinder" class="l_mb10 l_grid2">
            
            <div id="meList">
                <div class="l_f14 l_mb5">Load a meepo</div>
                <select onchange="meepoLoad(this.value)">
                </select>
            </div>

            <div>
                <div class="l_f14 l_mb5">Current Meepo</div>
                <input form="meepo_1646265283" type="text" name="title" value="New Meepo (<?=db('meepo_1646265283',NULL,NULL,'limit 1')[0]['id']+1?>)"/>
                <div class="l_mt5 l_grid4 l_f8">
                    <div id="meepoCallerInfo"></div>
                </div>
            </div>
        </div>

        <div id="meGlobalActions" class="l_center l_mb10">
            <?php
            $a=rand(1,3);
            $b=rand(1,4);
            ?>
                <div class="l_btn  l_lava" onclick="if(<?=$a+$b?>==$('#meResetCheck').val()){$('#meBoard').html('');init_meepo();}">Reset Board <span><?=$a.'+'.$b?></span>=<input style="width:20px" class="l_reset_input" type="text" id="meResetCheck"/></div>

                <div class="l_btn l_sea" onclick="meepoHighlight()">Highlight Elements</div>

                <div class="l_btn l_sea" meepo-autosave-state="off" onclick="meepoAutoSaveToggle(this)">Auto Save</div>

                <div class="l_btn l_grass" onclick="$('#meepo_1646265283').trigger('onsubmit')">Save</div>
            
        </div>


        <div id="meFrame">
            <div id="meToolsWrap" class="noselect">
                <div id="meToolsCon">
                    
                <div id="meElementsSuggestions">
                    <div class="meLabelSugg in move" draggable="true" meepo-target-sample="meRow" ondragstart="handleDragStart(event,this)">
                        <i class="mid">horizontal_rule</i>
                        <div class="meLabelSuggName mid">Row</div>
                    </div>
                            
                    <div class="meLabelSugg in move" draggable="true" meepo-target-sample="meLabel" ondragstart="handleDragStart(event,this)">
                        <i class="mid">label</i>
                        <div class="meLabelSuggName mid">Label</div>
                    </div>
                    
                    <div class="meLabelSugg in move" draggable="true" meepo-target-sample="mePhoto" ondragstart="handleDragStart(event,this)">
                        <i class="mid">insert_photo</i>
                        <div class="meLabelSuggName mid">Photo</div>
                    </div>
                    
                    <div class="meLabelSugg in move" draggable="true" meepo-target-sample="meTextArea" ondragstart="handleDragStart(event,this)">
                        <i class="mid">notes</i>
                        <div class="meLabelSuggName mid">TextArea</div>
                    </div>


                    <div class="meLabelSugg in move" draggable="true" meepo-target-sample="meBtn" ondragstart="handleDragStart(event,this)">
                        <i class="mid">smart_button</i>
                        <div class="meLabelSuggName mid">Button</div>
                    </div>

                    
                </div>
            </div>
           </div>

            
	    <div id="meepoBig" class="in">
            <div id="meBoard" ondrop="drop(event)" ondragover="handleDragOver(event)" ondragleave="dragEnd()" ondragend="dragEnd()" meepo-elem-type="board"></div>
        </div><!--

        --><div class="l_nicebox in" id="meControlWrap">
            <div id="meepoInfoBar">
            <div class="meepo-info-box mid">
                    <div class="meepo-info-title mid">Element:</div>
                    <div id="meepo-info-element-name" class="meepo-info-value mid"></div>
                </div>

                <div class="meepo-info-box mid" id="meepo-info-parent-btn" <?=dn()?>>
                    <div class="l_btn l_btn_small">Parent</div>
                </div>
            </div>

            <div class="meControlBox" id="meControl-actions">
                <div class="meControlBoxTitle">Actions</div>
                
                <div class="meElemTool in po" id="meControl-delete">
                    <i class="mid">delete_sweep</i>
                    <div class="mid">Delete</div>
                </div>
                
                
                <div class="meElemTool in po" id="meControl-background-color" meepo-target-css='background'>
                    <i class="mid">palette</i>
                    <div class="mid">Background Color</div>
                </div>
            </div>
           
            <div class="meControlBox" id="meControl-row">
                <div class="meControlBoxTitle">Row Settings</div>

                <div class="meElemTool in po" id="meControl-add-column">
                    <i class="mid">view_week</i>
                    <div class="mid">Add Column</div>
                </div>

                <div class="meTool ">
                    <div class="meControlLabel mid">Grid Gap</div>
                    <select class="mid noSelect2" id="meControl-grid-gap">
                        <?php foreach($me_grid_gap as $m){?>
                            <option value="l_grid-gap<?=$m?>"><?=$m?>px</option>
                        <?php }?>
                    </select>
                </div>
            </div>


            <div class="meControlBox" id="meControl-photo">
                <div class="meControlBoxTitle">Photo Settings</div>

                <div class="meElemTool in po" id="meControl-photo-change">
                    <i class="mid">image</i>
                    <div class="mid">Change Photo</div>
                </div>
            </div>

           


            <div class="meControlBox" id="meControl-position">
                <div class="meControlBoxTitle mid">Position</div>

                    <div class="meTool">
                        <div class="meControlLabel mid">Display</div>
                        <select class="mid noSelect2" id="meControl-vertical-inline-block">
                            <option value="l_in">Top (in)</option>
                            <option value="l_mid">Middle (mid)</option>
                            <option value="l_dis_block">Block</option>
                            <option value="l_dis_inline_block">Inline Block</option>
                        </select>
                    </div>
            </div>


            <div class="meControlBox" id="meControl-text">
                <div class="meControlBoxTitle">Text</div>

                    <div class="meTool ">
                        <div class="meControlLabel mid">Content</div>
                        <input class="l_reset_input l_niceinput mid" id="meControl-text-content" type="text"/>
                    </div>


                    <div class="meTool ">
                        <div class="meControlLabel mid">Font Color</div>
                        <input class="l_reset_input l_niceinput mid" id="meControl-color" meepo-target-css="color" type="text" data-jscolor="{}"/>
                    </div>

                    <div class="meTool ">
                        <div class="meControlLabel mid">Font Size</div>
                        <input class="l_reset_input l_niceinput mid" id="meControl-font-size" meepo-target-css="font-size" type="text"/>
                    </div>

                    <div class="meTool">
                        <div class="meControlLabel mid">Text Align</div>
                        <select class="noSelect2" id="meControl-text-align">
                            <option value="l_left">Left</option>
                            <option value="l_center">Center</option>
                            <option value="l_right">Right</option>
                        </select>
                    </div>
            </div>

            <div class="meControlBox" id="meControl-textarea">
                <div class="meControlBoxTitle">Text</div>
                <div class="meTool mid">
                    <div class="meToolLabel mid">Content</div>
                    <div class="l_btn l_btn_small" id="meControl-textarea-content" onclick="meEditTextAreaMCE(this)">Edit</div>
                </div>

            </div>

            
            <div class="meControlBox" id="meControl-btn">
                <div class="meControlBoxTitle">Button Settings</div>

                    <div class="meTool ">
                        <div class="meControlLabel mid">Target</div>
                        <select class="mid noSelect2" id="meControl-btn-target">
                            <option value="_self">Same Tab</option>
                            <option value="_blank">New Tab</option>
                        </select>
                    </div>

                    <div class="meTool mid">
                        <div class="meToolLabel mid">URL</div>
                        <input class="l_reset_input l_niceinput mid" id="meControl-href" type="url" pattern="https://.*"/>
                    </div>

                    <div class="meTool mid">
                        <div class="meToolLabel mid">SEO Title</div>
                        <input class="l_reset_input l_niceinput mid" id="meControl-seo-title" type="text"/>
                    </div>
            </div>

            

            <div class="meControlBox" id="meControl-column">
                <div class="meControlBoxTitle">Column Settings</div>
                
            </div>


          
            <div class="meControlBox" id="meControl-margin">
                <div class="meControlBoxTitle">Margin</div>
                <div class="meControlQuatroWrap">
                    <div class="meControlQuatroSquare"></div>
                    <?php foreach($me_sides as $m){?>
                        <input class="l_reset_input meQuatro-<?=$m?> mid" id="meControl-margin-<?=$m?>" meepo-target-css="margin-<?=$m?>" type="text"/>
                    <?php }?>
                </div>
            </div>

            <div class="meControlBox" id="meControl-padding">
                <div class="meControlBoxTitle">Padding</div>
                <div class="meControlQuatroWrap">
                    <div class="meControlQuatroSquare meControlQuatroContain"></div>
                    <?php foreach($me_sides as $m){?>
                        <input class="l_reset_input meQuatro-in-<?=$m?> mid" id="meControl-padding-<?=$m?>" meepo-target-css="padding-<?=$m?>" type="text"/>
                    <?php }?>
                </div>
            </div>

            <div class="meControlBox" id="meControl-border-radius">
                <div class="meControlBoxTitle">Border Radius</div>
                <div class="meControlQuatroWrap">
                    <div class="meControlQuatroSquare"></div>
                    <?php foreach($me_border_radius as $m){?>
                        <input class="l_reset_input meQuatro-<?=$m?> mid" id="meControl-border-radius-<?=$m?>" meepo-target-css="border-<?=$m?>-radius" type="text"/>
                    <?php }?>
                </div>
            </div>


            <div id="meColorOptions" class="" <?=dn()?>>
                <div class="color_palette_color in po" style="background: white" title="White">
                </div><!--

                --><div class="color_palette_color in po color_palette_transparent" style="background: transparent" title="Clear">
                </div><!--
                <?php $_m='color_palette_1645099749';?>
                <?php
                $resp=db($_m,NULL,NULL);
                $paletteForJS=NULL;
                if($resp==1) '';
                else { for($i=0;$i<count($resp);$i++){
                    $paletteForJS.='\''.$resp[$i]['color'].'\',';
                    ?>
                --><div class="color_palette_color in po" style="background: <?=$resp[$i]['color']?>" title="<?=l($resp[$i]['name'])?>">
                    </div><!--
                <?php 
                    }//for
                }//else
                unset($resp);?>
                --><div class="color_palette_color in po" style="background: var(--modernG)" meepo-color-gradient="true" title="<?=l('Gradient')?>"></div><!--
                --><input class="l_reset_input l_niceinput color_palette_color in po mid" id="meepo-manual-background" meepo-target-css="background" type="text" data-jscolor="{}"/>
	    	</div>

            <script>
            // These options apply to all color pickers on the page
            jscolor.presets.default = {
                width: 201,
                height: 81,
                position: 'right',
                previewPosition: 'right',
                backgroundColor: '#f3f3f3',
                borderColor: '#bbbbbb',
                controlBorderColor: '#bbbbbb',
                format:'hexa',
                // closeButton:true,
                // paletteSetsAlpha:true,
                palette: [<?=$paletteForJS?>
                    '#000000', '#7d7d7d', '#870014', '#ec1c23', '#ff7e26',
                    '#fef100', '#22b14b', '#00a1e7', '#3f47cc', '#a349a4',
                    '#ffffff', '#c3c3c3', '#b87957', '#feaec9', '#ffc80d',
                    '#eee3af', '#b5e61d', '#99d9ea', '#7092be', '#c8bfe7',
                ],
                paletteCols: 10,
                hideOnPaletteClick: true,
                hideOnLeave: true, 
                alphaChannel:true,
                
            }
           

            var meControl_color = new JSColor('#meControl-color', {
                onInput:function(){
                    meElem=$('[meepo-elem-id='+$('#meControl-color').attr('meepo-to-affect-id')+']');
                    $(meElem).css($('#meControl-color').attr('meepo-target-css'),$('#meControl-color').val());
                 }
            });


            var meControl_background = new JSColor('#meepo-manual-background', {
                onInput:function(){
                    meepoColorChoose($('#meepo-manual-background'),$('#meepo-manual-background').attr('meepo-to-affect-id'));
                 }
            });



            </script>



        </div>
			
	</div>
        
  
        <div id="meSamples" class="hidden">
            <div class="meRow meElem" meepo-elem-type="row"><!----><div class="meColumn meElem l_in" meepo-elem-type="column" style="width:100%;"></div></div>

            <div class="meColumn meElem l_in" meepo-elem-type="column" style="width:100%"></div>
			
            <div class="meLabel meElem" meepo-elem-type="label">Label</div>
            
            <div class="mePhoto meElem" meepo-elem-type="photo"><img meepo-elem-type="child-img" src="<?=u?>default_logo.png"/></div>
            
            <div class="meTextArea meElem mce" meepo-elem-type="textarea">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</div>
        
            
            <a class="meBtn meElem  meBtnAnchor" meepo-elem-type="btn" title="<?=l($settings['site_name'])?>" target="_self" meepo-href="#">Action</a>
          
        </div>
        
        <div id="meRights">MEEPO - Blocks Builder - developed by ProVision for Legion CMS ©</div>
  </div>


  <div id="gradX" style="display:none"></div>
  
  <?php include cms_dir.'plugins/tinymce/backendTinyCall.php'?>