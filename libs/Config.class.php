<?php

class Config
{
    static private $_instance =  null;
    protected $_config        =  null;
    protected $_default       =  null;

    protected $_settings      =  array(
        "ksapi" => array(
             "command" => "kset url ",
             "title" => "KSAPI",
             "desc"  => "KeePass Service API endpoint (e.g. http://localhost:8443/api/)",
             "path"  => array("ksapi"),
             "image" => "images/ksapi.png"
         ),
        "secret" => array(
             "command" => "kset secret ",
             "title" => "Secret",
             "desc"  => "Set user secret used to communicate with KSAPI",
             "path"  => array("secret"),
             "image" => "images/secret.png"
         ),
         "title_only" => array(
             "command" => "kset titleonly",
             "title" => "Title Only",
             "desc"  => "Search only by titles",
             "path"  => array("query", "title_only"),
             "image" => "images/title_only.png"
         ),
         "clear_delay" => array(
            "command" => "kset ccdelay ",
            "title"  => "CC Delay",
            "desc"   => "Delay of clipboard clear after password copied",
            "path"   => array("clear_delay"),
            "image" => "images/clear_delay.png"
        )
    );

    protected $_conf_user    = "config/config.json";
    protected $_conf_default = "config/default.json";

    private function __construct($config = null)
    {
        if ($config == null)
        {
            $config  = @json_decode(file_get_contents(WORKFLOW_ROOT. $this->_conf_user), true);
            $default = @json_decode(file_get_contents(WORKFLOW_ROOT. $this->_conf_default), true);
            $config  = array_merge($default, $config);
        }
        $this->_config = $config;
    }

    public static function instance()
    {
        if (self::$_instance == null) { self::$_instance = new Config(); }
        return self::$_instance;
    }

    public function save($config = null)
    {
        if ($config == null) { $config = $this->_config; }
        $r = @json_encode($config);
        if (!$r) { return false; };
        $wr = file_put_contents(WORKFLOW_ROOT . $this->_conf_user, $r);
        return $wr;
    }

    public function get($keys = null, $subs = null)
    {
        if ($subs == null) { $subs = $this->_config; }
        if ($keys == null) { return $subs; }
        if (!is_array($keys)) { $keys = $this->_settings[$keys]["path"]; }

        $key = array_shift($keys);

        if (!isset($subs[$key])) { return null; }

        if (empty($keys)) { return $subs[$key]; }

        return $this->get($keys, $subs[$key]);
    }

    public function hasset($option)
    {
        return isset($this->_settings[$option]["path"]) && $this->get($option) !== null;
    }

    // getters
    public function getTitle($option)   { return $this->_settings[$option]['title']; }
    public function getDesc($option)    { return $this->_settings[$option]['desc']; }
    public function getCommand($option) { return $this->_settings[$option]['command']; }
    public function getImage($option)   { return WORKFLOW_ROOT.$this->_settings[$option]['image']; }

    public function set($value, $keys, &$subs = null)
    {
        if ($subs == null) { $subs = &$this->_config; }
        if (!is_array($keys)) { $keys = $this->_settings[$keys]["path"]; }

        $key = array_shift($keys);

        if (!isset($subs[$key])) { return false; }

        if (empty($keys))
        {
            $subs[$key] = $value;
            return true;
        }

        return $this->set($value, $keys, $subs[$key]);
    }

    // check mandatory settings
    public function verify()
    {
        $err = array();
        $config = $this->_config;
        // ksapi
        if (!isset($config['ksapi']))
        {
            $err[] = "ksapi";
        }
        if (!isset($config['secret']))
        {
            $err[] = "secret";
        }
        return $err;
    }

    // show current settings
    public function show()
    {
        $w = new Workflows();
        // ksapi
        $w->result("CONF_SHOW_KSAPI"
                  ,$this->getCommand("ksapi")
                  ,$this->getTitle("ksapi") . " : "
                                            . ($this->hasset('ksapi')
                                            ? $this->get('ksapi')
                                            : "━Σ(ﾟДﾟ|||)━ ____MISSING!!!")
                  ,$this->getDesc("ksapi")
                  ,$this->getImage("ksapi")
                  );
        // db

        // secret
        $w->result("CONF_SHOW_SECRET"
                  ,$this->getCommand("secret")
                  ,$this->getTitle("secret") . " : "
                                            . ($this->hasset('secret')
                                            ? $this->get('secret')
                                            : "━Σ(ﾟДﾟ|||)━ ____MISSING!!!")
                  ,$this->getDesc("secret")
                  ,$this->getImage("secret")
                  );


        // search
        $w->result("CONF_SHOW_TITLE_ONLY"
                  ,$this->getCommand("title_only")
                  ,$this->getTitle("title_only") . " : "
                                                 . ($this->hasset('title_only')
                                                 ? $this->get('title_only')
                                                 : "━Σ(ﾟДﾟ|||)━ ____MISSING!!!")
                  ,$this->getDesc("title_only")
                  ,$this->getImage("title_only")
                  );

        // clipboard clear delay
        $w->result("CONF_SHOW_CLEAR_DELAY"
                  ,$this->getCommand("clear_delay")
                  ,$this->getTitle("clear_delay") . " : "
                                                  . ($this->hasset('clear_delay')
                                                  ? $this->get('clear_delay') . " seconds"
                                                  : "━Σ(ﾟДﾟ|||)━ ____MISSING!!!")
                  ,$this->getDesc("clear_delay")
                  ,$this->getImage("clear_delay")
                  );

        return $w->toxml();
    }

    public function showToggle($option)
    {
        $w = new Workflows();
        $value = $this->get($option);
        if ($value == null || !in_array($value, array("yes", "no")))
        {
            $w->result("ERROR_CONF_SHOW_TOGGLE"
                      ,"err"
                      ,"Ooooops!"
                      ,"Something wrong with the toggle-type option ($option)"
                      ,WORKFLOW_ROOT."images/error.png"
                      );
        }
        else
        {
            $title = $this->getTitle($option);

            $w->result("CONF_SHOW_TOGGLE_YES"
                      ,"yes"
                      ,"Enable" . (($value == "yes") ? " - [Current]" : "")
                      ,"Set option [$title] to be enabled"
                      ,WORKFLOW_ROOT."images/select.png"
                      );

            $w->result("CONF_SHOW_TOGGLE_NO"
                      ,"no"
                      ,"Disable" . (($value == "no") ? " - [Current]" : "")
                      ,"Set option [$title] to be disabled"
                      ,WORKFLOW_ROOT."images/select.png"
                      );
        }

        return $w->toxml();
    }

    // set options
    public function setOption($option, $value, $max = null, $min = null)
    {
        if ($max != null && $value > $max) { $value = $max; }
        if ($min != null && $value < $min) { $value = $min; }
        $r = $this->set($value, $option);
        if (!$r) {
            return "Failed to change settings ($option => $value).";
        }
        $r = $this->save();
        if (!$r) {
            return "Failed to save settings.";
        }
        return "Successfully updated settings. ($option => $value)";
    }
}

Config::instance();
