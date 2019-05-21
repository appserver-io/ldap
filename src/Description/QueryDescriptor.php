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

use AppserverIo\Description\DescriptorUtil;
use AppserverIo\Description\Configuration\ConfigurationInterface;
use AppserverIo\Psr\EnterpriseBeans\EnterpriseBeansException;
use AppserverIo\Ldap\Description\Annotations\Query;
use AppserverIo\Ldap\Description\Configuration\QueryConfigurationInterface;
use AppserverIo\Description\AbstractNameAwareDescriptor;
use AppserverIo\Lang\Reflection\MethodInterface;

/**
 * Simple descriptor implementation for LDAP queries.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 */
class QueryDescriptor extends AbstractNameAwareDescriptor implements QueryDescriptorInterface
{

    /**
     * The query search base.
     *
     * @var string
     */
    protected $searchBase;

    /**
     * The query filter.
     *
     * @var string
     */
    protected $filter;

    /**
     * Sets the query's search base.
     *
     * @param string $searchBase The search base
     *
     * @return void
     */
    public function setSearchBase($searchBase)
    {
        $this->searchBase = $searchBase;
    }

    /**
     * Returns the query's search base.
     *
     * @return string The search base
     */
    public function getSearchBase()
    {
        return $this->searchBase;
    }

    /**
     * Sets the query's filter.
     *
     * @param string $filter The filter
     *
     * @return void
     */
    public function setFilter($filter)
    {
        return $this->filter = $filter;
    }

    /**
     * Returns the query's filter.
     *
     * @return string The filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Returns a new descriptor instance.
     *
     * @return \AppserverIo\Ldap\Description\RepositoryDescriptorInterface The descriptor instance
     */
    public static function newDescriptorInstance()
    {
        return new QueryDescriptor();
    }

    /**
     * Return's the annoation class name.
     *
     * @return string The annotation class name
     */
    protected function getAnnotationClass()
    {
        return Query::class;
    }

    /**
     * Initializes the query descriptor instance from the passed reflection method instance.
     *
     * @param \AppserverIo\Lang\Reflection\MethodInterface $reflectionMethod The reflection method with the query annotation
     *
     * @return \AppserverIo\Ldap\Description\QueryDescriptorInterface|null The initialized descriptor instance
     */
    public function fromReflectionMethod(MethodInterface $reflectionMethod)
    {

        // create a new annotation instance
        /** @var \AppserverIo\Ldap\Description\Annotations\Query $annotationInstance */
        if ($annotationInstance = $this->getMethodAnnotation($reflectionMethod, $this->getAnnotationClass())) {
            // set the method name as default name, if not configured in the annotation
            if (empty($annotationInstance->getName())) {
                $annotationInstance->setName($reflectionMethod->getMethodName());
            }
            // initialize the descriptor from the annotation
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

        // query for the filter and set it
        if ($filter = (string) $annotationInstance->getFilter()) {
            $this->setFilter(DescriptorUtil::trim($filter));
        }

        // query for the search base and set it
        if ($searchBase = (string) $annotationInstance->getSearchBase()) {
            $this->setSearchBase(DescriptorUtil::trim($searchBase));
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

        // query for the filter and set it
        if ($filter = (string) $configuration->getFilter()) {
            $this->setFilter(DescriptorUtil::trim($filter));
        }

        // query for the search base and set it
        if ($searchBase = (string) $configuration->getSearchBase()) {
            $this->setSearchBase(DescriptorUtil::trim($searchBase));
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
                sprintf('You try to merge a query configuration for "%s" with "%s"', $queryDescriptor->getName(), $this->getName())
            );
        }

        //  merge the description
        if ($description = $queryDescriptor->getDescription()) {
            $this->setDescription($description);
        }

        //  merge the search base
        if ($searchBase = $queryDescriptor->getSearchBase()) {
            $this->setSearchBase($searchBase);
        }

        //  merge the filter
        if ($filter = $queryDescriptor->getFilter()) {
            $this->setFilter($filter);
        }
    }
}
