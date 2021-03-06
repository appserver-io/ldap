<?php

/**
 * AppserverIo\Ldap\Description\Configuration\RepositoryConfigurationInterface
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

namespace AppserverIo\Ldap\Description\Configuration;

use AppserverIo\Description\Configuration\BeanConfigurationInterface;

/**
 * Interface for LDAP repository description implementations.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
interface RepositoryConfigurationInterface extends BeanConfigurationInterface
{

    /**
     * Returns the Metadata for the distinguished name of the repository.
     *
     * @return string The Metadata with the repository's distinguished name
     */
    public function getDistinguishedName();

    /**
     * Returns the array with the repository's queries.
     *
     * @return array The array with the queries
     */
    public function getQueries();
}
