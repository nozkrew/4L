<?php


namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Image;

class ImageChoiceType extends AbstractType{
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'class' => Image::class,
            'choice_label' => "alt",
            'placeholder' => "SELECTIONNER",
            'choice_attr' => function($image, $key, $value) {
                return ['style' => 'background:url("'.$this->getTargetDirectory()."/".$image->getSite()->getSlug()."/".$image->getName().'") no-repeat; width:100px; height:100px;'];
            }
        ));
    }

    private function getTargetDirectory()
    {
        return "/download";
    }

    public function getParent() {
        return EntityType::class;
    }
}
