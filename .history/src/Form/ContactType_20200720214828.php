<?php

namespace App\Form;

use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom"
            ])
            ->add('prenom',TextType::class, [
                'label' => "Prénom"
            ])
            ->add('email', EmailType::class)
            ->add('objet')
            ->add('message', TextareaType::class)
            ->add('envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'button-sub'
                ]
            ])
            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptchaContact',
                'constraints' => [
                    new ValidCaptcha([
                        'message' => 'Invalid captcha, please try again',
                    ]),
                ],
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
