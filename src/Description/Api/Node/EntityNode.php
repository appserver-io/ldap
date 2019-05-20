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
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Ldap\Description\Api\Node;

use AppserverIo\Description\Annotations as DI;
use AppserverIo\Description\Api\Node\AbstractNode;
use AppserverIo\Ldap\Description\Configuration\EntityConfigurationInterface;

/**
 * Node implementation to transfer LDAP entity configuration.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class EntityNode extends AbstractNode implements EntityConfigurationInterface
{

    /**
     * The entity name information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="name", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $name;

    /**
     * The entity description information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="description", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $description;

    /**
     * The entity repository type information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="repository", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $repository;

    /**
     * The entity identifier type information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="repository", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $identifier;

    /**
     * The entity fields information.
     *
     * @var array
     * @DI\Mapping(nodeName="fields/field", nodeType="array", elementType="AppserverIo\Ldap\Description\Api\Node\FieldNode")
     */
    protected $fields = array();

    /**
     * Returns the entity name information.
     *
     * @return string The repository name information
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the entity description information.
     *
     * @return string The repository description information
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the entity identifier description information.
     *
     * @return string The entity identifier information
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Returns the entity repository type information.
     *
     * @return string The repository type information
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Returns the array with the entity fields information.
     *
     * @return array The array with the entity fields information
     */
    public function getFields()
    {
        return $this->fields;
    }
}
