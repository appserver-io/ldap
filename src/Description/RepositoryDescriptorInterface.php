<?php

/**
 * AppserverIo\Ldap\Description\RepositoryDescriptorInterface
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
 * @copyright 2019 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Ldap\Description;

use AppserverIo\Psr\EnterpriseBeans\Description\BeanDescriptorInterface;

/**
 * Interface for LDAP repository descriptor implementations.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2019 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
interface RepositoryDescriptorInterface extends LdapDescriptorInterface, BeanDescriptorInterface
{

    /**
     * Returns the distinguished name of the repository.
     *
     * @return string The repository's distinguished name
     */
    public function getDistinguishedName();

    /**
     * Returns the array with the repository's queries.
     *
     * @return array The array with the queries
     */
    public function getQueries();

    /**
     * Adds the passed query to the descriptor.
     *
     * @param \AppserverIo\Ldap\Description\QueryDescriptorInterface $query The query to add
     *
     * @return void
     */
    public function addQuery(QueryDescriptorInterface $query);

    /**
     * Returns the query descriptor for the query with the passed name.
     *
     * @param string $name The query name to return the descriptor for
     *
     * @return \AppserverIo\Ldap\Description\QueryDescriptorInterface|null The query descriptor instance
     */
    public function getQuery($name);
}
