<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Image;

/**
 * ImageSite
 *
 * @ORM\Table(name="image_site")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageSiteRepository")
 */
class ImageSite extends Image
{
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="string", length=255)
     */
    private $thumbnail;

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     *
     * @return ImageSite
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
}
