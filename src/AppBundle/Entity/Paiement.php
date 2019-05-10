<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaiementRepository")
 */
class Paiement
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
     * @ORM\Column(name="siteName", type="string", length=255)
     */
    private $siteName;

    /**
     * @var string
     *
     * @ORM\Column(name="secondUserFirstname", type="string", length=255)
     */
    private $secondUserFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="secondUserLastname", type="string", length=255)
     */
    private $secondUserLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="secondUserEmail", type="string", length=255)
     */
    private $secondUserEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="secondUserUsername", type="string", length=255)
     */
    private $secondUserUsername;
    
    /**
     * @var string
     *
     * @ORM\Column(name="charge_id", type="string", length=255)
     */
    private $chargeId;
    
    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User", inversedBy="paiements")
     */
    private $user;
    
    /**
     * @var Subscription
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Subscription", inversedBy="paiements")
     */
    private $subscription;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set siteName.
     *
     * @param string $siteName
     *
     * @return Paiement
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName.
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set secondUserFirstname.
     *
     * @param string $secondUserFirstname
     *
     * @return Paiement
     */
    public function setSecondUserFirstname($secondUserFirstname)
    {
        $this->secondUserFirstname = $secondUserFirstname;

        return $this;
    }

    /**
     * Get secondUserFirstname.
     *
     * @return string
     */
    public function getSecondUserFirstname()
    {
        return $this->secondUserFirstname;
    }

    /**
     * Set secondUserLastname.
     *
     * @param string $secondUserLastname
     *
     * @return Paiement
     */
    public function setSecondUserLastname($secondUserLastname)
    {
        $this->secondUserLastname = $secondUserLastname;

        return $this;
    }

    /**
     * Get secondUserLastname.
     *
     * @return string
     */
    public function getSecondUserLastname()
    {
        return $this->secondUserLastname;
    }

    /**
     * Set secondUserEmail.
     *
     * @param string $secondUserEmail
     *
     * @return Paiement
     */
    public function setSecondUserEmail($secondUserEmail)
    {
        $this->secondUserEmail = $secondUserEmail;

        return $this;
    }

    /**
     * Get secondUserEmail.
     *
     * @return string
     */
    public function getSecondUserEmail()
    {
        return $this->secondUserEmail;
    }

    /**
     * Set secondUserUsername.
     *
     * @param string $secondUserUsername
     *
     * @return Paiement
     */
    public function setSecondUserUsername($secondUserUsername)
    {
        $this->secondUserUsername = $secondUserUsername;

        return $this;
    }

    /**
     * Get secondUserUsername.
     *
     * @return string
     */
    public function getSecondUserUsername()
    {
        return $this->secondUserUsername;
    }

    /**
     * Set chargeId.
     *
     * @param string $chargeId
     *
     * @return Paiement
     */
    public function setChargeId($chargeId)
    {
        $this->chargeId = $chargeId;

        return $this;
    }

    /**
     * Get chargeId.
     *
     * @return string
     */
    public function getChargeId()
    {
        return $this->chargeId;
    }

    /**
     * Set user.
     *
     * @param \UserBundle\Entity\User|null $user
     *
     * @return Paiement
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \UserBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set subscription.
     *
     * @param \AppBundle\Entity\Subscription|null $subscription
     *
     * @return Paiement
     */
    public function setSubscription(\AppBundle\Entity\Subscription $subscription = null)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Get subscription.
     *
     * @return \AppBundle\Entity\Subscription|null
     */
    public function getSubscription()
    {
        return $this->subscription;
    }
}
