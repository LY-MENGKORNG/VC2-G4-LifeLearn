<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\MailController;
use App\Models\Frontuser;
use Illuminate\Http\Request;

class SendMailController extends MailController
{
    public function inviteTeacher(Request $request) 
    {
        if (!$this->isOnline())
            return response()->json([
                'status' => false,
                'message' => 'Please check your internet connection!'
            ], 200);

        $this->validateMail($request);

        $content = "front.auth.mail-invite-teacher";
        $request["from"] = $request->user()->email;
        $request["recipient"] = $request->email;
        $request["subject"] = $request->subject;
        $request["message"] = $request->message;

        if (!$this->send($request, $content)) 
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong'
        ], 400);

        return response()->json([
            'status' => true,
            'message' => 'Your email has been sent successfully',
        ], 200);
    }
}
