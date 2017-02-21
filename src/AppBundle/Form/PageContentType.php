<?php
namespace AppBundle\Form;


use AppBundle\Entity\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pageTitle', TextType::class,[
                'label' => 'Название страницы'
            ])
            ->add('pageSecondaryTitle', TextType::class, [
                'label' => 'Краткое описание'
            ])
            ->add('pageContent', TextareaType::class, [
                'label' => 'Контент страницы'
            ])
            ->add('slug', TextType::class, [
                'label' => 'URL страницы'
            ])
            ->add('title', TextType::class, [
                'label' => 'meta Title'
            ])
            ->add('keywords', TextType::class, [
                'label' => 'meta Keywords'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'meta Description'
            ])
            ->add('enabled', ChoiceType::class, [
                'label' => 'Показать на главной',
                'choices' => [
                    'Да' => true,
                    'Нет' => false,
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class
        ]);
    }
}