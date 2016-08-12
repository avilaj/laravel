<?php
namespace App\Http\Controllers;

use Validator;
use App\Model\Notification;
use App\Http\Controllers\Controller;
// use App\Http\Requests;
use Illuminate\Http\Request;

class Gateway extends Controller
{
    /**
     * Receives id and topic for storage.
     *
     * @param  int  $id
     * @param  string  $topic
     * @return Response
     */
    public function ipn (Request $request)
    {
      // $rules = ['topic' => 'required', 'id' => 'required'];
      // $validator = Validator::make($request, $rules);
      // if ($validator->fails())

      $data = $request->all();
      $data = [
        'topic' => @$data['topic']?: 'none',
        'identificator' => json_encode(@$data ?: 'none')
      ];

      Notification::create($data);

      return 'ok';
    }


}
