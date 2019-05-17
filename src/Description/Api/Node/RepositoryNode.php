<?php

/**
 * \AppserverIo\Ldap\Description\Api\Node\RepositoryNode
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

namespace AppserverIo\Ldap\Description\Api\Node;

use AppserverIo\Description\Api\Node\BeanNode;
use AppserverIo\Description\Annotations as DI;
use AppserverIo\Ldap\Description\Configuration\RepositoryConfigurationInterface;

/**
 * Node implementation to transfer LDAP repository configuration.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class RepositoryNode extends BeanNode implements RepositoryConfigurationInterface
{

    /**
     * The repository's distinguished name information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="distinguished-name", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $distinguishedName;

    /**
     * The repository query information.
     *
     * @var array
     * @DI\Mapping(nodeName="queries", nodeType="array", elementType="AppserverIo\Ldap\Description\Api\Node\QueryNode")
     */
    protected $queries = array();

    /**
     * Returns the repository's distinguished name information.
     *
     * @return \AppserverIo\Description\Api\Node\ValueNode The repository's distinguished name information
     */
    public function getDistinguishedName()
    {
        return $this->distinguishedName;
    }

    /**
     * Returns the array with the repository's queries.
     *
     * @return array The array with the queries
     */
    public function getQueries()
    {
        return $this->queries;
    }
}
