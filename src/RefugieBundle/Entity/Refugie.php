<?php


namespace RefugieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;
/**
 * @ORM\Entity
 *
 */
class Refugie
{
    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\Length(min="3",max="30",minMessage="Please enter at least 3 characters",maxMessage="Please do not exceed 30 characters")
     * @Assert\NotBlank(message="please fill in the field")
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",message="Special characters prohibited")
     */
    private $nom;
    /**
     * @ORM\Column(type="string",length=255)
     *  @Assert\Length(min="3",max="30",minMessage="Please enter at least 3 characters",maxMessage="Please do not exceed 30 characters")
     *  @Assert\NotBlank(message="please fill in the field")
     *  @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",message="Special characters prohibited"
     * )
     */
    private $prenom;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="please fill in the field")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Negative age",
     *      maxMessage = "Error Age"
     * )
     */
    private $age;
    /**
     * @ORM\Column(type="string",length=255)
     *  @Assert\Length(min="3",max="20",minMessage="Please enter at least 3 characters",maxMessage="Please do not exceed 20 characters")
     *  @Assert\NotBlank(message="please fill in the field")
     *  @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",message="Special characters prohibited")
     */
    private $origine;

    /**
     * @ORM\ManyToOne(targetEntity="GcampBundle\Entity\Camp")
     * @ORM\JoinColumn(name="idcamp",referencedColumnName="Id")
     */
    public $idcamp;



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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * @param mixed $origine
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

    /**
     * @return mixed
     */
    public function getIdCamp()
    {
        return $this->idcamp;
    }

    /**
     * @param mixed $id_camp
     */
    public function setIdCamp($idcamp)
    {
        $this->idcamp = $idcamp;
    }


}