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
    RewriteRule ^/modules/files(.+)\.fit-([0-9]+)x([0-9]+)\.([a-zA-Z]{3,4})$ /modules/images/fit/$2/$3/?path=/modules/files$1\.$4 [R,L]
    RewriteCond %{DOCUMENT_ROOT}/application/webroot%{REQUEST_URI} !-f
    RewriteRule ^/modules/files(.+)\.max-([0-9]+)\.([a-zA-Z]{3,4})$ /modules/images/max/$2/?path=/modules/files$1\.$3 [R,L]
    RewriteCond %{DOCUMENT_ROOT}/application/webroot%{REQUEST_URI} !-f
    RewriteRule ^/modules/files(.+)\.min-([0-9]+)\.([a-zA-Z]{3,4})$ /modules/images/min/$2/?path=/modules/files$1\.$3 [R,L]
    RewriteCond %{DOCUMENT_ROOT}/application/webroot%{REQUEST_URI} !-f
    RewriteRule ^/modules/files(.+)\.squ-([0-9]+)\.([a-zA-Z]{3,4})$ /modules/images/square/$2/?path=/modules/files$1\.$3 [R,L]

```

