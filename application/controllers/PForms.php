<?php

use setasign\Fpdi\Fpdi;

defined('BASEPATH') or exit('No direct script access allowed');

class PForms extends CI_Controller
{

      public function __construct()
      {
            parent::__construct();
            include APPPATH . 'third_party/fpdf/fpdf.php';
            include APPPATH . 'third_party/fpdi/src/autoload.php';
      }

      public function view($page = 'loanforms')
      {
            if (!file_exists(APPPATH . 'views/telesforms/' . $page . '.php')) {
                  show_404();
            }

            $this->load->view('telesforms/' . $page . '');
      }

      public function generatepdf()
      {

            // Check form submit or not
            if ($this->input->post('submit') != NULL) {

                  $postData = $this->input->post();

                  $filename = $postData['selectedfile'];

                  //TODO: Replace $member_name, $member_name with real variable
                  
                  $member_name = "Carrie-Anne Shaleen Carlyle S. Reyes";
                  $member_id = "444344";
                  $dr_no = "DR".$member_id; //date('Hms');

                  $pdf = new Fpdi();

                  $srcPath = FCPATH  . "assets/forms/$filename";
                  $pdf->setSourceFile("$srcPath.pdf");

                  //Import the first page of the file
                  $tpl  = $pdf->importPage(1);
                  $size = $pdf->getTemplateSize($tpl);
                  $pdf->AddPage('', [$size['width'], $size['height']]);

                  //We need to ensure the size of the pdf stays the same when pdf is generated
                  $pdf->useTemplate($tpl, 0, 0, $size['width'], $size['height'], FALSE);

                  $json = file_get_contents(FCPATH . "assets/forms/forms.config.json");
                  $obj_attr  = json_decode($json, true);

                  $obj  = (object) json_decode($json, true)[$filename];
                  
                  // Erase the DRNUMBER near the top right to give way to generated one                  
                  $pdf->SetXY($obj->DRX, $obj->DRY);

                  // Fill color similar to background
                  $pdf->SetFillColor($obj->R, $obj->G, $obj->B);

                  // Fill color the color
                  $pdf->Cell(0, 10, '', 3, 0, 'C', true);

                  $pdf = $this->insertData($pdf, $obj->DRX, $obj->DRY + 5, "$dr_no", 12, [255, 0, 0]);   //DR NUMBER
                  $pdf = $this->insertData($pdf, $obj->NAMEX, $obj->NAMEY, "$member_name", $obj->Font);  //MAKER NAME
                  $pdf = $this->insertData($pdf, $obj->EMPNOX, $obj->NAMEY, "$member_id",$obj->Font);    //EMPLOYEE NUMBER

                  //Download the File 
                  $pdf->Output('D', "$filename" . "_$dr_no.pdf");
                  //Go back to member downloads
                  $this->load->view('telesforms/loanforms.php');
            }
      }

      public function insertData(&$pdf, $xaxis, $yaxis, $text, $fontsize = 8, $fontcolor = [0, 0, 0])
      {
            $pdf->SetXY($xaxis, $yaxis);
            $pdf->SetFont('Arial', '', $fontsize);
            $pdf->SetTextColor($fontcolor[0], $fontcolor[1], $fontcolor[2]);
            $pdf->Write(0, $text);
            return $pdf;
      }

      public function index()
      {
            $this->load->view('telesforms/loanforms.php');
      }
}
