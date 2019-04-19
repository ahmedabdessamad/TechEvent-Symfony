<?php

namespace AppelSponsorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class dossierSponsoringType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nomevent')

            ->add('descreptionevent')
            ->add('packSilver')
            ->add('prixSilver')
            ->add('packGold')
            ->add('prixGold')
            ->add('packDiamond')
            ->add('prixDiamond')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppelSponsorBundle\Entity\dossierSponsoring'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appelsponsorbundle_dossiersponsoring';
    }


}
