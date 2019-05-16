<?php

namespace AppBundle\EventListener;

use AdminBundle\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Image;

class ImageListener {
    
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }
    
    public function preRemove(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        
        $file = $this->getTargetDirectory()."/".$entity->getSite()->getSlug()."/".$entity->getName();
        if(file_exists($file)){
            unlink($file);
        }
    }

    private function uploadFile($entity)
    {                
        // upload only works for Image entities
        if (!$entity instanceof Image) {
            return;
        }

        $file = $entity->getFile();

        if(!file_exists($this->getTargetDirectory()."/".$entity->getSite()->getSlug())){
            mkdir($this->getTargetDirectory()."/".$entity->getSite()->getSlug());
        }
        
        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            //Le fichier est dans /web/download, on le met au bon endroit
            rename($this->getTargetDirectory()."/".$fileName, $this->getTargetDirectory()."/".$entity->getSite()->getSlug()."/".$fileName);
            $entity->setName($fileName);
            
            //
            
        } elseif ($file instanceof File) {
            //$entity->setBrochure($file->getFilename());
        }
    }
    
    private function getTargetDirectory()
    {
        return __DIR__."../../../../web/download";
    }
}
