<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebinarAssignmentResource;
use App\Models\Api\WebinarAssignment;
use App\Models\WebinarChapter;

class WebinarAssignmentController extends Controller
{
    public function show($id)
    {
        $assignmnet = WebinarAssignment::where('id', $id)
            ->where('status', WebinarChapter::$chapterActive)->first();
        abort_unless($assignmnet, 404);
        if ($error = $assignmnet->canViewError()) {
            //       return $this->failure($error, 403, 403);
        }
        $resource = new WebinarAssignmentResource($assignmnet);

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), $resource);
    }
}
