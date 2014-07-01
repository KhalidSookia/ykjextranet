<?php

namespace Extranet\DocsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disposition
 *
 * @ORM\Table("disposition")
 * @ORM\Entity(repositoryClass="Extranet\DocsBundle\Entity\DispositionRepository")
 */
class Disposition
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
     * @var \DateTime
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity="Extranet\PersonnelBundle\Entity\Personnel")
     * @ORM\JoinColumn(nullable=true)
     */
    private $personnel;

    /**
     * @ORM\ManyToOne(targetEntity="Extranet\PersonnelBundle\Entity\Qualification")
     * @ORM\JoinColumn(nullable=true)
     */
    private $qualification;

    /**
     * @ORM\ManyToOne(targetEntity="Extranet\UtilisateurBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="Extranet\DiversBundle\Entity\Taux", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $taux;

    private $lastsDispositions;

    public function getLastsDispositions()
    {
        $q = $this->_em->createQuery('SELECT d FROM ExtranetDocsBundle:Disposition d 
            ORDER BY d.id DESC');

        $q->setMaxResults;
    }

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
     * @return Disposition
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
     * @return Disposition
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
     * @return Disposition
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

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return Disposition
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Disposition
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
     * @return Disposition
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

    /**
     * Set active
     *
     * @param boolean $active
     * @return Disposition
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
     * Set personnel
     *
     * @param \Extranet\PersonnelBundle\Entity\Personnel $personnel
     * @return Disposition
     */
    public function setPersonnel(\Extranet\PersonnelBundle\Entity\Personnel $personnel = null)
    {
        $this->personnel = $personnel;

        return $this;
    }

    /**
     * Get personnel
     *
     * @return \Extranet\PersonnelBundle\Entity\Personnel 
     */
    public function getPersonnel()
    {
        return $this->personnel;
    }

    /**
     * Set utilisateur
     *
     * @param \Extranet\UtilisateurBundle\Entity\Utilisateur $utilisateur
     * @return Disposition
     */
    public function setUtilisateur(\Extranet\UtilisateurBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Extranet\UtilisateurBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set qualification
     *
     * @param \Extranet\PersonnelBundle\Entity\Qualification $qualification
     * @return Disposition
     */
    public function setQualification(\Extranet\PersonnelBundle\Entity\Qualification $qualification = null)
    {
        $this->qualification = $qualification;

        return $this;
    }

    /**
     * Get qualification
     *
     * @return \Extranet\PersonnelBundle\Entity\Qualification 
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Set taux
     *
     * @param \Extranet\DiversBundle\Entity\Taux $taux
     * @return Disposition
     */
    public function setTaux(\Extranet\DiversBundle\Entity\Taux $taux = null)
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * Get taux
     *
     * @return \Extranet\DiversBundle\Entity\Taux 
     */
    public function getTaux()
    {
        return $this->taux;
    }

    /**
     * Set conditions
     *
     * @param \Extranet\DiversBundle\Entity\Conditions $conditions
     * @return Disposition
     */
    public function setConditions(\Extranet\DiversBundle\Entity\Conditions $conditions = null)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return \Extranet\DiversBundle\Entity\Conditions 
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set pied
     *
     * @param \Extranet\DiversBundle\Entity\Pied $pied
     * @return Disposition
     */
    public function setPied(\Extranet\DiversBundle\Entity\Pied $pied = null)
    {
        $this->pied = $pied;

        return $this;
    }

    /**
     * Get pied
     *
     * @return \Extranet\DiversBundle\Entity\Pied 
     */
    public function getPied()
    {
        return $this->pied;
    }
}
