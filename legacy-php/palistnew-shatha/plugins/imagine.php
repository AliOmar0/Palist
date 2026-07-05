<?php
include_once'../../panel/core/config.php';

if(!logged()) die('you are not signed in');
?>
<script src="<?=pres?>js/cropper.js"></script>
	<style>
canvas {
  display: block;
  width: 100%;
  height: auto;
}
</style>
	
<div class="container">
      <div id="mount" class="mount full"></div><!--
      --><div class="l_grid4">
          <div class="field">
            <input type="text" id="input-x" value="0"/>
            <label for="input-x">X</label>
          </div>
          <div class="field">
            <input type="text" id="input-y" value="0"/>
            <label for="input-x">Y</label>
          </div>
          <div class="field">
            <input type="text" id="input-width" value="0"/>
            <label for="input-x">Width</label>
          </div>
          <div class="field">
            <input type="text" id="input-height" value="0"/>
            <label for="input-x">Height</label>
          </div>

        <button id="swap-image">Swap image</button><!--
        --><button id="aspect-16-by-9">16:9 aspect ratio</button><!--
        --><button id="aspect-square">Square aspect ratio</button><!--
        --><button id="aspect-free">Free aspect ratio</button><!--
        --><button id="container-fit-to-image">Fit container to image</button><!--
        --><button id="container-square">Square container</button><!--
        --><button id="container-2-by-1">2:1 container</button><!--
        --><button id="change-background-colors">Change background colors</button>
      </div>
    </div>

    <script>
      var crop = tinycrop.create({
        parent: '#mount',
        image: '<?=u.$_GET['imagine']?>',
        bounds: {
          width: '100%',
          height: '50%'
        },
        // backgroundColors: ['#fff', '#f0f0f0'],
        selection: {
          // color: 'red',
          // activeColor: 'blue',
          // aspectRatio: 4 / 3,
          // minWidth: 200,
          // minHeight: 300
          // width: 400,
          // height: 500,
          // x: 100,
          // y: 500
        }
      });

      function getId(id) {
        return document.getElementById(id)
      }

      var inputX = getId('input-x');
      var inputY = getId('input-y');
      var inputWidth = getId('input-width');
      var inputHeight = getId('input-height');

      var buttonSwapImage = getId('swap-image');

      buttonSwapImage.addEventListener('click', function (e) {
        e.preventDefault()
        crop.setImage(
          crop.getImage().src !== 'images/landscape2.jpg' ?
            'images/landscape2.jpg' :
            'images/portrait.jpg'
        )
      });

      var buttonAspect16By9 = getId('aspect-16-by-9')
      buttonAspect16By9.addEventListener('click', function (e) {
        e.preventDefault()
        crop.setAspectRatio(16 / 9)
      });

      var buttonAspect1By1 = getId('aspect-square')
      buttonAspect1By1.addEventListener('click', function (e) {
        e.preventDefault()
        crop.setAspectRatio(1)
      });

      var buttonAspectFree = getId('aspect-free');
      buttonAspectFree.addEventListener('click', function (e) {
        e.preventDefault()
        crop.setAspectRatio(null)
      });

      var buttonContainerFitImage = getId('container-fit-to-image')
      buttonContainerFitImage.addEventListener('click', function (e) {
        e.preventDefault()
        crop.setBounds({width: '100%', height: 'auto'})
      })

      var buttonContainerSquare = getId('container-square')
      buttonContainerSquare.addEventListener('click', function (e) {
        e.preventDefault()
        crop.setBounds({width: '100%', height: '100%'})
      })

      var buttonContainer2By1 = getId('container-2-by-1')
      buttonContainer2By1.addEventListener('click', function (e) {
        e.preventDefault()
        crop.setBounds({width: '100%', height: '50%'})
      })

      var backgroundColorPreset = 0

      var buttonChangeBackgroundColors = getId('change-background-colors')
      buttonChangeBackgroundColors.addEventListener('click', function (e) {
        e.preventDefault()
        backgroundColorPreset = (backgroundColorPreset + 1) % 4
        switch (backgroundColorPreset) {
          case 0:
            crop.setBackgroundColors(['#ffffff', '#f0f0f0'])
            break
          case 1:
            crop.setBackgroundColors(['#000000', '#202020'])
            break
          case 2:
            crop.setBackgroundColors(['#38f'])
            break
          case 3:
            crop.setBackgroundColors(null)
            break
        }
      })

      function setInputsFromRegion (region) {
		  drawImageActualSize(region);
        inputX.value = region.x
        inputY.value = region.y
        inputWidth.value = region.width
        inputHeight.value = region.height
      }

      crop
        .on('start', function (region) {
          setInputsFromRegion(region)
        })
        .on('move', function (region) {
          setInputsFromRegion(region)
        })
        .on('resize', function (region) {
          setInputsFromRegion(region)
        })
        .on('change', function (region) {
          setInputsFromRegion(region)
        })
	  .on('end', function (region) {
               setInputsFromRegion(region);
});
		
		  function drawImageActualSize(region) {
			   var canvas = document.getElementById("myCanvas");
			   canvas.width = region.width;
				canvas.height = region.height;
			  var ctx = canvas.getContext("2d");
			  var img = $('<img src="<?=u.$_GET['imagine']?>"/>')[0];

			   ctx.drawImage(img, region.x, region.y, region.width, region.height, 0, 0, region.width, region.height);
	
				$('[name=canvas_field]').val(canvas.toDataURL("image/<?=end(explode('.',str_replace('jpg','jpeg',$_GET['imagine'])))?>"));
			  
                }
		
    </script>
	
	<?php echo form('canvas','canvas');?>
		<input type="hidden" name="canvas_field" value=""/>
		<input type="hidden" name="filename" value="<?=$_GET['imagine']?>"/>
	<?php echo endform()?>
	
<canvas id="myCanvas" <?=dn()?>></canvas>

<div id="omar"></div>