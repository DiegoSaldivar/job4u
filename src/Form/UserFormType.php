<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
            
            ->add(
                'password', 
                RepeatedType::class,
                array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
=======
            ->add('fullName', TextType::class)
            ->add('eMail', EmailType::class)
            ->add('username', TextType::class)
            ->add('password', RepeatedType::class, array
                   ('type' => PasswordType::class,'invalid_message' => 'The password fields must match.',
>>>>>>> job4ufront
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password')
                 )
               );
                
               if ($options['standalone'])
               {
                   $builder->add('submit', SubmitType::class);
               }
//             ->add('Fullname')
//             ->add('email')
//             ->add('verified')
//             ->add('role')
//             ->add('languages')
//             ->add('beFollowed')
//             ->add('following')
//        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'standalone' => false
        ]);
    }
}
