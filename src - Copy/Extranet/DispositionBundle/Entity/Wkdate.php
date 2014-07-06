<?php

namespace Extranet\DispositionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wkdate
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Extranet\DispositionBundle\Entity\WkdateRepository")
 */
class Wkdate
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
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heuredebut", type="time")
     */
    private $heuredebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dureequotidienne", type="time")
     */
    private $dureequotidienne;


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
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return Wkdate
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    
        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set heuredebut
     *
     * @param \DateTime $heuredebut
     * @return Wkdate
     */
    public function setHeuredebut($heuredebut)
    {
        $this->heuredebut = $heuredebut;
    
        return $this;
    }

    /**
     * Get heuredebut
     *
     * @return \DateTime 
     */
    public function getHeuredebut()
    {
        return $this->heuredebut;
    }

    /**
     * Set dureequotidienne
     *
     * @param \DateTime $dureequotidienne
     * @return Wkdate
     */
    public function setDureequotidienne($dureequotidienne)
    {
        $this->dureequotidienne = $dureequotidienne;
    
        return $this;
    }

    /**
     * Get dureequotidienne
     *
     * @return \DateTime 
     */
    public function getDureequotidienne()
    {
        return $this->dureequotidienne;
    }
}
