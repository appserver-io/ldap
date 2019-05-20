<?php

/**
 * AppserverIo\Ldap\Description\RepositoryDescriptor
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

use AppserverIo\Lang\Reflection\ClassInterface;
use AppserverIo\Description\BeanDescriptor;
use AppserverIo\Description\DescriptorUtil;
use AppserverIo\Description\Configuration\ConfigurationInterface;
use AppserverIo\Psr\EnterpriseBeans\EnterpriseBeansException;
use AppserverIo\Psr\EnterpriseBeans\Description\FactoryAwareDescriptorInterface;
use AppserverIo\Psr\EnterpriseBeans\Description\MethodInvocationAwareDescriptorInterface;
use AppserverIo\Ldap\Description\Annotations\Repository;
use AppserverIo\Ldap\Description\Configuration\RepositoryConfigurationInterface;
use AppserverIo\Psr\EnterpriseBeans\Description\BeanDescriptorInterface;

/**
 * Simple descriptor implementation for LDAP repositories.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class RepositoryDescriptor extends BeanDescriptor implements RepositoryDescriptorInterface, FactoryAwareDescriptorInterface, MethodInvocationAwareDescriptorInterface
{

    /**
     * The repository distinguished name.
     *
     * @var string
     */
    protected $distinguishedName;

    /**
     * The arary with the repository queries.
     *
     * @var array
     */
    protected $queries = array();

    /**
     * Sets the distinguished name of the repository.
     *
     * @param string $distinguishedName The repository's distinguished name
     *
     * @return void
     */
    public function setDistinguishedName($distinguishedName)
    {
        $this->distinguishedName = $distinguishedName;
    }

    /**
     * Returns the distinguished name of the repository.
     *
     * @return string The repository's distinguished name
     */
    public function getDistinguishedName()
    {
        return $this->distinguishedName;
    }

    /**
     * Sets the array with the repository's queries.
     *
     * @param array $queries The array with the queries
     *
     * @return void
     */
    public function setQueries(array $queries)
    {
        $this->queries = $queries;
    }

    /**
     * Adds the passed query to the descriptor.
     *
     * @param \AppserverIo\Ldap\Description\QueryDescriptorInterface $query The query to add
     *
     * @return void
     */
    public function addQuery(QueryDescriptorInterface $query)
    {
        $this->queries[$query->getName()] = $query;
    }

    /**
     * Returns the array with the repository's queries.
     *
     * @return array The array with the queries
     */
    public function getQueries()
    {
        return $this->queries;
    }

    /**
     * Returns the query descriptor for the query with the passed name.
     *
     * @param string $name The query name to return the descriptor for
     *
     * @return \AppserverIo\Ldap\Description\QueryDescriptorInterface|null The query descriptor instance
     */
    public function getQuery($name)
    {
        if (isset($this->queries[$name])) {
            return $this->queries[$name];
        }
    }

    /**
     * Returns a new descriptor instance.
     *
     * @return \AppserverIo\Ldap\Description\RepositoryDescriptorInterface The descriptor instance
     */
    public static function newDescriptorInstance()
    {
        return new RepositoryDescriptor();
    }

    /**
     * Return's the annoation class name.
     *
     * @return string The annotation class name
     */
    protected function getAnnotationClass()
    {
        return Repository::class;
    }

    /**
     * Initializes the repository descriptor instance from the passed reflection class instance.
     *
     * @param \AppserverIo\Lang\Reflection\ClassInterface $reflectionClass The reflection class with the repository description
     *
     * @return \AppserverIo\Ldap\Description\RepositoryDescriptorInterface|null The initialized descriptor instance
     */
    public function fromReflectionClass(ClassInterface $reflectionClass)
    {

        // load the parent bean information
        parent::fromReflectionClass($reflectionClass);

        // create a new annotation instance
        /** @var \AppserverIo\Ldap\Description\Annotations\Repository $annotationInstance */
        $annotationInstance = $this->getClassAnnotation($reflectionClass, $this->getAnnotationClass());

        // query if we've an LDAP repository with the requested annotation
        if ($annotationInstance === null) {
            // if not, do nothing
            return;
        }

        // query for the distinguished name and set it
        if ($distinguishedName = $annotationInstance->getDistinguishedName()) {
            $this->setDistinguishedName((DescriptorUtil::trim($distinguishedName)));
        }

        // query for the repositories queries by sub-annotations
        foreach ($annotationInstance->getQueries() as $query) {
            $this->addQuery(QueryDescriptor::newDescriptorInstance()->fromAnnotation($query));
        }

        // query for the repositories querys by the available reflection methods
        /** @var \AppserverIo\Lang\Reflection\MethodInterface $reflectionMethod */
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            if ($query = QueryDescriptor::newDescriptorInstance()->fromReflectionMethod($reflectionMethod)) {
                $this->addQuery($query);
            }
        }

        // return the instance
        return $this;
    }

    /**
     * Initializes a repository configuration instance from the passed configuration node.
     *
     * @param \AppserverIo\Description\Configuration\ConfigurationInterface $configuration The repository configuration
     *
     * @return \AppserverIo\Ldap\Description\RepositoryDescriptorInterface|null The initialized descriptor instance
     */
    public function fromConfiguration(ConfigurationInterface $configuration)
    {

        // load the parent bean information
        parent::fromConfiguration($configuration);

        // query whether or not we've preference configuration
        if (!$configuration instanceof RepositoryConfigurationInterface) {
            return;
        }

        // query for the distinguished name and set it
        if ($distinguishedName = (string) $configuration->getDistinguishedName()) {
            $this->setDistinguishedName(DescriptorUtil::trim($distinguishedName));
        }

        // query for the repositories queries
        foreach ($configuration->getQueries() as $query) {
            $this->addQuery(QueryDescriptor::newDescriptorInstance()->fromConfiguration($query));
        }

        // return the instance
        return $this;
    }

    /**
     * Merges the passed configuration into this one. Configuration values
     * of the passed configuration will overwrite the this one.
     *
     * @param \AppserverIo\Psr\EnterpriseBeans\Description\BeanDescriptorInterface $beanDescriptor The configuration to merge
     *
     * @return void
     */
    public function merge(BeanDescriptorInterface $beanDescriptor)
    {

        // check if the classes are equal
        /** @var \AppserverIo\Ldap\Description\RepositoryDescriptorInterface $beanDescriptor */
        if ($this->getName() !== $beanDescriptor->getName()) {
            throw new EnterpriseBeansException(
                sprintf('You try to merge a repository configuration for "%s" with "%s"', $beanDescriptor->getName(), $this->getName())
            );
        }

        // merge the parent bean information
        parent::merge($beanDescriptor);

        // merge the distinguished name
        if ($distinguishedName = $beanDescriptor->getDistinguishedName()) {
            $this->setDistinguishedName($distinguishedName);
        }

        // merge the queries
        foreach ($beanDescriptor->getQueries() as $query) {
            $this->addQuery($query);
        }
    }
}
