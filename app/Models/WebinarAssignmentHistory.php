<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinarAssignmentHistory extends Model
{
    protected $table = 'webinar_assignment_history';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    public static $assignmentHistoryStatus = ['pending', 'passed', 'not_passed', 'not_submitted'];

    public static $pending = 'pending';

    public static $passed = 'passed';

    public static $notPassed = 'not_passed';

    public static $notSubmitted = 'not_submitted';

    public function instructor()
    {
        return $this->belongsTo('App\User', 'instructor_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\WebinarAssignment', 'assignment_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\WebinarAssignmentHistoryMessage', 'assignment_history_id', 'id');
    }
}
