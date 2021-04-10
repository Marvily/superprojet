<?php

namespace App\Form\Admin;

use App\Entity\Classe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class,[
                'label'=> "Prenom",
                'attr'=> [
                    'placeholder'=>"Saisir le prenom"
                ]
            ])
            ->add('nom', TextType::class,[
                'label'=> "Nom",
                'attr'=> [
                    'placeholder'=>"Saisir le Nom"
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=> "Email",
                'attr'=> [
                    'placeholder'=>"Saisir le email"
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                    'Etudiant' => 'ROLE_USER',
                    'Formateur' => 'ROLE_TEACHER',
                    'Adminstrateur' => 'ROLE_SUPER_ADMIN',
                ],
            ])

            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'instituition',
                'required' => false
            ])
            ->add('password', RepeatedType::class,[
                'type'=> PasswordType::class,
                'invalid_message'=> 'Le mot de passe et la confirmation doivent etre identique',
                'label'=> "Mot de passe",
                'required'=>true,
                'first_options'=>[
                    'label'=>'Mot de passe',
                    'attr'=> [
                        'placeholder'=>"Saisir le Mot de passe"
                    ]
                ],
                'second_options'=>[
                    'label'=> 'Confirmez votre mot de passe',
                    'attr'=> [
                        'placeholder'=>"Saisir la confirmation du mot de passe"
                    ]

                ]

            ])
        ;


        // Data transformer
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                                      function ($rolesArray) {
                                          // transform the array to a string
                                          return count($rolesArray)? $rolesArray[0]: null;
                                      },
                                      function ($rolesString) {
                                          // transform the string back to an array
                                          return [$rolesString];
                                      }
                                  ));
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
