<?php require('../../header.php');?>
		<link rel="stylesheet" type="text/css" href="<?= fres?>css/commerce.css<?php clearCache();?>" media="all"/>

	
<?php
        $application_id=escape($_GET['application_id']);
?>

<div id="bread">
	<div id="module_title" class="midinline">
		<i class="material-icons midinline">dashboard</i>


    <?php
      
      $resp=db('joining_request_form_8371',"WHERE id=$application_id AND deleted=0");
        $i=0;
      ?>


		<span class="midinline">Application# <?=$_GET['application_id']?> | <?=l(detail('users_8400','username','id',$resp[$i]['user']))?></span>
	</div>
</div>
	
	
	<div class="working_area"> 


	<div id="page_top"  data-aos="fade-left">
		<div  class="w1200">
			<h1 class="sec_head sec_normal"><?= l('Apllication Details')?></h1>
		</div>
	</div>

<section>
   
    
	<div class="w1200">

    <?php
      
      $resp=db('joining_request_form_8371',"WHERE id=$application_id AND deleted=0");
        $i=0;
      ?>
        
        <table class="c_table">

<thead>
        <th>user</th>
        <th>active</th>
        <th>submitted</th>
        <th>email_address</th>
        <th>full_name</th>
        <th>full_name_en</th>
        <th>Id Number</th>
        <th>gender</th>
        <th>Mobile Number</th>
        <th>palce_of_birth</th>
        <th>date_of_birth</th>
        <th>social_situation</th>
        <th>province_residence</th>
        <th>mother_province</th>
        <th>home_adress</th>
        <th>branch</th>
</thead>

    <tbody>
    
    <tr>
        <td>
        <?=l(detail('users_8400','username','id',$resp[$i]['user']))?>
        </td>

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
            <?=$resp[$i]['full_name']?>
        </td>

        <td>
            <?=$resp[$i]['full_name_en']?>
        </td>


        <td>
            <?=$resp[$i]['id_number']?>
        </td>

     
        <td>
             <?=l(detail('gender_8371','title','id',$resp[$i]['gender']))?>
        </td>

        <td>
            <?=$resp[$i]['mobile_number']?>
        </td>

        
        <td>
            <?=$resp[$i]['palce_of_birth']?>
        </td>

        <td>
           <?=$resp[$i]['date_of_birth']?>
        </td>

        <td>
              <?=l(detail('social_situation_8368','title','id',$resp[$i]['social_situation']))?>
        </td>


        <td>
           <?=l(detail('provinces_8371','title','id',$resp[$i]['province_residence']))?>
        </td>


        <td>
          <?=l(detail('provinces_8371','title','id',$resp[$i]['mother_province']))?>
        </td>

   


        <td>
            <?=$resp[$i]['home_adress']?>
        </td>

        <td>
        <?=l(detail('branch_8371','title','id',$resp[$i]['branch']))?>
        </td>

    </tr>
  
       
    </tbody>

    <tfoot>

		




    </tfoot>
</table>
		
		
		
		

	</div>
</section>

</div>



	
<div class="working_area"> 


<div id="page_top"  data-aos="fade-left">
  <div  class="w1200">
    <h1 class="sec_head sec_normal"><?= l('User Details')?></h1>
  </div>
</div>

<section>
 
  
<div class="w1200">

  <?php
    
    $resp=db('users_8400',"WHERE id=".$_SESSION['user_id']." AND deleted=0");
      $i=0;
    ?>
      
      <table class="c_table">

<thead>
      <th>user</th>
      <th>email_address</th>
      <th>gender</th>
      <th>Specialization</th>
      <th>Employment status</th>
      <th>Organization</th>
      <th>Bussiness Type</th>
      <th>Work Nature</th>

</thead>

  <tbody>
  
  <tr>
      <td>
      <?=$resp[$i]['username']?>
      </td>

      <td>
      <?=$resp[$i]['email_address']?>
      </td>

      <td>
      <?=l(detail('gender_8371','title','id',$resp[$i]['gender']))?>
      </td>

      <td>
   <!--<?php
    $comp=comp('users_8400',$resp[$i]['id'],'majors_8367');
    if($comp!=1){
        for($_z=0;$_z<count($comp);$_z++){
            $tmp=db('majors_8367',"WHERE id='".$comp[$_z]['child_id']."'",NULL,'LIMIT 1')[0]?>
            --><div class="list_comp_item in"><?=l($tmp['title'])?></div><!--
    <?php }
        }
    ?>-->
      </td>

      <td>
      <?=l(detail('employment_status_8368','title','id',$resp[$i]['employment_status']))?>
      </td>

      <td>
          <?=$resp[$i]['organisation']?>
      </td>

      <td>
      <?=l(detail('business_type_8368','title','id',$resp[$i]['business_type']))?>
      </td> 
   

      <td>
      <?=$resp[$i]['work_nature']?>
      </td>


  </tr>

     
  </tbody>

  <tfoot>

  </tfoot>
</table>
  
  
  
  

</div>
</section>

</div>



<Style>


.c_table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  box-shadow:unset;
  border-bottom: unset;
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