<?php

namespace BettingSas\Bundle\UserBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use BettingSas\Bundle\UserBundle\Model\Organization;

/**
 * Description of UserRepository
 *
 * @author jobou
 */
class UserRepository extends DocumentRepository implements UserRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findAllInOrganizationQb(Organization $organization)
    {
        $qb = $this->createQueryBuilder()
            ->sort('username')
            ->field('organization.id')->equals($organization->getId());

        return $qb;
    }
}
