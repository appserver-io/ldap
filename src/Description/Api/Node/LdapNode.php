<?php

/**
 * \AppserverIo\Ldap\Description\Api\Node\EntityNode
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

namespace AppserverIo\Ldap\Description\Api\Node;

use AppserverIo\Description\Annotations as DI;
use AppserverIo\Description\Api\Node\AbstractNode;
use AppserverIo\Ldap\Description\Configuration\LdapConfigurationInterface;

/**
 * Node implementation to transfer LDAP configuration.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2019 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class LdapNode extends AbstractNode implements LdapConfigurationInterface
{

    /**
     * The array with the repositorys.
     *
     * @var array
     * @DI\Mapping(nodeName="repositories/repository", nodeType="array", elementType="AppserverIo\Ldap\Description\Api\Node\RepositoryNode")
     */
    protected $repositories = array();

    /**
     * The array with the repositorys.
     *
     * @var array
     * @DI\Mapping(nodeName="entities/entity", nodeType="array", elementType="AppserverIo\Ldap\Description\Api\Node\EntityNode")
     */
    protected $entities = array();

    /**
     * The query description information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="description", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $description;

    /**
     * Returns the array with the repositorys.
     *
     * @return array The array with the repositories
     */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * Returns the array with the entities.
     *
     * @return array The array with the entities
     */
    public function getEntities()
    {
        return $this->entities;
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
}
