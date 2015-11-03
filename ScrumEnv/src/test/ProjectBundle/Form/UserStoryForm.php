<?php
namespace test\ProjectBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
class UserStoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('describe_UserStory')
            ->add('priority_UserStory')
            ->add('difficulty_UserStory');
    }  

     public function getName()
    {
        return 'User_Story';
    } 
}
?>