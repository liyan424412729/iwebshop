<?php return array (
  'logs' => 
  array (
    'path' => 'backup/logs',
    'type' => 'file',
  ),
  'DB' => 
  array (
    'type' => 'mysqli',
    'tablePre' => 'iwebshop_',
    'read' => 
    array (
      0 => 
      array (
        'host' => '101.201.239.155:3306',
        'user' => 'root',
        'passwd' => 'root',
        'name' => 'iwebshop',
      ),
    ),
    'write' => 
    array (
      'host' => '101.201.239.155:3306',
      'user' => 'root',
      'passwd' => 'root',
      'name' => 'iwebshop',
    ),
  ),
  'interceptor' => 
  array (
    0 => 'themeroute@onCreateController',
    1 => 'layoutroute@onCreateView',
    2 => 'plugin',
  ),
  'langPath' => 'language',
  'viewPath' => 'views',
  'skinPath' => 'skin',
  'classes' => 'classes.*',
  'rewriteRule' => 'url',
  'theme' => 
  array (
    'pc' => 
    array (
      'huawei' => 'default',
      'sysdefault' => 'default',
      'sysseller' => 'default',
    ),
    'mobile' => 
    array (
      'mobile' => 'default',
      'sysdefault' => 'default',
      'sysseller' => 'default',
    ),
  ),
  'timezone' => 'Etc/GMT-8',
  'upload' => 'upload',
  'dbbackup' => 'backup/database',
  'safe' => 'cookie',
  'lang' => 'zh_sc',
  'debug' => '1',
  'configExt' => 
  array (
    'site_config' => 'config/site_config.php',
  ),
  'encryptKey' => 'd4ad7831d320cb4e19ebb7f418ed9d9b',
  'authorizeCode' => '',
  'uploadSize' => '10',
)?>