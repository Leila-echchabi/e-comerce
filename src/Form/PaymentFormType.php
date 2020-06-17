<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('shippingAdresse', TextType::class, ['label' => 'Adresse'])
            ->add('shippingCity', TextType::class, ['label' => 'Ville'])
            ->add('shippingZip', TextType::class, ['label' => 'CP'])
            ->add('billingAdresse', TextType::class, ['label' => 'Adresse'])
            ->add('billingCity', TextType::class, ['label' => 'Ville'])
            ->add('billingZip', TextType::class, ['label' => 'CP'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
