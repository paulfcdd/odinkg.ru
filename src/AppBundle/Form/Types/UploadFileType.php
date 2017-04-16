<?php

namespace AppBundle\Form\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UploadFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Выберите файл'
            ])
            ->add('name', TextType::class, [
                'label' => 'Задайте имя файла (может быть пустым)',
                'required' => false
            ]);
    }
}