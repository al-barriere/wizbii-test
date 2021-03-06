<?php


namespace App\Controller;


use App\Document\Element;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{

    /**
     * @Route("/collect", methods={"GET"})
     * @param Request $request
     * @param DocumentManager $dm
     * @return JsonResponse
     */
    public function getCollect(Request $request,DocumentManager $dm){

        $val = $this->checkAllGetParameter($request,$dm);

        return $val;
    }

    /**
     * @Route("/collect", methods={"POST"})
     * @param Request $request
     * @param DocumentManager $dm
     * @return JsonResponse
     */
    public function postCollect(Request $request,DocumentManager $dm){

        $content = json_decode($request->getContent());
        $response = "";
        // array_key_exists("v",$array_content)
        for($i = 0; $i< sizeof($content); $i++){
            $array_content = (array) $content[$i];
            $response = $this->checkAllPostParameter($array_content,$dm);
        }


        return $response;
    }

    public function checkAllPostParameter($element, $dm){
        $array = array();
        $version = "";
        $hitType = "";
        $documentLocation = "";
        $documentReferer = "";
        $wizbiiCreatorType = "";
        $wizbiiUserId = "";
        $eventCategory = "";
        $eventAction = "";
        $eventLabel = "";
        $eventValue = "";
        $trackingId = "";
        $dataSource = "";
        $campaignName = "";
        $campaignSource = "";
        $campaignMedium = "";
        $campaignKeyword = "";
        $campaignContent = "";
        $screenName = "";
        $applicationName = "";
        $applicationVersion = "";

        // version
        if((array_key_exists("v",$element)== false) ||
            $element["v"] !== "1")
        {
            return new JsonResponse(array('Status' => '400 : Parameter v must be equal to 1 or exist'));
        }
        $version =   $element["v"];

        // hit type
        if ((array_key_exists("t",$element)== false) ||
            !in_array($element["t"], array("pageview", "screenview", "event")))
        {
            return new JsonResponse(array('Status' => '400 : Parameter t must be equal to pageview, screenview, event or exist'));
        }
        $hitType = $element["t"];


        // document location
        if((array_key_exists("dl",$element)))
        {
            /*if($this->is_url($element["dl"]) === false)
            {
                return new JsonResponse(array('Status' => '400 : the document location must have a valid URL'));
            }*/
            $documentLocation = $element["dl"];
        }

        // document referer
        if((array_key_exists("dl",$element)))
        {
            /*if($this->is_url($query->get('dr')) === false)
            {
                return new JsonResponse(array('Status' => '400 : the document referer must have a valid URL'));
            }*/
            $documentReferer = $element["dr"];
        }

        if($hitType == "screenview")
        {

            // wizbii creator type
            if ((array_key_exists("wct",$element)== false) ||
                !in_array($element['wct'], array("profile", "recruiter", "visitor", "wizbii_employee")))
            {
                return new JsonResponse(array('Status' => '400 : Parameter wct must be equal to profile, recruiter, visitor, wizbii_employee  or exist'));
            }
            $wizbiiCreatorType = $element["wct"];

            // wizbii user id
            if(array_key_exists("wui",$element)== false)
            {
                return new JsonResponse(array('Status' => '400 : Parameter wui must exist'));
            }else{
                $regex = '/^[aA-zZ]+-[aA-zZ]+$/';
                if(!preg_match($regex,$element["wui"])){
                    return new JsonResponse(array('Status' => '400 : Parameter wui must respect format slug firstname-lastname'));
                }
            }
            $wizbiiUserId =$element["wct"];

            // screen name
            if(array_key_exists("sn",$element)== false)
            {
                return new JsonResponse(array('Status' => '400 : Parameter sn must exist'));
            }
            $screenName = $element["sn"];
        }else
        {
            // wizbii creator type
            if (array_key_exists("wct",$element) &&
                !in_array($element["wct"],array("profile", "recruiter", "visitor", "wizbii_employee")))
            {
                return new JsonResponse(array('Status' => '400 : Parameter wct must be equal to profile, recruiter, visitor, wizbii_employee  or exist'));
            }
            $wizbiiCreatorType =  array_key_exists("wct",$element)? $element["wct"]: "";

            // wizbii user id
            $regex = '/^[aA-zZ]+-[aA-zZ]+$/';
            if(array_key_exists("wui",$element) &&
                (!preg_match($regex, $element["wui"]))){
                return new JsonResponse(array('Status' => '400 : Parameter wui must respect format slug firstname-lastname'));
            }
            $wizbiiUserId = array_key_exists("wui",$element)? $element["wui"]: "";

            $screenName = array_key_exists("sn",$element)? $element["sn"]: "";
        }

        if($hitType == "event")
        {
            // event category
            if((array_key_exists("ec",$element)== false) || (strlen( $element["ec"])==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ec must exist and not be empty'));
            }
            $eventCategory =  $element["ec"];

            // event action
            if((array_key_exists("ea",$element)== false) || (strlen( $element["ea"])==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ea must exist and not be empty'));
            }
            $eventAction =  $element["ea"];
        }else{
            // event category
            if((array_key_exists("ec",$element)== false) || (strlen($element["ec"])==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ec must exist and not be empty'));
            }
            $eventCategory = array_key_exists("ec",$element)?$element["ec"]:"";

            // event action
            if((array_key_exists("ea",$element)== false) || (strlen($element["ea"])==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ea must exist and not be empty'));
            }
            $eventAction = array_key_exists("ea",$element)?$element["ea"]:"";
        }

        // event label
        if(array_key_exists("el",$element)){
            $eventLabel = $element["el"];
        }

        // event value
        if(array_key_exists("ev",$element) && !is_numeric($element["ev"]))
        {
            return new JsonResponse(array('Status' => '400 : Parameter ev must be a number'));
        }else {
            if($element["ev"]< 0)
            {
                return new JsonResponse(array('Status' => '400 : Parameter ev must be a positive number'));
            }
            $eventValue = $element["ev"];
        }

        // tracking id
        $regex = '/^[A-Z0-9]{2}-[A-Z0-9]{4}-[A-Z0-9]{1}$/';
       if((array_key_exists("tid",$element) == false) ||
            (!preg_match($regex, $element["tid"])))
        {
            return new JsonResponse(array('Status' => '400 : Parameter tid  must exist or respect format UA-XXXX-Y',));
        }
        $trackingId = $element["ev"];

        //data source
        if ((array_key_exists("ds",$element)== false) ||
            !in_array($element["ds"], array("web", "apps", "backend")))
        {
            return new JsonResponse(array('Status' => '400 : Parameter ds must be equal to web, apps, backend or exist'));
        }
        $dataSource = $element["ds"];

        // campaign name
        if(array_key_exists("cn",$element))
            $campaignName = $element["cn"];

        // campaign source
        if(array_key_exists("cs",$element))
            $campaignSource = $element["cs"];

        // campaign medium
        if(array_key_exists("cm",$element))
            $campaignMedium = $element["cm"];

        // campaign keyword
        if(array_key_exists("ck",$element))
            $campaignKeyword = $element["ck"];

        // campaign content
        if(array_key_exists("cc",$element))
            $campaignContent = $element["cc"];

        // application name
        if($dataSource == "web"){
            if(array_key_exists("an",$element) == false){
                return new JsonResponse(array('Status' => '400 : Parameter an must exist if data source equals to web'));
            }
            $applicationName = $element["an"];
        }else{
            $applicationName = array_key_exists("an",$element)? $element["an"]: "";
        }

        // application version
        $regex = '/^[0-9]+(.[0-9]+)*$/';
        if(array_key_exists("av",$element) && !preg_match($regex, $element["av"])){
            return new JsonResponse(array('Status' => '400 : Parameter av must respect format version'));
        }
        $applicationVersion = array_key_exists("av",$element)? $element["av"] : "";

        array_push($array,$version,$hitType,$documentLocation,$documentReferer,$wizbiiCreatorType,$wizbiiUserId,$eventCategory,$eventAction,$eventLabel,$eventValue,$trackingId,$dataSource,$campaignName,$campaignSource,$campaignMedium,$campaignKeyword,$campaignContent,$screenName,$applicationName,$applicationVersion);
        $this->createElemDb($array,$dm);
        return new JsonResponse($array,200);

    }

    public function checkAllGetParameter(Request $request, $dm){
        $query = $request->query;
        $array = array();
        $version = "";
        $hitType = "";
        $documentLocation = "";
        $documentReferer = "";
        $wizbiiCreatorType = "";
        $wizbiiUserId = "";
        $eventCategory = "";
        $eventAction = "";
        $eventLabel = "";
        $eventValue = "";
        $trackingId = "";
        $dataSource = "";
        $campaignName = "";
        $campaignSource = "";
        $campaignMedium = "";
        $campaignKeyword = "";
        $campaignContent = "";
        $screenName = "";
        $applicationName = "";
        $applicationVersion = "";

        // version
        if(($query->has('v')== false) ||
            $query->get('v') !== "1")
        {
            return new JsonResponse(array('Status' => '400 : Parameter v must be equal to 1 or exist'));
        }
        $version =  $query->get('v');

        // hit type
        if (($query->has('t')== false) ||
            !in_array($query->get('t'), array("pageview", "screenview", "event")))
        {
            return new JsonResponse(array('Status' => '400 : Parameter t must be equal to pageview, screenview, event or exist'));
        }
        $hitType = $query->get('t');


        // document location
        if($query->has('dl'))
        {
            if($this->is_url($query->get('dl')) === false)
            {
                return new JsonResponse(array('Status' => '400 : the document location must have a valid URL'));
            }
            $documentLocation = $query->get('dl');
        }

        // document referer
        if($query->has('dr'))
        {
            if($this->is_url($query->get('dr')) === false)
            {
                return new JsonResponse(array('Status' => '400 : the document referer must have a valid URL'));
            }
            $documentReferer = $query->get('dr');
        }

        if($hitType == "screenview")
        {

            // wizbii creator type
            if (($query->has('wct')== false) ||
                !in_array($query->get('wct'), array("profile", "recruiter", "visitor", "wizbii_employee")))
            {
                return new JsonResponse(array('Status' => '400 : Parameter wct must be equal to profile, recruiter, visitor, wizbii_employee  or exist'));
            }
            $wizbiiCreatorType = $query->get('wct');

            // wizbii user id
            if($query->has('wui')==false)
            {
                return new JsonResponse(array('Status' => '400 : Parameter wui must exist'));
            }else{
                $regex = '/^[aA-zZ]+-[aA-zZ]+$/';
                if(!preg_match($regex, $query->get('wui'))){
                    return new JsonResponse(array('Status' => '400 : Parameter wui must respect format slug firstname-lastname'));
                }
            }
            $wizbiiUserId = $query->get('wui');

            // screen name
            if($query->has('sn')==false)
            {
                return new JsonResponse(array('Status' => '400 : Parameter sn must exist'));
            }
            $screenName = $query->get('sn');
        }else
        {
            // wizbii creator type
            if (($query->has('wct')) &&
                !in_array($query->get('wct'), array("profile", "recruiter", "visitor", "wizbii_employee")))
            {
                return new JsonResponse(array('Status' => '400 : Parameter wct must be equal to profile, recruiter, visitor, wizbii_employee  or exist'));
            }
            $wizbiiCreatorType =  $query->has('wct')? $query->get('wct'): "";

            // wizbii user id
            $regex = '/^[aA-zZ]+-[aA-zZ]+$/';
            if($query->has('wui') &&
                (!preg_match($regex, $query->get('wui')))){
                return new JsonResponse(array('Status' => '400 : Parameter wui must respect format slug firstname-lastname'));
            }
            $wizbiiUserId = $query->has('wui')? $query->get('wui'): "";

            $screenName = $query->has('sn')? $query->get('sn'): "";
        }

        if($hitType == "event")
        {
            // event category
            if(($query->has('ec')== false) || (strlen($query->get('ec'))==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ec must exist and not be empty'));
            }
            $eventCategory = $query->get('ec');

            // event action
            if(($query->has('ea')== false) || (strlen($query->get('ea'))==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ea must exist and not be empty'));
            }
            $eventAction = $query->get('ea');
        }else{
            // event category
            if(($query->has('ec')== false) || (strlen($query->get('ec'))==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ec must exist and not be empty'));
            }
            $eventCategory = $query->get('ec');

            // event action
            if(($query->has('ea')== false) || (strlen($query->get('ea'))==0))
            {
                return new JsonResponse(array('Status' => '400 : Parameter ea must exist and not be empty'));
            }
            $eventAction = $query->get('ea');
        }

        // event label
        if($query->has('el')){
            $eventLabel = $query->get('el');
        }

        // event value
        if($query->has('ev') && !is_numeric($query->get('ev')))
        {
            return new JsonResponse(array('Status' => '400 : Parameter ev must be a number'));
        }else {
            if($query->get('ev')< 0)
            {
                return new JsonResponse(array('Status' => '400 : Parameter ev must be a positive number'));
            }
            $eventValue = $query->get('ev');
        }

        // tracking id
        $regex = '/^[A-Z0-9]{2}-[A-Z0-9]{4}-[A-Z0-9]{1}$/';
        if(($query ->has('tid') == false) ||
            (!preg_match($regex, $query->get('tid'))))
        {
            return new JsonResponse(array('Status' => '400 : Parameter tid  must exist or respect format UA-XXXX-Y',));
        }
        $trackingId = $query->get('tid');

        //data source
        if (($query->has('ds')== false) ||
            !in_array($query->get('ds'), array("web", "apps", "backend")))
        {
            return new JsonResponse(array('Status' => '400 : Parameter ds must be equal to web, apps, backend or exist'));
        }
        $dataSource = $query->get('ds');

        // campaign name
        if($query->has('cn'))
            $campaignName = $query->get('cn');

        // campaign source
        if($query->has('cs'))
            $campaignSource = $query->get('cs');

        // campaign medium
        if($query->has('cm'))
            $campaignMedium = $query->get('cm');

        // campaign keyword
        if($query->has('ck'))
            $campaignKeyword = $query->get('ck');

        // campaign content
        if($query->has('cc'))
            $campaignContent = $query->get('cc');

        // application name
        if($dataSource == "web"){
            if($query->has('an') == false){
                return new JsonResponse(array('Status' => '400 : Parameter an must exist if data source equals to web'));
            }
            $applicationName = $query->get('an');
        }else{
            $applicationName = $query->has('an')? $query->get('an'): "";
        }

        // application version
        $regex = '/^[0-9]+(.[0-9]+)*$/';
        if($query->has('av') && !preg_match($regex, $query->get('av'))){
            return new JsonResponse(array('Status' => '400 : Parameter av must respect format version'));
        }
        $applicationVersion = $query->has('av')? $query->get('av') : "";

        array_push($array,$version,$hitType,$documentLocation,$documentReferer,$wizbiiCreatorType,$wizbiiUserId,$eventCategory,$eventAction,$eventLabel,$eventValue,$trackingId,$dataSource,$campaignName,$campaignSource,$campaignMedium,$campaignKeyword,$campaignContent,$screenName,$applicationName,$applicationVersion);
        $this->createElemDb($array,$dm);
        return new JsonResponse($array,200);
    }

    public function createElemDb($array, $dm){

        $element = new Element();
        $element->setVersion($array[0]);
        $element->setHitType($array[1]);
        $element->setDocumentLocation($array[2]);
        $element->setDocumentReferer($array[3]);
        $element->setWizbiiCreatorType($array[4]);
        $element->setWizbiiUserId($array[5]);
        $element->setEventCategory($array[6]);
        $element->setEventAction($array[7]);
        $element->setEventLabel($array[8]);
        $element->setEventValue($array[9]);
        $element->setTrackingId($array[10]);
        $element->setDataSource($array[11]);
        $element->setCampaignName($array[12]);
        $element->setCampaignSource($array[13]);
        $element->setCampaignMedium($array[14]);
        $element->setCampaignKeyword($array[15]);
        $element->setCampaignContent($array[16]);
        $element->setScreenName($array[17]);
        $element->setApplicationName($array[18]);
        $element->setApplicationVersion($array[19]);

        $dm->persist($element);
        try {
            $dm->flush();
        } catch (MongoDBException $e) {
            return $e;
        }
        return new JsonResponse("ok",200);

    }

    public function is_url($uri){
        if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$uri)){
            return $uri;
        }
        else{
            return false;
        }
    }

}