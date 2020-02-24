<?php

namespace GcampBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation")
 * @ORM\Entity(repositoryClass="GcampBundle\Repository\AffectationRepository")
 */
class Affectation
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
     * @ORM\ManyToOne(targetEntity="Besoins")
     * @ORM\JoinColumn(name="id_bs",referencedColumnName="id")
     */
    private $idBs;
    /**
     * @ORM\ManyToOne(targetEntity="volontaireBundle\Entity\don")
     * @ORM\JoinColumn(name="id_don",referencedColumnName="id")
     */
    private $idDon;

    /**
     * @var int
     *
     * @ORM\Column(name="qnt", type="integer")
     */
    private $qnt;


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
     * Set idBs
     *
     * @param integer $idBs
     *
     * @return Affectation
     */
    public function setIdBs($idBs)
    {
        $this->idBs = $idBs;

        return $this;
    }

    /**
     * Get idBs
     *
     * @return int
     */
    public function getIdBs()
    {
        return $this->idBs;
    }

    /**
     * Set idDon
     *
     * @param integer $idDon
     *
     * @return Affectation
     */
    public function setIdDon($idDon)
    {
        $this->idDon = $idDon;

        return $this;
    }

    /**
     * Get idDon
     *
     * @return int
     */
    public function getIdDon()
    {
        return $this->idDon;
    }

    /**
     * Set qnt
     *
     * @param integer $qnt
     *
     * @return Affectation
     */
    public function setQnt($qnt)
    {
        $this->qnt = $qnt;

        return $this;
    }

    /**
     * Get qnt
     *
     * @return int
     */
    public function getQnt()
    {
        return $this->qnt;
    }
}

