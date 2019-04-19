<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Copon
 *
 * @ORM\Table(name="copon")
 * @ORM\Entity
 */
class Copon
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
     * @ORM\Column(name="codeCoupon", type="string", length=255, nullable=false)
     */
    private $codecoupon;


}

