<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class CreateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class)
            ->add('Fullname',TextType::class)
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('verified',BooleanToStringTransformer::class)
            ->add('role',TextType::class)
            ->add('languages',TextType::class)
            ->add('beFollowed',EntityType::class)
            ->add('following',EntityType::class)
        ;
        
            if($options['standalone']){
                $builder->add('Submit', SubmitType::class, array('label' => 'Create User'));
            }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'standalone' => true
        ]);
    }
}
