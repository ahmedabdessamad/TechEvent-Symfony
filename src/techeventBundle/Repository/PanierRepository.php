<?php
namespace techeventBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PanierRepository extends EntityRepository
{
public function findAllOrderedByName($iduser)
{

return $this->getEntityManager()
->createQuery(
'SELECT p FROM techeventBundle:Panier p WHERE p.userid = :iduser'
)->setParameter('iduser',$iduser)
->getOneOrNullResult();
}


}
