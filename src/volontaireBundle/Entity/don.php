<?php

namespace volontaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * don
 *
 * @ORM\Table(name="don")
 * @ORM\Entity(repositoryClass="volontaireBundle\Repository\donRepository")
 */
class don
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
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * Set objet
     *
     * @param string $objet
     *
     * @return don
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return don
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
     * @ORM\ManyToOne(targetEntity="volontaire")
     *  @ORM\JoinColumn(name="volontaire",referencedColumnName="cin")
     */
    private $volontaire;

    /**
     * @return mixed
     */
    public function getVolontaire()
    {
        return $this->volontaire;
    }

    /**
     * @param mixed $volontaire
     */
    public function setVolontaire($volontaire)
    {
        $this->volontaire = $volontaire;
    }




}

