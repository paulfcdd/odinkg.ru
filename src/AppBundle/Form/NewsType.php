<?php

namespace AppBundle\Form;


use AppBundle\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $data = $builder->getData();

        $builder
            ->add('title', TextType::class, [
                'label' => 'Заголовок новости'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Содержание новости'
            ])
            ->add('image', ImageType::class, [
                'label' => 'Иллюстрация к новости',
                'mapped' => false,
                'required' => isset($data) ? false : true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
               'data_class' => News::class,
            ]);
    }
}