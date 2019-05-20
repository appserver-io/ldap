<?php

/**
 * AppserverIo\Ldap\Description\FieldDescriptorInterface
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

use AppserverIo\Psr\Deployment\DescriptorInterface;
use AppserverIo\Psr\EnterpriseBeans\Description\NameAwareDescriptorInterface;

/**
 * Simple descriptor implementation for LDAP entity field.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2019 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
interface FieldDescriptorInterface extends DescriptorInterface, NameAwareDescriptorInterface
{

    /**
     * Returns the LDAP name.
     *
     * @return string The LDAP name
     */
    public function getLdapName();

    /**
     * Returns the LDAP type.
     *
     * @return string The LDAP type
     */
    public function getLdapType();
}
