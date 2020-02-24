<?php

namespace PBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="PBundle\Repository\ProjetRepository")
 */
class Projet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     *
     *  @Assert\GreaterThan(
     *     value=0,
     *     message="ereur"
     * )
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     *  @Assert\Length(max=20)(
     *     message="nom nom validéé"
     * )
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$"
     * )
     *
     * @ORM\Column(name="nom_projet", type="string", length=255)
     */
    private $nomProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     *  @Assert\Length(max=20)(
     *     message="nom nom validéé"
     * )
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$"
     * )
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     *  @ORM\Column(name="nombre_participant", type="integer")
     *  @Assert\GreaterThan(
     *     value=0,
     *     message="ereur"
     * )
     *
     * @ORM\Column(name="nombre_participant", type="integer")
     */
    private $nombreParticipant;

    /**
     * @ORM\ManyToOne(targetEntity="Partenaire")
     * @ORM\JoinColumn(name="partenaire_id",referencedColumnName="id")
     */
    private  $Partenaire;

    /**
     * @return int
     */
    public function getPartenaire()
    {
        return $this->Partenaire;
    }

    /**
     * @param int $Partenaire
     */
    public function setPartenaire($Partenaire)
    {
        $this->Partenaire = $Partenaire;
    }

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
     * Set nomProjet
     *
     * @param string $nomProjet
     *
     * @return Projet
     */
    public function setNomProjet($nomProjet)
    {
        $this->nomProjet = $nomProjet;

        return $this;
    }

    /**
     * Get nomProjet
     *
     * @return string
     */
    public function getNomProjet()
    {
        return $this->nomProjet;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Projet
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Projet
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Projet
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nombreParticipant
     *
     * @param integer $nombreParticipant
     *
     * @return Projet
     */
    public function setNombreParticipant($nombreParticipant)
    {
        $this->nombreParticipant = $nombreParticipant;

        return $this;
    }

    /**
     * Get nombreParticipant
     *
     * @return int
     */
    public function getNombreParticipant()
    {
        return $this->nombreParticipant;
    }
}

/**
 * @var int
 *
 * @ORM\Column(name="cin", type="integer")
 *  @Assert\GreaterThan(
 *     value=0,
 *     message="ereur"
 * )
 * @ORM\Id
 */