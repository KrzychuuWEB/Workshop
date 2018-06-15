<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-12
 * Time: 20:39
 */

namespace App\Form\Type;

use App\Entity\Permission;
use App\Entity\Position;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Login'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Hasło'],
                'second_options' => ['label' => 'Powtórz Hasło'],
            ])
            ->add('firstName', TextType::class, ['label' => 'Imię'])
            ->add('lastName', TextType::class, ['label' => 'Nazwisko'])
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'query_builder' => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Wybierz stanowisko'
            ])
            ->add('permission', EntityType::class, [
                'class' => Permission::class,
                'query_builder' => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Wybierz uprawnienia'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}