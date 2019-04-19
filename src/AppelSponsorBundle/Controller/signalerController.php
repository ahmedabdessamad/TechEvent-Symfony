<?php

namespace AppelSponsorBundle\Controller;

use AppelSponsorBundle\Entity\FosUser;
use AppelSponsorBundle\Entity\Signaler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Signaler controller.
 *
 */
class signalerController extends Controller
{
    /**
     * Lists all signaler entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $signalers = $em->getRepository('AppelSponsorBundle:Signaler')->findAll();

        return $this->render('@AppelSponsor/signaler/index.html.twig', array(
            'signalers' => $signalers,
        ));
    }

    /**
     * Creates a new signaler entity.
     *
     */
    public function newAction(Request $request)
    {
        $signaler = new Signaler();
        $form = $this->createForm('AppelSponsorBundle\Form\SignalerType', $signaler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($signaler);
            $em->flush();

            return $this->redirectToRoute('signaler_show', array('id' => $signaler->getId()));
        }

        return $this->render('@AppelSponsor/signaler/new.html.twig', array(
            'signaler' => $signaler,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a signaler entity.
     *
     */
    public function showAction(Signaler $signaler)
    {
        $deleteForm = $this->createDeleteForm($signaler);

        return $this->render('signaler/show.html.twig', array(
            'signaler' => $signaler,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing signaler entity.
     *
     */
    public function editAction(Request $request, Signaler $signaler)
    {
        $deleteForm = $this->createDeleteForm($signaler);
        $editForm = $this->createForm('AppelSponsorBundle\Form\SignalerType', $signaler);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('signaler_edit', array('id' => $signaler->getId()));
        }

        return $this->render('@AppelSponsor/signaler/edit.html.twig', array(
            'signaler' => $signaler,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a signaler entity.
     *
     */
    public function deleteAction(Request $request, Signaler $signaler)
    {
        $form = $this->createDeleteForm($signaler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($signaler);
            $em->flush();
        }

        return $this->redirectToRoute('signaler_index');
    }
    public function SignalAction(Request $request,$id)
    {
        $em1 = $this->getDoctrine()->getManager();

        $signal = new Signaler();
        //$user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        //$annonce = $em->getRepository('AppelSponsorBundle:FosUser')->find($id);
        $libRadio = $request->get('radioLib');
        $signal->setDescription($libRadio);
        $signal->setSponsor(1);
        $signal->setClub("1");
        $em->persist($signal);
        $em->flush();
        return $this->redirectToRoute('appel_sponsor_ Sponsors');
    }

    /**
     * Creates a form to delete a signaler entity.
     *
     * @param Signaler $signaler The signaler entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Signaler $signaler)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('signaler_delete', array('id' => $signaler->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
