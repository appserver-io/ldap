<?php

/**
 * \AppserverIo\Ldap\Description\Api\Node\FieldNode
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
use AppserverIo\Ldap\Description\Configuration\FieldConfigurationInterface;

/**
 * Node implementation to transfer LDAP entity field configuration.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2019 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class FieldNode extends AbstractNode implements FieldConfigurationInterface
{

    /**
     * The field name information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="name", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $name;

    /**
     * The field description information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="description", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $description;

    /**
     * The LDAP name information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="ldap-name", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $ldapName;

    /**
     * The LDAP type information.
     *
     * @var \AppserverIo\Description\Api\Node\ValueNode
     * @DI\Mapping(nodeName="ldap-type", nodeType="AppserverIo\Description\Api\Node\ValueNode")
     */
    protected $ldapType;

    /**
     * Returns the name information.
     *
     * @return \AppserverIo\Description\Api\Node\ValueNode The name information
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the description information.
     *
     * @return \AppserverIo\Description\Api\Node\ValueNode The description information
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the LDAP name information.
     *
     * @return string The LDAP name information
     */
    public function getLdapName()
    {
        return $this->ldapName;
    }

    /**
     * Returns the LDAP type information.
     *
     * @return string The LDAP type information
     */
    public function getLdapType()
    {
        return $this->ldapType;
    }
}
