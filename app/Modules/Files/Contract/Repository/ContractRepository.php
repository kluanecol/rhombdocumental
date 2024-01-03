<?php

namespace App\Modules\Invoicing\Contract\Repository;

use App\Modules\Invoicing\Collective\Configuration\GeneralVariables;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Modules\Invoicing\Contract\models\Contract;

class ContractRepository implements ContractInterface{

    public function dataTableContracts($request){

        $contracts=[];
        $table=[];


        $contracts = $this->getByProjectYearAndClient($request->id_project, $request->year, $request->id_client);



        foreach ($contracts as $contract) {

            $table[] = [
                'id' => $contract->consecutive,
                'project_name' => $contract->project->nombre_corto,
                'client_name' => $contract->client->nombre_cliente,
                'name' => $contract->name != NULL ? $contract->name : "NO",
                'initial_date' => $contract->initial_date,
                'end_date' => $contract->end_date,
                'year' => $contract->year,
                'options' => view('sections.contracts.components.table-options', ['contract' => $contract])->render()
            ];


        }

        return Datatables::of($table)->addIndexColumn()->rawColumns(['options'])->make(true);
    }

    public function getById($id, $relations = []){
        return Contract::with($relations)->find($id);
    }

    public function getByProjectYearAndClient($idProject, $year, $idClient){

        $idCountry= GeneralVariables::getCurrentCountryId();
        return Contract::when($idProject, function ($query, $idProject) {
            return $query->whereIn('fk_id_project', $idProject);
        })
        ->when($year, function ($query, $year) {
            return $query->whereIn('year',$year);
        })
        ->when($idClient, function ($query, $idClient) {
            return $query->whereIn('fk_id_client', $idClient);
        })
        ->where('fk_id_country',$idCountry)->get();

    }

    public function save($request){
        $result = 200;

        try {
            if (isset($request->id)) {
                $contract = Contract::find($request->id);
            }else{
                $contract = new Contract();
            }

           $data = $request->only($contract->getFillable());
           $data['fk_id_user'] = Auth::user()->id;
           $data['fk_id_country'] = GeneralVariables::getCurrentCountryId();
           $data['consecutive'] = $this->generateCountryConsecutive(GeneralVariables::getCurrentCountryId());

           if ($contract->fill($data)->save()) {
                $result = 200;
            }else{
                $result = 400;
           }

           return $result;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($request){
        $result = 200;

        try {

            if (isset($request->id_contract)) {
                $contract = Contract::find($request->id_contract);
            }

           if ($contract->delete()) {
                $result = 200;
            }else{
                $result = 400;
           }

           return $result;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getContractsIdByProject($idProject){
        return Contract::where('fk_id_project', $idProject)->pluck('id');
    }

    private function generateCountryConsecutive($countryId){
        return (Contract::where('fk_id_country', $countryId)->max('consecutive') + 1);
    }


}
