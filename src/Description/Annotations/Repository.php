<?php

/**
 * AppserverIo\Ldap\Description\Annotations\Repository
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

use Doctrine\Common\Annotations\Annotation\Target;
use Doctrine\Common\Annotations\Annotation\Required;
use AppserverIo\Psr\EnterpriseBeans\Annotations\Inject;

/**
 * Annotation implementation for a LDAP repository.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/ldap
 * @link      http://www.appserver.io
 *
 * @Annotation
 * @Target({"CLASS"})
 */
class Repository extends Inject
{

    /**
     * The distinguished name.
     *
     * @var string
     * @Required()
     */
    protected $distinguishedName;

    /**
     * The querys.
     *
     * @var array<\AppserverIo\Ldap\Description\Annotations\Query>
     */
    protected $queries = array();

    /**
     * Initializes the annotation with the data from the doc block.
     *
     * @param array $values The values from the doc block
     */
    public function __construct(array $values)
    {

        // pass the values to the parent instance
        parent::__construct($values);

        // set the queries and the DN
        $this->queries = $values['queries'];
        $this->distinguishedName = $values['distinguishedName'];
    }

    /**
     * Returns the distinguished name.
     *
     * @return string The distinguished name
     */
    public function getDistinguishedName()
    {
        return $this->distinguishedName;
    }

    /**
     * Returns the querys.
     *
     * @return array<\AppserverIo\Ldap\Description\Annotations\Query> The array with the queries
     */
    public function getQueries()
    {
        return $this->queries;
    }
}
