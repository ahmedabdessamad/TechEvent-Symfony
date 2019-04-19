<?php
namespace techeventBundle\Repository;

use Doctrine\ORM\EntityRepository;

class InttereserRepository extends EntityRepository
{
public function findAlleventBymembre($idm)
{

return $this->getEntityManager()
->createQuery(
    'SELECT r FROM techeventBundle:reservation r WHERE r.id IN ( SELECT  event_id from techeventBundle:interesser b   WHERE  b.user_id = :idm)'
)->setParameter('idpanier',$idm)
->getResult();
}
}
