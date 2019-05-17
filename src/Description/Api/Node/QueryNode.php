<?php

/**
 * \AppserverIo\Ldap\Description\Api\Node\QueryNode
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

use AppserverIo\Description\Annotations as DI;
use AppserverIo\Description\Api\Node\AbstractNode;
use AppserverIo\Ldap\Description\Configuration\QueryConfigurationInterface;

/**
 * Node implementation to transfer LDAP repository configuration.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class QueryNode extends AbstractNode implements QueryConfigurationInterface
{

    /**
     * The query name information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="name", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $name;

    /**
     * The query description information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="description", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $description;

    /**
     * The query search base information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="search-base", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $searchBase;

    /**
     * The query filter information.
     *
     * @var string
     * @DI\Mapping(nodeName="filter", elementType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $filter;

    /**
     * Returns the repository name information.
     *
     * @return \AppserverIo\Description\Api\Node\ValueNode The repository name information
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the repository description information.
     *
     * @return \AppserverIo\Description\Api\Node\ValueNode The repository description information
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the query's search base.
     *
     * @return string The search base
     */
    public function getSearchBase()
    {
        return $this->searchBase;
    }

    /**
     * Returns the query's filter.
     *
     * @return string The filter
     */
    public function getFilter()
    {
        return $this->filter;
    }
}
