<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Mixins\Certificate\MakeCertificate;
use App\Models\Certificate;
use App\Models\CertificateTemplate;
use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarCertificateController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $webinars = Webinar::where('status', 'active')
            ->where('certificate', true)
            ->whereHas('sales', function ($query) use ($user) {
                $query->where('buyer_id', $user->id);
                $query->whereNull('refund_at');
                $query->where('access_to_purchased_item', true);
            })
            ->get();

        $this->calculateCertificates($user, $webinars);

        $query = Certificate::whereNotNull('webinar_id')
            ->where('type', 'course')
            ->where('student_id', $user->id);

        $certificates = $this->handleFilters($query, $request)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => trans('update.course_certificates'),
            'certificates' => $certificates,
            'userWebinars' => $webinars,
        ];

        return view('web.default.panel.certificates.webinar_certificates', $data);
    }

    private function handleFilters($query, $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $webinar_id = $request->get('webinar_id');

        fromAndToDateFilter($from, $to, $query, 'created_at');

        if (! empty($webinar_id)) {
            $query->where('webinar_id', $webinar_id);
        }

        return $query;
    }

    private function calculateCertificates($user, $webinars)
    {
        foreach ($webinars as $webinar) {
            $webinar->makeCourseCertificateForUser($user);
        }
    }

    public function makeCertificate($certificateId)
    {
        $user = auth()->user();

        $certificate = Certificate::where('id', $certificateId)
            ->where('student_id', $user->id)
            ->whereNotNull('webinar_id')
            ->first();

            $template = CertificateTemplate::where('status', 'publish')
            ->where('type', 'course')
            ->first();
            
            $body = $template->body;
            $user = $certificate->student;
            $course = $certificate->webinar;
    
            // dd($course);
    
            $data = [
                'fullname' => $user['full_name'],
                'body' => $body,
                'img' =>      $template->image,
                'name_komite' =>  $template->name_komite,
                'duration' => $course['duration'],
                'certificate_id' => $certificate['id'],
                'nip_komite' =>      $template->nip_komite,
                'tanda_tanggan_komite' =>      $template->tanda_tangan_komite,
                'is_komite' =>      $template->is_komite,
                'course' => $course['title'],
                'instructor' =>  $course->teacher->full_name,
                'instructor_nip' =>  $course->teacher->nip,
            ];
            

        if (! empty($certificate)) {
            $makeCertificate = new MakeCertificate();

            return view('web.default.course.certificate.index', $data);
            // return $makeCertificate->makeCourseCertificate($certificate);
        }

        abort(404);
    }
}
