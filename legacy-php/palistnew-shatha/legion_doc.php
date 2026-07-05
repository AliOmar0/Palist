<?php require_once 'panel/core/config.php';
require'legion_header.php';

$doc=o("documentations_8343",1)[0];
// d($doc);
$resp=db("documentation_items_8343","WHERE documentation=1 AND !deleted","ORDER BY order_number ASC,id ASC");
?>

	<div class="l_grid4 l_grid_gap0 ">
		<div id="side" class="l_pad10 l_nicebox">
			<div class="l_fixed">
				<div onclick="href('<?=url?>legion_doc.php#sec_intro')" class="l_mtb10 l_f16 l_bold po"><?=l($doc['title'])?></div>
				<div>
					<?php foreach($resp as $r){?>
						<a href="<?=url?>legion_doc.php#sec_<?=$r['id']?>" class="l_mtb5 po l_dis_block"><?=l($r['title'])?></a>
					<?php }?>
					<?php if($doc['errors']){?>
						<a href="<?=url?>legion_doc.php#sec_errors" class="l_mtb5 po l_dis_block"><?=l('Response Codes<>قائمة الحالات')?></a>
					<?php }?>
				</div>
				<div id="" class="l_mt50">
			</div>
			<?php
				$url = $legion['provision']['logo_medium'];
				$img = 'uploads/provision.png';
				if(!file_exists($img))
					file_put_contents($img, file_get_contents($url));
				?>
				<a href="<?= $legion['provision']['link'];?>" target="_blank" title="Design & Development by <?= $legion['provision']['name'];?>">
					<div id="pv_inside" class="l_f6">
					<?php if(get_lang_direction()=='ltr'){?>
					<span class="mid"><span id="design">d</span>esign
						&
						<span id="dev">d</span>evelopment</span>
					<clear></clear>
					<div class="mid">
						<img  src="<?= uploads_link.img('provision_logo_web.png',140,100);?>" alt="<?= $legion['provision']['name'];?>"/>
						
						
						</div>
					<?php } else { ?>
					<span class="mid">تصميم
						و
						تطوير</span>
					<div class="mid">
						<img src="<?= uploads_link.img('provision_logo_web.png',140,100);?>" alt="<?= $legion['provision']['name'];?>"/>
						
						</div>
					<?php }?>
					</div>
				</a>
			</div>
		</div>

		<div id="doc_items" class="l_grid_span25 l_pad10">
			<!-- <div class=""> -->
				<div id="sec_intro" class="l_mtb10">
					<div class="l_bold"><?=l('Introduction<>مقدمة')?></div>
					<div class="l_mtb10"><?=l($doc['content'])?></div>
				</div>

				<?php foreach($resp as $r){?>
					<div id="sec_<?=$r['id']?>" class="l_mtb50 l_lines ">
						<div class="">
							<div class="l_bold"><?=l($r['title'])?></div>
							<div class="l_mtb10 l_f14 mce l_break"><?=l($r['content'])?></div>
							<div class="l_mtb10 l_f14 mce l_break"><?=l($r['additional_content'])?></div>
						</div>
						<!-- <div class="l_pad10 l_f14 l_break mce">
							
						</div> -->
					</div>

					

				<?php }?>


				<?php if($doc['errors']){?>
					<div id="sec_errors" class="l_mtb50 l_lines ">
						<div class="">
							<div class="l_bold"><?=l('Response Codes<>قائمة الحالات')?></div>
							<div class="l_mtb10 l_f14 mce l_break">
								<table>
									<thead>
										<tr>
											<th>Code</th>
											<th>Type</th>
											<th>Message</th>
										</tr>
									</thead>
								<?php $errors=db("error_1528374155",NULL,"ORDER BY id ASC");
								foreach($errors as $a){?>
										<tr>
											<td><?=$a['id']?></td>
											<td><?=$a['icon']?></td>
											<td><?=l($a['error_desc'])?></td>
										</tr>
								<?php }?>
								</table>
							</div>
						</div>
					</div>
					<?php }?>
			<!-- </div> -->
		</div>
	</div>

	

	<style>
		table{
			/* border:1px solid; */
			height:unset !important;
		}

		#doc_items table {
  			width: unset !important;
			  display: inline-block;
		}

		#doc_items td {
  			width: unset !important;
		}

		#doc_items tr,#doc_items td {
  			height: unset !important;
		}

	</style>
<?php 
require'legion_footer.php';