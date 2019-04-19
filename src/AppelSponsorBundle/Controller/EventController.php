<?php

namespace AppelSponsorBundle\Controller;

use AppelSponsorBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{



    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppelSponsorBundle:Event')->findAll();

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm('AppelSponsorBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('event/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('AppelSponsorBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('event/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }



    public function rechercheAction(Request $request)
    {
        $keyWord = $request->get('keyWord');
        //dump($keyWord);
        if($keyWord == '')
        {
            $events = $this->getDoctrine()->getRepository('AppelSponsorBundle:Event')->findAll();

        }else
        {
            $events = $this->getDoctrine()->getRepository('AppelSponsorBundle:Event')->RechercheTitreEvent($keyWord);

        }

        $template = $this->render( '@AppelSponsor/Default/RechercherEvent.html.twig', array("Events" => $events))->getContent();
        $json     = json_encode($template);
        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function recherchesponAction(Request $request)
    {
        $keyWord = $request->get('keyWord');
        //dump($keyWord);
        if($keyWord == '')
        {
            $FosUsers = $this->getDoctrine()->getRepository('AppelSponsorBundle:FosUser')->findAll();

        }else
        {
            $FosUsers = $this->getDoctrine()->getRepository('AppelSponsorBundle:FosUser')->RechercheNomEvent($keyWord);

        }

        $template = $this->render( '@AppelSponsor/Default/RechercherSponsor.html.twig', array("FosUser" => $FosUsers))->getContent();
        $json     = json_encode($template);
        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function AllEventbyprixdescAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('AppelSponsorBundle:Event','e')
            ->orderBy('e.prix','DESC')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $Events=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@AppelSponsor/Default/ConsulterEvent.html.twig', array(
            'Events' => $Events,
        ));
    }

    public function AllEventbyprixasecAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('AppelSponsorBundle:Event','e')
            ->orderBy('e.prix','ASC')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $Events=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@AppelSponsor/Default/ConsulterEvent.html.twig', array(
            'Events' => $Events,
        ));

    }
    public function AllEventbyTitreAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('AppelSponsorBundle:Event','e')
            ->orderBy('e.titre','ASC')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $Events=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@AppelSponsor/Default/ConsulterEvent.html.twig', array(
            'Events' => $Events,
        ));

    }
    public function AllEventbyDateAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('AppelSponsorBundle:Event','e')
            ->orderBy('e.dateevent','ASC')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $Events=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@AppelSponsor/Default/ConsulterEvent.html.twig', array(
            'Events' => $Events,
        ));

    }
    public function AllSponsorbyTitreAction(Request $request)
    {



        $em = $this->getDoctrine()->getManager();
//
        $RAW_QUERY = 'SELECT * FROM fos_user ORDER BY fos_user.username  LIMIT 10;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        // Set parameters
        $statement->bindValue('status', 5);
        $statement->execute();

        $FosUser = $statement->fetchAll();



        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $FosUsers=$paginator->paginate(
            $FosUser,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@AppelSponsor/Default/ConsulterSponsor.html.twig', array(
            'FosUsers' => $FosUsers,
        ));

    }
    public function AllSponsorbyDateAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
