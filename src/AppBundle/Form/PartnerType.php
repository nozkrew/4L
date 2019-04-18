<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AppBundle\Repository\ImageRepository;
use AppBundle\Form\ImageChoiceType;

class PartnerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
                
                ))
                ->add('description', TextareaType::class, array(
                    'attr'=> array(
                        'rows' => 5
                    )
                ))
                ->add('picture', ImageChoiceType::class, array(
                    'query_builder' => function(ImageRepository $ir) use ($options){
                        return $ir->createQueryBuilder('i')
                                ->where('i.site = :site')
                                ->setParameter('site', $options['site']);
                    }
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Partner'
        ));
        
        $resolver->setRequired("site");
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_partner';
    }


}
