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
                'label' => 'Выберите тип объекта',
                'choices' => Object::TYPE,
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('saleStatus', ChoiceType::class, [
                'label' => 'Выберите статус объекта',
                'choices' => Object::SALE_TYPE,
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('highway', TextType::class,[
                'required' => false,
                'label' => 'Ближайшее шоссе',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('location', TextType::class, [
                'required' => false,
                'label' => 'Населенный пункт',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('plotDecription', TextareaType::class, [
                'required' => false,
               'label' => 'Описание участка',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('communications', TextType::class,[
                'label' => 'Коммуникации',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('square', IntegerType::class, [
                'required' => false,
                'label' => 'Площадь',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('pricePerUnit', IntegerType::class, [
                'required' => false,
                'label' => 'Цена за квадратный метр',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('totalPrice', IntegerType::class, [
                'label' => 'Общая цена',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('objectDescription', TextareaType::class, [
                'label' => 'Описание объекта',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('contactName', TextType::class, [
                'label' => 'Контактное лицо',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('contactEmail', EmailType::class, [
                'label' => 'Контактный e-mail',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('contactPhone', IntegerType::class, [
                'label' => 'Контактный телефон',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Сохранить объект',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Object::class,
        ]);
    }
}