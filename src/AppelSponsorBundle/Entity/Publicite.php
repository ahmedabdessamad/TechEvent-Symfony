<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicite
 *
 * @ORM\Table(name="publicite")
 * @ORM\Entity
 */
class Publicite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuePub", type="string", length=255, nullable=false)
     */
    private $contenuepub;

    /**
     * @var string
     *
     * @ORM\Column(name="photoPub", type="string", length=255, nullable=false)
     */
    private $photopub;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacementPub", type="string", length=255, nullable=false)
     */
    private $emplacementpub;


}

