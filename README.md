# appserver.io LDAP

This is a basic LDAP integration that provides a Doctrine ORM like functionality for LDAP handling.

## Data Source

To define a Data Source, simply add a XML file with a following structure to your application's `META-INF` directory

```xml
<?xml version="1.0" encoding="UTF-8"?>
<datasources xmlns="http://www.appserver.io/appserver">
    <datasource name="my-ldap-ds">
        <database>
            <driver>ext_ldap</driver>
            <user>cn=admin,dc=example,dc=org</user>
            <password>admin</password>
            <databaseName>dc=example,dc=org</databaseName>
            <databaseHost>127.0.0.1</databaseHost>
            <databasePort>389</databasePort>
        </database>
    </datasource>
</datasources>
```

## Persistence Manager

Configure the Persistence Manager in `META-INF/persistence.xml` like 

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persistence xmlns="http://www.appserver.io/appserver">
    <persistenceUnits>
        <persistenceUnit
            name="MyLdapEntityManager"
            interface="AppserverIo\Appserver\Ldap\EntityManagerInterface"
            type="AppserverIo\Appserver\Ldap\EntityManager"
            factory="AppserverIo\Appserver\Ldap\EntityManagerFactory">
            <datasource name="my-ldap-ds"/>
        </persistenceUnit>
    </persistenceUnits>
</persistence>
```

## Inject the Persistence Manager

The LDAP Persistence Manager can then be injected as a Doctrine Entity Manager, e. g.

```php

/**
 * TechDivision\Project\Repositories\Ldap\RoleRepositoryInterface
 */

namespace AppserverIo\MyProject;

/**
 * Dummy implementation of a LDAP repository.
 */
class DummyRepository
{

    /**
     * The Symfony LDAP adapter instance.
     *
     * @var \AppserverIo\Appserver\PersistenceContainer\Doctrine\DoctrineEntityManagerProxy
     * @EPB\PersistenceUnit(unitName="MyLdapEntityManager")
     */
    protected $ldapEntityManager;
}
```

## Persistence Manager Interface

The LDAP Persistence Manager provides the following interface which gives you access to your LDAP.

> ATTENTION: In version 2.x `persist()` and `remove()` methods has not yet been implemented.

```php

/**
 * AppserverIo\Ldap\EntityManagerInterface
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Ldap;

/**
 * The interface for all LDAP Entity Manager implementations.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
interface EntityManagerInterface
{

    /**
     * Returns the LDAP client instance.
     *
     * @return \AppserverIo\Ldap\LdapClientInterface The LDAP client instance
     */
    public function getLdapClient();

    /**
     * Returns the persistence unit configuration instance.
     *
     * @return \AppserverIo\Description\Configuration\PersistenceUnitConfigurationInterface The configuration instance
     */
    public function getConfiguration();

    /**
     * Returns the base DN => database in datasource configuration.
     *
     * @return string The base DN
     */
    public function getBaseDn();

    /**
     * Returns the repository instance for the entity with the passed lookup name.
     *
     * @param string $lookupName The lookup name of the entity to return the repository for
     *
     * @return object The LDAP repository instance
     */
    public function getRepository($lookupName);

    /**
     * Finds an entity by its lookup name.
     *
     * @param string $lookupName The look name of the entity to find
     * @param mixed  $id         The identity of the entity to find
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     *
     * @throws \Exception
     */
    public function find($lookupName, $id);

    /**
     * Tells the EntityManager to make an instance managed and persistent.
     *
     * The entity will be entered into the database at or before transaction
     * commit or as a result of the flush operation.
     *
     * NOTE: The persist operation always considers entities that are not yet known to
     * this EntityManager as NEW. Do not pass detached entities to the persist operation.
     *
     * @param object $entity The instance to make managed and persistent
     *
     * @return void
     * @throws \Exception
     */
    public function persist($entity);

    /**
     * Removes an entity instance.
     *
     * A removed entity will be removed from the database at or before transaction commit
     * or as a result of the flush operation.
     *
     * @param object $entity The entity instance to remove
     *
     * @return void
     * @throws \Exception
     */
    public function remove($entity);
```
