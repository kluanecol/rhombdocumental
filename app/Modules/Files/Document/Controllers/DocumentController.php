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

    public function getContractForm(Request $request){
        if (isset($request->id_contract)) {
            $data['contract'] = $this->contractRepo->getById($request->id_contract);
        }

        $data['projects'] = $this->projectRepo->getByCountry(GeneralVariables::getCurrentCountryId())->pluck('nombre_corto', 'id');
        $data['clients'] = $this->clientRepo->getByCountry(GeneralVariables::getCurrentCountryId())->pluck('nombre_cliente', 'id');
        $data['years'] = GeneralVariables::yearsArray();

        $returnHTML = view('sections.contracts.form.form', $data)->render();
        return response()->json(['success' => true, 'html'=>$returnHTML]);

    }

    public function save(Request $request){
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

    public function delete(Request $request){

        $contract = $this->contractRepo->getById($request->id_contract, ['invoices']);

        if ($contract->invoices->count() > 0) {

            $messages = [
                'title' => trans('contracts.elContractoTieneFacturasAsociadas'),
                'message' => trans('general.errorAlEliminar'),
                'type'  => 'warning',
                'status' => 500
            ];

            return response()->json($messages);
        }


        $result = $this->contractRepo->delete($request);

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
                'message' => trans('general.borradoConExito'),
                'type'  => 'success',
                'status' => $result
            ];
        }else{
            $messages = [
                'message' => trans('general.algoSalioMal'),
                'title' => trans('general.errorAlEliminar'),
                'type'  => 'warning',
                'status' => $result
            ];
        }
        return response()->json($messages);

    }

    public function configuration($idContract){
        $data=[];
        $percentage = 0;

        $contractConfigurations = $this->contractConfigurationRepo->getContractConfigurationsByIdContract($idContract)->groupBy('fk_id_configuration_subtype');
        $globalCurrentSettings =  $this->configurationSubtypeRepo->getActive();

        if ($globalCurrentSettings->count() > 0) {
            $percentage = ($contractConfigurations->count()*100)/$globalCurrentSettings->count();
        }

        $data['contract'] = $this->contractRepo->getById($idContract);
        $data['configurationSubtypes'] = $this->configurationSubtypeRepo->getActive();
        $data['percentage'] = round($percentage, 1);

        return view('sections.contracts.configurations.index', $data);
    }

}
