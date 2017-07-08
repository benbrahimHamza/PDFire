<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Config;


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
            return "PDF file must be supplied.";
        } // Upload problem
        else if (!$request->file('pdf_file')->isValid()) {
            return "There was a problem during the upload of the file.";
        }

        // Move the validated file to the folder
        $request->file('pdf_file')->move(Config::UPLAOD_PATH,
            $request->file('pdf_file')->getFilename());

        // Return the moved file name
        return [Config::UPLAOD_PATH. $request->file('pdf_file')->getFilename(),
            $request->file('pdf_file')->getClientOriginalName()];
    }
}
