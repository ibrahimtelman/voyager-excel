<?php

namespace VoyagerExcelExport\Actions;

use TCG\Voyager\Actions\AbstractAction;
use Maatwebsite\Excel\Facades\Excel;
use VoyagerExcelExport\Exports\BaseExport;
use Illuminate\Database\Eloquent\Model;

class Export extends AbstractAction
{
    public function getTitle()
    {
        return __('voyager_excel::excel.export_excel');
    }

    public function getIcon()
    {
        return 'voyager-list';
    }

    public function shouldActionDisplayOnDataType()
    {
        if (empty($this->dataType->model_name)) {
            return false;
        }

        if (!class_exists($this->dataType->model_name)) {
            return false;
        }

        $model = new $this->dataType->model_name;
        if (!($model instanceof  Model)) {
            return false;
        }

        if (!isset($model->exportable)) {
            return false;
        }

        return true;
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return null;
    }

    public function massAction($ids, $comingFrom)
    {

        return Excel::download(
            new BaseExport($this->dataType, $ids),
            $this->getFileName()
        );
    }

    protected function getFileName()
    {
        return sprintf('%s_%s.xls',  $this->dataType->display_name_plural, date('Y-m-d_H_i_s'));
    }
}
