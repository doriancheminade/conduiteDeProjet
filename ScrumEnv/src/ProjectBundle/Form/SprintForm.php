<?php
namespace test\ProjectBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
class UserStoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('id')
            ->add('description')
            ->add('dateBegining')
            ->add('dateEnd');
    }  

     public function getName()
    {
        return 'Sprint';
    } 
}
?>
