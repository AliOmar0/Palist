<?php if(!privilege('settings','sitemap'))echo $noPermission;else{
    if(!file_exists(cms_dir.'sitemap.php')){
        echo 'no sitemap generated yet, regenerating...';
        echo "<script>
        $(function(){
            sub({'module':'settings','action':'sitemap_generator','e':''})
        });
        </script>";
    }
    else{
        include(cms_dir.'sitemap.php');

      $lang_possibilites_arr=[];
      foreach($langArr as $l){
        $lang_possibilites_arr[]='/'.$l['prefix'];
      }
    ?>


<h1>Sitemap Analysis built by ProVision, measuring global standards and ProVision's engine (Legion) standards</h1>

<div class="form_field">
<label>Sitemap Generator</label>
<div class="input_area">
	<div class="explainer mid">
		It generates a  <a class="l_sky_c" href="<?=url.'sitemap.xml'?>" target="_blank">sitemap.xml</a> 
	</div>
	<?php if($settings['sitemapping']==4){?>
		<div class="mid l_anime_pulse">Processing..</div>
	<?php }else{?>
		<a onClick="sub({'module':'settings','action':'sitemap_generator','e':''})" class="l_btn mid" title="Reset">Generate</a>
	<?php }?>
	</div>
</div>

<?php if(isset($sitemap_links)){?>

<div>
    Analyzer will consider missing one of these as language issue: <?=implode('  ,  ',$lang_possibilites_arr)?>
</div>

<div>
		Total: <?=count($sitemap_links)?> links filtered
	</div>
	<div>
		PHP Generator Problems: <?=empty($problematic_urls)?'No problems':'<pre>'.print_r($problematic_urls).'</pre>'?>
	</div>

    <div>
        URLs with Analyzed problems: <div class="in l_red_c" id="l_analyzed_problems_link_count"></div> links
        <script>
            $(function(){
                $('#l_analyzed_problems_link_count').html($('[data-l-sitemap-problems=true]').length);
            });
        </script>
    </div>

    <div>
        Good URLs: <div class="in l_green_c" id="l_analyzed_good_link_count"></div> links
        <script>
            $(function(){
                $('#l_analyzed_good_link_count').html(<?=count($sitemap_links)?> - parseInt($('[data-l-sitemap-problems=true]').length));
            });
        </script>
    </div>



	<table class="l_table l_mt10" id="sitemap_view_table">
		<thead>
			<tr>
                <th>#</th>
				<th>Link</th>
                <th>Legion Analyzed Problems</th>
                <th>Anchor</th>
                <th>From URL</th>
				<th>Frequency</th>
				<th>priority</th>
			</tr>
		</thead>
		<tbody id="sitemap_table_body">

        <?php if(!empty($sitemap_links)){
            foreach($sitemap_links as $i=>$link){
                $problems='';
                $problems_count=0;
                // if(preg_match('[@_!#$%^&*()<>?/|}{~:]',$link['link']))
                    // $problems.='<div class="l_tag mid">Special Characters</div>';
                if(str_contains($link['link'],'&lt;&gt;')){
                    $problems.='<div class="l_tag mid l_lava l_white_c l_f10">Filter language</div><br>';
                    $problems_count++;
                }elseif(count(explode('//',$link['link']))>2){
                    $problems.='<div class="l_tag mid l_orange l_white_c l_f10">Double Slash</div>';
                    $problems_count++;
                }
               
                if(str_contains($link['link'],'?')){
                    $problems.='<div class="l_tag mid l_green l_white_c l_f10">Query</div>';
                    $problems_count++;
                }

                if(!str_containsa($link['link'],$lang_possibilites_arr)){
                    $problems.='<div class="l_tag mid l_lava l_white_c l_f10">No Language</div>';
                    $problems_count++;
                }

                    
                

                foreach($sitemap_links as $j=>$sub_link){
                    if($sub_link['link']==$link['link'] && $i!=$j){
                        $problems.='<div class="l_tag mid l_purple l_white_c l_f10"><div class="po" onclick="l_scroll(\'#sitemap_link_'.$j.'\')">Duplicated to '.$j.'</div></div></div>';
                        $problems_count++;
                        break;
                    }
                }
                ?>
                <tr id="sitemap_link_<?=$i?>" <?=($problems==''?'':'data-l-sitemap-problems="true"')?> data-l-sitemap-problems-count="<?=$problems_count?>">
                    <td><?=$i?></td>
                    <td><?=$link['link']?>
                    <div class="mid ">
                        <a target="_blank" class="mid l_btn l_btn_small" href="<?=$link['link']?>">Visit</a>
                        <div target="_blank" class="mid l_btn l_btn_small" onclick="c('view-source:<?=$link['link']?>')">Copy Source Link</a>
                    </div>
                    </td>
                    <td><?=$problems?></td>
                    <td><div class="<?=($problems_count==0?'el':'')?>"><?=$link['anchor']?></div><?php if($problems_count>0){?><div class="l_btn l_btn_small" onclick="$(this).prev().removeClass('el');$(this).hide();">Expand</div><?php }?></td>
                    <td><?=$link['from_url']?>
                        <div class="mid l_ml10">
                            <a target="_blank" class="mid l_btn l_btn_small" href="<?=$link['from_url']?>">Visit</a>
                            <div target="_blank" class="mid l_btn l_btn_small" onclick="c('view-source:<?=$link['from_url']?>')">Copy Source Link</a>
                        </div>
                    </td>
                    <td><?=$link['freq']?></td>
                    <td><?=$link['priority']?></td>
                </tr>
            <?php }?>
        
    
    <?php }?>


        </tbody>
	</table>
	
	</div>
    


    <script>
        $(function(){
            function sortLiElements(b,a) {
                return parseInt($(a).data('l-sitemap-problems-count')) -  parseInt($(b).data('l-sitemap-problems-count'));
            }

            $('#sitemap_table_body').html($('#sitemap_table_body tr').sort(sortLiElements));
            // p($('[data-l-sitemap-problems=true]'));
            // $('[data-l-sitemap-problems=true]').hide().prependTo('#sitemap_view_table').fadeIn();
        });
    </script>
<?php
}else{echo 'error php';}
}
}?>

