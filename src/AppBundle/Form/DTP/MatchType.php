<?php

namespace AppBundle\Form\DTP;

use AppBundle\Entity\DTP\Match;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('league', EntityType::class, [
                'class' => 'DTP:League',
                'choice_label' => 'name',
                'placeholder' => 'dtp.select.league',
                'empty_data' => null,
                'required' => false
            ])
            ->add('hometeam', EntityType::class, [
                'class' => 'DTP:Team',
                'choice_label' => 'name',
                'placeholder' => 'dtp.select.team',
                'empty_data' => null,
                'required' => false
            ])
            ->add('awayteam', EntityType::class, [
                'class' => 'DTP:Team',
                'choice_label' => 'name',
                'placeholder' => 'dtp.select.team',
                'empty_data' => null,
                'required' => false
            ])
            ->add('save', SubmitType::class)
            ->add('addLeague', SubmitType::class, ['label'=>'form.new','attr'=>['formnovalidate'=>'']])
            ->add('addHTeam', SubmitType::class, ['label'=>'form.new','attr'=>['formnovalidate'=>'']])
            ->add('addATeam', SubmitType::class, ['label'=>'form.new','attr'=>['formnovalidate'=>'']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Match::class
        ]);
    }
}
