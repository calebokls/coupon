<?php

namespace App\Form;

use App\Entity\BookMaker;
use App\Entity\MacherCoupon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarcherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('prix')
            ->add('cote')
            ->add('book',EntityType::class,[
                'label'=>'Type de bookMaker',
                'class'=>BookMaker::class,
                'multiple'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MacherCoupon::class,
        ]);
    }
}
