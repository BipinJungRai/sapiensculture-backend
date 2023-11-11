<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulkMail;

class BulkEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function createBulkEmail()
    {
        $activeSubscribers = DB::table('subscribes')->pluck('email')->toArray();
        return view('admin.bulk-email.create', compact('activeSubscribers'));
    }

    public function sendBulkEmail(Request $request)
    {
        $validatedData = $request->validate([
            'recipient-emails' => 'required|string',
            'email-subject' => 'required|string',
            'email-body' => 'required|string'
        ]);

        $recipients = explode(',', $validatedData['recipient-emails']);
        $emailSubject = $validatedData['email-subject'];
        $emailBody = $validatedData['email-body'];

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new BulkMail($emailSubject, $emailBody));
        }
        toastr()->success('Email sent successfully!');
        return back();      
    }
}
