<?php

/**
 * AppserverIo\Ldap\Description\FieldDescriptor
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

use AppserverIo\Description\DescriptorUtil;
use AppserverIo\Description\Configuration\ConfigurationInterface;
use AppserverIo\Psr\EnterpriseBeans\EnterpriseBeansException;
use AppserverIo\Ldap\Description\Annotations\Query;
use AppserverIo\Ldap\Description\Configuration\QueryConfigurationInterface;
use AppserverIo\Description\AbstractNameAwareDescriptor;
use AppserverIo\Ldap\Description\Annotations\Field;
use AppserverIo\Lang\Reflection\PropertyInterface;

/**
 * Simple descriptor implementation for LDAP queries.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class FieldDescriptor extends AbstractNameAwareDescriptor implements FieldDescriptorInterface
{

    /**
     * The LDAP name.
     *
     * @var string
     */
    protected $ldapName;

    /**
     * The LDAP type.
     *
     * @var string
     */
    protected $ldapType;

    /**
     * Sets the LDAP name.
     *
     * @param string $ldapName The sLDAP name
     *
     * @return void
     */
    public function setLdapName($ldapName)
    {
        $this->ldapName = $ldapName;
    }

    /**
     * Returns the LDAP name.
     *
     * @return string The LDAP name
     */
    public function getLdapName()
    {
        return $this->ldapName;
    }

    /**
     * Sets the LDAP type.
     *
     * @param string $ldapType The LDAP type
     *
     * @return void
     */
    public function setLdapType($ldapType)
    {
        return $this->ldapType = $ldapType;
    }

    /**
     * Returns the LDAP type.
     *
     * @return string The LDAP type
     */
    public function getLdapType()
    {
        return $this->ldapType;
    }

    /**
     * Returns a new descriptor instance.
     *
     * @return \AppserverIo\Ldap\Description\RepositoryDescriptorInterface The descriptor instance
     */
    public static function newDescriptorInstance()
    {
        return new FieldDescriptor();
    }

    /**
     * Return's the annoation class name.
     *
     * @return string The annotation class name
     */
    protected function getAnnotationClass()
    {
        return Field::class;
    }

    /**
     * Initializes the field descriptor instance from the passed reflection property instance.
     *
     * @param \AppserverIo\Lang\Reflection\PropertyInterface $reflectionProperty The reflection property with the field annotation
     *
     * @return \AppserverIo\Ldap\Description\QueryDescriptorInterface|null The initialized descriptor instance
     */
    public function fromReflectionProperty(PropertyInterface $reflectionProperty)
    {

        // create a new annotation instance
        /** @var \AppserverIo\Ldap\Description\Annotations\Query $annotationInstance */
        if ($annotationInstance = $this->getPropertyAnnotation($reflectionProperty, $this->getAnnotationClass())) {
            return $this->fromAnnotation($annotationInstance);
        }
    }

    /**
     * Initializes the query descriptor instance from the passed annotation instance.
     *
     * @param \AppserverIo\Ldap\Description\Annotations\Query $annotationInstance The annoation instance with the query description
     *
     * @return \AppserverIo\Ldap\Description\QueryDescriptorInterface|null The initialized descriptor instance
     */
    public function fromAnnotation(Query $annotationInstance)
    {

        // load the default name to register in naming directory
        if ($name = $annotationInstance->getName()) {
            $this->setName(DescriptorUtil::trim($name));
        }

        // query for the description and set it
        if ($description = (string) $annotationInstance->getDescription()) {
            $this->setDescription(DescriptorUtil::trim($description));
        }

        // query for the LDAP name and set it
        if ($ldapName = (string) $annotationInstance->getLdapName()) {
            $this->setLdapName(DescriptorUtil::trim($ldapName));
        }

        // query for the LDAP type and set it
        if ($ldapType = (string) $annotationInstance->getLdapType()) {
            $this->setLdapType(DescriptorUtil::trim($ldapType));
        }

        // return the instance
        return $this;
    }

    /**
     * Initializes a repository configuration instance from the passed configuration node.
     *
     * @param \AppserverIo\Description\Configuration\ConfigurationInterface $configuration The repository configuration
     *
     * @return \AppserverIo\Ldap\Description\QueryDescriptorInterface|null The initialized descriptor instance
     */
    public function fromConfiguration(ConfigurationInterface $configuration)
    {

        // query whether or not we've preference configuration
        if (!$configuration instanceof QueryConfigurationInterface) {
            return;
        }

        // query for the name and set it
        if ($name = (string) $configuration->getName()) {
            $this->setName(DescriptorUtil::trim($name));
        }

        // query for the description and set it
        if ($description = (string) $configuration->getDescription()) {
            $this->setDescription(DescriptorUtil::trim($description));
        }

        // query for the LDAP name and set it
        if ($ldapName = (string) $configuration->getLdapName()) {
            $this->setLdapName(DescriptorUtil::trim($ldapName));
        }

        // query for the LDAP type and set it
        if ($ldapType = (string) $configuration->getLdapType()) {
            $this->setLdapType(DescriptorUtil::trim($ldapType));
        }

        // return the instance
        return $this;
    }

    /**
     * Merges the passed configuration into this one. Configuration values
     * of the passed configuration will overwrite the this one.
     *
     * @param \AppserverIo\Ldap\Description\RepositoryDescriptorInterface $queryDescriptor The configuration to merge
     *
     * @return void
     */
    public function merge(QueryDescriptorInterface $queryDescriptor)
    {

        // check if the classes are equal
        if ($this->getName() !== $queryDescriptor->getName()) {
            throw new EnterpriseBeansException(
                sprintf('You try to merge a field configuration for "%s" with "%s"', $queryDescriptor->getName(), $this->getName())
            );
        }

        //  merge the description
        if ($description = $queryDescriptor->getDescription()) {
            $this->setDescription($description);
        }

        //  merge the LDAP name base
        if ($ldapName = $queryDescriptor->getLdapName()) {
            $this->setLdapName($ldapName);
        }

        //  merge the LDAP type
        if ($ldapType = $queryDescriptor->getLdapType()) {
            $this->setLdapType($ldapType);
        }
    }
}
