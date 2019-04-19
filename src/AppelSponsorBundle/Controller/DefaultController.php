<?php

namespace AppelSponsorBundle\Controller;

use AppelSponsorBundle\Entity\AppelSponsor;
use AppelSponsorBundle\Entity\Event;
use AppelSponsorBundle\Entity\FosUser;
use AppelSponsorBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{




    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
//
        $RAW_QUERY = 'SELECT * FROM fos_user where fos_user.raiting = :status and fos_user.role = :ss LIMIT 3;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        // Set parameters
        $statement->bindValue('status', 5);
        $statement->bindValue('ss', "sponsor");

        $statement->execute();

        $FosUser = $statement->fetchAll();


        return $this->render('@AppelSponsor/Default/index.html.twig', array('FosUsers' => $FosUser));
    }

    public function AllSponsorAction()
    {
        $em = $this->getDoctrine()->getManager();
//
        $RAW_QUERY = 'SELECT * FROM fos_user LIMIT 10;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);

        $statement->execute();

        $FosUsers = $statement->fetchAll();
        $em1 = $this->getDoctrine()->getManager();
        $signalSpon = $em1->getRepository('AppelSponsorBundle:Signaler')->findAll();

        return $this->render('@AppelSponsor/Default/AllSponsor.html.twig', array(
            'FosUsers' => $FosUsers,
            'signalSpon' => $signalSpon,
        ));
    }


    public function SponsorAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'SELECT * FROM fos_user where fos_user.id = :status LIMIT 10;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        // Set parameters
  $statement->bindValue('status', $id);
        $statement->execute();

        $FosUsers = $statement->fetchAll();

        $dossierSponsoring =  $em->getRepository('AppelSponsorBundle:AppelSponsor')->findByUser($id);

        $RAW_QUERY = 'SELECT * FROM appel_sponsor where appel_sponsor.user_id = :status LIMIT 10;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        // Set parameters
        $statement->bindValue('status', $id);
        $statement->execute();

        $events = $statement->fetchAll();

        return $this->render('@AppelSponsor/Default/Sponsor.html.twig', array(
            'FosUsers' => $FosUsers,
            'events'=> $events,

        ));
    }
    ////

    /// ////
    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder('e');
        $Events = $qb->select('e')
            ->from('AppelSponsorBundle:Event','e')
            ->where('e.dateevent < CURRENT_DATE()+7  AND e.dateevent > CURRENT_DATE()')
            ->getQuery()
            ->getResult();
//        $Events =  $em->getRepository('AppelSponsorBundle:Event')->findAll();



        return $this->render('@AppelSponsor/Default/index2.html.twig', array(
            'Events' => $Events,

        ));

    }
