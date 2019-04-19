<?php

namespace eventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use techeventBundle\Entity\Event;
use techeventBundle\Entity\Inttereser;
use techeventBundle\Entity\User;
use techeventBundle\Entity\Interesser;
use techeventBundle\Repository;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;

class DefaultController extends Controller
{


    public function alleventAction(Request $request)
    {
        //redirection based on role
        $id = $this->getUser()->getId();
        $role = $this->getUser()->getRoles();
        if ($role[0] == "ROLE_SUPER_ADMIN"){
         $id = $this->getUser()->getId();
            return $this->redirect($this->generateUrl('Create_post'));
        }
        if ($role[0] == "ROLE_CLUB"){
            $id = $this->getUser()->getId();
            return $this->redirect($this->generateUrl('Alleventclub',array('id'=>$id)));
        }
        if ($role[0] == "ROLE_SPONSOR"){
            $id = $this->getUser()->getId();
            return $this->redirect($this->generateUrl('appel_sponsor_index2'));
        }
        //redirection based on role
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.validation = :d')
            ->setParameter('d',"1")
            ->orderBy('e.id','desc')
            ->getQuery()
            ->getResult();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event1=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12)
        );
        return $this->render('@event/Default/allevent.html.twig', array(
            'events' => $event1,
        ));



    }

    public function rechercheAction(Request $request)
    { $em = $this->getDoctrine()->getManager();
        $id=$request->get('rech');
        $results = $this->getDoctrine()->getManager()
            ->createQuery("
	            SELECT p FROM techeventBundle:Event p
	            WHERE p.titre LIKE :key AND p.validation = :d "
            );
        $results->setParameter('key', '%'.$id.'%')
        ->setParameter('d', "1");
        $results->getResult();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event1=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12)
        );
        return $this->render('@event/Default/allevent.html.twig', array(
            'events' => $event1,
        ));



    }


    public function recherchedateAction(Request $request)
    {

        $date1=$request->get('prixmin');
        $date2=$request->get('prixmax');
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.dateevent BETWEEN :min AND :max and e.validation = :d')
                ->setParameter('min', $date1)
                ->setParameter('max', $date2)
                ->setParameter('d', "1")
                ->getQuery()
                 ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event1=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12)
        );
        return $this->render('@event/Default/allevent.html.twig', array(
            'events' => $event1,
        ));



    }



    public function AllEventClubAction(Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.user = :b')
            ->setParameter('b', $id)
            ->OrderBy('e.id','desc')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/alleventclub.html.twig', array(
            'events' => $event2,
        ));
    }


    public function HomeAction(Request $request)
    {

        return $this->render('@event/Default/index.html.twig');
    }

    public function AllEventbyprixdescAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.validation = :d')
            ->setParameter('d', "1")
            ->orderBy('e.prix','DESC')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/allevent.html.twig', array(
            'events' => $event2,
        ));
    }

    public function AllEventbyprixasecAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.validation = :d')
            ->setParameter('d', "1")
            ->orderBy('e.prix','ASC')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/allevent.html.twig', array(
            'events' => $event2,
        ));
    }
    public function AllinteresserAction(Request $request)
    {
        $id = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT t FROM techeventBundle:Event t   WHERE t.id  IN(SELECT  r.eventId FROM techeventBundle:Inttereser r WHERE r.userId =:id )')
        ->setParameter('id', $id);
        $results = $query->getResult();




        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/alleventinterreser.html.twig', array(
            'events' => $event2,
        ));
    }


    public function AffEventClubAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('techeventBundle:Event')->find($id);

        return $this->render('@event/Default/AffEventClub.html.twig',array('event'=>$event) );
    }




    public function AffEventAction($id , $cat)


    {

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('techeventBundle:Event')->find($id);

        $em1 = $this->getDoctrine()->getManager();
        $query = $em1->createQuery('SELECT t FROM techeventBundle:Event t   WHERE t.categorie =:t ')
            ->setParameter('t',$cat);
        $results = $query->getResult();

        return $this->render('@event/Default/AffEvent.html.twig',array('event'=>$event, 'events'=>$results) );
    }

    public function DeleteEventAction(Request $request,$id )
    {  $idu = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository('techeventBundle:Event')->find($id);
        $em->remove($event);
        $em->flush();


        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.user = :b')
            ->setParameter('b', $idu)
            ->OrderBy('e.id','desc')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/alleventclub.html.twig', array(
            'events' => $event2,
        ));

    }


    public function DeleteEventinteresserAction(Request $request ,$id)
    {      $idu = $this->getUser()->getId();

        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder();



        $qb ->DELETE('techeventBundle:Inttereser', 'e')



            ->where('e.eventId = :b AND e.userId =:a')
            ->setParameter('b', $id)
            ->setParameter('a', $idu)
            ->getQuery()
            ->execute();;


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT t FROM techeventBundle:Event t   WHERE t.id  IN(SELECT  r.eventId FROM techeventBundle:Inttereser r WHERE r.userId =:av )')
            ->setParameter('av', $idu);
        $results = $query->getResult();




        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/alleventinterreser.html.twig', array(
            'events' => $event2,
        ));



    }

    public function allusersinteresserAction( $id)
    {
        $em1 = $this->getDoctrine()->getManager();
        $query = $em1->createQuery('SELECT t FROM techeventBundle:User t   WHERE t.id  IN(SELECT  r.userId FROM techeventBundle:Inttereser r WHERE r.eventId =:t )')
            ->setParameter('t',$id);
        $results = $query->getResult();


        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('techeventBundle:Event')->find($id);

        return $this->render('@event/Default/alluserinteresser.html.twig', array(
            'users' => $results, 'even' =>$event
        ));

    }







    public function MofidiereventAction(Request $request, $id)
    {
        $titre=$request->get('titre');
        $description=$request->get('description');

        $nbrplace=$request->get('nbrplace');
        $localisation=$request->get('localisation');
        $dateevent=$request->get('dateevent');
        $hdebut=$request->get('hdebut');
        $hfin=$request->get('hfin');

        $prix=$request->get('prix');
        $categories=$request->get('categories');
        $type=$request->get('type');


        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder();



        $qb ->update('techeventBundle:Event', 'e')
            ->set('e.titre',"'$titre'")
            ->set('e.description',"'$description'")
            ->set('e.nbrplaces',"'$nbrplace'")
            ->set('e.localisation',"'$localisation'")
            ->set('e.dateevent',"'$dateevent'")
            ->set('e.hdebut',"'$hdebut'")
            ->set('e.hfin',"'$hfin'")
            ->set('e.prix',"'$prix'")
            ->set('e.categorie',"'$categories'")
            ->set('e.type',"'$type'")
            ->where('e.id  = :a')
            ->setParameter('a', $id)
            ->getQuery()
            ->execute();;
        $id = $this->getUser()->getId();

        $em1 = $this->getDoctrine()->getManager();
        $qbv = $em1->createQueryBuilder('e');
        $results = $qbv->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.user = :b')
            ->setParameter('b',$id )
            ->OrderBy('e.id','desc')
            ->getQuery()

            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/alleventclub.html.twig', array(
            'events' => $event2,
        ));



    }


    public function AjouterEventAction(Request $request)
    {

        $event = new Event();
        $id = $this->getUser()->getId();

        if ($request->isMethod('POST')) {
            $usr = new User();
            $usr->setId($id);
            $event->setUser($usr);

            $event->setTitre($request->get('titre'));
            $event->setDescription($request->get('description'));

            $event->setNbrplaces($request->get('nbrpalce'));
            $event->setLocalisation($request->get('localisation'));
            $event->setDateevent($request->get('dateevent'));
            $event->setHdebut($request->get('hdebut'));
            $event->setHfin($request->get('hfin'));
            $event->setPrix($request->get('prix'));
            $event->setCategorie($request->get('categories'));
            $event->setType($request->get('type'));
            $event->setValidation("0");
            $event->setAffiche('00001.jpg');



            $datetime1 = new \DateTime('now');
            $datetime2 =  new \DateTime($request->get('dateevent'));

            $interval = $datetime1->diff($datetime2);
            $test= $interval->format('%R%a days');
            $greater = substr($test,0,1);
                $em=$this->getDoctrine()->getManager();
            if (strcmp($greater,"+")==0) {
                $em->merge($event);
                $em->flush();
            }
            else{
                return $this->redirectToRoute('event');

            }
        }




        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.user = :b')
            ->setParameter('b', $id)
            ->OrderBy('e.id','desc')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/alleventclub.html.twig', array(
            'events' => $event2,
        ));



    }

    public  function acceptereventAction (Request $request ,$id)
    {

        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder();


        $qb->update('techeventBundle:Event', 'e')
            ->set('e.validation', 1)
            ->where('e.id  = :a')
            ->setParameter('a', $id)
            ->getQuery()
            ->execute();;
        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event', 'e')
            ->OrderBy('e.id','desc')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2 = $paginator->paginate(
            $results,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12));
        return $this->render('@event/Default/Eventadmin.html.twig', array(
            'events' => $event2,
        ));
    }
        public  function refusereventAction (Request $request ,$id){

            $em1 = $this->getDoctrine()->getManager();
            $qb = $em1->createQueryBuilder();



            $qb ->update('techeventBundle:Event', 'e')
                ->set('e.validation',2)
                ->where('e.id  = :a')
                ->setParameter('a', $id)
                ->getQuery()
                ->execute();;


            $em1 = $this->getDoctrine()->getManager();
            $qb = $em1->createQueryBuilder('e');
            $results = $qb->select('e')
                ->from('techeventBundle:Event','e')
                ->OrderBy('e.id','desc')
                ->getQuery()
                ->getResult();

            /**
             * @var $paginator \Knp\Component\Pager\Paginator
             */

            $paginator = $this->get('knp_paginator');
            $event2=$paginator->paginate(
                $results,
                $request->query->getInt('page',1),
                $request->query->getInt('limit',12));
            return $this->render('@event/Default/Eventadmin.html.twig', array(
                'events' => $event2,
            ));


        }


    public function recupereEventAction($id)
    {


        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder('e');
        $even = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->where('e.id = :b')
            ->setParameter('b', $id)
            ->getQuery()
            ->getResult();

        return $this->render('@event/Default/eventrecuperer.html.twig',array('events'=>$even) );



    }

        public function IntersserAction(Request $request, $id){

            $inters = new Inttereser();
            $idu = $this->getUser()->getId();

            if ($request->isMethod('POST')) {
                $usr = new User();


                $inters->setUserId($idu);
                $inters->setEventId($id);
                $em = $this->getDoctrine()->getManager();
                $em->persist($inters);
                $em->flush();

                return $this->redirectToRoute('allevent');
            }
            return $this->redirectToRoute('allevent');

        }



    public function EventadminAction(Request $request)
    {


        $em1 = $this->getDoctrine()->getManager();
        $qb = $em1->createQueryBuilder('e');
        $results = $qb->select('e')
            ->from('techeventBundle:Event','e')
            ->OrderBy('e.id','desc')
            ->getQuery()
            ->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        $event2=$paginator->paginate(
            $results,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',12));
        return $this->render('@event/Default/Eventadmin.html.twig', array(
            'events' => $event2,
        ));
    }


        public function AjouterAction(){

        return $this->render('@event/Default/event.html.twig');

    }


    public function sendMailAction( $email ,$nom, $nomevent, $date, $id)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject("TECH EVENT: ".$nomevent)
            ->setFrom('techevent5013@gmail.com')
            ->setTo($email)
            ->setBody("Salut ".$nom." l'event ".$nomevent."  se déroulera le ".$date." \n SOYEZ LE BIENVENUE");

        $this->get('mailer')->send($message);




        $em1 = $this->getDoctrine()->getManager();
        $query = $em1->createQuery('SELECT t FROM techeventBundle:User t   WHERE t.id  IN(SELECT  r.userId FROM techeventBundle:Inttereser r WHERE r.eventId =:t )')
            ->setParameter('t',$id);
        $results = $query->getResult();


        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('techeventBundle:Event')->find($id);

        return $this->render('@event/Default/alluserinteresser.html.twig', array(
            'users' => $results, 'even' =>$event
        ));

    }
}
