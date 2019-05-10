<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SectionSite
 *
 * @ORM\Table(name="section_site")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectionSiteRepository")
 */
class SectionSite
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
     * @var integer
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private $ordering;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     * @var Section
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Section", inversedBy="sectionsSite", cascade={"persist"})
     */
    private $section;
    
    /**
     * @var Site
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Site", inversedBy="sectionsSite", cascade={"persist"})
     */
    private $site;


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
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return SectionSite
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return SectionSite
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set section
     *
     * @param \AppBundle\Entity\Section $section
     *
     * @return SectionSite
     */
    public function setSection(\AppBundle\Entity\Section $section = null)
    {
        $this->section = $section;
        $section->addSectionsSite($this);

        return $this;
    }

    /**
     * Get section
     *
     * @return \AppBundle\Entity\Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set site
     *
     * @param \AppBundle\Entity\Site $site
     *
     * @return SectionSite
     */
    public function setSite(\AppBundle\Entity\Site $site = null)
    {
        $this->site = $site;
        $site->addSectionsSite($this);

        return $this;
    }

    /**
     * Get site
     *
     * @return \AppBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }
}
