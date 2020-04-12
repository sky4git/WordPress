<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf7ca495e2b3343ce561631def1960fe3
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'b067bc7112e384b61c701452d53a14a8' => __DIR__ . '/..' . '/mtdowling/jmespath.php/src/JmesPath.php',
        '8a9dc1de0ca7e01f3e08231539562f61' => __DIR__ . '/..' . '/aws/aws-sdk-php/src/functions.php',
        'db1766888a4f96ab813d6f6a38125eb9' => __DIR__ . '/..' . '/philipnewcomer/wp-ajax-helper/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Cache\\' => 10,
            'PhilipNewcomer\\WP_Ajax_Helper\\' => 30,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'J' => 
        array (
            'JmesPath\\' => 9,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
            'Google\\Cloud\\Storage\\' => 21,
            'Google\\Cloud\\Core\\' => 18,
            'Google\\CRC32\\' => 13,
            'Google\\Auth\\' => 12,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'A' => 
        array (
            'Aws\\' => 4,
            'Appsero\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'PhilipNewcomer\\WP_Ajax_Helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/philipnewcomer/wp-ajax-helper/src/components',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'JmesPath\\' => 
        array (
            0 => __DIR__ . '/..' . '/mtdowling/jmespath.php/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Google\\Cloud\\Storage\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/cloud-storage/src',
        ),
        'Google\\Cloud\\Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/cloud-core/src',
        ),
        'Google\\CRC32\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/crc32/src',
        ),
        'Google\\Auth\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/auth/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'Aws\\' => 
        array (
            0 => __DIR__ . '/..' . '/aws/aws-sdk-php/src',
        ),
        'Appsero\\' => 
        array (
            0 => __DIR__ . '/..' . '/appsero/client/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Rize\\UriTemplate' => 
            array (
                0 => __DIR__ . '/..' . '/rize/uri-template/src',
            ),
        ),
    );

    public static $classMap = array (
        'w2cloud_AWS_Process' => __DIR__ . '/../..' . '/admin/channels/class-w2cloud-aws-process.php',
        'w2cloud_Abstract_Modules' => __DIR__ . '/../..' . '/admin/views/modules/class-w2cloud-abstract-modules.php',
        'w2cloud_Admin' => __DIR__ . '/../..' . '/admin/class-w2cloud-admin.php',
        'w2cloud_DO_Process' => __DIR__ . '/../..' . '/admin/channels/class-w2cloud-do-process.php',
        'w2cloud_GCS_Process' => __DIR__ . '/../..' . '/admin/channels/class-w2cloud-gcs-process.php',
        'w2cloud_Module_Integration_Manager' => __DIR__ . '/../..' . '/admin/views/class-w2cloud-module-integration-manager.php',
        'w2cloud_Process' => __DIR__ . '/../..' . '/admin/channels/abstract-class-w2cloud-process.php',
        'w2cloud_Rest_Api' => __DIR__ . '/../..' . '/admin/APIs/class-w2cloud-rest-api.php',
        'w2cloud_amazon_media_check' => __DIR__ . '/../..' . '/admin/views/modules/amazon-media-check/class-w2cloud-module-amazon-media-check.php',
        'w2cloud_aws' => __DIR__ . '/../..' . '/admin/views/modules/amazon-s3/class-w2cloud-module-aws.php',
        'w2cloud_aws_sync' => __DIR__ . '/../..' . '/admin/views/modules/aws-media-offload/class-w2cloud-module-aws-sync.php',
        'w2cloud_compatibility' => __DIR__ . '/../..' . '/admin/views/modules/compatibility/class-w2cloud-module-compatibility.php',
        'w2cloud_dashboard' => __DIR__ . '/../..' . '/admin/views/modules/dashboard/class-w2cloud-module-dashboard.php',
        'w2cloud_do' => __DIR__ . '/../..' . '/admin/views/modules/do-space/class-w2cloud-module-do.php',
        'w2cloud_do_sync' => __DIR__ . '/../..' . '/admin/views/modules/do-sync/class-w2cloud-module-do-sync.php',
        'w2cloud_file' => __DIR__ . '/../..' . '/admin/views/modules/file-url/class-w2cloud-module-file.php',
        'w2cloud_gcs' => __DIR__ . '/../..' . '/admin/views/modules/google-cloud-storage/class-w2cloud-module-gcs.php',
        'w2cloud_gcs_media_check' => __DIR__ . '/../..' . '/admin/views/modules/google-cloud-media-check/class-w2cloud-module-gcs-media-check.php',
        'w2cloud_gcs_sync' => __DIR__ . '/../..' . '/admin/views/modules/gcs-media-offload/class-w2cloud-module-gcs-sync.php',
        'w2cloud_general' => __DIR__ . '/../..' . '/admin/views/modules/general-info/class-w2cloud-module-general.php',
        'w2cloud_media' => __DIR__ . '/../..' . '/admin/views/modules/media-library-template/class-w2cloud-module-media.php',
        'w2cloud_media_control' => __DIR__ . '/../..' . '/admin/class-w2cloud-media-control.php',
        'w2cloud_setting' => __DIR__ . '/../..' . '/admin/views/modules/settings/class-w2cloud-module-settings.php',
        'w2cloud_storage' => __DIR__ . '/../..' . '/admin/views/modules/google-cloud-setting-storage/class-w2cloud-module-storage.php',
        'w2cloud_support' => __DIR__ . '/../..' . '/admin/views/modules/support/class-w2cloud-module-support.php',
        'w2cloud_syncs' => __DIR__ . '/../..' . '/admin/views/modules/sync-template/class-w2cloud-module-sync.php',
        'w2cloud_wizard' => __DIR__ . '/../..' . '/admin/views/modules/setup-wizard/class-w2cloud-module-wizard.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf7ca495e2b3343ce561631def1960fe3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf7ca495e2b3343ce561631def1960fe3::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf7ca495e2b3343ce561631def1960fe3::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf7ca495e2b3343ce561631def1960fe3::$classMap;

        }, null, ClassLoader::class);
    }
}
