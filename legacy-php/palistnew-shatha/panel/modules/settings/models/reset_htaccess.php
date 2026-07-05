<?php

trash(cms_dir.'.htaccess');
$myfile = fopen(cms_dir.'.htaccess', "w") or json(false,3);
	
$key=array_search($settings["language"],array_column($langArr,'id'));

if($settings['cms_folder']!='')$put=" /".$settings['cms_folder'];
else $put=' ';


$auto_lang=$legacy_default=$default=$linker=$legacy_lang=NULL;

if($settings['www']==0)
    $www='RewriteCond %{HTTP_HOST} ^www\. [NC,OR]
RewriteCond %{HTTPS} off
RewriteCond %{HTTP_HOST} ^(?:www\.)?(.+)$ [NC]
RewriteRule ^ https://%1%{REQUEST_URI} [R=301,NE]';
  else
    $www=NULL;



$resp=db('link_handler_1566934564',NULL,NULL,NULL,'all_entries,single,custom');

//lang
$lang_tmp=[];
foreach($langArr as $lang){
  $lang_tmp[]=$lang['prefix'];
}

$lang_imp=implode("|",$lang_tmp);

$lang="#language forcing if not in the url
# empty url -> redirect to ".$langArr[$key]['prefix']."/ (default language)
RewriteRule ^$ $put".$langArr[$key]['prefix']."/ [R=301,L]

# url is ONLY '/en' or '/ar' for example -> redirect to /en/ or /ar/ (adding slash)
RewriteRule ^(".$lang_imp.")$  ".$put."$1/ [R=301,L]

#default rewriters, this is where legion comes
RewriteRule ^([a-z]{2})/?$".$put."index.php [NC]";

//default
$default="#default basic rewrites, language is not important for these Files
RewriteRule ^app-ads.txt(.*)$ app-ads.txt [L,QSA,END]
RewriteRule ^apple-app-site-association(.*)$ apple-app-site-association.json [NC,L,END]
RewriteRule ^app(.*)$ ".$put."legion_app.php?device=all [L,QSA,END]
RewriteRule ^ios(.*)$ ".$put."legion_app.php?device=ios [L,QSA,END]
RewriteRule ^android(.*)$ ".$put."legion_app.php?device=android [L,QSA,END]";

//linker
$primary_slugs=[];
if($resp!=1){
  foreach($resp as $linker){
    if($linker['all_entries']!=NULL)$primary_slugs[]=$linker['all_entries'];
    if($linker['single']!=NULL)$primary_slugs[]=$linker['single'];
    if($linker['custom']!=NULL)$primary_slugs[]=$linker['custom'];
  }
  $linker_primary_slugs='('.implode("|",$primary_slugs).')';
  $linker="RewriteRule ^([a-z]{2})/$linker_primary_slugs/(.*)$".$put."$2.php [L,QSA,END]
RewriteRule ^([a-z]{2})/$linker_primary_slugs$".$put."$2.php [L,QSA,END]


#fix transition from old url lang structure to the new one
RewriteRule ^(.*)/(".$lang_imp.")$  ".$put."$2/$1 [R=301,L]
";
}

//errors
$errors="
RewriteRule ^error/(.*)/([a-zA-Z0-9]+)?$ ".$put."legion_$1.php?lang=$2 [L,QSA,END]
RewriteRule ^error/(.*) ".$put."legion_$1.php [L,QSA,END]";


$txt = 'RewriteEngine On
RewriteBase /
'.$www.'

'.$default.'

'.$legacy_lang.'

'.$lang.'

'.$auto_lang.'

'.$legacy_default.'

#custom htaccess
'.
file_get_contents(custom_dir.'htaccess.txt')
.'
'.

$linker		
.'



#error docs
'.$errors.'
ErrorDocument 404 '.($put==' '?'/':$put).'legion_404.php
ErrorDocument 403 '.($put==' '?'/':$put).'legion_403.php


DirectoryIndex index.html index.php

#security
Options -Indexes
IndexIgnore *
<Files "sftp.json">  
  Require all denied
</Files>

