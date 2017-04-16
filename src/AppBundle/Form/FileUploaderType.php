<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileUploaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Выберите файл',
            ])
            ->add('name', TextType::class, [
                'label' => 'Задайте имя файла',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Краткое описание файла',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('alt', TextType::class, [
                'label' => 'Alt-тэг',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Title-тэг',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }
}