<?php

namespace App\Form;

use App\Entity\Customer;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class FormPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom'])
            ->add('prenom', TextType::class, ['label'=>'Prénom'])
            ->add('shipping_street', TextType::class, ['label'=>'Rue'])
            ->add('shipping_city', TextType::class, ['label'=>'Ville'])
            ->add('shipping_cp', TextType::class, ['label'=>'Code Postal'])

            ->add('billing_street', TextType::class, ['label'=>'Rue'])
            ->add('billing_city', TextType::class, ['label'=>'Ville'])
            ->add('billing_cp', TextType::class, ['label'=>'Code Postal'])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
