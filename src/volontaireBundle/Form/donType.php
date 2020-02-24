<?php

namespace volontaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class donType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('objet',ChoiceType::class,array(
            'choices'=>array(
                'matelas'=>'matelas',
                'du sang'=>'du sang',
                'nourriture '=>'nourriture',
                'argent '=>'argent',
                'Autre chose'=>'Autre chose'
            )
        ))
            ->add('description')
            ->add('Ajouter',SubmitType::class);
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'volontaireBundle\Entity\don'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'volontairebundle_don';
    }


}
