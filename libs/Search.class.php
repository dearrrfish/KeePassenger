<?php

class Search extends KSAPI
{
    protected $_endpoint = Endpoint::SEARCH;

    public function parseResponse($err = null)
    {
        if ($err == null && $this->_response->status == "OK")
        {
            $data = $this->_response->data;
            foreach ($data as $d)
            {
                $e = $d->entry;
                $this->_w->result($e->uuid
                                , $e->uuid
                                , $e->title . ' - [' . $e->user . ']'
                                , 'Path: '. $e->path .' Notes: '. $e->notes
                                , WORKFLOW_ROOT.'images/key.png');
            }
            if (count($this->_w->results()) == 0)
            {
                $this->_w->result("EMPTY_SEARCH_RESULT"
                                , ""
                                , "Not Found"
                                , "Unable to find matched entries by given query."
                                , WORKFLOW_ROOT."images/info.png");
            }
        }
        parent::parseResponse($err);
    }

}
