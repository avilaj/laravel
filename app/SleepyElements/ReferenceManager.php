<?php

namespace App\SleepyElements;

use Illuminate\Database\Eloquent\Model;
use Request;
use SleepingOwl\Admin\Form\Element\MultiSelect;

class ReferenceManager extends MultiSelect
{
    public function render()
    {

        $params = $this->toArray();
        // dd($params);

        // $params will contain 'name', 'label', 'value' and 'instance'

        // dd($params);
        return view('admin.references-manager', $params)->render();
    }
}
