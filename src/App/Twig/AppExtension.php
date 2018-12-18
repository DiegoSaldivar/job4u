<?php
namespace App\App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('linkPreview', array($this, 'linkPreview')),
            new TwigFilter('is_json',array($this,'isJson')),
            new TwigFilter('translateToEmbeddedLink',array($this,'translateToEmbeddedLink'))
        );
    }
    
    public function linkPreview($content) {
        
        $target = urlencode($content);
        $key = "5c1385b510419135d8379e15248059a8664c375223e08";
               
        $ret = file_get_contents("https://api.linkpreview.net?key={$key}&q={$target}");
        
        //var_dump(json_decode($ret));        
        return json_decode($ret);
    }
    
    public function isJson($content){
        return is_object($content);
    }
    
    public function translateToEmbeddedLink($content){
        $olink=$content;
        
        $urlsplit=explode('watch?v=', $olink);
        $olink=$urlsplit[0];
        
        $urlsplit=explode('&', $urlsplit[1]);
        
        return $olink . 'embed/'.$urlsplit[0];
        
    }
    
}

