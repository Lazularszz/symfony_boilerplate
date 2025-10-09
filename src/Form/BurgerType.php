<?php
 
namespace App\Form;
 
use App\Entity\Burger;
use App\Entity\Fromage;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
 
class BurgerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du burger',
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('pain', EntityType::class, [
                'label' => 'Pain',
                'class' => Pain::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true,
                'required' => true,
            ])
            ->add('oignons', EntityType::class, [
                'label' => 'Oignons',
                'class' => Oignon::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'by_reference' => false
            ])
            ->add('sauces', EntityType::class, [
                'label' => 'Sauces',
                'class' => Sauce::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'by_reference' => false
            ])
            ->add('fromages', EntityType::class, [
                'label' => 'Fromages',
                'class' => Fromage::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'by_reference' => false
            ])
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Burger::class,
        ]);
    }
}
