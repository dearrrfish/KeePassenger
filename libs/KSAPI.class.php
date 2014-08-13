<?php

class Endpoint
{
    const UPDATE = "/cache/update/";
    const SEARCH = "/search/";
    const GET = "/get/";
}

abstract class KSAPI
{
    protected $_w = null;       // workflow object
    protected $_url = null;
    protected $_query = null;
    protected $_endpoint = "/";
    protected $_response = null;
    protected $_results = null;

    // ctor
    public function __construct($query = "", $tail = "")
    {
        $this->_query = urlencode($query) . $tail;
        $this->_w = new Workflows();
    }

    // contruct request url
    public function constructUrl()
    {
        // e.g. http://localhost:3000/api/1234adefg/search/target_name?title_only=true
        $config = Config::instance()->get();
        $url = $config['ksapi']
             . $config['secret']
             . $this->_endpoint
             . $this->_query;

        if ($this->_endpoint == Endpoint::SEARCH && isset($config['query']) && !empty($config['query']))
        {
            // parse options
            $opts = array();
            foreach ($config['query'] as $opt => $val)
            {
                $opts[] = $opt . "=" . urlencode($val);
            }
            if (!empty($opts))
            {
                $url .= "?" . implode("&", $opts);
            }
        }

        return $url;
    }


    // execute
    public function execute($url = null)
    {
        // load and verify config
        $err = Config::instance()->verify();
        if (!empty($err))
        {
            $this->parseResponse($err);
            return $this->_results;
        }

        $this->_url = ($url == null)
            ? $this->constructUrl()
            : $url
            ;
        $options = array(
            CURLOPT_CONNECTTIMEOUT => 5,     // set curl timeout to 5 sec.
        );

        $this->_response = @json_decode($this->_w->request($this->_url, $options));
        $this->parseResponse();
        return $this->_results;
    }

    // parse response
    public function parseResponse($err = null)
    {
        if ($err != null)
        {
            $this->_w->result("ERROR_CONFIG"
                             , ""
                             , "Ooooops!"
                             , "Invalid configurations...(" . implode("/", $err) . ")"
                             , WORKFLOW_ROOT."images/error.png"
                             );
        }
        elseif ($this->_response == null || $this->_response->status == 'KO' || count($this->_w->results()) == 0)
        {
            $this->_w->result("ERROR_KSAPI"
                            , ""
                            , "Ooooops!"
                            , "Something went wrong in service call process..."
                            , WORKFLOW_ROOT."images/error.png");
        }
        $this->_results = $this->_w->toxml();
    }
}
