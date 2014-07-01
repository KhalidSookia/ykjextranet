<?php

namespace Extranet\DiversBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Taux
 *
 * @ORM\Table("taux")
 * @ORM\Entity(repositoryClass="Extranet\DiversBundle\Entity\TauxRepository")
 */
class Taux
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
     * @var float
     *
     * @ORM\Column(name="normale", type="float")
     */
    private $normale;

    /**
     * @var float
     *
     * @ORM\Column(name="repas", type="float")
     */
    private $repas;

    /**
     * @var float
     *
     * @ORM\Column(name="transport", type="float")
     */
    private $transport;


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
     * Set normale
     *
     * @param float $normale
     * @return Taux
     */
    public function setNormale($normale)
    {
        $this->normale = $normale;

        return $this;
    }

    /**
     * Get normale
     *
     * @return float 
     */
    public function getNormale()
    {
        return $this->normale;
    }

    /**
     * Set repas
     *
     * @param float $repas
     * @return Taux
     */
    public function setRepas($repas)
    {
        $this->repas = $repas;

        return $this;
    }

    /**
     * Get repas
     *
     * @return float 
     */
    public function getRepas()
    {
        return $this->repas;
    }

    /**
     * Set transport
     *
     * @param float $transport
     * @return Taux
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return float 
     */
    public function getTransport()
    {
        return $this->transport;
    }
}
