<?php

require_once __DIR__.'/vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';
require __DIR__.'/vendor/silex/autoload.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'               => __DIR__.'/vendor',
    'Knp\\Silex'            => array(
                                __DIR__.'/Doctrine/src',
                                __DIR__.'/DoctrineMongoDB/src',
                            ),
    'SilexServiceProviders' => __DIR__,
));
$loader->register();
