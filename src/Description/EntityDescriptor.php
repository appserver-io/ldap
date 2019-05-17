<?php

/**
 * AppserverIo\Ldap\Description\EntityDescriptor
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
use AppserverIo\Description\AbstractNameAwareDescriptor;
use AppserverIo\Lang\Reflection\ClassInterface;
use AppserverIo\Description\Configuration\ConfigurationInterface;
use AppserverIo\Psr\EnterpriseBeans\EnterpriseBeansException;
use AppserverIo\Ldap\Description\Annotations\Entity;
use AppserverIo\Ldap\Description\Configuration\EntityConfigurationInterface;

/**
 * Simple descriptor implementation for LDAP entities.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class EntityDescriptor extends AbstractNameAwareDescriptor implements EntityDescriptorInterface
{

    /**
     * The entity repository name.
     *
     * @var string
     */
    protected $repository;

    /**
     * Sets the entity repository type.
     *
     * @param string $repository The repository type
     *
     * @return void
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns the entity repository type.
     *
     * @return string The repository type
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Returns a new descriptor instance.
     *
     * @return \AppserverIo\Ldap\Description\EntityDescriptorInterface The descriptor instance
     */
    public static function newDescriptorInstance()
    {
        return new EntityDescriptor();
    }

    /**
     * Return's the annoation class name.
     *
     * @return string The annotation class name
     */
    protected function getAnnotationClass()
    {
        return Entity::class;
    }

    /**
     * Initializes the entity descriptor instance from the passed reflection class instance.
     *
     * @param \AppserverIo\Lang\Reflection\ClassInterface $reflectionClass The reflection class with the entity description
     *
     * @return \AppserverIo\Ldap\Description\EntityDescriptorInterface|null The initialized descriptor instance
     */
    public function fromReflectionClass(ClassInterface $reflectionClass)
    {

        // create a new annotation instance
        /** @var \AppserverIo\Ldap\Description\Annotations\Entity $annotationInstance */
        $annotationInstance = $this->getClassAnnotation($reflectionClass, $this->getAnnotationClass());

        // query if we've an LDAP entity with the requested annotation
        if ($annotationInstance === null) {
            // if not, do nothing
            return;
        }

        // load the default name to register in naming directory
        if ($name = $annotationInstance->getName()) {
            $this->setName(DescriptorUtil::trim($name));
        } else {
            // if @Annotation(name=****) is NOT set, we use the short class name by default
            $this->setName($reflectionClass->getShortName());
        }

        // query for the description and set it
        if ($description = $annotationInstance->getDescription()) {
            $this->setDescription((DescriptorUtil::trim($description)));
        }

        // query for the repository and set it
        if ($repository = $annotationInstance->getRepository()) {
            $this->setRepository((DescriptorUtil::trim($repository)));
        }

        // return the instance
        return $this;
    }

    /**
     * Initializes an entity configuration instance from the passed configuration node.
     *
     * @param \AppserverIo\Description\Configuration\ConfigurationInterface $configuration The entity configuration
     *
     * @return \AppserverIo\Ldap\Description\EntityDescriptorInterface|null The initialized descriptor instance
     */
    public function fromConfiguration(ConfigurationInterface $configuration)
    {

        // query whether or not we've preference configuration
        if (!$configuration instanceof EntityConfigurationInterface) {
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

        // query for the repository and set it
        if ($repository = (string) $configuration->getRepository()) {
            $this->setRepository(DescriptorUtil::trim($repository));
        }

        // return the instance
        return $this;
    }

    /**
     * Merges the passed configuration into this one. Configuration values
     * of the passed configuration will overwrite the this one.
     *
     * @param \AppserverIo\Ldap\Description\EntityDescriptorInterface $entityDescriptor The configuration to merge
     *
     * @return void
     */
    public function merge(EntityDescriptorInterface $entityDescriptor)
    {

        // check if the classes are equal
        if ($this->getName() !== $entityDescriptor->getName()) {
            throw new EnterpriseBeansException(
                sprintf('You try to merge a entity configuration for "%s" with "%s"', $entityDescriptor->getName(), $this->getName())
            );
        }

        //  merge the description
        if ($description = $entityDescriptor->getDescription()) {
            $this->setDescription($description);
        }

        // merge the repository
        if ($repository = $entityDescriptor->getRepository()) {
            $this->setRepository($repository);
        }
    }
}
