<?php

namespace AppelSponsorBundle\Controller;

use AppelSponsorBundle\Entity\AppelSponsor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppelSponsorBundle\Entity\Event;
use AppelSponsorBundle\Form\EventType;

/**
 * Appelsponsor controller.
 *
 */
class AppelSponsorController extends Controller
{
    /**
     * Lists all appelSponsor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appelSponsors = $em->getRepository('AppelSponsorBundle:AppelSponsor')->findAll();

        return $this->render('@AppelSponsor/appelsponsor/index.html.twig', array(
            'appelSponsors' => $appelSponsors,
        ));
    }

    /**
     * Creates a new appelSponsor entity.
     *
     */
    public function newAction(Request $request)
    {
        $appelSponsor = new AppelSponsor();
        $form = $this->createForm('AppelSponsorBundle\Form\AppelSponsorType', $appelSponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appelSponsor);
            $em->flush();

//            return $this->redirectToRoute('appelsponsor_show', array('id' => $appelSponsor->getId()));
        }

        return $this->render('@AppelSponsor/appelsponsor/new.html.twig', array(
            'appelSponsor' => $appelSponsor,
            'form' => $form->createView(),
        ));
    }
     public function NewEventAction(Request $request)
        {
            $Event = new Event();
            $form = $this->createForm(EventType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($Event);
                $em->flush();

                //return $this->redirectToRoute('dossiersponsoring_show', array('id' => $Event->getId()));
            }

            return $this->render('@AppelSponsor/Default/NewEvent.html.twig', array(
                'Event' => $Event,
                'form' => $form->createView(),
            ));
        }

    /**
     * Finds and displays a appelSponsor entity.
     *
     */
    public function showAction(AppelSponsor $appelSponsor)
    {
        $deleteForm = $this->createDeleteForm($appelSponsor);

        return $this->render('@AppelSponsor/appelsponsor/show.html.twig', array(
            'appelSponsor' => $appelSponsor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appelSponsor entity.
     *
     */
    public function editAction(Request $request, AppelSponsor $appelSponsor)
    {
        $deleteForm = $this->createDeleteForm($appelSponsor);
        $editForm = $this->createForm('AppelSponsorBundle\Form\AppelSponsorType', $appelSponsor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appel_sponsor_edit', array('id' => $appelSponsor->getId()));
        }

        return $this->render('@AppelSponsor/appelsponsor/edit.html.twig', array(
            'appelSponsor' => $appelSponsor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appelSponsor entity.
     *
     */
    public function deleteAction(Request $request, AppelSponsor $appelSponsor)
    {
        $form = $this->createDeleteForm($appelSponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appelSponsor);
            $em->flush();
        }

        return $this->redirectToRoute('appel_sponsor_index');
    }

    /**
     * Creates a form to delete a appelSponsor entity.
     *
     * @param AppelSponsor $appelSponsor The appelSponsor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppelSponsor $appelSponsor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appel_sponsor_delete', array('id' => $appelSponsor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
