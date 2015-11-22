<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use ProjectBundle\Entity\Repository;


class RepoController extends Controller
{
   public function AddRepoAction($owner, $project)
   {
        $repoform = new Repository();
        $form = $this->createFormBuilder($repoform)
            ->add('type', 'choice', array(
                'choice_list' => new ChoiceList(
                    array('GITHUB'),
                    array('github'))))
            ->add('repoOwner', 'text',
                array('label' => 'repository owner'))
            ->add('repoName', 'text',
                array('label' => 'repository name'))
            ->add('add', 'submit')
            ->add('owner', 'hidden', array(
                'data' =>$owner))
            ->add('project', 'hidden', array(
                'data' =>$project))
            ->getForm();
            
        $request = $this->container->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($repoform);
            $em->flush();
        }
        return $this->container->get('templating')->renderResponse('ProjectBundle:Repo:addRepo.html.twig',
            array('form' => $form->createView(), 'owner' => $owner, 'project' => $project));
   }   
    public function getCommitsAction($owner, $repo)
    {
        $url = 'https://api.github.com/repos/'.$owner.'/'.$repo.'/commits';
        $parameters="";
        $output = $this->get('api_caller')->call(new HttpGetJson($url, $parameters));
        return $output;
    }
    public function commitsByTaskAction($taskId)
    {
        return "";
    }
}
