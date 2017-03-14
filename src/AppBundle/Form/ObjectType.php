<?php

namespace AppBundle\Form;

use AppBundle\Entity\Object;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    ChoiceType, EmailType, IntegerType, NumberType, SubmitType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class,[
                'label' => 'Тип объекта',
                'choices' => Object::TYPE,
            ])
            ->add('saleStatus', ChoiceType::class, [
                'label' => 'Статус объекта',
                'choices' => Object::SALE_TYPE,
            ])
            ->add('highway', TextType::class,[
                'required' => false,
                'label' => 'Ближайшее шоссе',
            ])
            ->add('location', TextType::class, [
                'required' => false,
                'label' => 'Населенный пункт',
            ])
            ->add('plotDecription', TextareaType::class, [
                'required' => false,
               'label' => 'Описание участка',
            ])
            ->add('communications', TextType::class,[
                'label' => 'Коммуникации',
            ])
            ->add('square', IntegerType::class, [
                'label' => 'Площадь',
            ])
            ->add('pricePerUnit', IntegerType::class, [
                'required' => false,
                'label' => 'Цена за квадратный метр',
            ])
            ->add('totalPrice', IntegerType::class, [
                'label' => 'Общая цена',
            ])
            ->add('objectDescription', TextareaType::class, [
                'label' => 'Описание объекта',
            ])
            ->add('contactName', TextType::class, [
                'label' => 'Контактное лицо',
            ])
            ->add('contactEmail', EmailType::class, [
                'label' => 'Контактный e-mail',
            ])
            ->add('contactPhone', IntegerType::class, [
                'label' => 'Контактный телефон',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Сохранить объект',
                'attr' => [
                    'class' => 'btn btn-primary btn-block'
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Название объекта',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Object::class,
        ]);
    }
}