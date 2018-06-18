<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-14
 * Time: 19:25
 */

namespace App\Form\Type;

use App\Entity\Car;
use App\Entity\Customer;
use App\Entity\VehicleType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAdd', DateType::class, ['label' => 'Data dodania samochodu', 'widget' => 'single_text'])
            ->add('timeAdd', TimeType::class, ['label' => 'Godzina dodania samochodu', 'widget' => 'single_text'])
            ->add('vehicleType', EntityType::class, [
                'class' => VehicleType::class,
                'query_builder' => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('v')
                        ->orderBy("v.name", 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Typ pojazdu',
            ])
            ->add('mark', TextType::class, ['label' => 'Marka'])
            ->add('model', TextType::class, ['label' => 'Model'])
            ->add('registration', TextType::class, ['label' => 'Rejestracja'])
            ->add('engineNumber', TextType::class, ['label' => 'Numer silnika'])
            ->add('bodyNumber', TextType::class, ['label' => 'Numer nadwozia'])
            ->add('capacity', NumberType::class, ['label' => 'Pojemność'])
            ->add('enginePower', NumberType::class, ['label' => 'Moc silnika'])
            ->add('productionYear', DateType::class, ['label' => 'Rok produkcji', 'widget' => 'single_text'])
            ->add('fuelCondition', NumberType::class, ['label' => 'Stan paliwa'])
            ->add('testDrive', ChoiceType::class, [
                'label' => 'Jazda próbna',
                'choices' => [
                    'Tak' => 1,
                    'Nie' => 0,
                ]
            ])
            ->add('insuranceOC', ChoiceType::class, [
                'label' => 'Ubezpieczenie OC',
                'choices' => [
                    'Tak' => 1,
                    'Nie' => 0,
                ]
            ])
            ->add('repairBook', ChoiceType::class, [
                'label' => 'Książeczka napraw',
                'choices' => [
                    'Tak' => 1,
                    'Nie' => 0,
                ]
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'query_builder' => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('c')
                        ->orderBy("c.id", 'ASC');
                },
                'choice_label' => function($customer)
                {
                    return 'ID: '.$customer->getId().
                        ' | Imię: '.$customer->getFirstName().
                        ' | Nazwisko: '.$customer->getLastName().
                        ' | Numer Telefonu: '.$customer->getPhoneNumber().
                        ' | Adres: '.$customer->getAddress();
                },
                'label' => 'Klient',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}