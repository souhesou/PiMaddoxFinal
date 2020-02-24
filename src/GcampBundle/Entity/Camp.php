<?php

namespace GcampBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Camp
 *
 * @ORM\Table(name="camp")
 * @ORM\Entity(repositoryClass="GcampBundle\Repository\CampRepository")
 */
class Camp
{

    /**
     * @var int
     * @ORM\Column(name="Id",type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     *@ORM\ManyToOne(targetEntity="Cord")
     *@ORM\JoinColumn(name="lieu", referencedColumnName="id")
     *
     */
    private $lieu;

    /**
     * @var int
     *
     * * @Assert\GreaterThan(
     *     value=10,
     *     message="la capacité doit etre supérieur à 10"
     *     )
     *
     * @ORM\Column(name="capacite", type="integer")
     */
    private $capacite;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lieu
     *
     * @param integer $lieu
     *
     * @return Camp
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return int
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set capacite
     *
     * @param integer $capacite
     *
     * @return Camp
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return int
     */
    public function getCapacite()
    {
        return $this->capacite;
    }
}

