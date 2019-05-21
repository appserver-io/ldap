<?php

/**
 * AppserverIo\Ldap\Description\Annotations\Field
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

namespace AppserverIo\Ldap\Description\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;
use AppserverIo\Psr\EnterpriseBeans\Annotations\AbstractBeanAnnotation;

/**
 * Annotation implementation for a LDAP entity field type.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2019 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 *
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Field extends AbstractBeanAnnotation
{

    /**
     * The LDAP field name.
     *
     * @var string
     */
    protected $ldapName;

    /**
     * The LDAP field type.
     *
     * @var string
     */
    protected $ldapType;

    /**
     * Initializes the annotation with the data from the doc block.
     *
     * @param array $values The values from the doc block
     */
    public function __construct(array $values = array())
    {

        // pass the values to the parent instance
        parent::__construct($values);

        // set the LDAP field name + type
        $this->ldapName = $values['ldapName'];
        $this->ldapName = $values['ldapType'];
    }

    /**
     * Sets the value of the name attribute.
     *
     * @param string $name The name attribute to set
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the LDAP field name.
     *
     * @param string $ldapName The LDAP field name
     *
     * @return void
     */
    public function setLdapName($ldapName)
    {
        $this->ldapName = $ldapName;
    }

    /**
     * Returns the LDAP field name.
     *
     * @return string The LDAP field name
     */
    public function getLdapName()
    {
        return $this->ldapName;
    }

    /**
     * Returns the LDAP field type.
     *
     * @return string The LDAP field type
     */
    public function getLdapType()
    {
        return $this->ldapType;
    }
}
