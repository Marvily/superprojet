<?php

namespace App\Form\Admin;

use App\Entity\Classe;
use App\Entity\Discipline;
use App\Entity\Masterclass;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MasterclassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('heuredebut', DateTimeType::class, [
                'date_widget'=>'single_text'])
            ->add('heurefin', DateTimeType::class, [
                'date_widget'=>'single_text'])
            ->add('webcam')
            ->add('professor', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom',
                'query_builder' => function (UserRepository $userRepository) {
                    return $userRepository->createQueryBuilder('user')
                        ->where('user.roles LIKE :role')
                        ->setParameter('role', '%ROLE_TEACHER%');
                }
            ])
            ->add('students', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (UserRepository $userRepository) {
                    return $userRepository->createQueryBuilder('user')
                        ->where('user.roles LIKE :role')
                        ->setParameter('role', '%ROLE_USER%');
                }
            ])

            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'instituition',
                'required' => false
            ])

            ->add('discipline', EntityType::class,[
                'class'=> Discipline::class,
                'choice_label'=> 'titre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Masterclass::class,
        ]);
    }
}