//    public function index2Action()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $em1 = $this->getDoctrine()->getManager();
//        $qb = $em->createQueryBuilder('e');
//        $Events = $qb->select('e')
//            ->from('AppelSponsorBundle:Event','e')
//            ->where('e.dateevent < CURRENT_DATE()+7  AND e.dateevent > CURRENT_DATE()')
//            ->getQuery()
//            ->getResult();
////        $Events =  $em->getRepository('AppelSponsorBundle:Event')->findAll();
//        $RAW_QUERY = 'SELECT `id` ,`titre`,`description`,`nbrplaces`,`dateevent`,`localisation`, MIN(`dateevent`) FROM `event`;';
//
//        $statement = $em1->getConnection()->prepare($RAW_QUERY);
//
//        $statement->execute();
//
//        $Event2 = $statement->fetchAll();
//        return $this->render('@AppelSponsor/Default/index2.html.twig', array(
//            'Events' => $Events,
//            'Event2' => $Event2,
//        ));
//
//    }




    public function ConsulterSponsorAction()
    {
        //$em = $this->getDoctrine()->getManager();
        //$FosUsers =  $em->getRepository('AppelSponsorBundle:FosUser')->findAll();
       // return $this->render('@AppelSponsor/Default/ConsulterSponsor.html.twig', array(
      //      'FosUsers' => $FosUsers,
        //));
        $em = $this->getDoctrine()->getManager();


        // =  $em->getRepository('AppelSponsorBundle:FosUser')->find(1);
        $FosUsers =  $em->getConnection()->prepare("select * from fos_user");
        $FosUsers->execute();

        $result = $FosUsers->fetchAll();
//        dump($result);
//        exit();

        $em1 = $this->getDoctrine()->getManager();

        return $this->render('@AppelSponsor/Default/ConsulterSponsor.html.twig', array('FosUsers' => $result));
    }
    public function rechAction(Request $request )
    {
        $name=$request->get('rech');
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT * FROM fos_user where fos_user.username LIKE  :status;';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        // Set parameters
        $statement->bindValue('status', '%'.$name.'%');
        $statement->execute();

        $FosUsers = $statement->fetchAll();



        return $this->render('@AppelSponsor/Default/ConsulterSponsor.html.twig', array('FosUsers' => $FosUsers));
    }

    public function ConsulterEventAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Events =  $em->getRepository('AppelSponsorBundle:Event')->findAll();
        return $this->render('@AppelSponsor/Default/ConsulterEvent.html.twig', array(
            'Events' => $Events,
        ));
    }

    public function InvitationAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $qb = $em->createQueryBuilder('e');
        $appelSponsors = $qb->select('e')
            ->from('AppelSponsorBundle:AppelSponsor','e')
            ->where('e.role = :r')
            ->setParameter('r','club')
            ->getQuery()
            ->getResult();



        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $appelSponsors,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );
        return $this->render('@AppelSponsor/Default/Invitation.html.twig', array(
            'appelSponsors' => $result,
        ));
    }
    public function DeleteInvitationAction(Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

//        $appelSponsors = $qb->delete('e')
//            ->from('AppelSponsorBundle:AppelSponsor','e')
//            ->where('e.id = :r')
//            ->setParameter('r',$id)
//            ->getQuery()
//            ->execute();
//        $sqlQuery = "delete from appel_sponsor where appel_sponsor.id = ".$id.";";
//
//        $query = $this->getEntityManager()->createNativeQuery($sqlQuery);
//
//        $query->execute();
        ////
        $sql = "delete from appel_sponsor where appel_sponsor.id = :fieldoneid ";
        $params = array('fieldoneid'=>$id);

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $this->redirectToRoute('appel_sponsor_invitation');
    }
    public function AccepterInvitationAction(Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository(AppelSponsor::class)->createQueryBuilder('')
            ->update(AppelSponsor::class, 'u')

            ->set('u.confirmation', ':c')
            ->setParameter('c', "oui" )


            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $result = $query->execute();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */


        return $this->redirectToRoute('appel_sponsor_invitation');
    }
    public function InvitationSponsorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $qb = $em->createQueryBuilder('e');
        $appelSponsors = $qb->select('e')
            ->from('AppelSponsorBundle:AppelSponsor','e')
            ->where('e.role = :r')
            ->setParameter('r','sponsor')
            ->getQuery()
            ->getResult();


        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $appelSponsors,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );
        return $this->render('@AppelSponsor/Default/InvitationSponsor.html.twig', array(
            'appelSponsors' => $result,
        ));
    }

//    public function SponsorAction()
//    {
//        return $this->render('@AppelSponsor/Default/Sponsor.html.twig');
//    }
    /**
     *
     * @Route("/Default/RechercherEvent", name="f_recherche")
     * @Method({"GET", "POST"})
     */
    public function rechercheAction(Request $request)
    {
        $keyWord = $request->get('keyWord');
        // dump($keyWord);
        if($keyWord == '')
        {
            $annonce = $this->getDoctrine()->getRepository('AppelSponsorBundle:Event')->findAll();
        }else
        {
            $annonce = $this->getDoctrine()->getRepository('AppelSponsorBundle:Event')->RechercheTitreAnnonce($keyWord);

        }

        $template = $this->render( '@Eco/Front/Annonce/Recherche.html.twig', array("annonces" => $annonce))->getContent();
        $json     = json_encode($template);
        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }




}
