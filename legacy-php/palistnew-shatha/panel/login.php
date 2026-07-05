<link rel="stylesheet" href="<?=pres?>css/login.css"/>
<div id="login_bg_wrap">
	<?php if($settings['login']!=NULL){?><div id="login_bg" <?=bg($settings['login'])?>></div><?php }?>
</div>
<div class="login_wrap l_vh l_vw">
	<div class="l_par">
		<div class="l_ch">
<div id="login" class="login-page">
	
  <div class="form">
    <form action="" class="login-form" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
	<div id="login_logo">
		<img src="<?=u.$settings['logo']?>"  width="auto" height="auto"/>
		</div>
		
	<div id="login_title"><?=l($settings['site_name'])?></div>
		
      <input required type="text" name="username" placeholder="<?=l('Username<>اسم المستخدم')?>"/>
      <input required type="password" name="password" placeholder="<?=l('Password<>كلمة المرور')?>"/>
		<clear></clear>
		<div id="rem_block">
			<input id="checkboxid" class="css-checkbox mid"  type="checkbox" name="rememberme" /><label class="mid" for="checkboxid"></label>
			<label for="checkboxid" class="mid po"><?= l('Remember Me<>تذكرني');?></label>
	</div>
		<clear></clear>
		
		
      <input type="hidden" value="" name="e"/>
     
    <input type="hidden" name="type" value="login"/> 
      <button <?php if($settings['login']!=NULL){?>style="background:var(--mainColor);"<?php }?>><?=l('login<>دخول')?></button>
    </form>
	  
	  <a class="go_main" href="<?=url?>" title="<?=l($settings['site_name'])?>"><?=l('Go to the main site<>اذهب الى الموقع')?></a>
	
	<a class="powered" target="_blank" href="<?=$legion['provision']['website_link']?>" title="<?=$legion['provision']['name']?>"><span><?=l($legion['by'].'<>'.'برمجة ')?></span><div class="power_provision"><?=$legion['provision']['name']?></div></a>
	  
  </div>
</div>
	</div>
	</div>
</div>
<script>
$(function(){
(function() {
    // Add event listener
    document.addEventListener("mousemove", parallax);
    const elem = document.querySelector("#login_bg");
    // Magic happens here
    function parallax(e) {
        let _w = window.innerWidth/2;
        let _h = window.innerHeight/2;
        let _mouseX = e.clientX;
        let _mouseY = e.clientY;
//        let _depth1 = `${50 - (_mouseX - _w) * 0.01}% ${50 - (_mouseY - _h) * 0.01}%`;
//        let _depth2 = `${50 - (_mouseX - _w) * 0.02}% ${50 - (_mouseY - _h) * 0.02}%`;
//        let _depth3 = `${50 - (_mouseX - _w) * 0.06}% ${50 - (_mouseY - _h) * 0.06}%`;
//        let x = `${_depth3}, ${_depth2}, ${_depth1}`;
//        let x = `${_depth1}`;
//        console.log(x);
        $('#login_bg').css('left',-10 - (_mouseX - _w) * 0.002 + '%');
        $('#login_bg').css('top',-10 - (_mouseY - _h) * 0.002 + '%');
    }

})();
});
</script>

<?php require 'footer.php';?>