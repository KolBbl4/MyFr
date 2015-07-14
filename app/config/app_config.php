<?php
error_reporting(E_ALL);

$config = Config::instance();
// базовый uri
$config->set('base_uri', 'myfr.loc/') ;
// режим разработок 0-выкл 1-вкл
$config->set('dev_mode', 1);
//Лэйойт по умолчанию
$config->set('default_layout', 'default');
// выбор расширения для файла .
$config->set('view_ext', '.php');
//gzip сжатие 1 - вкл, 0 - выкл
$config->set ('gzip_output','1');
unset($config);

