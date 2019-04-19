<?php

namespace techeventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use techeventBundle\Entity\Event;

class techeventController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('@techevent/front/index.html.twig');
    }

    public function viewEventAction(){
     $event = $this->getDoctrine()->getRepository('techeventBundle:Event')->findAll();
        return $this->render('@techevent/front/index.html.twig',array('event' => $event));
    }

}