<IfModule mod_headers.c>
    #CSP policy, suggested to be dynamic from panel
    Header set Content-Security-Policy "default-src * data:  \'unsafe-eval\'  \'unsafe-inline\';"
    #prevent clickjacking
    Header always set X-FRAME-OPTIONS \'SAMEORIGIN\'
    #prevent xss attack
    Header set X-XSS-Protection \'0; mode=block\'
    #prevent mime type false predection
    Header set X-Content-Type-Options nosniff
    #force SSL
    Header set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" env=HTTPS
    #secure cookies, like PHPSESSID
    Header edit Set-Cookie ^(.*)$ $1;HttpOnly;Secure
</IfModule>

<IfModule mod_deflate.c>
  # Compress HTML, CSS, JavaScript, Text, XML and fonts
  AddOutputFilterByType DEFLATE application/javascript
  AddOutputFilterByType DEFLATE application/rss+xml
  AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
  AddOutputFilterByType DEFLATE application/x-font
  AddOutputFilterByType DEFLATE application/x-font-opentype
  AddOutputFilterByType DEFLATE application/x-font-otf
  AddOutputFilterByType DEFLATE application/x-font-truetype
  AddOutputFilterByType DEFLATE application/x-font-ttf
  AddOutputFilterByType DEFLATE application/x-javascript
  AddOutputFilterByType DEFLATE application/xhtml+xml
  AddOutputFilterByType DEFLATE application/xml
  AddOutputFilterByType DEFLATE font/opentype
  AddOutputFilterByType DEFLATE font/otf
  AddOutputFilterByType DEFLATE font/ttf
  AddOutputFilterByType DEFLATE image/svg+xml
  AddOutputFilterByType DEFLATE image/x-icon
  AddOutputFilterByType DEFLATE text/css
  AddOutputFilterByType DEFLATE text/html
  AddOutputFilterByType DEFLATE text/javascript
  AddOutputFilterByType DEFLATE text/plain
  AddOutputFilterByType DEFLATE text/xml
  AddOutputFilterByType DEFLATE application/json
 
  # Remove browser bugs (only needed for really old browsers)
  BrowserMatch ^Mozilla/4 gzip-only-text/html
  BrowserMatch ^Mozilla/4\.0[678] no-gzip
  BrowserMatch \bMSIE !no-gzip !gzip-only-text/html
  Header append Vary User-Agent
</IfModule>



<IfModule mod_expires.c>
  ExpiresActive on

# Perhaps better to whitelist expires rules? Perhaps.
  ExpiresDefault                          "access plus 1 year"

# Data
  ExpiresByType text/xml                  "access plus 0 seconds"
  ExpiresByType application/xml           "access plus 0 seconds"
  ExpiresByType application/json          "access plus 0 seconds"

# Favicon (cannot be renamed)
  ExpiresByType image/x-icon              "access plus 1 week"

# Media: images, video, audio
  ExpiresByType image/gif                 "access plus 1 year"
  ExpiresByType image/png                 "access plus 1 year"
  ExpiresByType image/jpeg                "access plus 1 year"
  ExpiresByType video/ogg                 "access plus 1 year"
  ExpiresByType audio/ogg                 "access plus 1 year"
  ExpiresByType video/mp4                 "access plus 1 year"
  ExpiresByType video/webm                "access plus 1 year"
  ExpiresByType image/webp 				  "access plus 1 year"

# Webfonts
  ExpiresByType application/x-font-ttf    "access plus 1 year"
  ExpiresByType font/opentype             "access plus 1 year"
  ExpiresByType application/x-font-woff   "access plus 1 year"
  ExpiresByType image/svg+xml             "access plus 1 year"
  ExpiresByType application/vnd.ms-fontobject "access plus 1 year"

# CSS and JavaScript
  ExpiresByType text/css                  "access plus 1 year"
  ExpiresByType application/javascript    "access plus 1 year"
  
 
</IfModule>

<FILESMATCH "croner.php$">
  order deny,allow
  deny from all
</FILESMATCH>
	';
			
	fwrite($myfile, $txt);
	fclose($myfile);


  
  
	autoMetaResetter();

	json(true,2,NULL,'Reset Successful');