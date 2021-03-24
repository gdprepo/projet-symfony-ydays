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

class PronoFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('Equip1', TextType::class, [
                'label' => 'Equip1'
            ])
            ->add('Equip2', TextType::class, [
                'label' => 'Equip1'
            ])
            ->add('Confiance', IntegerType::class, [
                'label' => 'Confiance'
            ])
            ->add('Date', DateTimeType::class, [
                'label' => 'Date du match'
            ])
            ->add('Ligue', TextType::class, [
                'label' => 'Ligue'
            ])
            ->add('Type', ChoiceType::class, [
                'label' => 'Type de parie',
                'choices' => [
                    'Simple' => "simple",
                    'Combiné' => "combine",
                ],
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
            'data_class' => Prono::class,
        ]);
    }
}
