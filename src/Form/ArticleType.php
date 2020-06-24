<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Subject')
            ->add('Title')
            ->add('Content')
            ->add('State')
            ->add('NbViews')
            ->add('Image')
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'label' => 'Thème(s)',
                'multiple' => true,
                'label_attr' => ['class' => 'ml-3'],
                'attr' => [
                    'class' => 'custom-select-lg',
                    'size' => '6'
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
