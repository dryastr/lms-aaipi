<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\TermsCondition;
// use App\Models\TermsCondition;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactSettings = getContactPageSettings();

        $seoSettings = getSeoMetas('contact');
        $pageTitle = ! empty($seoSettings['title']) ? $seoSettings['title'] : trans('site.contact_page_title');
        $pageDescription = ! empty($seoSettings['description']) ? $seoSettings['description'] : trans('site.contact_page_title');
        $pageRobot = getPageRobot('contact');

        $data = [
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageRobot' => $pageRobot,
            'contactSettings' => $contactSettings,
        ];

        return view('web.default.pages.contact', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
            'termsconditions' => 'required',
        ]);

        $termsconditions = $request->input('termsconditions') ? 1 : 0;

        $data = $request->all();
        unset($data['_token']);
        $data['termsconditions'] = $termsconditions;
        $data['created_at'] = time();

        Contact::create($data);

        $notifyOptions = [
            '[c.u.title]' => $data['subject'],
            '[u.name]' => $data['name'],
            '[time.date]' => dateTimeFormat(time(), 'j M Y H:i'),
            '[c.u.message]' => $data['message'],
        ];

        sendNotification('contact_message_submission_for_admin', $notifyOptions, 1);

        sendNotificationToEmail('contact_message_submission', $notifyOptions, $data['email']);

        // dd(sendNotification('contact_message_submission_for_admin', $notifyOptions, 1));

        return back()->with(['msg' => trans('site.contact_store_success')]);
    }

    public function conditionsContact()
    {
        $contents = TermsCondition::get(); 
        return view('web.default.pages.tems.step_terms-conditions', compact('contents'));
    }
}
