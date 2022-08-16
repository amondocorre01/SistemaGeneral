<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once 'tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}
