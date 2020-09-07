<?php

namespace VoyagerExcelExport\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use TCG\Voyager\Facades\Voyager;

class BaseExport implements FromCollection
{
    protected $dataType;
    protected $model;
    protected $ids;
    public function __construct($dataType, $ids)
    {
        $this->dataType = $dataType;
        $this->model = new $dataType->model_name;
        $this->ids = $ids;
    }
    public function collection()
    {
        $exportable = ($this->model->exportable);

        $fields = $exportable["fields"];
        $table = $exportable["table"];

        if (!empty(array_filter($this->ids))) {
            $rs =  $this->model->whereIn($this->model->getKeyName(), $this->ids)->get();
        } else {
            $rs =  $this->model->all();
        }

        $rs = $rs->map(function ($res) use ($fields) {
            $arr = [];
            foreach ($fields as $key => $val) {

                $arr[$key] = $val($res[$key]);
            }
            return $arr;
        });

        $table = collect([$table])->merge($rs);

        return $table;
    }
}
