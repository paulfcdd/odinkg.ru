<?php
namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\{
    HiddenType, SubmitType, TextType
};
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, [
                'mapped' => false,
//                'attr' => [
//                    'onFocus' => 'geolocate()'
//                ]
            ])
            ->add('email', TextType::class)
            ->add('phone1', TextType::class)
            ->add('phone2', TextType::class, [
                'required' => false
            ])
            ->add('street_number', HiddenType::class)
            ->add('route', HiddenType::class)
            ->add('locality', HiddenType::class)
            ->add('country', HiddenType::class)
            ->add('adm_level_1', HiddenType::class)
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}