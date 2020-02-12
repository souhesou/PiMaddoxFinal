<?php

namespace GcampBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BesoinsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom_bs', ChoiceType::class, [
            'choices'  => [
                'vetements' => 'vetements',
                'aliments' => 'aliments',
                'Medicaments' => 'Medicaments',
                'Produits hygiène' => 'Produits hygiène',
                'sang' => 'sang',
                'argents' => 'argents',
                'argents' => 'argents',
            ],
        ])->add('quantite');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GcampBundle\Entity\Besoins'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gcampbundle_besoins';
    }


}
