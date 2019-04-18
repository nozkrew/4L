<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Image;
use AppBundle\Repository\ImageRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AppBundle\Form\ImageChoiceType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('content', TextareaType::class)
                ->add('picture', ImageChoiceType::class, array(
                    'query_builder' => function(ImageRepository $ir) use ($options){
                        return $ir->createQueryBuilder('i')
                                ->where('i.site = :site')
                                ->setParameter('site', $options['site']);
                    }
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
        
        $resolver->setRequired("site");
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
