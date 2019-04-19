<?php

namespace techeventBundle\Controller;

use techeventBundle\Entity\Archive;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Archive controller.
 *
 * @Route("archive")
 */
class ArchiveController extends Controller
{
    /**
     * Lists all archive entities.
     *
     * @Route("/", name="archive_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $archives = $em->getRepository('techeventBundle:Archive')->findAll();

        return $this->render('archive/index.html.twig', array(
            'archives' => $archives,
        ));
    }

    /**
     * Finds and displays a archive entity.
     *
     * @Route("/{id}", name="archive_show")
     * @Method("GET")
     */
    public function showAction(Archive $archive)
    {

        return $this->render('archive/show.html.twig', array(
            'archive' => $archive,
        ));
    }
}
