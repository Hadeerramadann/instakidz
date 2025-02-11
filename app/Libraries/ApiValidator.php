<?php  

namespace App\Libraries;

use Illuminate\Support\Facades\Validator;

class ApiValidator
{
    public static function validate($rules, $messages = null)
    {
        if ($messages)
            $validate = Validator::make(request()->all(), $rules, $messages);
        else
            $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {
            return $validate->messages();
        }
    }

    public  static function ConvertArrayImageToString($ImagesString){
        $ImageArray=implode(',',$ImagesString);
        return $ImageArray;
    }

    public  static function ConvertStringImageToArray($ImagesString){
        $ImageArray=explode(',',$ImagesString);
        return $ImageArray;
    }

}
