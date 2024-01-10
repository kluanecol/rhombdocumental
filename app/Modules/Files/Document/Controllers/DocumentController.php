<?php

namespace App\Modules\Files\Document\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Files\Document\Repository\DocumentInterface;


class DocumentController extends Controller
{
    private $documentRepo;

    function __construct(
            DocumentInterface $documentRepo
        )
        {
            $this->documentRepo = $documentRepo;
        }

    public function index(){
        /*
        $data['projects'] = $this->projectRepo->getByCountry(GeneralVariables::getCurrentCountryId())->pluck('nombre_corto', 'id');
        $data['clients'] = $this->clientRepo->getByCountry(GeneralVariables::getCurrentCountryId())->pluck('nombre_cliente', 'id');
        $data['years'] = GeneralVariables::yearsArray();
        */
        return view('files.index');
    }

    public function create(Request $request){

        return view('files.create');
    }

    public function save(Request $request){

        dd($request->all());
        $result = $this->contractRepo->save($request);

        if (is_string($result)) {
            $messages = [
                'message' => $result,
                'title' => trans('general.errorNoControlado'),
                'type'  => 'warning',
            ];
        }
        else if($result == 200){
            $messages = [
                'title' => trans('general.bienHecho'),
                'message' => trans('general.guardadoConExito'),
                'type'  => 'success',
                'status' => $result
            ];
        }else{
            $messages = [
                'message' => trans('general.algoSalioMal'),
                'title' => trans('general.errorAlGuardar'),
                'type'  => 'warning',
                'status' => $result
            ];
        }
        return response()->json($messages);

    }

}
