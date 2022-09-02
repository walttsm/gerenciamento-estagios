<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Turma;

class CSVController extends Controller
{
    /**
     * Este método cadastra alunos no sistema usando CSV
     */
    public function cadastrar_alunos(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|mimes:csv,txt'
        ]);
        $file = $request->file('arquivo');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            $this->checkUploadedFileProperties($extension, $fileSize);
            if (!Storage::exists('/app/public/csv_uploads')) {
                Storage::makeDirectory('/public/csv_uploads');
            }
            $location = storage_path('app/public/csv_uploads');
            $file->move($location, $filename);
            $filepath = $location . "/" . $filename;
            $imported_data_arr = $this->readCSV($filepath);

            $turma = Turma::select('id')->where('ano', '=', date('Y'))->get()->first();

            foreach ($imported_data_arr as $data_row) {
                try {
                    Aluno::updateOrCreate(['email' => $data_row[3]], [
                        'nome_aluno' => $data_row[0],
                        'curso' => $data_row[1],
                        'matricula' => $data_row[2],
                        'nome_trabalho' => $data_row[4],
                        'turma_id' => $turma->id,
                        'user_id' => 1,
                    ]);
                } catch (Exception $e) {
                    DB::rollback();
                }
            }
        }

        return redirect(Route('alunos.index'))->with(['message' => 'Alunos inseridos com sucesso!']);
    }

    /**
     * Este método cadastra alunos no sistema usando CSV
     */
    public function cadastrar_orientadores(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|mimes:csv,txt'
        ]);
        $file = $request->file('arquivo');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            $this->checkUploadedFileProperties($extension, $fileSize);
            if (!Storage::exists('/app/public/csv_uploads')) {
                Storage::makeDirectory('/public/csv_uploads');
            }
            $location = storage_path('app/public/csv_uploads');
            $file->move($location, $filename);
            $filepath = $location . "/" . $filename;
            $imported_data_arr = $this->readCSV($filepath);

            foreach ($imported_data_arr as $data_row) {
                try {
                    Orientador::updateOrCreate(
                        [
                            'email' => $data_row[2],
                        ],
                        [
                            'nome' => $data_row[0],
                            'curso' => $data_row[1],
                        ]
                    );
                } catch (Exception $e) {
                    dd($e);
                    DB::rollback();
                }
            }
        }

        return redirect(Route('orientadores.index'))->with(['message' => 'Orientadores inseridos com sucesso!']);
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

    /**
     * Lê um arquivo .csv.
     * @param $filepath Caminho do arquivo com os dados. Deve ser um arquivo .csv.
     * @return Array com os dados de cada linha presente no arquivo.
     */
    public function readCSV($filepath)
    {
        $file = fopen($filepath, "r");
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
        return $imported_data_arr;
    }
}
