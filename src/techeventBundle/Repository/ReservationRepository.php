<?php
namespace techeventBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{
public function findAllReservationByPanier($idpanier)
{

return $this->getEntityManager()
->createQuery(
'SELECT r FROM techeventBundle:reservation r WHERE r.idpanier = :idpanier'
)->setParameter('idpanier',$idpanier)
->getResult();
}
    public function findTotalPanier($idpanier)
    {

        return $this->getEntityManager()
            ->createQuery(
                'SELECT sum(r.quantite*e.prix) FROM techeventBundle:reservation r , techeventBundle:event e  WHERE r.event = e.id AND r.idpanier = :idpanier'
            )->setParameter('idpanier',$idpanier)
            ->getOneOrNullResult();
    }

    //calcul nombre d'items au panier
    public function findNumberOfItems($idpanier){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(r) FROM techeventBundle:reservation r  WHERE r.idpanier = :idpanier'
            )->setParameter('idpanier',$idpanier)
            ->getOneOrNullResult();

    }
    //calcul nombre d'itemds au panier

    //get reservation by id panier
    public function findReservationByIdpanier($idpanier){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM techeventBundle:reservation r  WHERE r.idpanier = :idpanier'
            )->setParameter('idpanier',$idpanier)
            ->getResult();
    }
    //get reservation by id panier

    //get recommandation event selon categorie
    public function findEventByCategorie($categorie){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e FROM techeventBundle:Event e  WHERE e.categorie = :categorie'
            )->setParameter('categorie',$categorie)
            ->getResult();
    }
    //get recommandation event selon categorie

    //get number of reservation by event id
    public function findNumberReservationByeventId($eventid,$iduser){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(r) FROM techeventBundle:reservation r  WHERE r.event = :eventid and r.user= :iduser'
            )->setParameter('eventid',$eventid)
            ->setParameter('iduser',$iduser)
            ->getOneOrNullResult();
    }
    //get number of reservation by event id

    //recuperer reservation selon id d'event et et user id
    public function findReservationByEventAndUser($eventid,$iduser){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM techeventBundle:reservation r  WHERE r.event = :eventid and r.user= :iduser'
            )->setParameter('eventid',$eventid)
            ->setParameter('iduser',$iduser)
            ->getResult();
    }
    //recuperer reservation selon id d'event et et user id

    //récuperer le nombre des places réservées
     public function findNombreRservations($eventid){
         return $this->getEntityManager()
             ->createQuery(
                 'SELECT sum(r.quantite) FROM techeventBundle:reservation r  WHERE r.event = :eventid'
             )->setParameter('eventid',$eventid)
             ->getOneOrNullResult();
     }
    //récuperer le nombre des places réservées

    //check coupon existe ou non
    public function findCoupon($textCoupon){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(c) FROM techeventBundle:Coupon c  WHERE c.codecoupon = :textCoupon'
            )->setParameter('textCoupon',$textCoupon)
            ->getOneOrNullResult();
    }
    //check coupon existe ou non

    //récuperer les tickets dont la date event est passée
      public function findTicketsPasser($iduser){
          return $this->getEntityManager()
              ->createQuery(
                  'SELECT r FROM techeventBundle:reservation r,techeventBundle:event e  WHERE r.user=:iduser AND  CURRENT_DATE()>e.dateevent AND r.event = e.id'
              )->setParameter('iduser',$iduser)
              ->getResult();
      }
    //récuperer les tickets dont la date event est passée

    //récuperer avis sur
    public function findAvisSurReservation($idres){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM techeventBundle:avis a  WHERE a.idres=:idres'
            )->setParameter('idres',$idres)
            ->getOneOrNullResult();
    }
    //récuperer les tickets dont la date event est passée

    //récuperer messages d'une conversation
    public function findByMessages($idsender,$idreceiver){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM techeventBundle:chat c  WHERE c.idsender=:idsender OR c.idreceiver=:idreceiver'
            )->setParameter('idsender',$idsender)
            ->setParameter('idreceiver',$idreceiver)
            ->getResult();
    }
    //récuperer messages d'une conversation

    //récuperer réservation par club
    public function findByClubReservations($iduser){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM techeventBundle:Reservation r,techeventBundle:Event e  WHERE r.event=e.id AND e.user=:iduser'
            )->setParameter('iduser',$iduser)
            ->getResult();
    }
    //récuperer réservation par club

    //récuperer réservation seat A
    public function findReservationsA($userid){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT sum(r.quantite) FROM techeventBundle:Reservation r,techeventBundle:Event e WHERE r.seat=:seat AND e.user=:userid'
            )->setParameter('seat',"A")
            ->setParameter('userid',$userid)
            ->getOneOrNullResult();
    }
    public function findReservationsB($userid){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT sum(r.quantite) FROM techeventBundle:Reservation r,techeventBundle:Event e WHERE r.seat=:seat AND e.user=:userid'
            )->setParameter('seat',"B")
            ->setParameter('userid',$userid)
            ->getOneOrNullResult();
    }
    public function findReservationsC($userid){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT sum(r.quantite) FROM techeventBundle:Reservation r,techeventBundle:Event e WHERE r.seat=:seat AND e.user=:userid'
            )->setParameter('seat',"C")
            ->setParameter('userid',$userid)
            ->getOneOrNullResult();
    }

    //récuperer réservation seat A

}
