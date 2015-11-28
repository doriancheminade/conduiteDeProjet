<?php  
namespace ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ProjectBundle\Entity\Task;
use JpGraph\JpGraph;
use JpGraph\Graph;



class BdcController extends Controller
{

    public function bdcAction() {


JpGraph::load();
JpGraph::module('line');

/*$em = $this->getDoctrine()->getManager();
        $tasklist = $em->getRepository('ProjectBundle:Task')
        ->findBy(
        array('cost' => $cost), //these are the parameters for the search 
        array('sprint' => $sprintId)); // this is to order the list
   
   
    for Task in tasklist
    {
     
    } */
   
 
$graph = new \Graph(300,300);
$ydata = array("",56, 43, 27, 12, 8,"");

$xdata = array(0,1, 2, 3, 4, 5,6);
//$graph->SetScale('textlin');
//http://support.severalnines.com/entries/20978841-JPGraph-installation
$graph->SetScale('intint');
$lineplot = new \LinePlot($ydata, $xdata);
$lineplot->SetColor('forestgreen');
$graph->Add($lineplot);

$graph->title->Set('Burndownchart');
$graph->xaxis->title->Set('Sprints');
$graph->yaxis->title->Set('Diff');
$lineplot->SetWeight(3);
//$graph->Stroke();
   $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
   //Start buffering
ob_start();     
//Print the data stream to the buffer
$graph->img->Stream();
//Get the contents of the buffer
$image_data = ob_get_contents();
//Stop the buffer/clear it.
ob_end_clean();
//Set the variable equal to the base 64 encoded value of the stream.
//This gets passed to the browser and displayed.
$image = base64_encode($image_data);
   $redirect = $this->render('ProjectBundle:Sprint:bdc.html.twig', array(
                              'EncodedImage' => $image,                   
                               ));  
return $redirect;
}
}
