<?php

/**
 * AppserverIo\Ldap\Description\Annotations\Entity
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
 * Annotation implementation for a LDAP entity.
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
class Entity extends Inject
{

    /**
     * The repository name.
     *
     * @var string
     * @Required()
     */
    protected $repository;

    /**
     * Initializes the annotation with the data from the doc block.
     *
     * @param array $values The values from the doc block
     */
    public function __construct(array $values = array())
    {

        // pass the values to the parent instance
        parent::__construct($values);

        // set the repository
        $this->repository = $values['repository'];
    }

    /**
     * Returns the repository type.
     *
     * @return string The repository type
     */
    public function getRepository()
    {
        return $this->repository;
    }
}
