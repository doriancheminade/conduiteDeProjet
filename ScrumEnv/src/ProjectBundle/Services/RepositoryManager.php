<?php
namespace ProjectBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lsw\ApiCallerBundle\Call\HttpGetJson;
use Lsw\ApiCallerBundle\Helper\Curl;
use Lsw\ApiCallerBundle\Caller\LoggingApiCaller;

class RepositoryManager extends Controller
{ 
    public function getCommitsAction($owner, $repo)
    {      
        $url = 'https://api.github.com/repos/'.$owner.'/'.$repo.'/commits';
        $ch = curl_init ();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_USERAGENT, $owner);
        $result=curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
    public function commitsByTaskAction($taskList, $commitList)
    {
        $data = json_decode($commitList, true);
        $result = array();
        //TODO: allow the user to choose the pattern
        $pattern = '/\[.*\]/';
        for($i=0; $i<count($data); $i++)
        {
            $msg = $data[$i]['commit']['message'];
            preg_match($pattern, $msg, $matches, PREG_OFFSET_CAPTURE);
            if(!empty($matches)){
                for($j=0; $j<count($matches[0]); $j++)
                {
                    //remove regex delimiter
                    $s = substr($matches[0][$j],1, -1);
                    if(is_string($s))
                    {
                        if(empty($result[$s]))
                        {
                            $result[$s] = array($msg);
                        }
                        else
                        {
                           $count = count($result[$s]);
                           $result[$s][$count] = $msg; 
                        }
                    }
                }
            }
        }
        //var_dump($result);
        return $result;
    }
}
