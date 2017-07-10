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
        // Check for the pdf
        if (!($request->hasFile('pdf_file'))) {
            return response(Errors::UPLOAD_FILE_MISSING_ERROR, '404');
        } else {
          $pdfFile = $request->file('pdf_file');
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
}
