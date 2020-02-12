<?php


namespace RefugieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 *
 */
class RefConsult
{
    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $sujet;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $contenu;
    /**
     * @ORM\Column(type="date")
     */
    private $date;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="Refugie")
     * @ORM\JoinColumn(name="idref",referencedColumnName="id")
     */
    public $idref;

    /**
     * @return mixed
     */
    public function getIdref()
    {
        return $this->idref;
    }

    /**
     * @param mixed $idref
     */
    public function setIdref($idref)
    {
        $this->idref = $idref;
    }





    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param mixed $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate ($date)
    {
        $this->date= $date;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

}