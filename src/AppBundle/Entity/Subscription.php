<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubscriptionRepository")
 */
class Subscription
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
     * @var int
     *
     * @ORM\Column(name="nbMonth", type="integer")
     */
    private $nbMonth;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @var Site
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Site", mappedBy="subscription")
     */
    private $sites;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;
    
    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * 
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
    
    /**
     * @var Paiement
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Paiement", mappedBy="subscription")
     */
    private $paiements;


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
     * Set nbMonth
     *
     * @param integer $nbMonth
     *
     * @return Subscription
     */
    public function setNbMonth($nbMonth)
    {
        $this->nbMonth = $nbMonth;

        return $this;
    }

    /**
     * Get nbMonth
     *
     * @return int
     */
    public function getNbMonth()
    {
        return $this->nbMonth;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Subscription
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add site
     *
     * @param \AppBundle\Entity\Site $site
     *
     * @return Subscription
     */
    public function addSite(\AppBundle\Entity\Site $site)
    {
        $this->sites[] = $site;

        return $this;
    }

    /**
     * Remove site
     *
     * @param \AppBundle\Entity\Site $site
     */
    public function removeSite(\AppBundle\Entity\Site $site)
    {
        $this->sites->removeElement($site);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Subscription
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Subscription
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add paiement.
     *
     * @param \AppBundle\Entity\Paiement $paiement
     *
     * @return Subscription
     */
    public function addPaiement(\AppBundle\Entity\Paiement $paiement)
    {
        $this->paiements[] = $paiement;

        return $this;
    }

    /**
     * Remove paiement.
     *
     * @param \AppBundle\Entity\Paiement $paiement
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePaiement(\AppBundle\Entity\Paiement $paiement)
    {
        return $this->paiements->removeElement($paiement);
    }

    /**
     * Get paiements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaiements()
    {
        return $this->paiements;
    }
}
