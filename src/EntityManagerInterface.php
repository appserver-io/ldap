<?php

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
     * Returns the repository instance for the passed class.
     *
     * @param string $class The class name to return the repository for
     *
     * @return object The LDAP repository instance
     */
    public function getRepository($entityName);

    /**
     * Finds an entity by its identifier.
     *
     * @param string $entityName The class name of the entity to find
     * @param mixed  $id         The identity of the entity to find
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     *
     * @throws \Exception
     */
    public function find($entityName, $id);

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
}
