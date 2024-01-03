<?php

namespace App\Modules\Files\Document\Repository;

use App\Modules\Invoicing\Collective\Configuration\GeneralVariables;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Modules\Files\Document\models\Document;

class DocumentRepository implements DocumentInterface{

    public function dataTableDocuments($request){

        $documents=[];
        $table=[];


        $documents = $this->getByProjectYearAndClient($request->id_project, $request->year, $request->id_client);



        foreach ($documents as $Document) {

            $table[] = [
                'id' => $Document->consecutive,
                'project_name' => $Document->project->nombre_corto,
                'client_name' => $Document->client->nombre_cliente,
                'name' => $Document->name != NULL ? $Document->name : "NO",
                'initial_date' => $Document->initial_date,
                'end_date' => $Document->end_date,
                'year' => $Document->year,
                'options' => view('sections.Documents.components.table-options', ['Document' => $Document])->render()
            ];


        }

        return Datatables::of($table)->addIndexColumn()->rawColumns(['options'])->make(true);
    }

    public function getById($id, $relations = []){
        return Document::with($relations)->find($id);
    }

    public function getByProjectYearAndClient($idProject, $year, $idClient){

        $idCountry= GeneralVariables::getCurrentCountryId();
        return Document::when($idProject, function ($query, $idProject) {
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
                $Document = Document::find($request->id);
            }else{
                $Document = new Document();
            }

           $data = $request->only($Document->getFillable());
           $data['fk_id_user'] = Auth::user()->id;
           $data['fk_id_country'] = GeneralVariables::getCurrentCountryId();
           $data['consecutive'] = $this->generateCountryConsecutive(GeneralVariables::getCurrentCountryId());

           if ($Document->fill($data)->save()) {
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

            if (isset($request->id_Document)) {
                $Document = Document::find($request->id_Document);
            }

           if ($Document->delete()) {
                $result = 200;
            }else{
                $result = 400;
           }

           return $result;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDocumentsIdByProject($idProject){
        return Document::where('fk_id_project', $idProject)->pluck('id');
    }

    private function generateCountryConsecutive($countryId){
        return (Document::where('fk_id_country', $countryId)->max('consecutive') + 1);
    }


}
