<?php


namespace App\Sources;


use App\Traits\ConsumeExternalSource;

class AnimeSource
{
    use ConsumeExternalSource;
    public $baseUri;

    public function __construct(){
        $this->baseUri = config('sources.random_source.base_uri');
    }

    public static function init(){
        return new self();
    }
    public function getAnimes($url){
    return $this->performRequest("GET",$url);
    }
    public function getAnimesFiltered($url){
    return $this->performCustomRequest("GET",$url);
    }
}
