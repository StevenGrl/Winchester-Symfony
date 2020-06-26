<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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

            ->add('Subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => [
                    'placeholder' => 'Sujet de l\'article',
                    'autofocus' => true
                ]
            ])
            ->add('Title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Titre de l\'article',
                    'autofocus' => true
                ]
            ])
            ->add('Content', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'rows' => '3',
                    'placeholder' => 'Contenu de l\'article'
                ],
                'required' => false
            ])
            ->add('State', TextType::class, [
                'label' => 'Etat',
                'attr' => [
                    'placeholder' => 'Etat de l\'article',
                    'autofocus' => true
                ]
            ])
            ->add('Image', FileType::class,[
                'label'=>'Image',
            ])
            ->add('Theme', EntityType::class, [
                'class' => Theme::class,
                'label' => 'Thème(s)',
                'multiple' => true,
                'label_attr' => ['class' => 'ml-3'],
                'attr' => [
                    'class' => 'custom-select-lg',
                    'size' => '10'
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