//
        $RAW_QUERY = 'SELECT * FROM fos_user ORDER BY fos_user.raiting asc  LIMIT 10;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        // Set parameters
        $statement->bindValue('status', 5);
        $statement->execute();

        $FosUser = $statement->fetchAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $FosUsers=$paginator->paginate(
            $FosUser,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@AppelSponsor/Default/ConsulterSponsor.html.twig', array(
            'FosUsers' => $FosUsers,
        ));



    }

    public function statAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        //nb1
        $RAW_QUERY = 'SELECT  COUNT(*) as nb1 from appel_sponsor where prix > 0 and prix < 20;';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $nb1 = $statement->fetch();

        //nb2

        $RAW_QUERY2 = 'SELECT  COUNT(*) as nb2 from appel_sponsor where prix > 20 and prix < 40;';
        $statement2 = $em->getConnection()->prepare($RAW_QUERY2);
        $statement2->execute();
        $nb2 = $statement2->fetch();

        //nb3
        $RAW_QUERY3 = 'SELECT  COUNT(*) as nb3 from appel_sponsor where prix > 40 and prix < 60;';
        $statement3 = $em->getConnection()->prepare($RAW_QUERY3);
        $statement3->execute();
        $nb3 = $statement3->fetch();

        //nb4
        $RAW_QUERY4 = 'SELECT  COUNT(*) as nb4 from appel_sponsor where prix > 60 and prix < 80;';
        $statement4 = $em->getConnection()->prepare($RAW_QUERY4);
        $statement4->execute();
        $nb4 = $statement4->fetch();

        //nb5
        $RAW_QUERY5 = 'SELECT  COUNT(*) as nb5 from appel_sponsor where prix > 80 and prix < 100;';
        $statement5 = $em->getConnection()->prepare($RAW_QUERY5);
        $statement5->execute();
        $nb5 = $statement5->fetch();

        //nb6
        $RAW_QUERY6 = 'SELECT  COUNT(*) as nb6 from appel_sponsor where prix > 100 and prix < 120;';
        $statement6 = $em->getConnection()->prepare($RAW_QUERY6);
        $statement6->execute();
        $nb6 = $statement6->fetch();

        //nb7
        $RAW_QUERY7 =  'SELECT  COUNT(*) as nb7 from appel_sponsor where prix > 120 and prix < 150;';
        $statement7= $em->getConnection()->prepare($RAW_QUERY7);
        $statement7->execute();
        $nb7 = $statement7->fetch();

        //nb8
        $RAW_QUERY8 = 'SELECT  COUNT(*) as nb8 from appel_sponsor where prix > 150 and prix < 180;';
        $statement8= $em->getConnection()->prepare($RAW_QUERY8);
        $statement8->execute();
        $nb8 = $statement8->fetch();

        //nb9
        $RAW_QUERY9 = 'SELECT  COUNT(*) as nb9 from appel_sponsor where prix > 180 and prix < 210;';
        $statement9= $em->getConnection()->prepare($RAW_QUERY9);
        $statement9->execute();
        $nb9 = $statement9->fetch();

        //nb10
        $RAW_QUERY10 = 'SELECT  COUNT(*) as nb10 from appel_sponsor where prix > 210 and prix < 250;';
        $statement10= $em->getConnection()->prepare($RAW_QUERY10);
        $statement10->execute();
        $nb10 = $statement10->fetch();

        //nb11
        $RAW_QUERY11 = 'SELECT  COUNT(*) as nb11 from appel_sponsor where prix > 250 and prix < 300;';
        $statement11= $em->getConnection()->prepare($RAW_QUERY11);
        $statement11->execute();
        $nb11 = $statement11->fetch();

        //nb12
        $RAW_QUERY12 = 'SELECT  COUNT(*) as nb12 from appel_sponsor where prix > 300;';
        $statement12= $em->getConnection()->prepare($RAW_QUERY12);
        $statement12->execute();
        $nb12 = $statement12->fetch();

        $jan=intval($nb1['nb1']);
        $fev=intval($nb2['nb2']);
        $mars=intval($nb3['nb3']);
        $avril=intval($nb4['nb4']);
        $mai=intval($nb5['nb5']);
        $juin=intval($nb6['nb6']);
        $jui=intval($nb7['nb7']);
        $aout=intval($nb8['nb8']);
        $sep=intval($nb9['nb9']);
        $oct=intval($nb10['nb10']);
        $nov=intval($nb11['nb11']);
        $dec=intval($nb12['nb12']);


        $tab=array();
        $tab[1]=$jan;
        $tab[2]=$fev;
        $tab[3]=$mars;
        $tab[4]=$avril;
        $tab[5]=$mai;
        $tab[6]=$juin;
        $tab[7]=$jui;
        $tab[8]=$aout;
        $tab[9]=$sep;
        $tab[10]=$oct;
        $tab[11]=$nov;
        $tab[12]=$dec;

        return $this->render('@AppelSponsor/Default/stat.html.twig',array('tab'=> $tab));

    }


}
