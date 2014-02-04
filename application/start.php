<?php

/* system */
include_once __root.'application/system/Bootstrip.php';
include_once __root.'application/system/controller.php';
include_once __root.'application/system/model.php';
include_once __root.'application/system/load.php';

/* lib */ 
include_once __root.'application/lib/recaptchalib.php';
include_once __root.'application/lib/functions.php'; 
include_once __root.'application/lib/phpMyGraph5.0.php';
include_once __root.'application/lib/getimage.php';
include_once __root.'application/lib/validation.php';
include_once __root.'application/lib/cache.php';
include_once __root.'application/lib/export.php';
include_once __root.'application/lib/cep.php';
/* email */
include_once __root.'application/lib/mime_parser.php'; 
include_once __root.'application/lib/pop3.php'; 
include_once __root.'application/lib/rfc822_addresses.php'; 
include_once __root.'application/lib/randon.php';
include_once __root.'application/lib/captcha_numbersV2.php';
include_once __root.'application/lib/UploadHandler.php';

/* this is for echange collection of data */
include_once __root.'application/class_http/class_http.php';
include_once __root.'application/class_xml/class_xml.php';

/* this is db */
include_once __root.'application/db/mysql.php';
include_once __root.'application/db/mysqli.php';

/* pagination */
include_once __root.'application/pagination/Pagination.class.php';
/* soap */
//include_once __root.'application/soap/nusoap.php';
