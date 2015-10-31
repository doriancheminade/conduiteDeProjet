<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\US;

class RouteController extends Controller 
{
	public function homepageAction(){
		return $this->render('homepage.html.twig');
	}
    public function backlogAction($owner, $project)
    {
        //phony data for testing purpose
        /*$usList = array(
            array("owner" => "bob", "project" => "pacman2015", "id" => 1,"description" => "this is a user story", "cost" => 2, "priority" => 1),
            array("owner" => "bob", "project" => "pacman2015", "id" => 2,"description" => "this is an other user story for my project", "cost" => 3, "priority" => 2),
            array("owner" => "bob", "project" => "pacman2015", "id" => 3,"description" => "and an other", "cost" => 1, "priority" => 1),
            array("owner" => "bob", "project" => "pacman2015", "id" => 4,"description" => "yet an other", "cost" => 3, "priority" => 2));
        */ 
        $usList = $this->getDoctrine()
            ->getRepository('AppBundle:US')
            ->findBy(
                array('owner' => $owner,
                    'project' => $project),
                array('id' => 'ASC')
             );
        
        if (!$usList) 
        {
            throw $this->createNotFoundException('No data found for owner: '.$owner.', and project: '.$project);
        }
        else 
        {
            return $this->render("backlog.html.twig", array("usList" => $usList));
        }
    }
    public function formUSBacklogDelete($USToDelete)
    {
        $us = new US();
        $us->set($USToDelete.owner, 
            $USToDelete.project, 
            $USToDelete.id,
            $USToDelete.description,
            $USToDelete.cost,
            $USToDelete.priority);
        
        $form =  $this->createFormBuilder($us)
            ->add('owner', 'hidden')
            ->add('project', 'hidden')
            ->add('id', 'hidden')
            ->add('description', 'hidden')
            ->add('cost', 'hidden')
            ->add('priority', 'hidden')
            ->add('delete', 'submit')
            ->getForm();
        return $form;
    }
    public function USBacklogDeleteAction($owner, $project, $USId){
        $em = $this->getDoctrine()->getManager();
        $us = $this->getDoctrine()->getRepository('AppBundle:US')->findOneBy(
            array('owner' => $owner,
                'project' => $project,
                'id' => $USId)
        );
        if (!$us) 
        {
            throw $this->createNotFoundException('No data found for owner: '.$owner.', and project: '.$project.' ,and id: '.$USId);
        }
        else 
        {
            $em->remove($us);
            $em->flush();
            return $this->redirect($this->get('router')->generate('backlog', array('owner' => $owner, 'project' => $project)));
        }
    }
}

