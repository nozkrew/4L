<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Section
 *
 * @ORM\Table(name="section")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectionRepository")
 */
class Section
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255)
     */
    private $template;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * 
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
    
    /**
     * @var SectionSite
     * 
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\SectionSite", mappedBy="section", cascade={"persist"})
     */
    private $sectionsSite;
    
    /**
     * @var Type
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Type", inversedBy="")
     */
    private $type;


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
     * Set title
     *
     * @param string $title
     *
     * @return Section
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set template
     *
     * @param string $template
     *
     * @return Section
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Section
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
     * Constructor
     */
    public function __construct()
    {
        $this->sectionsSite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sectionsSite
     *
     * @param \AppBundle\Entity\SectionSite $sectionsSite
     *
     * @return Section
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
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Section
     */
    public function setType(\AppBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }
}
