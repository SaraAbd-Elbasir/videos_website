<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Messages\Store;
use App\Mail\ReplayContact;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class Messages extends BackEndController
{

    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
    //store request to validate admin message (replay)
    public function replay($id , Store $request){
    	// to get message which user sent it
        $message = $this->model->findOrFail($id);
        //
        Mail::send(new ReplayContact($message , $request->message));
        return redirect()->route('messages.edit' , ['id' => $message->id]);
    }
}
