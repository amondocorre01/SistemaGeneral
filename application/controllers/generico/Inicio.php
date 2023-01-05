<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(!isset($_SESSION['loggin'])){
            redirect('login/index', 'refresh');
        }
        
        $data = null;
        $data['page'] = '';
        $id_user = $this->session->userdata('id_usuario'); 
        if(isset($_GET['vc'])){
                $id_vc = $_GET['vc'];
                $data['id_vc']=$id_vc;
                $ventas_acceso = $this->getVentasAcceso($id_vc);
                $data['ventas_acceso'] = $ventas_acceso;
                foreach ($ventas_acceso as $item) {
                    $nombre = $item->NOMBRE;
                    $link = $item->LINK;
                  }
            if(isset($link)){
                if($link != null){
                    $data['page'] = 'link';
                    switch ($link) {
                        case 'REPORTE_01':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_01';
                                $sql = "EXEC REPORTE_01 '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                          case 'REPORTE_02':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_02';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                          case 'REPORTE_03':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_03';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_04':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_04';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_05':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_05';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_06':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_06';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_07':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_07';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_08':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_08';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_09':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_09';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_10':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_10';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_11':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_11';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_12':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_12';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_13':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_13';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_14':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_14';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_15':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_15';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_16':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_16';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_17':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_17';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;case 'REPORTE_18':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_18';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                        case 'REPORTE_001':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_01';
                                $sql = "EXEC REPORTE_01'".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                        case 'REPORTE_002':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_02';
                                $sql = "EXEC REPORTE_02'".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                        case 'REPORTE_003':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_03';
                                $sql = "EXEC REPORTE_03'".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                        case 'REPORTE_004':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_04';
                                $sql = "EXEC REPORTE_04'".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                        case 'REPORTE_005':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_05';
                                $sql = "EXEC REPORTE_05'".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                        case 'REPORTE_006':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_06';
                                $sql = "EXEC REPORTE_06'".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                          break;
                        case 'REPORTE_007':
                            $name_procedimiento='REPORTE_07';
                            $sql = "EXEC REPORTE_07";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                          break;
                        case 'REPORTE_008':
                            $name_procedimiento='REPORTE_08';
                            $sql = "EXEC REPORTE_08";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                          break;
                        case 'REPORTE_01_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_01_PANDO';
                            $sql = "EXEC REPORTE_01_PANDO '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;
                        case 'REPORTE_02_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_02_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;
                        case 'REPORTE_03_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_03_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_04_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_04_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_05_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_05_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_06_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_06_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_07_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_07_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_08_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_08_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_09_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_09_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $DB_PANDO = $this->load->database('pando',TRUE);                          
                            //$res = $this->main->getQuery($sql);
                            $res = $DB_PANDO->query($sql)->result();
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnasProcedimiento($name_procedimiento, 'pando');
                        }
                        break;case 'REPORTE_10_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_10_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_11_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_11_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_12_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_12_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_13_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_13_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_14_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_14_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_15_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_15_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_16_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_16_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_17_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_17_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;case 'REPORTE_18_PANDO':
                        if(isset($_POST['form_date'])){
                            $f_ini = $_POST['f_inicio'];
                            $f_fin = $_POST['f_fin'];
                            $name_procedimiento='REPORTE_18_PANDO';
                            $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                            $res = $this->main->getQuery($sql);
                            $data['campos_excel'] = $res;
                            $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                        }
                        break;
                        case 'REPORTE_01_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_01_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;
                            case 'REPORTE_02_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_02_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;
                            case 'REPORTE_03_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_03_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_04_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_04_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_05_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_05_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_06_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_06_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_07_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_07_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_08_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_08_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_09_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_09_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_10_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_10_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_11_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_11_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_12_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_12_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_13_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_13_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_14_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_14_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_15_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_15_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_16_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_16_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_17_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_17_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;case 'REPORTE_18_SALAMANCA':
                            if(isset($_POST['form_date'])){
                                $f_ini = $_POST['f_inicio'];
                                $f_fin = $_POST['f_fin'];
                                $name_procedimiento='REPORTE_18_SALAMANCA';
                                $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                $res = $this->main->getQuery($sql);
                                $data['campos_excel'] = $res;
                                $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                            }
                            break;
                            case 'REPORTE_01_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_01_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;
                                case 'REPORTE_02_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_02_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;
                                case 'REPORTE_03_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_03_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_04_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_04_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_05_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_05_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_06_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_06_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_07_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_07_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_08_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_08_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_09_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_09_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_10_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_10_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_11_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_11_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_12_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_12_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_13_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_13_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_14_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_14_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_15_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_15_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_16_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_16_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;case 'REPORTE_17_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_17_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;
                                case 'REPORTE_18_JORDAN':
                                if(isset($_POST['form_date'])){
                                    $f_ini = $_POST['f_inicio'];
                                    $f_fin = $_POST['f_fin'];
                                    $name_procedimiento='REPORTE_18_JORDAN';
                                    $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                    $res = $this->main->getQuery($sql);
                                    $data['campos_excel'] = $res;
                                    $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                }
                                break;
                                case 'REPORTE_01_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_01_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;
                                    case 'REPORTE_02_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_02_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;
                                    case 'REPORTE_03_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_03_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_04_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_04_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_05_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_05_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_06_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_06_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_07_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_07_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_08_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_08_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_09_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_09_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_10_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_10_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_11_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_11_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_12_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_12_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_13_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_13_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_14_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_14_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_15_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_15_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_16_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_16_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_17_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_17_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;case 'REPORTE_18_LINCOLN':
                                    if(isset($_POST['form_date'])){
                                        $f_ini = $_POST['f_inicio'];
                                        $f_fin = $_POST['f_fin'];
                                        $name_procedimiento='REPORTE_18_LINCOLN';
                                        $sql = "EXEC ".$name_procedimiento." '".$f_ini."', '".$f_fin."'";
                                        $res = $this->main->getQuery($sql);
                                        $data['campos_excel'] = $res;
                                        $data['nombre_columnas'] = $this->getNombreColumnas($name_procedimiento);
                                    }
                                    break;
                        
                      }
                }
            }
            
        }else{
            $acceso = $this->session->userdata('acceso_menu_ventas');
            if($acceso=='accept'){
                if(isset($_GET['lp'])){
                    $id_vnlp = $_GET['lp'];
                    $name_page = $_GET['name'];
                    $facturado = $_GET['fac'];
                    $data['ventas_ui'] = $id_vnlp;
                    $data['ventas_page'] = $id_vnlp;
                    $data['name_page'] = $name_page;
                    $data['facturado_page'] = $facturado;
                    $data['page']= 'panel';
                    $data['collapse'] = 'sidebar-collapse sidebar-closed';
                    $this->session->set_userdata('id_lista', $_GET['lp']);
                }else{
                    $data['menu_ventas'] = $this->getMenuVentas($id_user);
                    $data['page'] = 'menu_ventas';
                }
            }else if($acceso=='deny'){
                if(isset($_GET['lp'])){
                    $id_vnlp = $_GET['lp'];
                    $name_page = $_GET['name'];
                    $facturado = $_GET['fac'];
                    $data['ventas_ui'] = $id_vnlp;
                    $data['ventas_page'] = $id_vnlp;
                    $data['name_page'] = $name_page;
                    $data['facturado_page'] = $facturado;
                    $data['collapse'] = 'sidebar-collapse sidebar-closed';
                    $data['page']= 'panel';
                    $this->session->set_userdata('id_lista', $_GET['lp']);
                }else{
                    $data['menu_ventas'] = $this->getMenuVentas($id_user);
                    $data['page'] = 'menu_ventas';
                }
            }
        }

        if(isset($_SESSION['menu'])){
            $data['menu'] = $_SESSION['menu'];
        }else{
            $menu=$this->obtenerMenuPrincipal($id_user, $data);
            $_SESSION['menu']= $menu;
            $data['menu'] = $menu;
        }

        $this->load->view('generico/layout/head', $data, FALSE);
        $this->load->view('generico/layout/navbar', $data, FALSE);
        $this->load->view('generico/layout/aside', $data, FALSE);
        $this->load->view('generico/layout/content', $data, FALSE);
        $this->load->view('generico/layout/footer', $data, FALSE);
    }

    public function getNombreColumnas($name_procedimiento){
        $sql="select name as column_name
        from sys.dm_exec_describe_first_result_set
               (N'[dbo].[".$name_procedimiento."]', null, 0)
       order by column_ordinal;";
       return $this->main->getQuery($sql);

    }

    public function getNombreColumnasProcedimiento($name_procedimiento, $conexion){
        $sql="select name as column_name
        from sys.dm_exec_describe_first_result_set
               (N'[dbo].[".$name_procedimiento."]', null, 0)
       order by column_ordinal;";
       $DB2 = $this->load->database($conexion, TRUE);
       return $DB2->query($sql)->result();

    }

    public function getVentasAcceso($id_vc){
        $sql="select * from VENTAS_ACCESO where ID_VENTAS_ACCESO = '$id_vc';";
		$res = $this->main->getQuery($sql);
        return $res;
    }
    
    public function obtenerMenuPrincipal($id_usuario, $data){
        $sql = "SELECT va.* FROM VENTAS_ACCESO va, VENTAS_USUARIOS_ACCESO vua  
        WHERE SISTEMA_GENERAL = 1 AND NIVEL_SUPERIOR = 0 AND va.tipo='menu' AND va.estado=1 AND vua.estado=1
        AND va.ID_VENTAS_ACCESO = vua.ID_VENTAS_ACCESO AND vua.ID_USUARIO = ".$id_usuario."
        ORDER BY numero_orden;";
        $res_sql = $this->main->getQuery($sql);
        $res='';
        foreach ($res_sql as $row)
            {
                $nombre = $row->NOMBRE;
                $id_nivel = $row->ID_VENTAS_ACCESO;
               
                    $res = $res.'<li class="nav-item">
                    <a href="#" class="nav-link" id="menunav_'.$row->ID_VENTAS_ACCESO.'">
                        '.$row->ICONO.'
                        <p>
                        '.$nombre.'
                        <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>';
                    $res = $res.'<ul class="nav nav-treeview">';
                        $submenu = $this->obtenerSubMenu($id_usuario, $id_nivel, $data);
                        $res=$res.$submenu.'</ul>';
                    
                    $res = $res.'</li>';
                               
            }
        return $res;
    }

    public function obtenerSubMenu($id_usuario, $id_nivel_superior, $data){
        $sql = "SELECT va.* FROM VENTAS_ACCESO va, VENTAS_USUARIOS_ACCESO vua  
        WHERE SISTEMA_GENERAL = 1 AND NIVEL_SUPERIOR = ".$id_nivel_superior." AND va.estado=1 AND vua.estado=1
        AND va.ID_VENTAS_ACCESO = vua.ID_VENTAS_ACCESO AND vua.ID_USUARIO = ".$id_usuario."
        ORDER BY numero_orden;";
        $res_sql = $this->main->getQuery($sql);
        $res='';
        foreach ($res_sql as $row)
            {
                $nombre = $row->NOMBRE;
                $id_nivel = $row->ID_VENTAS_ACCESO;
                $link = $row->LINK;
                $tipo = $row->TIPO;
                $navegacion = $row->NAVEGACION;
                if($tipo =='acceso'){
                    $url= base_url('index.php/generico/inicio');
                    $url= $url.'?vc='.$id_nivel;
                    
                        if($navegacion=='new-tab'){
                            $url=site_url($link);
                            $res = $res.'<li class="nav-item">
                            <a href="'.$url.'" target="_blank" class="nav-link '.'" data-page="'.$row->ID_VENTAS_ACCESO.'">
                            '.$row->ICONO.'
                            <p>'.$nombre.'</p>
                            </a>
                            </li>';
                        }else{
                            $res = $res.'<li class="nav-item">
                            <a href="'.$url.'" class="nav-link" data-sup="'.$row->NIVEL_SUPERIOR.'" id="menunav_'.$row->ID_VENTAS_ACCESO.'">   
                            '.$row->ICONO.'
                            <p>'.$nombre.'</p>
                            </a>
                            </li>';
                        }
                   
                }else{
                    $habilitado = $this->verificarPermisoMenu($id_usuario, $id_nivel);
                    if($habilitado){
                    $res = $res.'<li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-table nav-icon"></i>
                        <p>
                        '.$nombre.'
                        <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">';
                    $submenu = $this->obtenerSubMenu($id_usuario, $id_nivel, $data);
                    $res=$res.$submenu.'</ul>
                    </li>';
                    }
                }     
            }
        return $res;
    }

    public function verificarPermisoMenu($id_usuario, $id_nivel){
        $res = false;
        $sql="select count(*) as cantidad from VENTAS_USUARIOS_ACCESO where ID_USUARIO = '$id_usuario' and ID_VENTAS_ACCESO = '$id_nivel';";
        $res_sql = $this->main->getQuery($sql);
        $cantidad = $res_sql[0]->cantidad;
        if($cantidad != 0 ){
            $sql="select estado from ventas_usuarios_acceso where ID_USUARIO = '$id_usuario' and ID_VENTAS_ACCESO = '$id_nivel';";
            $res_sql = $this->main->getQuery($sql);
            $estado= $res_sql[0]->estado;
            if($estado == 1)
                return true;
            else
                return false;
        }else{
            return false;
        }
    }

    public function getMenuVentas($id_usuario){
        $id_ubicacion = $this->session->userdata('id_ubicacion'); 
        $res = '<div class="card">
        <div class="card-body">
          <center>';
        $sql= "select distinct(NLP.ID_NOMBRE_LISTA_PRECIOS) as ID_NOMBRE_LISTA_PRECIOS,NLP.NOMBRE_LISTA_PRECIOS, NLP.FACTURADO 
        from ventas_nombre_lista_precios NLP,VENTAS_LISTA_VENTA_SUCURSAL LVS,VENTAS_PERMISO_SUCURSAL PS  
        where PS.ID_USUARIO='$id_usuario'AND PS.ID_UBICACION='$id_ubicacion' AND PS.ID_UBICACION=LVS.ID_UBICACION  AND NLP.ID_NOMBRE_LISTA_PRECIOS=LVS.ID_NOMBRE_LISTA_PRECIOS";
        $res_sql = $this->main->getQuery($sql);
        foreach ($res_sql as $row){
            $url= base_url('index.php/generico/inicio');
            $id = $row->ID_NOMBRE_LISTA_PRECIOS;
            $nombre = $row->NOMBRE_LISTA_PRECIOS;
            $facturado = $row->FACTURADO;
            $url= $url.'?lp='.$id.'&name='.$nombre.'&fac='.$facturado;
            switch (strtoupper($nombre)) {
                case 'SUCURSALES':
                    $res = $res.'<a class="btn btn-app bg-capresso" href="'.$url.'">
                    <img  width="30" src="'.base_url('assets/dist/img/iconos/capresso.png').'" alt=""> '.$nombre.'
                    </a>';
                    break;
                case 'PEDIDOS YA':
                    $res = $res.'<a class="btn btn-app bg-pedidos-ya" href="'.$url.'">
                    <!--<i class="fa fa-users"></i> -->
                    <img  width="30" src="'.base_url('assets/dist/img/iconos/pedidos_ya.png').'" alt=""> '.$nombre.'
                  </a>';
                    break;
                case 'SER':
                    $res = $res.'<a class="btn btn-app bg-ser" href="'.$url.'">
                    <img  width="30" src="'.base_url('assets/dist/img/iconos/ser.jpg').'" alt=""> '.$nombre.'
                    </a>';
                    break;
                case 'YAIGO':
                    $res = $res.'<a class="btn btn-app bg-yaigo" href="'.$url.'">
                    <img  width="30" src="'.base_url('assets/dist/img/iconos/yaigo.png').'" alt=""> '.$nombre.'
                    </a>';
                    break;
                case 'CONSUMO INTERNO':
                    $res = $res.'<a class="btn btn-app bg-capresso" href="'.$url.'">
                    <img  width="30" src="'.base_url('assets/dist/img/iconos/capresso.png').'" alt=""> '.$nombre.'
                    </a>';
                    break;
                case 'CORTESIAS':
                    $res = $res.'<a class="btn btn-app bg-capresso" href="'.$url.'">
                    <img  width="30" src="'.base_url('assets/dist/img/iconos/capresso.png').'" alt=""> '.$nombre.'
                    </a>';
                    break;
                
                default:
                    $res = $res.'<a class="btn btn-app bg-capresso" href="'.$url.'">
                    <img  width="30" src="'.base_url('assets/dist/img/iconos/capresso.png').'" alt="">'.$nombre.'
                    </a>';
                    break;
            }
        }
        $res = $res.'</center>
                </div>
            </div>';
      return $res;
    }
}

?>