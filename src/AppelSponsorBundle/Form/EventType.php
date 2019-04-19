<?php

namespace AppelSponsorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')->add('description')->add('affiche')->add('nbrplaces')->add('localisation')->add('dateevent')->add('hdebut')->add('hfin')->add('prix')
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_link' => true
            ])->add('categorie')->add('type')->add('psilver')->add('pglod')->add('pdiamond')->add('prixsilver')->add('prixgold')->add('prixdiamond')->add('user');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppelSponsorBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appelsponsorbundle_event';
    }


}
