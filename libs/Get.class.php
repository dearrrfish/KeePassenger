<?php

class Get extends KSAPI
{
    protected $_endpoint = Endpoint::GET;

    public function parseResponse($err = null)
    {
        if ($err == null && $this->_response->status == "OK")
        {
            $this->_results = $this->_response->data;
        }
    }

}
