<?php

/**
 * AppserverIo\Ldap\Description\Configuration\EntityConfigurationInterface.php
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

namespace AppserverIo\Ldap\Description\Configuration;

/**
 * Interface for LDAP entity field description implementations.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2019 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
interface FieldConfigurationInterface extends ConfigurationInterface
{

    /**
     * Returns the LDAP field name.
     *
     * @return string The LDAP field name
     */
    public function getLdapName();

    /**
     * Returns the LDAP field type.
     *
     * @return string The LDAP field type
     */
    public function getLdapType();
}
