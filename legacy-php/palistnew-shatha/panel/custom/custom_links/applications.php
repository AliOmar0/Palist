<?php require('../../header.php');?>


<div id="bread">
	<div id="module_title" class="midinline">
		<i class="material-icons midinline">dashboard</i>
		<span class="midinline">Applications</span>
	</div>
</div>
	
	
	<div class="working_area"> 
		
	<?php
$resp=db('joining_request_form_8371');
if($resp==1){
?>
No Applications
<?php
}else{
?>


        <table class="c_table">
<thead>
    <th>Application ID</th>
    <th>Date Created</th>
	<th>User</th>
    <th>Active</th>
	<th>submitted</th>
    <th>Email Address</th>
	<th>Id Number</th>
    <th></th>
    </thead>

    <tbody>
  
    
    <?php
for($i=0;$i<count($resp);$i++){

    ?>
        <tr>
      
            
            <td>
                <?= $resp[$i]['id'];?>
            </td>
            
            <td>
              <?= cleanDate($resp[$i]['date_created'])?>
            </td>
			
			<td><?=l(detail('users_8400','username','id',$resp[$i]['user']))?></td>
            
            <td>
                 <?=$resp[$i]['active']?>
               
            </td>
			
			 <td>
                 <?=$resp[$i]['submitted']?>
            </td>
            
            <td>
              <?=$resp[$i]['email_address']?>
            </td>
            
			<td>
			<?=$resp[$i]['id_number']?>
			</td>
			
         
            <td>
                <a class="btn" href="<?= custom_links.'application.php?application_id='.$resp[$i]['id']?>" title="<?= l('View This Application<>استعرض هذا الطلب')?>">
                    <?= l('View This Application<>استعرض هذا الطلب')?>
                </a>
				
<!-- 				
				 <a class="btn" href="<?=urlPanel?>?module=orders_8357&action=edit&id=<?=$resp[$i]['id']?>">
                   <?= l('Modify Status<>تعديل هذا الطلب')?>
                </a> -->
				
            </td>
            
        </tr>
      <?php }?>
        
        
    </tbody>

</table>
		
		<?php }
		?>
</div>



<Style>


.c_table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.c_table td, .c_table th {
  border: 1px solid #EC6342;
  padding: 8px;
}

.c_table tr:nth-child(even){background-color: #EC6342;}


.c_table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #EC6342;
  color: white;
}
</style>


<?php require('../../footer.php')?>