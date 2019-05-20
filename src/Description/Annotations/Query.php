<?php

/**
 * AppserverIo\Ldap\Description\Annotations\Query
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

namespace AppserverIo\Ldap\Description\Annotations;

use AppserverIo\Psr\EnterpriseBeans\Annotations\AbstractBeanAnnotation;

/**
 * Annotation implementation for a LDAP query.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 *
 * @Annotation
 */
class Query extends AbstractBeanAnnotation
{

    /**
     * The search base.
     *
     * @var string
     */
    protected $searchBase;

    /**
     * The filter.
     *
     * @var string
     */
    protected $filter;

    /**
     * Initializes the annotation with the data from the doc block.
     *
     * @param array $values The values from the doc block
     */
    public function __construct(array $values)
    {

        // pass the values to the parent instance
        parent::__construct($values);

        // set the filter and search base
        $this->filter = $values['filter'];
        $this->searchBase = $values['searchBase'];
    }

    /**
     * Returns the search base.
     *
     * @return string The search base
     */
    public function getSearchBase()
    {
        return $this->searchBase;
    }

    /**
     * Returns the filter.
     *
     * @return string The filter
     */
    public function getFilter()
    {
        return $this->filter;
    }
}
