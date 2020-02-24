<?php

namespace volontaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * volontaire
 *
 * @ORM\Table(name="volontaire")
 * @ORM\Entity(repositoryClass="volontaireBundle\Repository\volontaireRepository")
 */
class volontaire
{
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
    private $cin;
    /**
     * @var int
     *
     * @Assert\GreaterThan(
     *     value=0,
     *     message="ereur"
     * )
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @return int
     *
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @var string|null
     *     @Assert\Length(max=20)(
     *     message="nom nom validéé"
     * )
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$"
     * )
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }



    /**
     * @var string|null
     *   @Assert\Length(max=20)(
     *    message="nom nom validéé")
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$"
     * )
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @Assert\Email()
     *
     * @ORM\Column(name="email", type="string", length=255 ,unique=true)
     */
    private $email;

    /**
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param int $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }




    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return volontaire
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return volontaire
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return volontaire
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


}

