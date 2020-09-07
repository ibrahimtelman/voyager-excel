<?php

namespace VoyagerExcelExport\Traits;

/**
 * 
 */
trait ExcelExport
{
    public $exportable;

    public function __construct()
    {
        parent::__construct();

        $exportable = $this->setExportable();

        $table = [];

        $fields = [];

        foreach ($exportable as $key => $res) {
            if (gettype($key) === "string") {
                if (gettype($res) == "string") {
                    $fields[$key] = function ($value) {
                        return $value;
                    };

                    array_push($table, $res);
                } else {
                    $fields[$key] = $res["value"];
                    array_push($table, $res["name"]);
                }
            } else {
                $fields[$res] = function ($value) {
                    return $value;
                };
                array_push($table, $res);
            }
        }

        $exportable["fields"] = $fields;
        $exportable["table"] = $table;

        $this->exportable = $exportable;
    }

    abstract function setExportable();
}
