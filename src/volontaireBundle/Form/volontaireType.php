<?php

namespace volontaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class volontaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cin')
            ->add('numero')
            ->add('nom')
            ->add('prenom')
            ->add('email')

            ->add('role',ChoiceType::class,array(
                'choices'=>array(
                    'donneur'=>'donneur',
                    'medecin'=>'medecin',
                    'responsable de camp '=>'responsable de camp ',
                    'Utilisateur'=>'Utilisateur'
                )
            ))
            ->add('Ajouter',SubmitType::class);
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'volontaireBundle\Entity\volontaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'volontairebundle_volontaire';
    }

}
