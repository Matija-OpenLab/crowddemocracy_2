<?php return array (
  '*::app' => 
  array (
    'debug' => true,
    'name' => 'October CMS',
    'url' => 'http://localhost',
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:oDIfYA7QZwLXEACz56CZtKCzqFJkWCKdMHg0wE1Ejng=',
    'cipher' => 'AES-256-CBC',
    'log' => 'single',
    'providers' => 
    array (
      0 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      1 => 'Illuminate\\Bus\\BusServiceProvider',
      2 => 'Illuminate\\Cache\\CacheServiceProvider',
      3 => 'Illuminate\\Cookie\\CookieServiceProvider',
      4 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      5 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      6 => 'Illuminate\\Hashing\\HashServiceProvider',
      7 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      8 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      9 => 'Illuminate\\Queue\\QueueServiceProvider',
      10 => 'Illuminate\\Redis\\RedisServiceProvider',
      11 => 'Illuminate\\Session\\SessionServiceProvider',
      12 => 'Illuminate\\Validation\\ValidationServiceProvider',
      13 => 'Illuminate\\View\\ViewServiceProvider',
      14 => 'Laravel\\Tinker\\TinkerServiceProvider',
      15 => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      16 => 'October\\Rain\\Database\\DatabaseServiceProvider',
      17 => 'October\\Rain\\Halcyon\\HalcyonServiceProvider',
      18 => 'October\\Rain\\Filesystem\\FilesystemServiceProvider',
      19 => 'October\\Rain\\Parse\\ParseServiceProvider',
      20 => 'October\\Rain\\Html\\HtmlServiceProvider',
      21 => 'October\\Rain\\Html\\UrlServiceProvider',
      22 => 'October\\Rain\\Network\\NetworkServiceProvider',
      23 => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
      24 => 'October\\Rain\\Flash\\FlashServiceProvider',
      25 => 'October\\Rain\\Mail\\MailServiceProvider',
      26 => 'October\\Rain\\Argon\\ArgonServiceProvider',
      27 => 'System\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Db' => 'Illuminate\\Support\\Facades\\DB',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Url' => 'Illuminate\\Support\\Facades\\URL',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Model' => 'October\\Rain\\Database\\Model',
      'Block' => 'October\\Rain\\Support\\Facades\\Block',
      'File' => 'October\\Rain\\Support\\Facades\\File',
      'Config' => 'October\\Rain\\Support\\Facades\\Config',
      'Seeder' => 'October\\Rain\\Database\\Updates\\Seeder',
      'Flash' => 'October\\Rain\\Support\\Facades\\Flash',
      'Form' => 'October\\Rain\\Support\\Facades\\Form',
      'Html' => 'October\\Rain\\Support\\Facades\\Html',
      'Http' => 'October\\Rain\\Support\\Facades\\Http',
      'Str' => 'October\\Rain\\Support\\Facades\\Str',
      'Markdown' => 'October\\Rain\\Support\\Facades\\Markdown',
      'Yaml' => 'October\\Rain\\Support\\Facades\\Yaml',
      'Ini' => 'October\\Rain\\Support\\Facades\\Ini',
      'Twig' => 'October\\Rain\\Support\\Facades\\Twig',
      'DbDongle' => 'October\\Rain\\Support\\Facades\\DbDongle',
      'Schema' => 'October\\Rain\\Support\\Facades\\Schema',
      'Cms' => 'Cms\\Facades\\Cms',
      'Backend' => 'Backend\\Facades\\Backend',
      'BackendMenu' => 'Backend\\Facades\\BackendMenu',
      'BackendAuth' => 'Backend\\Facades\\BackendAuth',
      'AjaxException' => 'October\\Rain\\Exception\\AjaxException',
      'SystemException' => 'October\\Rain\\Exception\\SystemException',
      'ApplicationException' => 'October\\Rain\\Exception\\ApplicationException',
      'ValidationException' => 'October\\Rain\\Exception\\ValidationException',
    ),
  ),
  '*::cms' => 
  array (
    'activeTheme' => 'demo',
    'edgeUpdates' => false,
    'backendUri' => 'backend',
    'backendForceSecure' => NULL,
    'backendForceRemember' => true,
    'backendTimezone' => 'UTC',
    'backendSkin' => 'Backend\\Skins\\Standard',
    'runMigrationsOnLogin' => NULL,
    'loadModules' => 
    array (
      0 => 'System',
      1 => 'Backend',
      2 => 'Cms',
    ),
    'disableCoreUpdates' => false,
    'disablePlugins' => 
    array (
    ),
    'enableRoutesCache' => false,
    'urlCacheTtl' => 10,
    'parsedPageCacheTTL' => 10,
    'enableAssetCache' => false,
    'enableAssetMinify' => NULL,
    'enableAssetDeepHashing' => NULL,
    'databaseTemplates' => false,
    'pluginsPath' => '/plugins',
    'themesPath' => '/themes',
    'storage' => 
    array (
      'uploads' => 
      array (
        'disk' => 'local',
        'folder' => 'uploads',
        'path' => '/storage/app/uploads',
        'temporaryUrlTTL' => 3600,
      ),
      'media' => 
      array (
        'disk' => 'local',
        'folder' => 'media',
        'path' => '/storage/app/media',
      ),
    ),
    'convertLineEndings' => false,
    'linkPolicy' => 'detect',
    'defaultMask' => 
    array (
      'file' => NULL,
      'folder' => NULL,
    ),
    'enableSafeMode' => NULL,
    'enableCsrfProtection' => true,
    'forceBytecodeInvalidation' => true,
    'enableTwigStrictVariables' => false,
    'restrictBaseDir' => true,
    'enableBackendServiceWorkers' => false,
  ),
  '*::cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\laragon\\www\\crowddemocracy\\storage\\framework/cache',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'october',
    'codeParserDataCacheKey' => 'cms-php-file-data',
    'disableRequestCache' => NULL,
  ),
  '*::view' => 
  array (
    'paths' => 
    array (
    ),
    'compiled' => 'C:\\laragon\\www\\crowddemocracy\\storage\\framework\\views',
  ),
  '*::database' => 
  array (
    'fetch' => 8,
    'default' => 'sqlite',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'storage/database.sqlite',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'engine' => 'InnoDB',
        'host' => 'localhost',
        'port' => 3306,
        'database' => 'storage/database.sqlite',
        'username' => '',
        'password' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'varcharmax' => 191,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => 5432,
        'database' => 'storage/database.sqlite',
        'username' => '',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'port' => 5432,
        'database' => 'storage/database.sqlite',
        'username' => '',
        'password' => '',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'cluster' => false,
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => '',
        'port' => '6379',
        'database' => 0,
      ),
    ),
    'useConfigForTesting' => false,
  ),
  '*::filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\laragon\\www\\crowddemocracy\\storage\\app',
        'url' => '/storage/app',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => 'your-key',
        'secret' => 'your-secret',
        'region' => 'your-region',
        'bucket' => 'your-bucket',
      ),
      'rackspace' => 
      array (
        'driver' => 'rackspace',
        'username' => 'your-username',
        'key' => 'your-key',
        'container' => 'your-container',
        'endpoint' => 'https://identity.api.rackspacecloud.com/v2.0/',
        'region' => 'IAD',
      ),
    ),
  ),
  '*::tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
