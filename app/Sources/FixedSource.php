<?php


namespace App\Sources;


use App\Traits\ConsumeExternalSource;

class FixedSource
{
    use ConsumeExternalSource;
    public $baseUri;

    public function __construct(){
       $this->baseUri = config('sources.fixed_source.base_uri');
    }
    public static function init(){
        return new self();
    }
    public function getJokes(){
     return $this->performRequest("GET","/jokes/ten");
    }

}
