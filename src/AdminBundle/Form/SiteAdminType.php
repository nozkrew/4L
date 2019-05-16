<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use UserBundle\Form\UserType;
use AppBundle\Form\ImageChoiceType;
use AppBundle\Repository\ImageRepository;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SiteAdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('users', CollectionType::class, array(
                    'entry_type' => UserType::class,
                    'entry_options' => array(
                        'site' =>$options['data']
                    ),
                    'by_reference' => false
                ))
                ->add('headerImage', ImageChoiceType::class, array(
                    'query_builder' => function(ImageRepository $ir) use ($options){
                        return $ir->createQueryBuilder('i')
                                ->where('i.site = :site')
                                ->setParameter('site', $options['data']);
                    },
                    'required' => false
                ))
                ->add('twitter', null, array(
                    'required' => false
                ))
                ->add('facebook', null, array(
                    'required' => false
                ))
                ->add('instagram', null, array(
                    'required' => false
                ))
                ->add('objectif', IntegerType::class, array(
                    'required' => false
                ))
                ->add('actual', IntegerType::class, array(
                    'required' => false
                ))
                ->add('displayProgressBar', CheckboxType::class, array(
                    'required' => false
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Site'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_siteadmin';
    }


}
