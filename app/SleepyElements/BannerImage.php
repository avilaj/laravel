<?php

namespace App\SleepyElements;

use Illuminate\Database\Eloquent\Model;
use Request;
use SleepingOwl\Admin\Form\Element\Images;
use KodiCMS\Assets\Meta;
class BannerImage extends Images
{
    // use \SleepingOwl\Admin\Traits\Assets;
    public function render()
    {

        $params = $this->toArray();
        dd($params);
        Meta::addJs('custom-image', asset('js/custom-image.js'));
        // $params will contain 'name', 'label', 'value' and 'instance'
        // Add scripts and styles
        // dd($params);
        return view('admin.references-manager', $params)->render();
    }
}
