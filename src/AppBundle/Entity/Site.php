<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Site
 *
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SiteRepository")
 */
class Site
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
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
     * @var User
     * 
     * @ORM\OneToMany(targetEntity="\UserBundle\Entity\User", mappedBy="site", cascade={"persist", "remove"})
     */
    private $users;
    
    /**
     * @var Post
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Post", mappedBy="articles")
     */
    private $posts;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;
    
    /**
     * @var Subscription
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Subscription", inversedBy="sites")
     */
    private $subscription;
    
    /**
     * @var SectionSite
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\SectionSite", mappedBy="site", cascade={"persist"})
     */
    private $sectionsSite;
    
    /**
     * @var Article
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Article", mappedBy="site")
     */
    private $articles;
    
    /**
     * @var Partner
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Partner", mappedBy="site")
     */
    private $partners;
    
    /**
     * @var Contact
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Contact", mappedBy="site")
     */
    private $contacts;
    
    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;
    
    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;
    
    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=true)
     */
    private $instagram;
    
    /**
     * @var Image
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Image", mappedBy="site")
     */
    private $pictures;
    
    /**
     * @var Image
     * 
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Image")
     */
    private $headerImage;


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
     * Set name
     *
     * @param string $name
     *
     * @return Site
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createDate = new \DateTime();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Site
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Site
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;
        $user->setSite($this);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add post
     *
     * @param \AppBundle\Entity\Post $post
     *
     * @return Site
     */
    public function addPost(\AppBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \AppBundle\Entity\Post $post
     */
    public function removePost(\AppBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     *
     * @return Site
     */
    public function setSubscription(\AppBundle\Entity\Subscription $subscription = null)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Get subscription
     *
     * @return \AppBundle\Entity\Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Site
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add sectionsSite
     *
     * @param \AppBundle\Entity\SectionSite $sectionsSite
     *
     * @return Site
     */
    public function addSectionsSite(\AppBundle\Entity\SectionSite $sectionsSite)
    {
        $this->sectionsSite[] = $sectionsSite;

        return $this;
    }

    /**
     * Remove sectionsSite
     *
     * @param \AppBundle\Entity\SectionSite $sectionsSite
     */
    public function removeSectionsSite(\AppBundle\Entity\SectionSite $sectionsSite)
    {
        $this->sectionsSite->removeElement($sectionsSite);
    }

    /**
     * Get sectionsSite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSectionsSite()
    {
        return $this->sectionsSite;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Site
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add partner
     *
     * @param \AppBundle\Entity\Partner $partner
     *
     * @return Site
     */
    public function addPartner(\AppBundle\Entity\Partner $partner)
    {
        $this->partners[] = $partner;

        return $this;
    }

    /**
     * Remove partner
     *
     * @param \AppBundle\Entity\Partner $partner
     */
    public function removePartner(\AppBundle\Entity\Partner $partner)
    {
        $this->partners->removeElement($partner);
    }

    /**
     * Get partners
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Add contact
     *
     * @param \AppBundle\Entity\Contact $contact
     *
     * @return Site
     */
    public function addContact(\AppBundle\Entity\Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \AppBundle\Entity\Contact $contact
     */
    public function removeContact(\AppBundle\Entity\Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Site
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Site
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set instagram
     *
     * @param string $instagram
     *
     * @return Site
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram
     *
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set headerImage
     *
     * @param \AppBundle\Entity\Image $headerImage
     *
     * @return Site
     */
    public function setHeaderImage(\AppBundle\Entity\Image $headerImage = null)
    {
        $this->headerImage = $headerImage;

        return $this;
    }

    /**
     * Get headerImage
     *
     * @return \AppBundle\Entity\Image
     */
    public function getHeaderImage()
    {
        return $this->headerImage;
    }

    /**
     * Add picture
     *
     * @param \AppBundle\Entity\Image $picture
     *
     * @return Site
     */
    public function addPicture(\AppBundle\Entity\Image $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \AppBundle\Entity\Image $picture
     */
    public function removePicture(\AppBundle\Entity\Image $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }
}
