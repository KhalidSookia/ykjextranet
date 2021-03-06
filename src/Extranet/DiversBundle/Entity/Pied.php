<?php

namespace Extranet\DiversBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pied
 *
 * @ORM\Table("pied")
 * @ORM\Entity(repositoryClass="Extranet\DiversBundle\Entity\PiedRepository")
 */
class Pied
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="pied", type="text")
     */
    private $pied;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * Set nom
     *
     * @param string $nom
     * @return Pied
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
     * Set pied
     *
     * @param string $pied
     * @return Pied
     */
    public function setPied($pied)
    {
        $this->pied = $pied;

        return $this;
    }

    /**
     * Get pied
     *
     * @return string 
     */
    public function getPied()
    {
        return $this->pied;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Pied
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
}
