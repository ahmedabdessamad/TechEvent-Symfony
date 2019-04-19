<?php

namespace AppelSponsorBundle\Repository;

/**
 * dossierSponsoringRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends \Doctrine\ORM\EntityRepository
{

    public function RechercheTitreEvent($keyWord)
    {
        $query = $this->getEntityManager()->createQuery('SELECT v from AppelSponsorBundle:Event v WHERE v.titre LiKE :val ')
            ->setParameter('val',$keyWord);

        return $query->getResult();

    }
    public function RechercheNomEvent($keyWord)
    {
        $query = $this->getEntityManager()->createQuery('SELECT v from AppelSponsorBundle:FosUser v WHERE v.username LiKE :val ')
            ->setParameter('val',$keyWord);

        return $query->getResult();

    }
    public function TrierAction(Request $request)
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
    }
}