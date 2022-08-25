<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CSVController extends Controller
{
    /**
     * Este método cadastra alunos no sistema usando CSV
     */

    public function cadastrar_alunos(Request $request)
    {
        dd($request->file('uploaded_file')->getMimeType());
        $request->validate([
            'uploaded_file' => 'required|mimes:csv,txt'
        ]);
        $file = $request->file;
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            $this->checkUploadedFileProperties($extension, $fileSize);
            if (!Storage::exists('csv_uploads')) {
                Storage::makeDirectory('/public/csv_uploads');
            }
            $location = storage_path('/public/csv_uploads');
            $file->move($location, $filename);

            $file->fopen($file, "r");
            $imported_data_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 1000, ',')) != false) {
                $num = count($filedata);
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $imported_data_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file);
        }
        dd($imported_data_arr);
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }
}
