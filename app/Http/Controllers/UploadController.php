<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Config;
use App\Errors;


class UploadController extends BaseController
{

    /*
     * @param  Request  $request
     * @return Array with fully qualified upload path and nameg and original name.
     *
     */

    public function upload(Request $request)
    {
        $pdfFile = $request->file('pdf_file');
        // Check for the pdf
        if (is_null($pdfFile)) {
            return response(Errors::UPLOAD_FILE_MISSING_ERROR, '404');
        }

        // Upload problem
        if (!$pdfFile->isValid()) {
            return response(Errors::UPLOAD_FILE_INVALID_ERROR, '406');
        }

        // Move the validated file to the folder
        $pdfFile->move(Config::UPLOAD_PATH,
        $pdfFile->getFilename() . '.pdf');

        // Return the moved file name
        return response()->json(['fileName' => $pdfFile->getFilename(), 'fileOriginalName' => $pdfFile->getClientOriginalName()], '201');
    }

    /*
     * @param  Request  $request
     * @return Array with fully qualified upload path and nameg and original name.
     */

     public function upload_base64(Request $request)
     {
         // Get File Data
        $fileData = $request->fileData;
        $fileName = $request->fileName;
        $fileSize = $request->fileSize;

        $pdf = base64_decode($fileData);

        // $randomId = Math.floor((Math.random() * 1000) + 1);
        
        $file = Config::UPLOAD_PATH . $fileName;
        file_put_contents($file . '.txt', $fileData);
        file_put_contents($file, $pdf);

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . $filesize);
            readfile($file);
        }

        // Return the file info
        return response()->json(['fileName' => $fileName, 'fileSize' => $fileSize]);
     }
}
