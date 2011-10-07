<?php

require_once __DIR__.'/vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'               => __DIR__.'/vendor',
    'Knp\\Silex'            => __DIR__.'/Doctrine/src',
    'SilexServiceProviders' => __DIR__,
));
$loader->register();
