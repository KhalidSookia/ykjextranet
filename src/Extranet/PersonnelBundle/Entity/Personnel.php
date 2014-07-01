<?php

namespace Extranet\PersonnelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personnel
 *
 * @ORM\Table("personnel")
 * @ORM\Entity(repositoryClass="Extranet\PersonnelBundle\Entity\PersonnelRepository")
 */
class Personnel
{
    public function __construct()
    {
        $this->created_at = new \Datetime();
        $this->updated_at = new \Datetime();
        $this->active = true;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="civilite", type="boolean")
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var \DateTime
     * date of birth
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @var string
     * the place of birth
     * @ORM\Column(name="pob", type="string", length=255)
     */
    private $pob;

    /**
     * @var string
     *
     * @ORM\Column(name="ss", type="string", length=255)
     */
    private $ss;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     */
    private $nationalite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="upated_at", type="datetime")
     */
    private $updated_at;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set civilite
     *
     * @param boolean $civilite
     * @return Personnel
     */
    public function setCivilite($civilite)
    {
        if(is_bool($civilite)){

        $this->civilite = $civilite;

        return $this;

        }
    }

    /**
     * Get civilite
     *
     * @return boolean 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Personnel
     */
    public function setNom($nom)
    {
        if(is_string($nom)){

        $this->nom = $nom;

        return $this;

        }
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
     * @return Personnel
     */
    public function setPrenom($prenom)
    {
        if(is_string($prenom)){

        $this->prenom = $prenom;

        return $this;

        }
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
     * @return Personnel
     */
    public function setEmail($email)
    {
        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,5}$#", $email))
        {

        $this->email = $email;

        return $this;

        }
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

    /**
     * Set tel
     *
     * @param string $tel
     * @return Personnel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     * @return Personnel
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set ss
     *
     * @param string $ss
     * @return Personnel
     */
    public function setSs($ss)
    {
        $this->ss = $ss;

        return $this;
    }

    /**
     * Get ss
     *
     * @return string 
     */
    public function getSs()
    {
        return $this->ss;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Personnel
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     * @return Personnel
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Personnel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set pob
     *
     * @param string $pob
     * @return Personnel
     */
    public function setPob($pob)
    {
        $this->pob = $pob;

        return $this;
    }

    /**
     * Get pob
     *
     * @return string 
     */
    public function getPob()
    {
        return $this->pob;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Personnel
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Personnel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
