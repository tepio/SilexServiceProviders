DoctrineMongoDB
===============

The *DoctrineMongoDBServiceProvider* provides a default `Doctrine2 <http://www.doctrine-project.org>`_ MongoDB ODM Connection and an DocumentManager.


Registering
-----------

``` php

    use Knp\Silex\ServiceProvider\DoctrineMongoDBServiceProvider;

    $app->register(new DoctrineMongoDBServiceProvider(), array(
        'doctrine.odm.mongodb.connection_options' => array(,
            'database' => 'my_database_name',
            'host'     => 'localhost',
        )
    ));

    // if you want to autoload your documents, use the autoloader service:
    $app['autoloader']->registerNamespace('Document', __DIR__);

```

Parameters
----------

* **doctrine.odm.mongodb.connection_options**: an array of connection parameters for MongoDB connection of the form:

``` php

    'doctrine.odm.mongodb.connection_options' => array(
        'database' => 'my_database_name',
        'host'     => 'localhost',
    ),

```

This parameter provides options for the ``doctrine.mongodb.connection`` service.

* **doctrine.odm.mongodb.documents** (optional): an array of mapping configurations of the form:

``` php

    'doctrine.odm.mongodb.documents' => array(
        array('type' => 'yml', 'path' => '/path/to/yml/files', 'namespace' => 'My\\Document'),

        array('type' => 'annotation', 'path' => array(
            '/path/to/Documents',
            '/path/to/another/dir/for/the/same/namespace'
        ), 'namespace' => 'Document'),

        array('type' => 'annotation', 'path' => '/path/to/another/dir/with/documents', 'namespace' => 'Acme\\Document'),

        array('type' => 'xml', 'path' => '/path/to/xml/files', 'namespace' => 'Your\\Document')
    )
    
```

This is an advanced configuration example which replaces the default one:

``` php

    array('type' => 'annotation', 'path' => 'Document', 'namespace' => 'Document')

```

Default behavior will search annotated ``Documents`` in the ``Document`` directory.

* **doctrine.odm.mongodb.proxies_dir** (optional): Path to where the
  doctrine Proxies are generated. Default is ``cache/doctrine/odm/mongodb/Proxy``.

* **doctrine.odm.mongodb.proxies_namespace** (optional): Namespace of generated
  doctrine Proxies. Default is ``DoctrineMongoDBProxy``.

* **doctrine.orm.auto_generate_proxies** (optional): Tell Doctrine wether it should generate proxies automatically. Default is ``true``.

* **doctrine.odm.mongodb.class_path** (optional): Path to where the
  Doctrine\\ODM\\MongoDB library is located.

* **doctrine.common.class_path** (optional): Path to where the
  Doctrine\\Common library is located.

* **doctrine.mongodb.class_path** (optional): Path to where the
  Doctrine\\MongoDB library is located.

Services
--------

* **doctrine.mongodb.connection**: The ``Doctrine\MongoDB\Connection`` instance.
* **doctrine.odm.mongodb.configuration**: The ``Doctrine\ODM\MongoDB\Configuration`` instance
* **doctrine.odm.mongodb.dm**: The ``Doctrine\ODM\MongoDB\DocumentManager`` instance.


Usage
-----

* DocumentManager

``` php

    $category = $app['doctrine.odm.mongodb.dm']
        ->getRepository('Acme\Entity\Category')
        ->findOneBy(array('name' => 'Category A'));

```

* Event subscribers, Behaviors

This is an example of how to add a Timestampable behavior to Doctrine. ( http://gediminasm.org/article/timestampable-behavior-extension-for-doctrine-2 )

``` php

    // if you need autoloading of external lib
    $app['autoloader']->registerNamespace('Gedmo', __DIR__.'/vendor/Gedmo/DoctrineExtensions/lib');

    $timestampableListener = new \Gedmo\Timestampable\TimestampableListener(); 
    $app['doctrine.odm.mongodb.dm']->getEventManager()->addEventSubscriber($timestampableListener);

```

