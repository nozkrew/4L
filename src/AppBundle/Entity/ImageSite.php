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
}
