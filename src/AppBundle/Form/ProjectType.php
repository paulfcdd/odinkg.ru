<?php

namespace AppBundle\Form;


use AppBundle\Entity\Project;
use AppBundle\Form\Types\UploadFileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название проекта'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание проекта'
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Цена'
            ])
            ->add('link', UrlType::class, [
                'label' => 'Ссылка на проект'
            ])
            ->add('photos', CollectionType::class, [
                'label' => false,
                'mapped' => false,
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('files', CollectionType::class, [
                'mapped' => false,
                'label' => false,
                'entry_type' => UploadFileType::class,
                'allow_add' => true,
                'allow_delete' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Project::class
            ]);
    }
}