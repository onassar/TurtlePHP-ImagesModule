TurtlePHP-ImagesModule
======================

Note to myself: I decoupled this from TurtlePHP-FilesModule to allow me to make
use of the image-manipulation routing regardless of whether it's through an
admin interface for file uploading, or user-based file uploading.

More flexible this way, for down the line :)

### Apache Rules

```
# images
RewriteCond %{DOCUMENT_ROOT}/application/webroot%{REQUEST_URI} !-f
RewriteRule ^<source>(.+)\.fit-([0-9]+)x([0-9]+)\.?([^.]+|)\.([a-zA-Z]{3,4})$ /modules/images/fit/$2/$3/?path=<source>$1\.$5&effect=$4 [R,L]
RewriteCond %{DOCUMENT_ROOT}/application/webroot%{REQUEST_URI} !-f
RewriteRule ^<source>(.+)\.max-([0-9]+)\.?([^.]+|)\.([a-zA-Z]{3,4})$ /modules/images/max/$2/?path=<source>$1\.$4&effect=$3 [R,L]
RewriteCond %{DOCUMENT_ROOT}/application/webroot%{REQUEST_URI} !-f
RewriteRule ^<source>(.+)\.min-([0-9]+)\.?([^.]+|)\.([a-zA-Z]{3,4})$ /modules/images/min/$2/?path=<source>$1\.$4&effect=$3 [R,L]
RewriteCond %{DOCUMENT_ROOT}/application/webroot%{REQUEST_URI} !-f
RewriteRule ^<source>(.+)\.squ-([0-9]+)\.?([^.]+|)\.([a-zA-Z]{3,4})$ /modules/images/square/$2/?path=<source>$1\.$4&effect=$3 [R,L]
```

In order for the above rules to function as you'd expect them to, change `<source>` to a path resembling `/content/uploads`.

Everything else should just work :)  
More to come on what these rules do, and the functionality of this module.

### Sample Requests

``` html
<img src="/path/to/image.jpg" />
<img src="/path/to/image.fit-100x200.jpg" />
<img src="/path/to/image.max-150.jpg" />
<img src="/path/to/image.min-75.jpg" />
<img src="/path/to/image.squ-48.jpg" />

<img src="/path/to/image.jpg" />
<img src="/path/to/image.fit-100x200.bw.jpg" />
<img src="/path/to/image.max-150.bw.jpg" />
<img src="/path/to/image.min-75.bw.jpg" />
<img src="/path/to/image.squ-48.bw.jpg" />
```

### Tips
I've only tested this with filenames that I could control. For example, alphanumeric, with no spaces or punctuation. I'm not sure if the rules above work under edge-cases (they should).

### Sample calls from init.init.php

``` php
require_once APP . '/plugins/TurtlePHP-ConfigPlugin/Config.class.php';
require_once APP . '/vendors/PHP-ImageHelper/Image.class.php';
require_once APP . '/vendors/PHP-ImagesEffects/Image.class.php';
require_once APP . '/modules/TurtlePHP-ImagesModule/includes/init.inc.php';
```
