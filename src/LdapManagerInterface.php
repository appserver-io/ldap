<?php

/**
 * AppserverIo\Ldap\LdapManagerInterface
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
 * The interface for a LDAP manager implementation.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
interface LdapManagerInterface
{

    /**
     * Unique identifier for the LDAP manager.
     *
     * @var string
     */
    const IDENTIFIER = 'LdapManagerInterface';

    /**
     * Runs a lookup for the entity with the passed lookup name.
     *
     * @param string $lookupName The lookpu name of the entity class
     *
     * @return object The requested entity instance
     */
    public function lookup($lookupName);

    /**
     * Lookup the LDAP repository for the entity with the passed lookup name.
     *
     * @param string $lookupName The lookup name of the entity to return the repository for
     * @param array  $args       The arguments passed to the repository's constructor
     *
     * @return object The repository instance
     * @throws \Exception Is thrown, if the requested instance is NO LDAP repository
     */
    public function lookupRepositoryByEntityName($lookupName, array $args = array());

    /**
     * Lookup the LDAP entity for the entity with the passed lookup name.
     *
     * @param string $lookupName The lookup name of the repository to return the entity for
     * @param array  $args       The arguments passed to the entity's constructor
     *
     * @return object The entity instance
     * @throws \Exception Is thrown, if the requested instance is NO LDAP entity
     */
    public function lookupEntityByRepositoryName($lookupName, array $args = array());

    /**
     * Returns the object descriptor for the repository with the passed class name.
     *
     * @param string $className The class name to return the object descriptor for
     *
     * @return \AppserverIo\Ldap\Description\RepositoryDescriptorInterface The requested repository descriptor instance
     */
    public function lookupDescriptorByClassName($className);
}
