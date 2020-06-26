<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => [
                    'placeholder' => 'Sujet de l\'article',
                    'autofocus' => true
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Titre de l\'article',
                    'autofocus' => true
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'rows' => '3',
                    'placeholder' => 'Contenu de l\'article'
                ],
                'required' => false
            ])
            ->add('isPublished', CheckboxType::class, [
                'label' => 'Etat',
                'attr' => [
                    'placeholder' => 'Etat de l\'article',
                    'autofocus' => true
                ]
            ])
            ->add('image', FileType::class,[
                'label'=>'Image',
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'label' => 'Thème',
                'label_attr' => ['class' => 'ml-3'],
                'attr' => [
                    'class' => 'custom-select-lg',
                    'size' => '4'
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
