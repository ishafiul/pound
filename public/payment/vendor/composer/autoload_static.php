<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9f4978125f1bf32d7d5ee7411ddc95a1
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/vendor',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/vendor',
        '9c67151ae59aff4788964ce8eb2a0f43' => __DIR__ . '/vendor',
        '8cff32064859f4559445b89279f3199c' => __DIR__ . '/vendor',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/vendor',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/vendor',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/vendor',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/vendor',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/vendor',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\HttpFoundation\\' => 33,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'O' => 
        array (
            'Omnipay\\PayPal\\' => 15,
            'Omnipay\\Common\\' => 15,
        ),
        'M' => 
        array (
            'Money\\' => 6,
        ),
        'H' => 
        array (
            'Http\\Promise\\' => 13,
            'Http\\Message\\' => 13,
            'Http\\Discovery\\' => 15,
            'Http\\Client\\' => 12,
            'Http\\Adapter\\Guzzle7\\' => 21,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'C' => 
        array (
            'Clue\\StreamFilter\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Symfony\\Component\\HttpFoundation\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Omnipay\\PayPal\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Omnipay\\Common\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Money\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Http\\Promise\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Http\\Message\\' => 
        array (
            0 => __DIR__ . '/vendor',
            1 => __DIR__ . '/vendor',
        ),
        'Http\\Discovery\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Http\\Client\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Http\\Adapter\\Guzzle7\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
        'Clue\\StreamFilter\\' => 
        array (
            0 => __DIR__ . '/vendor',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/vendor',
        'Composer\\InstalledVersions' => __DIR__ . '/vendor',
        'Omnipay\\Omnipay' => __DIR__ . '/vendor',
        'Stringable' => __DIR__ . '/vendor',
        'UnhandledMatchError' => __DIR__ . '/vendor',
        'ValueError' => __DIR__ . '/vendor',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9f4978125f1bf32d7d5ee7411ddc95a1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9f4978125f1bf32d7d5ee7411ddc95a1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9f4978125f1bf32d7d5ee7411ddc95a1::$classMap;

        }, null, ClassLoader::class);
    }
}