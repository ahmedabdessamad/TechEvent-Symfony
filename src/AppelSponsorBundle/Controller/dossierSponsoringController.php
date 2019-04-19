<?php

namespace AppelSponsorBundle\Controller;

use AppelSponsorBundle\Entity\AppelSponsor;
use AppelSponsorBundle\Entity\dossierSponsoring;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use techeventBundle\Tests\Controller\AppelSponsorControllerTest;

/**
 * Dossiersponsoring controller.
 *
 */
class dossierSponsoringController extends Controller
{
    /**
     * Lists all dossierSponsoring entities.
     *
     */

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dossierSponsorings = $em->getRepository('AppelSponsorBundle:dossierSponsoring')->findAll();

        return $this->render('@AppelSponsor/dossiersponsoring/index.html.twig', array(
            'dossierSponsorings' => $dossierSponsorings,
        ));
    }

    /**
     * Creates a new dossierSponsoring entity.
     *
     */
    public function newAction(Request $request)
    {
        $dossierSponsoring = new Dossiersponsoring();
        $form = $this->createForm('AppelSponsorBundle\Form\dossierSponsoringType', $dossierSponsoring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dossierSponsoring);
            $em->flush();

            return $this->redirectToRoute('dossiersponsoring_show', array('id' => $dossierSponsoring->getId()));
        }

        return $this->render('@AppelSponsor/dossiersponsoring/new.html.twig', array(
            'dossierSponsoring' => $dossierSponsoring,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dossierSponsoring entity.
     *
     */
    public function showAction(dossierSponsoring $dossierSponsoring)
    {
        $deleteForm = $this->createDeleteForm($dossierSponsoring);

        return $this->render('@AppelSponsor/dossiersponsoring/show.html.twig', array(
            'dossierSponsoring' => $dossierSponsoring,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function insertDemandeSponsorSilverAction(Request $request,$id,$prix)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('AppelSponsorBundle:Event')->find($id);
        $p = $event->getTitre();
        $d = $event->getDateevent();

         $dossier = new AppelSponsor();

        $dossier->setEvent($event);
        $dossier->setNomevent($p);
        $dossier->setDateevent($d);
        $dossier->setRole("sponsor");
        $dossier->setPrix($prix);
        $dossier->setConfirmation("no");
        //$dossier->setUser(2);
         $em->persist($dossier);
         $em->flush();

        //        //$user = $this->get('security.token_storage')->getToken()->getUser();
        //        $em = $this->getDoctrine()->getManager();
        //        //$annonce = $em->getRepository('AppelSponsorBundle:FosUser')->find($id);
        //        $libRadio = $request->get('radioLib');
        //        $signal->setDescription($libRadio);
        //        $signal->setSponsor(1);
        //        $signal->setClub("1");
        //        $em->persist($signal);
        //        $em->flush();
             return $this->redirectToRoute('appel_sponsor_ Events');
        ///

    }

    public function visualAction(Request $request, $id)
    {
        $id = $request->get('id');
       // dump($id);exit()
        $em = $this->getDoctrine()->getManager();
//        $qb = $em->createQueryBuilder('e');
////        $dossierSponsoring = $qb->select('e')
////            ->from('AppelSponsorBundle:dossierSponsoring','e')
////            ->where('e.event = :p')
////            ->setParamter('p',$id)
////            ->getQuery()
////            ->getResult();
        $dossierSponsoring =  $em->getRepository('AppelSponsorBundle:dossierSponsoring')->findByevent($id);
        //$dossierSponsoring =  $em->getRepository('AppelSponsorBundle:dossierSponsoring')->findAll();

        return $this->render('@AppelSponsor/dossiersponsoring/showdossier.html.twig', array(
            'dossierSponsoring' => $dossierSponsoring,

        ));
    }




    public function pdfAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();

        $dossierSponsoring = $em->getRepository('AppelSponsorBundle:dossierSponsoring')->find($id);
        $snappy=$this->get("knp_snappy.pdf");

        $html = $this->renderView("@AppelSponsor/dossiersponsoring/dossiersponsoringPdf.html.twig", array(
            "title" =>"liste_des_question_filtrer_pdf",
            'dossierSponsoring' => $dossierSponsoring
        ));
        $filename="question_filtrer_pdf";


        return new  Response(
            $snappy->getOutputFromHtml($html),
            200,

            array(
                'Content-Type' =>'application/pdf',
                'Content-Disposition' =>'inline; filename"'.$filename.'.pdf"',
            )
        );



    }

    /**
     * Displays a form to edit an existing dossierSponsoring entity.
     *
     */
    public function editAction(Request $request, dossierSponsoring $dossierSponsoring)
    {
        $deleteForm = $this->createDeleteForm($dossierSponsoring);
        $editForm = $this->createForm('AppelSponsorBundle\Form\dossierSponsoringType', $dossierSponsoring);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dossiersponsoring_edit', array('id' => $dossierSponsoring->getId()));
        }

        return $this->render('@AppelSponsor/dossiersponsoring/edit.html.twig', array(
            'dossierSponsoring' => $dossierSponsoring,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dossierSponsoring entity.
     *
     */
    public function deleteAction(Request $request, dossierSponsoring $dossierSponsoring)
    {
        $form = $this->createDeleteForm($dossierSponsoring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dossierSponsoring);
            $em->flush();
        }

        return $this->redirectToRoute('dossiersponsoring_index');
    }

    /**
     * Creates a form to delete a dossierSponsoring entity.
     *
     * @param dossierSponsoring $dossierSponsoring The dossierSponsoring entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(dossierSponsoring $dossierSponsoring)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dossiersponsoring_delete', array('id' => $dossierSponsoring->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function RecherchCategorieAction(Request $request, $cat)
    {

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('EcoBundle:CategorieAnnonce')->findAll();
        $liste = $em->getRepository('EcoBundle:AnnoncePanier')->findAll();
        $lc = $em->getRepository('EcoBundle:LigneCommande')->findAll();
        $annnonce = new Annonce();
        $annnonce = $em->getRepository('EcoBundle:Annonce')->findByCategorie($cat);

        return $this->render('@Eco/Front/Annonce/annonce.html.twig', array(
            "annonces" => $annnonce, 'categories' => $categories,'liste' => $liste,'lc' => $lc

        ));
    }

//    public function newappelspon1Action($id,$user_id,$prix,$nomevent,$dateevent,$nomsponsor)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $qb = $em->createQueryBuilder('e');
//        $qb->insert('AppelSponsorBundle:AppelSponsor', 'momc')
//            ->values(array(
//                momc.event => '?'
//                momc.user => '?'
//                'role' => '?'
//                'confirmation' => '?'
//                'prix' => '?'
//                'nomevent' => '?'
//                'dateevent' => '?'
//                'nomsponsor' => '?'
//
//   ))
//        ->setParameter(0, $id)
//        ->setparameter(1, $user_id)
//        ->setParameter(2, "sponsor")
//        ->setparameter(3, "non")
//        ->setParameter(4, $prix)
//        ->setparameter(5, $nomevent)
//        ->setParameter(6, $id)
//        ->setparameter(7, $dateevent)
//        ->setParameter(8, $nomsponsor)
//        ->getQuery()
//        ->getResult();
//
//        }

  /*  public function TrierAction(Request $request)
    {

        $val = $request->get('val');
        //dump($val);exit();
        if ($val == 'PR') {
            $em = $this->getDoctrine()->getManager();
            $categories = $em->getRepository('EcoBundle:CategorieAnnonce')->findAll();
            $liste = $em->getRepository('EcoBundle:AnnoncePanier')->findAll();
            $lc = $em->getRepository('EcoBundle:LigneCommande')->findAll();
            $annonces = $em->getRepository('EcoBundle:Annonce')->trierPlusRecent();
            $likes = $em->getRepository('EcoBundle:Annonce')->likeAnnonce();
        } elseif ($val == 'PE') {
            $em = $this->getDoctrine()->getManager();
            $categories = $em->getRepository('EcoBundle:CategorieAnnonce')->findAll();
            $liste = $em->getRepository('EcoBundle:AnnoncePanier')->findAll();
            $lc = $em->getRepository('EcoBundle:LigneCommande')->findAll();
            $annonces = $em->getRepository('EcoBundle:Annonce')->trierPrixElv();
            $likes = $em->getRepository('EcoBundle:Annonce')->likeAnnonce();

        } elseif ($val == 'PB') {

            $em = $this->getDoctrine()->getManager();
            $categories = $em->getRepository('EcoBundle:CategorieAnnonce')->findAll();
            $liste = $em->getRepository('EcoBundle:AnnoncePanier')->findAll();
            $lc = $em->getRepository('EcoBundle:LigneCommande')->findAll();
            $annonces = $em->getRepository('EcoBundle:Annonce')->trierPrixBas();
            $likes = $em->getRepository('EcoBundle:Annonce')->likeAnnonce();

        }
        return $this->render('@Eco/Front/Annonce/annonce.html.twig', array(
            "annonces" => $annonces, 'categories' => $categories, 'likes' => $likes,'liste' => $liste,'lc' => $lc
        ));
    }*/
    /**
     * @Route("/pdf/{id}", name="pdf")
     */
/*
    public function pdfAction(Request $request)
    {
        $val = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('EcoBundle:Annonce')->find($val);

        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('@Eco/Front/Annonce/annoncePdf.html.twig', array(
            'annonce' => $annonce,
        ));

        $filename = 'Annonce';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }*/
    /**
     *
     * @Route("/annonce/recherche", name="f_recherche")
     * @Method({"GET", "POST"})
     */
//    public function rechercheAction(Request $request)
//    {
//        $keyWord = $request->get('keyWord');
//        // dump($keyWord);
//        if($keyWord == '')
//        {
//            $annonce = $this->getDoctrine()->getRepository('EcoBundle:Annonce')->findAll();
//        }else
//        {
//            $annonce = $this->getDoctrine()->getRepository('EcoBundle:Annonce')->RechercheTitreAnnonce($keyWord);
//
//        }
//
//        $template = $this->render( '@Eco/Front/Annonce/Recherche.html.twig', array("annonces" => $annonce))->getContent();
//        $json     = json_encode($template);
//        $response = new Response($json, 200);
//        $response->headers->set('Content-Type', 'application/json');
//
//        return $response;
//    }

}
