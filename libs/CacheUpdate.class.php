<?php

class CacheUpdate extends KSAPI
{
    protected $_endpoint = Endpoint::UPDATE;

    public function parseResponse($err = null)
    {
        if ($err == null && isset($this->_response->status))
        {
            $this->_results = $this->_response;
        }
        else {
            $this->_results = array(
                "status" => "KO",
                "data"   => "unknown error"
            );
        }
    }

}
