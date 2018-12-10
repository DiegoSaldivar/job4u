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

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add(
                'password', 
                RepeatedType::classs,
                array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password filds must match.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_optios' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password')
                 )
               )->add('username', TextType::class);
                
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
