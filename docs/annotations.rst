Using annotations for Doctrine metadata
=======================================

Doctrine can read Entity/Document mapping metadata from docBlocks. You'll need then some extra configuration:

Put this somewhere in your bootstrap file, **after** having loaded your ``Doctrine*ServiceProvider``.
The order is important because of the automatic registration of doctrine classes autoloading.

If you have manually registered the autoloading of Doctrine files, you can put this whereveryou want **after** the autoload registration.


Registering
-----------

With Doctrine ORM you need to use:

.. code-block:: php

    use Doctrine\Common\Annotations\AnnotationRegistry;

    AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
        return class_exists($class, false);
    });
    AnnotationRegistry::registerFile(__DIR__.'/vendor/doctrine_orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');


With Doctrine ODM (MongoDB) you need to use:

.. code-block:: php

    use Doctrine\Common\Annotations\AnnotationRegistry;

    AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
        return class_exists($class, false);
    });
    AnnotationRegistry::registerFile(__DIR__.'/vendor/doctrine/common/lib/Doctrine/Common/Annotations/AnnotationRegistry.php');


Maybe you must change the file location to respect folder structure in your project.

With composer you need to get $loader with:

.. code-block:: php

    $loader = ComposerAutoloaderInit::getLoader();

