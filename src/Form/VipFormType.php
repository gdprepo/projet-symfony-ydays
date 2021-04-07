<?php

namespace App\Form;

use DateTime;
use App\Entity\Vip;
use App\Entity\Prono;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class VipFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('Title', TextType::class, [
                'label' => 'Title'
            ])
            ->add('Price', TextType::class, [
                'label' => 'Price'
            ])

            // ->add('sub', EntityType::class, [
            //     // Look for choices from the Categories entity
            //     'class' => Vip::class,
            //     // Display as checkboxes
            //     'expanded' => true,
            //     'multiple' => true,
            //     // The property of the Categories entity that will show up on the select (or checkboxes)
            //     'choice_label' => 'title' 
            // ])
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => ['class' => ' shadow-1 rounded-1 outline txt-blue'],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vip::class,
        ]);
    }
}
