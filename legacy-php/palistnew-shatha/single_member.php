<?php require 'header.php';?>

<div class="single_member w1200">
<div class="single_member_photo"><?=pic($post['photo']);?></div>
<div class="single_member_name"><?=l($post['name']);?></div>
<div class="single_member_job_name"><?=l($post['job_name']);?></div>
<div class="single_member_content mce"><?=l($post['content']);?></div>

</div>

<?php require 'footer.php';?>