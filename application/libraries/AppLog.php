<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AppLog
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }
}
