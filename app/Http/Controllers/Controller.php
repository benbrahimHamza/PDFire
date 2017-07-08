<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // Split PDF file
    function split_pdf() {
      // Setup the directory name writing
      $fileName = $_POST['fileName'];
      $firstPage = $_POST['firstPage'];
      $lastPage = $_POST['lastPage'];
      $filePath = './upload/' . $fileName . '.pdf';
      $end_directory = false;
    	$end_directory = $end_directory ? $end_directory : './splittedPDFFiles/';

      if (!is_dir($end_directory))
    	{
    		// Will make directories under end directory that don't exist
    		// Provided that end directory exists and has the right permissions
    		mkdir($end_directory, 0777, true);
        // TODO : Less permissive directory permissions if possible
    	}

      // Split each page into a new PDF
    	for ($i = $firstPage; $i <= $lastPage; $i++) {
    		$pdf = new \FPDI();
    		$pdf->AddPage();
        $pdf->setSourceFile($filePath);
    		$pdf->useTemplate($pdf->importPage($i));
    		 try {
          // Create the split page PDF file
    			$new_filePath = $end_directory.str_replace('.pdf', '', $fileName).'_'.$i.".pdf";
    			$pdf->Output($new_filePath, "F");
    		} catch (Exception $e) {
    			echo 'Caught exception: ',  $e->getMessage(), "\n";
    		}
            $pdf->close();
    	}
    }
}
