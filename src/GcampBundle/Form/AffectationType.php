<?php

namespace GcampBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffectationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('qnt')->add('idBs',EntityType::class,array('class'=>'GcampBundle:Besoins','choice_label'=>'id_c.lieu.lieu','multiple'=>false))->add('idDon',EntityType::class,array('class'=>'volontaireBundle:don','choice_label'=>'objet','multiple'=>false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GcampBundle\Entity\Affectation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gcampbundle_affectation';
    }


}
