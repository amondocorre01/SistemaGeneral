<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pedido extends CI_Controller {
	
		public function index()
		{
			
		}

		public function inventario()
	  	{
			$sufijo = $this->uri->segment(3, 0);
			$bd = $this->uri->segment(2, 0);

			$DB2 = $this->load->database($bd, TRUE);

			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Inventario');
			
		

	   		$matriz =  $DB2->query("SELECT NOMBRE_PRODUCTO, CANTIDAD FROM INVENTARIOS_DECLARACION_".$sufijo." id WHERE FECHA_CONTEO = (SELECT FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA = (SELECT MAX(FECHA) FROM CABECERA_PEDIDO_".$sufijo." cp))")->result();


	   $this->excel->getProperties()->setCreator("Capresso")
										 ->setLastModifiedBy("Capresso")
										 ->setTitle("PHPExcel Test Document")
										 ->setSubject("PHPExcel Test Document")
										 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
										 ->setKeywords("office PHPExcel php")
										 ->setCategory("Test result file");
			$this->excel->getDefaultStyle()->getFont()->setName('Arial');
			$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(21);  //1 cm de alto
			$this->excel->getActiveSheet()->setCellValue('A1', 'REPORTE DE CANTIDADES INVENTARIADAS');
			$this->excel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92daec');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->mergeCells('A1:B1');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);  // custom width of column
			

			$this->excel->getActiveSheet()->setCellValue('A2', 'Producto' );
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');
			$this->excel->getActiveSheet()->setCellValue('B2', 'Cantidad' );
			$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');
			
			$i = 0;
			foreach ($matriz as $row)
			{
				$posicion                       = ($i + 3);
				$producto                       = $row->NOMBRE_PRODUCTO;
				$cantidad                       = $row->CANTIDAD;
				
				$this->excel->getActiveSheet()->setCellValue('A'.$posicion, $producto );
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('B'.$posicion, $cantidad );
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$i+=1;
			}
	   $filename='inventario-'.date('Y-m-d').'.xls'; //save our workbook as this file name
	   header('Content-Type: application/vnd.ms-excel'); //mime type
	   header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	   header('Cache-Control: max-age=0'); //no cache
	   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	   $objWriter->save('php://output');
	  }

	  public function solicitud()
	  	{
			$sufijo = $this->uri->segment(3, 0);
			$bd = $this->uri->segment(2, 0);

			$DB2 = $this->load->database($bd, TRUE);

			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Inventario');
			
		

	   		$matriz =  $DB2->query("SELECT NOMBRE_PRODUCTO, CANTIDAD_SOLICITADA FROM INVENTARIOS_DECLARACION_".$sufijo." id WHERE FECHA_CONTEO = (SELECT FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA_SOLICITUD = (SELECT MAX(FECHA_SOLICITUD) FROM CABECERA_PEDIDO_".$sufijo." cp))")->result();


	   $this->excel->getProperties()->setCreator("Capresso")
										 ->setLastModifiedBy("Capresso")
										 ->setTitle("PHPExcel Test Document")
										 ->setSubject("PHPExcel Test Document")
										 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
										 ->setKeywords("office PHPExcel php")
										 ->setCategory("Test result file");
			$this->excel->getDefaultStyle()->getFont()->setName('Arial');
			$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(21);  //1 cm de alto
			$this->excel->getActiveSheet()->setCellValue('A1', 'REPORTE DE CANTIDADES SOLICITADAS');
			$this->excel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92daec');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->mergeCells('A1:B1');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);  // custom width of column
			

			$this->excel->getActiveSheet()->setCellValue('A2', 'Producto' );
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');
			$this->excel->getActiveSheet()->setCellValue('B2', 'Cantidad' );
			$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');
			
			$i = 0;
			foreach ($matriz as $row)
			{
				$posicion                       = ($i + 3);
				$producto                       = $row->NOMBRE_PRODUCTO;
				$cantidad                       = $row->CANTIDAD_SOLICITADA;
				
				$this->excel->getActiveSheet()->setCellValue('A'.$posicion, $producto );
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('B'.$posicion, $cantidad );
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$i+=1;
			}
	   $filename='solicitud-'.date('Y-m-d').'.xls'; //save our workbook as this file name
	   header('Content-Type: application/vnd.ms-excel'); //mime type
	   header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	   header('Cache-Control: max-age=0'); //no cache
	   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	   $objWriter->save('php://output');
	  }


	  public function preparacion()
	  	{
			$sufijo = $this->uri->segment(3, 0);
			$bd = $this->uri->segment(2, 0);

			$DB2 = $this->load->database($bd, TRUE);

			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Inventario');
			
		

	   		$matriz =  $DB2->query("SELECT NOMBRE_PRODUCTO, CANTIDAD_SOLICITADA, CANTIDAD_ENVIADA, TURNO, OBSERVACION FROM INVENTARIOS_DECLARACION_".$sufijo." id WHERE CANTIDAD_SOLICITADA > 0 AND FECHA_CONTEO = (SELECT FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA_PREPARACION = (SELECT MAX(FECHA_PREPARACION) FROM CABECERA_PEDIDO_".$sufijo." cp))")->result();


	   $this->excel->getProperties()->setCreator("Capresso")
										 ->setLastModifiedBy("Capresso")
										 ->setTitle("PHPExcel Test Document")
										 ->setSubject("PHPExcel Test Document")
										 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
										 ->setKeywords("office PHPExcel php")
										 ->setCategory("Test result file");
			$this->excel->getDefaultStyle()->getFont()->setName('Arial');
			$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(21);  //1 cm de alto
			$this->excel->getActiveSheet()->setCellValue('A1', 'REPORTE DE CANTIDADES PREPARADAS');
			$this->excel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92daec');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->mergeCells('A1:E1');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

			$this->excel->getActiveSheet()->setCellValue('A2', 'Producto' );
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('B2', 'Cantidad Solicitada' );
			$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('C2', 'Cantidad Preparada' );
			$this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('C2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('D2', 'Turno' );
			$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('D2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('E2', 'Observación' );
			$this->excel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('E2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');
			
			$i = 0;
			foreach ($matriz as $row)
			{
				$posicion                       = ($i + 3);
				$producto                       = $row->NOMBRE_PRODUCTO;
				$cantidad                       = $row->CANTIDAD_SOLICITADA;
				$preparada                      = $row->CANTIDAD_ENVIADA;
				$turno                      	= $row->TURNO;
				$observacion                    = $row->OBSERVACION;
				
				$this->excel->getActiveSheet()->setCellValue('A'.$posicion, $producto );
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('B'.$posicion, $cantidad );
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('C'.$posicion, $preparada );
				$this->excel->getActiveSheet()->getStyle('C'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('C'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('D'.$posicion, $turno );
				$this->excel->getActiveSheet()->getStyle('D'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('E'.$posicion, $observacion );
				$this->excel->getActiveSheet()->getStyle('E'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$i+=1;
			}
	   $filename='preparacion-'.$bd.'-'.date('Y-m-d').'.xls'; //save our workbook as this file name
	   header('Content-Type: application/vnd.ms-excel'); //mime type
	   header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	   header('Cache-Control: max-age=0'); //no cache
	   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	   $objWriter->save('php://output');
	  }

	  public function recepcion()
	  	{
			$sufijo = $this->uri->segment(3, 0);
			$bd = $this->uri->segment(2, 0);

			$DB2 = $this->load->database($bd, TRUE);

			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Recepcion');
			
		

	   		$matriz =  $DB2->query("SELECT NOMBRE_PRODUCTO, CANTIDAD_SOLICITADA, CANTIDAD_ACEPTADA, TURNO, OBSERVACION2 FROM INVENTARIOS_DECLARACION_".$sufijo." id WHERE CANTIDAD_SOLICITADA > 0 AND FECHA_CONTEO = (SELECT FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA_RECEPCION = (SELECT MAX(FECHA_RECEPCION) FROM CABECERA_PEDIDO_".$sufijo." cp))")->result();


	   $this->excel->getProperties()->setCreator("Capresso")
										 ->setLastModifiedBy("Capresso")
										 ->setTitle("PHPExcel Test Document")
										 ->setSubject("PHPExcel Test Document")
										 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
										 ->setKeywords("office PHPExcel php")
										 ->setCategory("Test result file");
			$this->excel->getDefaultStyle()->getFont()->setName('Arial');
			$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(21);  //1 cm de alto
			$this->excel->getActiveSheet()->setCellValue('A1', 'REPORTE DE CANTIDADES PREPARADAS');
			$this->excel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92daec');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->mergeCells('A1:E1');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

			$this->excel->getActiveSheet()->setCellValue('A2', 'Producto' );
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('B2', 'Cantidad Solicitada' );
			$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('C2', 'Cantidad Preparada' );
			$this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('C2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('D2', 'Turno' );
			$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('D2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('E2', 'Observación' );
			$this->excel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('E2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');
			
			$i = 0;
			foreach ($matriz as $row)
			{
				$posicion                       = ($i + 3);
				$producto                       = $row->NOMBRE_PRODUCTO;
				$cantidad                       = $row->CANTIDAD_SOLICITADA;
				$aceptada                      = $row->CANTIDAD_ACEPTADA;
				$turno                      	= $row->TURNO;
				$observacion                    = $row->OBSERVACION2;
				
				$this->excel->getActiveSheet()->setCellValue('A'.$posicion, $producto );
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('B'.$posicion, $cantidad );
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('C'.$posicion, $aceptada );
				$this->excel->getActiveSheet()->getStyle('C'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('C'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('D'.$posicion, $turno );
				$this->excel->getActiveSheet()->getStyle('D'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('E'.$posicion, $observacion );
				$this->excel->getActiveSheet()->getStyle('E'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$i+=1;
			}
	   $filename='recepcion-'.$bd.'-'.date('Y-m-d').'.xls'; //save our workbook as this file name
	   header('Content-Type: application/vnd.ms-excel'); //mime type
	   header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	   header('Cache-Control: max-age=0'); //no cache
	   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	   $objWriter->save('php://output');
	  }


	  public function entrega()
	  	{
			$sufijo = $this->uri->segment(3, 0);
			$bd = $this->uri->segment(2, 0);

			$DB2 = $this->load->database($bd, TRUE);

			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Recepcion');
			
		

	   		$matriz =  $DB2->query("SELECT NOMBRE_PRODUCTO, CANTIDAD_SOLICITADA, CANTIDAD_ACEPTADA, CANTIDAD_DEVUELTA, OBSERVACION3 FROM INVENTARIOS_DECLARACION_".$sufijo." id WHERE CANTIDAD_SOLICITADA > 0 AND FECHA_CONTEO = (SELECT FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA_ENTREGA = (SELECT MAX(FECHA_ENTREGA) FROM CABECERA_PEDIDO_".$sufijo." cp))")->result();


	   $this->excel->getProperties()->setCreator("Capresso")
										 ->setLastModifiedBy("Capresso")
										 ->setTitle("PHPExcel Test Document")
										 ->setSubject("PHPExcel Test Document")
										 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
										 ->setKeywords("office PHPExcel php")
										 ->setCategory("Test result file");
			$this->excel->getDefaultStyle()->getFont()->setName('Arial');
			$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(21);  //1 cm de alto
			$this->excel->getActiveSheet()->setCellValue('A1', 'REPORTE DE CANTIDADES PREPARADAS');
			$this->excel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92daec');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->mergeCells('A1:E1');
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);  // custom width of column
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

			$this->excel->getActiveSheet()->setCellValue('A2', 'Producto' );
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('B2', 'Cantidad Solicitada' );
			$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('C2', 'Cantidad Preparada' );
			$this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('C2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('D2', 'Cantidad Devuelta' );
			$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('D2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');

			$this->excel->getActiveSheet()->setCellValue('E2', 'Observación' );
			$this->excel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('E2')->applyFromArray($this->excel->getBorderThinBlack());
			$this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold( true );
			$this->excel->getActiveSheet()->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('a4dbd2');
			
			$i = 0;
			foreach ($matriz as $row)
			{
				$posicion                       = ($i + 3);
				$producto                       = $row->NOMBRE_PRODUCTO;
				$cantidad                       = $row->CANTIDAD_SOLICITADA;
				$aceptada                      = $row->CANTIDAD_ACEPTADA;
				$rechazada                      	= $row->CANTIDAD_DEVUELTA;
				$observacion                    = $row->OBSERVACION3;
				
				$this->excel->getActiveSheet()->setCellValue('A'.$posicion, $producto );
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('B'.$posicion, $cantidad );
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('C'.$posicion, $aceptada );
				$this->excel->getActiveSheet()->getStyle('C'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('C'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('D'.$posicion, $turno );
				$this->excel->getActiveSheet()->getStyle('D'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$this->excel->getActiveSheet()->setCellValue('E'.$posicion, $observacion );
				$this->excel->getActiveSheet()->getStyle('E'.$posicion)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E'.$posicion)->applyFromArray($this->excel->getBorderThinBlack());

				$i+=1;
			}
	   $filename='entrega-'.$bd.'-'.date('Y-m-d').'.xls'; //save our workbook as this file name
	   header('Content-Type: application/vnd.ms-excel'); //mime type
	   header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	   header('Cache-Control: max-age=0'); //no cache
	   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	   $objWriter->save('php://output');
	  }
	
	}


	
	
	/* End of file Pedido.php */
	

?>