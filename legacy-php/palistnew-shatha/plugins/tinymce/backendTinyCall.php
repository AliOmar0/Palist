<script src="<?=url?>plugins/tinymce/tinymce.min.js<?=clearCache()?>"></script>

<script src="<?=url?>plugins/tinymce/tinymce.min.js<?=clearCache()?>"></script>

<?php if(super()){?>
  
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js" data-manual></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.22.0/components/prism-markup-templating.min.js" integrity="sha512-TbMpeuT8rHP3DrAX8tSkpspYIT3It0fypBn5XaSp+Hiy3n9wvPFjd3pal7YtesrphulbmxcLNB9E0sq7xDGtWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-css.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-dart.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-swift.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-kotlin.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
  <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>


<?php }?>

<script type="text/javascript">
  function initiateMCE() {
    tinymce.init({
      
      branding: false,
      <?php if (super()) { ?>
        codesample_global_prismjs: true,
    
      <?php }?>

      codesample_languages: [
    { text: 'HTML/XML', value: 'markup' },
    { text: 'JavaScript', value: 'javascript' },
    { text: 'CSS', value: 'css' },
    { text: 'PHP', value: 'php' },
    { text: 'Python', value: 'python' },
      
    <?php if(super()){?>
    { text: 'Swift', value: 'swift' },
    { text: 'Kotlin', value: 'kotlin' },
    { text: 'Dart', value: 'dart' },
    { text: 'Bash', value: 'bash' }
    <?php }?>
  ],



      // keep_styles: false,
      // inline:false,
      init_instance_callback: function(editor) {
        if (typeof tinyIsReady === 'function') {
          $(function(){
            tinyIsReady();
          });
        }
        
        editor.on('KeyDown', function(e) {
          
          if (e.keyCode == 27) {
            let editor = tinyMCE.activeEditor
            const dom = editor.dom
            const parentBlock = tinyMCE.activeEditor.selection.getSelectedBlocks()[0]
            const containerBlock = parentBlock.parentNode.nodeName == 'BODY' ? dom.getParent(parentBlock, dom.isBlock) : dom.getParent(parentBlock.parentNode, dom.isBlock)
            let newBlock = tinyMCE.activeEditor.dom.create('p')
            newBlock.innerHTML = '<br data-mce-bogus="1">';
            dom.insertAfter(newBlock, containerBlock)
            let rng = dom.createRng();
            newBlock.normalize();
            rng.setStart(newBlock, 0);
            rng.setEnd(newBlock, 0);
            editor.selection.setRng(rng);
          }
        });
      },

      browser_spellcheck: true,

      image_advtab: true,
      content_css: "<?= fres ?>css/fonts.css<?=clearCache()?>",
      font_family_formats: "<?php $h = db('fonts_1582219344');
                      if ($h != 1) {
                        foreach ($h as $font) {
                          echo $font['css_name'] . '=' . $font['css_name'] . ';';
                        }
                      } ?>Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",

      font_size_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt 50pt 72pt 90pt",

      image_prepend_url: '<?=u?>',
      image_title: true,

      <?php if (isset($userInfoArr) && $userInfoArr['dark_mode']) { ?>
        skin: "oxide-dark",
        content_css: "dark",
      <?php } ?>


      style_formats_merge: true,
      style_formats: [{
        title: 'Pro',
        items: [{
            title: 'English Number (bidi)',
            selector: '*',
            classes: 'bidi'
          },
          //			      { title: 'Badge', in: 'span', classes: 'bidi'
          ////				   styles: { display: 'in-block', border: '1px solid #2276d2', 'border-radius': '5px', padding: '2px 5px', margin: '0 2px', color: '#2276d2' }
          //				  },
        ]
      }, ],

      selector: "textarea:not(.mceNoEditor)",
      <?php if (curr() == 'ar') { ?>
        language: 'ar',
        directionality: 'rtl',
      <?php } ?>
      images_upload_url: '<?= urlPanel; ?>uploader.php',
      images_upload_base_path: '<?= uploads_link; ?>',
      relative_urls: false,

      setup: function(editor) {
        //alert('This function runs when TinyMCE has fully loaded.');
        editor.on('change', function() {
          editor.save();
          //language plugin by provision
          change_lang_values(this.id,'mce');
        });

      },
      toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent lineheight| link openlink unlink media table image codesample',
      toolbar2: 'forecolor backcolor emoticons fontfamily fontsize | ltr rtl | removeformat visualchars visualblocks loremipsum loremipsumar| searchreplace | fullscreen code  preview help',

      removeformat_selector: 'b,strong,em,i,span,ins,div',


     



      color_cols: 10,
      color_map: [
        '#BFEDD2', 'Light Green',
        '#FBEEB8', 'Light Yellow',
        '#F8CAC6', 'Light Red',
        '#ECCAFA', 'Light Purple',
        '#C2E0F4', 'Light Blue',

        '#2DC26B', 'Green',
        '#F1C40F', 'Yellow',
        '#E03E2D', 'Red',
        '#B96AD9', 'Purple',
        '#3598DB', 'Blue',

        '#169179', 'Dark Turquoise',
        '#E67E23', 'Orange',
        '#BA372A', 'Dark Red',
        '#843FA1', 'Dark Purple',
        '#236FA1', 'Dark Blue',

        '#ECF0F1', 'Light Gray',
        '#CED4D9', 'Medium Gray',
        '#95A5A6', 'Gray',
        '#7E8C8D', 'Dark Gray',
        '#34495E', 'Navy Blue',

        '#000000', 'Black',
        '#ffffff', 'White',
        <?php $colors = db('color_palette_1645099749');
        if ($colors != 1 && $colors != 0) {
        ?> '#ffffff', 'White',
          '<?= $settings['main_color'] ?>', '<?= l('Main Color<>اللون الرئيسي') ?>',
        <?php
          foreach ($colors as $color) {
            echo "'" . $color['color'] . "','" . l($color['name']) . "',";
          }
        }
        ?> '#ffffff', 'White',
      ],

      promotion: false,
      min_height: 400,
      width: '100%',
      resize: 'both',
      plugins: [
        'lists', 'autoresize', 'preview', 'media', 'emoticons', 'directionality', 'fullscreen', 'code', 'wordcount', 'help', 'searchreplace', 'advlist', 'link', 'table', 'visualchars', 'visualblocks', 'image', 'loremipsum', 'loremipsumar', 'emoticons', 'codesample'
      ],
      paste_data_images: true,

      paste_as_text: true,

      file_picker_callback: function(callback, value, meta) {
        if (meta['filetype'] == 'file' || meta['filetype'] == 'media') allowedFiles = 'true';
        else allowedFiles = 'false';
        tinymce.activeEditor.windowManager.openUrl({
          title: '<?= l('File Manager<>ادارة الملفات') ?>',
          url: "<?= url ?>plugins/tinymce/filebrowser.php?multi=false&tiny=true&allowedFiles=" + allowedFiles,
          onMessage: function(api, data) {
            if (data.mceAction === 'photo_inserter_caller') {
              callback(data.url, {
                alt: data.desc
              });
              api.close();
            }
          }
        });
      },

      link_list: [{
          title: '<?= l('Home Page<>الصفحة الرئيسية') ?>',
          value: '<?= url ?>'
        },
        {
          title: '<?= l('ProVision<>بروفجن') ?>',
          value: 'https://provision.ps/en'
        },

      ],

      link_assume_external_targets: true,
      link_class_list: [{
          title: '<?= l('None<>بدون') ?>',
          value: ''
        },
        {
          title: '<?= l('Button<>زر') ?>',
          value: 'btn'
        },

        {
          title: '<?= l('Anchor<>رابط') ?>',
          value: 'l_a'
        }

      ]

    });


  }


  

  initiateMCE();
</script>