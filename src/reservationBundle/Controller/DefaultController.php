<?php

namespace reservationBundle\Controller;
use Doctrine\Common\Cache\ChainCache;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use techeventBundle\Entity\avis;
use techeventBundle\Entity\chat;
use techeventBundle\Entity\Event;
use techeventBundle\Entity\Panier;
use techeventBundle\Entity\Reservation;
use techeventBundle\Entity\User;
use techeventBundle\Repository;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@reservation/Default/reservation.html.twig');
    }
    public function AjoutReservationAction(Request $request,$id,$iduser){
        $reservation = new Reservation();
        $event = new Event();
        $User =  new User();
        $event->setId($id);
        $User->setId($iduser);
        $erreur = "";
        $ev = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Event')
            ->find($id);

      //  echo $iduser;
        if($request->isMethod('POST')){
            $type=$request->get('type');
            $seat=$request->get('seat');
            $quantity = $request->get('quantity');
            $reservation->setType($type);
            $reservation->setSeat($seat);
            $reservation->setQuantite($quantity);
            $reservation->setEvent($event);
            $reservation->setUser($User);
                 //check if event already exist in cart
            $nombreRservationsEvent = $this->getDoctrine()
                ->getManager()
                ->getRepository('techeventBundle:reservation')
                ->findNumberReservationByeventId($id,$this->getUser()->getId());
                    //update quantité réservation
            $nbr = 0;
                foreach ($nombreRservationsEvent as $k){
                    $nbr =$k;
                }
                   if($nbr!=0){
                       echo $nbr;
                       $rs = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('techeventBundle:reservation')
                           ->findReservationByEventAndUser($id,$iduser);
                       $k = new Reservation();
                       $k = $rs[0];
                       $em = $this->getDoctrine()->getManager();
                       $reservation = $em->getRepository('techeventBundle:reservation')->find($k->getId());
                       $newQte = $k->getQuantite();
                       $reservation->setQuantite($newQte+$quantity);
                       $em->flush();
                   }
                   //update quantité réservation
                 //check if event already exist in cart
                    else{
                        $resultnbplaces = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('techeventBundle:reservation')
                            ->findNombreRservations($id);
                        $nbp = 0;
                        foreach ($resultnbplaces as $k){$nbp = $k;}
                        $nbptotal = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('techeventBundle:event')
                            ->find($id);
                        $total = $nbptotal->getNbrplaces();
                        $nbpdispo = $total - $nbp;
                        echo $nbpdispo;
                        if($quantity <= $nbpdispo){
                            //Ajout réservation pour la 1ére fois
                            // echo "Ajout réservation pour la 1ére fois";
                            $idusr = $this->getUser()->getId();
                            $panier = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('techeventBundle:Panier')
                                ->findAllOrderedByName($iduser);
                            $p = new Panier();
                            $p->setId(1);
                            $reservation->setIdpanier($p);
                            $em = $this->getDoctrine()->getManager();
                            $em->merge($reservation);
                            $em->flush();

                                   //generation pdf et envoi en mail

                                   //generation pdf et envoi en mail

                            $erreur= "reservation ajoutée avec succées !";
                            //Ajout réservation pour la 1ére fois
                        }else{
                            $erreur=  "nombre de places demandés non disponible !";
                        }

                    }
        }
        $nbreser = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:reservation')
            ->findNombreRservations($id);

        foreach ($nbreser as $k){
          $val = $k;
        }
        $sature="il y'a encore ".intval($ev->getNbrplaces()-$val)." Tickets disponibles réserver le votre ! ";
        if ($ev->getNbrplaces() == $val){
            $sature ="Tout les tickets sont réservée !";
        }
        return $this->render('@reservation/Default/reservation.html.twig',['erreur'=>$erreur,'ev'=>$ev,'sature'=>$sature]);
    }


    public function afficherPanierAction($iduser){
        $idpanier = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Panier')
            ->findAllOrderedByName($iduser);
            //get idpanier
        $ListeDesReservations = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findAllReservationByPanier($idpanier);
          //calcul total panier
        $total = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findTotalPanier($idpanier);
        $x = 0 ;
           foreach($total as $t){
            $x= $t;
            }
        $panierTotal = new Panier();
        $em = $this->getDoctrine()->getManager();
        $panierTotal = $em->getRepository('techeventBundle:Panier')->find($idpanier);
        $panierTotal->setTotal($x);
        $em->flush();

        //calcul total panier

        //calcul nombre des reservations au panier

        $nbrReservations = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findNumberOfItems($idpanier);
        $nbrItems = 0 ;
        foreach($nbrReservations as $n){
            $nbrItems= $n;
        }
        //calcul nombre des reservations au paneir


        //ajouter  infos au session
        $session = new Session();

// set and get session attributes
             $session->set('name',$nbrItems);
        //ajouter  infos au session

        //affichage recommondations
         $categories = array();
         $i=0;
          foreach ($ListeDesReservations as $r){
              $e = new Event();
              $e = $r->getEvent();
              array_push($categories,$e->getCategorie());
          }
        $values = array_count_values($categories);
        arsort($values);
        $popular = array_slice(array_keys($values), 0, 1, true);
        $recommandations = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findEventByCategorie($popular);
        //affichage recommondations
        if ($popular==null){
            $popular[0]="";
        }

        return $this->render('@reservation/Default/afficherPanier.html.twig',['ListeDesReservations' => $ListeDesReservations,'total' => $total,'recommandations' => $recommandations,'popular' => $popular[0]]);
    }

    //SUPPRESSION
    public function SupprimerReservationAction($idReservation){
        echo $idReservation;
        $em = $this->getDoctrine()->getEntityManager();
        $entite = $em->getRepository('techeventBundle:Reservation')->find($idReservation);
        $em->remove($entite);
        $em->flush();
        //Affichage
        /*
        $iduser = $this->getUser()->getId();
        $idpanier = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Panier')
            ->findAllOrderedByName($iduser);
        //get idpanier
        $ListeDesReservations = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findAllReservationByPanier($idpanier);
        return $this->render('@reservation/Default/afficherPanier.html.twig',['ListeDesReservations' => $ListeDesReservations]);
        */
        //Affichage
        $iduser = $this->getUser()->getId();
        return $this->redirectToRoute('affichage', array('iduser' => $iduser));
    }

    public function ModifierReservationAction($idReservation,$quantite){
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('techeventBundle:reservation')->find($idReservation);
        $reservation->setQuantite($quantite);
        $em->flush();
        //Affichage    
        /*
        $iduser = $this->getUser()->getId();
        $idpanier = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Panier')
            ->findAllOrderedByName($iduser);
        //get idpanier
        $ListeDesReservations = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:reservation')
            ->findAllReservationByPanier($idpanier);
        return $this->render('@reservation/Default/afficherPanier.html.twig',['ListeDesReservations' => $ListeDesReservations]);
          */
        //Affichage
                $iduser = $this->getUser()->getId();
        return $this->redirectToRoute('affichage', array('iduser' => $iduser));
    }

    //clear shopping cart
    public function viderPanierAction(){
        $iduser = $this->getUser()->getId();
        $idpanier = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Panier')
            ->findAllOrderedByName($iduser);
        //get idpanier
        //suppression
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->delete('techeventBundle:Reservation', 'res')
            ->where('res.idpanier = :bussId')
            ->setParameter('bussId',$idpanier)
            ->getQuery();

        $query->execute();
        //supression
        $iduser = $this->getUser()->getId();
        return $this->redirectToRoute('affichage', array('iduser' => $iduser));
    }
    //clear shopping cart

    //Ajax load data
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posts =  $em->getRepository('techeventBundle:event')->findAll();
        if(!$posts) {
            $result['posts']['error'] = "Post Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getTitre(),$posts->getDescription()];
        }
        return $realEntities;
    }
    //Ajax load data

    //afficher chaises de la salle
     public function afficherSalleAction($idevent){
         $resultnbplaces = $this->getDoctrine()
             ->getManager()
             ->getRepository('techeventBundle:reservation')
             ->findNombreRservations($idevent);
         $nbp = 0;
         foreach ($resultnbplaces as $k){$nbp = $k;}
         $nbptotal = $this->getDoctrine()
             ->getManager()
             ->getRepository('techeventBundle:event')
             ->find($idevent);
         $total = $nbptotal->getNbrplaces();
         $nbpdispo = $total - $nbp;
       //  echo "event ".$idevent;// echo "nbp ".$nbp;
      //   echo "total ".$total;// echo "dispo".$nbpdispo;
         return $this->render('@reservation/Default/afficherSalle.html.twig',['idevent'=>$idevent,'nbp'=>$nbp,'total'=>$total,'nbpdispo'=>$nbpdispo]);
     }
    //afficher chaises de la salle

     //appliquer coupon de réduction
      public function ApplyCouponAction(Request $request){

          if ($request->isMethod('POST'))
          {
              $coupontext = $request->request->get('coupon_text');
              $nbrCoupons = $this->getDoctrine()
                  ->getManager()
                  ->getRepository('techeventBundle:reservation')
                  ->findCoupon($coupontext);
               $exist = 0 ;
               foreach ($nbrCoupons as $k){ $exist = $k;}
              $iduser = $this->getUser()->getId();
              $panier = $this->getDoctrine()
                  ->getManager()
                  ->getRepository('techeventBundle:Panier')
                  ->findAllOrderedByName($iduser); 
               $newTotal = ($panier->getTotal()*50)/100;
                  //modifier total panier
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('techeventBundle:panier')->find($panier->getId());
        $p->setTotal($newTotal);
        $em->flush();
                //modifier total panier
          }

        return $this->redirectToRoute('affichage', array('iduser' => $iduser));
      }
     //appliquer coupn de réduction

    //payement
    public function payementAction($total){
        \Stripe\Stripe::setApiKey("sk_test_JKYj8WMuOsnaD5nOXiAYaPXr");

// Token creation. In production this should be done client-side via Stripe.js or Checkout.
        $token = \Stripe\Token::create([
            "card" => array(
                "number" => "4242424242424242",
                "exp_month" => 8,
                "exp_year" => 20,
                "cvc" => "123"
            )
        ]);

// Charge creation

        $charge = \Stripe\Charge::create([
            "amount" => $total*100,
            "currency" => "gbp",
            "source" => $token->id,
            "description" => "Payement Techevents"
        ]);

        return $this->render('@reservation/Default/checkout.html.twig');
    }
    //payement

    //affichage tickets passés
    public function TicketsPasserAction(){
        $iduser = $this->getUser()->getId();
        $listeResPasser = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findTicketsPasser($iduser);
        return $this->render('@reservation/Default/tickets.html.twig',['listeResPasser'=>$listeResPasser]);

    }
    //affichage tickets passées

    //affichage un seul ticket
    public function viewTicketAction($idres){
        $reservation = $this->getDoctrine()->getRepository('techeventBundle:Reservation')->find($idres);
        $avis = $this->getDoctrine()->getRepository('techeventBundle:Reservation')->findAvisSurReservation($idres);
        return $this->render('@reservation/Default/viewticket.html.twig',['reservation'=>$reservation,'avis'=>$avis]);
    }
    //affichage un seul ticket

    //Ajout d'un avis
    public function ajouterAvisAction(Request $request){
        if($request->isMethod('POST')) {
            $review=$request->get('review');
            $stars=$request->get('stars');
            $idres = $request->get('idres');
            $choix =$request->get('choix');

            if ($choix == 1){
                dump("kfdkfksfk");
                $avis = new avis();
                $res = new Reservation();
                $res->setId($idres);
                $em = $this->getDoctrine()->getManager();
                $avis->setReview($review);
                $avis->setStars($stars);
                $avis->setIdres($res);
                $usr = new User();
                $usr->setId($this->getUser()->getId());
                $avis->setIduser($usr);
                // tells Doctrine you want to (eventually) save the Product (no queries yet)
                $em->merge($avis);
                // actually executes the queries (i.e. the INSERT query)
                $em->flush();
                return $this->redirectToRoute('viewticket',array('idres'=>$idres));
            }
            if ($choix == 2){
                $em = $this->getDoctrine()->getManager();
                $res = $em->getRepository('techeventBundle:avis')->findOneBy([]);
                $res->setReview($review);
                $res->setStars($stars);
                $em->flush();
                return $this->redirectToRoute('viewticket',array('idres'=>$idres));
            }
            if ($choix == 3){
                $em = $this->getDoctrine()->getManager();
                $res = $em->getRepository('techeventBundle:avis')->findOneBy([]);
                $em->remove($res);
                $em->flush();
                return $this->redirectToRoute('viewticket',array('idres'=>$idres));
            }

        }

    }
    //Ajout d'un avis

    //chat
    public function chatAction($idevent){
        $event = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Event')
            ->find($idevent);
        $organisateur = $event->getUser();
        //get messages
        $messages = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findByMessages($organisateur,$this->getUser()->getId());
        //get messages
        return $this->render('@reservation/Default/chat.html.twig',['organisateur'=>$organisateur,'messages'=>$messages,'idevent'=>$idevent]);
    }
    //chat

    //ajouter message au chat
    public function EnvoyerchatAction(Request $request){
            if($request->isMethod('POST')) {
                $content=$request->get('content');
                $idreceiver=$request->get('receiverid');
                $idevent=$request->get('idevent');

                $chat = new chat();
               $chat->setContent($content);

               $idsender = $this->getUser()->getId();
               $usr = new User();
               $usr->setId($idsender);
               $chat->setIdsender($usr);

                $usr1 = new User();
                $usr1->setId($idreceiver);
                $chat->setIdsender($usr1);

               //add chat to  databse
                $em = $this->getDoctrine()->getManager();
                $em->merge($chat);
                $em->flush();
                return $this->redirectToRoute('chat',['idevent'=>$idevent]);
            }
    }
    //ajouter message au chat

    //affichage réservations events par club
    public function ReservationClubAction()
    {
        $idclub = $this->getUser()->getId();
        $listeReservationsClub = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findByClubReservations($idclub);
        $A = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findReservationsA($idclub);
          foreach ($A as $k){
              $nbrA = $k;
          }

        $B = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findReservationsB($idclub);
        foreach ($B as $k){
            $nbrB = $k;
        }

        $C = $this->getDoctrine()
            ->getManager()
            ->getRepository('techeventBundle:Reservation')
            ->findReservationsC($idclub);
        foreach ($C as $k){
            $nbrC = $k;
        }
        if ($nbrB==0)
        {$nbrB=0;}
        if ($nbrA==0)
        {$nbrA=0;}
        if ($nbrC==0)
        {$nbrC=0;}
        return $this->render('@reservation/Default/reservationsClub.html.twig',['listeReservationsClub'=>$listeReservationsClub,'nbrA'=>$nbrA,'nbrC'=>$nbrC,'nbrB'=>$nbrB]);
    }
        //affichage réservations events par club

}
