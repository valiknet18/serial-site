<?php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('poster')
            ->add('description')
            ->add('releasedAt')
            ->add('country')
            ->add('city')
            ->add('genres')
            ->add('actors')
            ->add('directors')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Serial'
        ));
    }

    public function getName()
    {
        return 'serial_type';
    }
}
