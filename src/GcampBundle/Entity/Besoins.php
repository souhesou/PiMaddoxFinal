<?php

namespace GcampBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Besoins
 *
 * @ORM\Table(name="besoins")
 * @ORM\Entity(repositoryClass="GcampBundle\Repository\BesoinsRepository")
 */
class Besoins
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Camp")
     * @ORM\JoinColumn(name="id_c",referencedColumnName="Id")
     */
    private $id_c;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_bs", type="string", length=255)
     */
    private $nomBs;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;


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
     * Set nomBs
     *
     * @param string $nomBs
     *
     * @return Besoins
     */
    public function setNomBs($nomBs)
    {
        $this->nomBs = $nomBs;

        return $this;
    }

    /**
     * Get nomBs
     *
     * @return string
     */
    public function getNomBs()
    {
        return $this->nomBs;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Besoins
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @return mixed
     */
    public function getIdC()
    {
        return $this->id_c;
    }

    /**
     * @param mixed $id_c
     */
    public function setIdC($id_c)
    {
        $this->id_c = $id_c;
    }

}

