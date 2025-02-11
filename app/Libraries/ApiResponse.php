<?php  
namespace App\Libraries;

class ApiResponse{
	public static function errors($errorsArray){
        
        if ($errorsArray instanceof \Illuminate\Support\MessageBag) {
            $errorsArray = $errorsArray->toArray();
        }
    
        
        if (is_array($errorsArray)) {
            $messages = [];
            foreach ($errorsArray as $error) {
               
                if (is_array($error)) {
                    $messages = array_merge($messages, $error);
                }
            }
    
           
            $messageString = implode("\n", $messages);
    
            return response([
                'status' => false, 
                'message' => $messageString, 
                'errors' => $errorsArray 
            ]);
        } else {
            
            return response([
                'status' => false, 
                'message' => $errorsArray, 
                'errors' => [] 
            ]);
        }
	}

	public static function data($data){
		return response(['status' => true, 'data' => $data]);
	}

	public static function success($message)
    {
        return response(['status' => true, 'message' => $message]);
    }

    

}
