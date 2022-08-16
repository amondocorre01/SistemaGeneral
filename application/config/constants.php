<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('PRE_SUC', 'PP_'); //PARA PROCEDIMIENTOS y VISTAS
define('SUF_SUC', '_P'); //PARA TABLAS  _P
define('BD_SERV_2', 'capresso.database.windows.net');
define('BD_NAME_2', 'BDVentasSucursalPrueba');
define('BD_USER_2', 'capresso');
define('BD_PASS_2', 'Qwerty123');
define('SUCURSAL', 'Sucursal Prueba');
define('IP_SUCURSAL','200.58.85.21'); // es la ip de la BD correspondiente a la suc Cine center 177.222.102.26
define('LOGO', 'iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAAAn1BMVEXgISj///8AAADeAADgHCTgGSHfERvfFR7fABDeAAneAAT30NH99fXfCRX++fn53N31xcb2ysvytrftmZrvoKLzvL3iNTrqg4XnaWzjRUn87OzhLjPwqarpeHr65eXxsLHsjpDkUFTy8vLl5eW0tLTlXF7ocXPiO0DHxsaKiopcXFw6OjosLCxTU1N6enpkZGTV1NQRERFGRkadnZ0gICA0ILdeAAAE9klEQVRoga2a63qqOhCGgwkhQCKoIIIoYG1t19rt6jrc/7XtREBRMgEP3y+fiq/jZDKZmRRZo8S3s3m+UIqKMMim4z6Fhh/x81VKMXaFoJQKweTL5WsZ8ofhPH5zPeYQdCliCxen0fYRuP9GsYMg2QxXhdFBBvh86VGQ3PBdpzS4B4QXa3ztDK0ETrIb4bODNwp9xIvFLfBsNc7qVgzNRsNjOuTraxG8GQl/wzeilcQ6GAHPUnEHWxkfD8ID176LLYXLAXh420pe0a8dfwmP73H3We7KAH+QLelvINx/lC3pCQDfPs6Wfl9o4dP1A2vZoYc6eHXrtgTEtn149AynKNmHHjzwnsSWppfX8PTujdmXF1zC8xFOIcS2bTJi1e30As4HFtMRGHvrtKqqdOlgzKj5K/C8C08MmZAIz1lFs4zXZ/F0mgVFsvaYwY8ETc/wDHYKwevSt/rK8spQGLjRGZ6AXnHXMVg8BCsMWU/ICc5d4Bmb5hC5xqcMMqpo4RHwCF0OlVRWAjiULFv4Ur/2TnVF2ild/S0CNh/2aziQaUk3G+/eP378nCj99/m1f+narg80uqnhwHLic5B8/5pc6uf+TNcn02M0Srj+q53TkfX9Oenr9wkf6n84nik44BW3zcsfGrTSZ+N+jrSm00TBF3rL3aa8/ALY0vsN/VUb7WrJEPAeYvXm+QuyJ5M/NfxNv1NxZiHgVzXwFwN7Mtmb4G5sIehYZtzk8Fr/jvCVHi5KC4XALqjheyP80wS3Xy0UAdm2WVB4PaV2hgVF5GAhKCOy4Wh5MUWLpHO0At5y26QFeear3UUQHGeoAk4s91TM7/7+7qN/nfNLBcG3aKl/pwNXGeDj898Z/Odr302OINwH0FdwZf/u5X2/379/v1xnXRA+g+G6k1OrFHCsCa7v/jQ63AEPh7FHTYGDTMHBBR1rOVh6ywWFQpHNR8I5VF/IUIQ2keg1foDAhkRuogSom2TeGacYKr5tDiYu5IyYMyltAOtU4oqhckvTbmsFeUWl3AB6k6TDYKkcquioPCw4WGrjUcEIRbkKNwSmBlnvjRgfLiDDZSRKeAkW/iwZZINOlW45FkVwH4eHNhKHG2NVLMrSBQoXdNkOazQ9wM2F+igC6476EVM88oOhT6P8CJ+Z2sT++OcknxisctRwBA1NFNwU2KmlcfLohTUcKkVb23V9ES+E8UNkbTXwrbHvp/2A9BNkiAIlFrVw45LW3lPK8ziOiyipMB7ooNsy9gg3zohaywvMPIxdRkeMIJrBRd1VbQwx1RxJixvmMcTmHXgGZoim3A2rASdfqOnO25EInH/Icp5v1jfNSetQOcOBhu/4KBO9OwuzTrm6hT9hpthKnKaupza5NLj9JnU67/Orw5OmXDjQwDP7OUPLwtLAn+N2r5ssuqOJ+eN0cTHkvhhxjxkAmtmVBcIfnbke2fMyLizf78Mfs53V5WXMN1akg1vx/ZcWuMnN88wvYy3cCpApuZvYTbaywiwIeKCFWzy9xzWOrs3RXZ9F4DASNvtVd4xrL/6C9DbP0+62HILLM42Mz2OOtwGqD+iydbpwx+Ed/Kq58jPD5cIu6OD5Q4S7AtEDF9zzCjPY+YTidWmc9g5czW+jA3Y1xQRxGLaTofHA8D8V8DipEMZMUEeJUuFhka5ygzvGw49fsJ0VUZlspJJFHgbgffml/gdgC0Y8dhAW7AAAAABJRU5ErkJggg==');
define('ID_UBICACION', 18);
