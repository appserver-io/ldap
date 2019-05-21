<?php

/**
 * AppserverIo\Ldap\Description\EntityDescriptorInterface
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

namespace AppserverIo\Ldap\Description;

/**
 * Interface for LDAP entity descriptor implementations.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
interface EntityDescriptorInterface extends LdapDescriptorInterface
{

    /**
     * Returns the entity class name.
     *
     * @return string The entity class name
     */
    public function getClassName();

    /**
     * Returns the entity identifier.
     *
     * @return string The entity identifier
     */
    public function getIdentifier();

    /**
     * Returns the entity repository type.
     *
     * @return string The repository type
     */
    public function getRepository();

    /**
     * Returns the entity's fields.
     *
     * @return array The array with the fields
     */
    public function getFields();

    /**
     * Returns the field descriptor for the field with the given name.
     *
     * @param string $name The name of the field to return the descriptor for
     *
     * @return \AppserverIo\Ldap\Description\FieldDescriptorInterface|null The field descriptor
     */
    public function getField($name);
}
