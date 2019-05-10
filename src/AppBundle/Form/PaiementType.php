<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('siteName', null, array(
                'label' => "Nom de votre équipage"
            ))
                ->add('secondUserFirstname', null, array(
                        'label' => "Prénom"
                    ))
                ->add('secondUserLastname', null, array(
                        'label' => "Nom"
                    ))
                ->add('secondUserEmail', null, array(
                        'label' => "Email"
                    ))
                ->add('secondUserUsername', null, array(
                        'label' => "Pseudo"
                    ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Paiement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_paiement';
    }


}
