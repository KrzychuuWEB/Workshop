<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-16
 * Time: 18:36
 */

namespace App\Form\Type;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'Imię'])
            ->add('lastName', TextType::class, ['label' => 'Nazwisko'])
            ->add('phoneNumber', NumberType::class, ['label' => 'Numer telefonu'])
            ->add('postCode', TextType::class, ['label' => 'Kod pocztowy'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('address', TextType::class, ['label' => 'Adres zamieszkania'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}