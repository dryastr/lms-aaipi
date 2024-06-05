<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendEmail;
use App\Models\Category;
use App\Models\Role;
use App\Models\Resources;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Exports\WebinarsExport;
use App\Mail\SendNotifications;
use App\Models\CrossCompetency;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ResourceFilterOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin_resources_list');

        $resources = Resources::paginate(10);

        $data = [
            'pageTitle' => trans('admin/main.resources'),
            'resources' => $resources,
        ];

        return view('admin.resources.index', $data);
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize('admin_resources_create');

        removeContentLocale();

        $categories = Category::where('parent_id', null)->get();
        $otherCategories = CrossCompetency::all();
        $types = CrossCompetency::where('types', 'type')->get();
        $crosscomsAndThematics = CrossCompetency::where('types', '!=', 'type')->get();

        $data = [
            'pageTitle' => trans('admin/main.resources_new_page_title'),
            'categories' => $categories,
            'otherCategories' => $otherCategories,
            'types' => $types, // Menambahkan types ke dalam data
            'crosscomsAndThematics' => $crosscomsAndThematics, // Menambahkan crosscomsAndThematics ke dalam data
        ];

        return view('admin.resources.create', $data);
    }

    /**
     * Menyimpan resource baru yang dibuat.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin_resources_create');
        // dd($request->all());
        DB::beginTransaction();
        
        $this->validate($request, [
            'title' => 'required|max:255',
            'seotitle' => 'required|max:255',
            'description' => 'required',
            'cover' => 'required',
            'category_id' => 'required',
            'type_other_category_id' => 'required|exists:other_categories,id',
            'crosscom_tematik_other_category_id' => 'required|exists:other_categories,id',
            'source' => [
                'required',
                'file',
                'mimes:pdf',
            ],
        ]);
        try {

            $resource = new Resources();
            $resource->type_other_category_id = $request->type_other_category_id;
            $resource->crosscom_tematik_other_category_id = $request->crosscom_tematik_other_category_id;

            $userId = Auth::id();

            $data = $request->all();

            $data['seotitle'] = Str::slug($data['seotitle']);
            // dd($data);
            if ($request->hasFile('source')) {
                $file = $request->file('source');

                $path = $file->storeAs('public/files', $file->getClientOriginalName());

                $filename = $file->getClientOriginalName();
                $size = $file->getSize();
                $ext = $file->getClientOriginalExtension();
            } else {
                return redirect()->back()->withErrors(['source' => 'The source file is required.'])->withInput();
            }

            $resource = Resources::create([
                'user_id' => $userId,
                'title' => str_replace('-', ' ', $data['title']),
                'seotitle' => $data['seotitle'],
                'description' => $data['description'],
                'cover' => $data['cover'],
                'category_id' => $data['category_id'],
                'type_other_category_id' => $data['type_other_category_id'],
                'crosscom_tematik_other_category_id' => $data['crosscom_tematik_other_category_id'],
                'source' => $path,
                'filename' => $filename,
                'size' => $size,
                'ext' => $ext,
                'status' => (! empty($data['draft']) && $data['draft'] == 1) ? Resources::$isDraft : Resources::$pending,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $filters = $request->get('filters', null);
            // dd($filters);
            if (! empty($filters) and is_array($filters)) {
                ResourceFilterOption::where('resource_id', $resource->id)->delete();
                foreach ($filters as $filter) {
                    ResourceFilterOption::create([
                        'resource_id' => $resource->id,
                        'filter_option_id' => $filter,
                    ]);
                }
            }

            // dd($request->all());
            DB::commit();

            return redirect(getAdminPanelUrl().'/resources/'.$resource->id.'/edit')
                ->with('success', 'Resource has been created successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            // dd($request->all());
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $this->authorize('admin_resources_edit');

        $resource = Resources::findOrFail($id);
        $categories = Category::where('parent_id', null)->get();
        $otherCategories = CrossCompetency::all();
        $types = CrossCompetency::where('types', 'type')->get();
        $crosscomsAndThematics = CrossCompetency::where('types', '!=', 'type')->get();

        // Mengambil filter yang terkait dengan kategori sumber daya
        $ResourceCategoryFilters = ! empty($resource->category) ? $resource->category->filters : null;

        // Mengambil opsi filter yang dipilih untuk sumber daya
        $ResourceFilterOptions = $resource->filterOptions->pluck('filter_option_id')->toArray();

        $data = [
            'pageTitle' => trans('admin/main.resources_edit_page_title'),
            'resource' => $resource,
            'categories' => $categories,
            'otherCategories' => $otherCategories,
            'types' => $types,
            'crosscomsAndThematics' => $crosscomsAndThematics,
            'ResourceCategoryFilters' => $ResourceCategoryFilters,
            'ResourceFilterOptions' => $ResourceFilterOptions,
        ];

        return view('admin.resources.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_resources_edit');
        DB::beginTransaction();

        try {
            $this->validate($request, [
                'title' => 'required|max:255',
                'seotitle' => 'required',
                'description' => 'required',
                'cover' => 'required',
                'category_id' => 'required',
                'type_other_category_id' => 'required|exists:other_categories,id',
                'crosscom_tematik_other_category_id' => 'required|exists:other_categories,id',
                'source' => [
                    'file',
                    'mimes:pdf',
                ],
            ]);

            $resource = Resources::findOrFail($id);
            $data = $request->except('source');

            if ($request->hasFile('source')) {
                $file = $request->file('source');
                $path = $file->storeAs('public/files', $file->getClientOriginalName());

                $filename = $file->getClientOriginalName();
                $size = $file->getSize();
                $ext = $file->getClientOriginalExtension();

                $data['source'] = $path;
                $data['filename'] = $filename;
                $data['size'] = $size;
                $data['ext'] = $ext;

                if ($resource->source) {
                    Storage::delete($resource->source);
                }
            }

            if ($request->input('forDraft') === 'publish') {
                $data['status'] = Resources::$active;
            } elseif ($request->input('forDraft') === 'reject') {
                $data['status'] = Resources::$pending;
            }

            $resource->update($data);

            $filters = $request->get('filters', null);
            if (! empty($filters) && is_array($filters)) {
                ResourceFilterOption::where('resource_id', $resource->id)->delete();
                foreach ($filters as $filter) {
                    ResourceFilterOption::create([
                        'resource_id' => $resource->id,
                        'filter_option_id' => $filter,
                    ]);
                }
            }

            DB::commit();

            return redirect(getAdminPanelUrl().'/resources/'.$resource->id.'/edit')
                ->with('success', 'Resource has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $resource = Resources::findOrFail($id);
            $resource->delete();

            return redirect(getAdminPanelUrl().'/resources')->with('success', 'Resource has been deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function approve(Request $request, $id)
    {
        $this->authorize('admin_resources_edit');

        $webinar = Resources::findOrFail($id);

        // Periksa apakah status aktualnya adalah 'pending' sebelum diupdate
        if ($webinar->status == 'pending') {
            // Update status menjadi 'active'
            $webinar->update([
                'status' => 'active',
            ]);

            // Buat pesan toast untuk memberitahu bahwa status telah berubah
            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => trans('update.course_status_changes_to_approved'),
                'status' => 'success',
            ];
        } else {
            // Jika status bukan 'pending', mungkin Anda ingin menangani kasus ini secara berbeda
            // Misalnya, tampilkan pesan kesalahan
            $toastData = [
                'title' => trans('public.error'),
                'msg' => trans('public.invalid_status_transition'),
                'status' => 'error',
            ];
        }

        // Redirect kembali dengan pesan toast
        return redirect(getAdminPanelUrl().'/resources')->with(['toast' => $toastData]);
    }

    public function reject(Request $request, $id)
    {
        $this->authorize('admin_resources_edit');

        $webinar = Resources::query()->findOrFail($id);

        $webinar->update([
            'status' => Resources::$inactive,
        ]);

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('update.course_status_changes_to_rejected'),
            'status' => 'success',
        ];

        return redirect(getAdminPanelUrl().'/resources')->with(['toast' => $toastData]);
    }

    public function unpublish(Request $request, $id)
    {
        $this->authorize('admin_resources_edit');

        $webinar = Resources::query()->findOrFail($id);

        $webinar->update([
            'status' => Resources::$pending,
        ]);

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('update.course_status_changes_to_unpublished'),
            'status' => 'success',
        ];

        return redirect(getAdminPanelUrl().'/resources')->with(['toast' => $toastData]);
    }

    public function notificationToStudents($id)
    {
        // $this->authorize('admin_webinar_notification_to_students');

        $resource = Resources::findOrFail($id);

        $data = [
            'pageTitle' => trans('notification.send_notification'),
            'resource' => $resource,
        ];

        return view('admin.resources.send-notification-to-course-students', $data);
    }

    public function sendNotificationToStudents(Request $request, $id)
    {
        // $this->authorize('admin_resource_notification_to_students');

        $this->validate($request, [
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        $data = $request->all();

        $resource = Resources::where('id', $id)
            ->with([
                'sales' => function ($query) {
                    $query->whereNull('refund_at');
                    $query->with([
                        'buyer',
                    ]);
                },
            ])
            ->first();

        if (! empty($resource)) {
            foreach ($resource->sales as $sale) {
                if (! empty($sale->buyer)) {
                    $user = $sale->buyer;

                    Notification::create([
                        'user_id' => $user->id,
                        'group_id' => null,
                        'sender_id' => auth()->id(),
                        'title' => $data['title'],
                        'message' => $data['message'],
                        'sender' => Notification::$AdminSender,
                        'type' => 'single',
                        'created_at' => time(),
                    ]);

                    if (! empty($user->email) and env('APP_ENV') == 'production') {
                        \App\Jobs\SendEmail::dispatch($user->email, ['title' => $data['title'], 'message' => $data['message']]);
                        // \Mail::to($user->email)->send(new SendNotifications(['title' => $data['title'], 'message' => $data['message']]));
                    }
                }
            }

            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => trans('update.the_notification_was_successfully_sent_to_n_students', ['count' => count($resource->sales)]),
                'status' => 'success',
            ];

            return redirect(getAdminPanelUrl("/resources/{$resource->id}/students"))->with(['toast' => $toastData]);
        }

        abort(404);
    }

    public function search(Request $request)
    {
        $term = $request->get('term');

        $option = $request->get('option', null);

        $query = Resources::select('id')
            ->whereTranslationLike('title', "%$term%");

        if (! empty($option) and $option == 'just_webinar') {
            // $query->where('type', Resources::$webinar);
            $query->where('status', Resources::$active);
        }

        $webinar = $query->get();

        return response()->json($webinar, 200);
    }

    // public function exportExcel(Request $request)
    // {
    //     $this->authorize('admin_webinars_export_excel');

    //     $query = Resources::query();

    //     $query = $this->filterWebinar($query, $request)
    //         ->with(['teacher' => function ($qu) {
    //             $qu->select('id', 'full_name');
    //         }, 'sales']);

    //     $webinars = $query->get();

    //     $webinarExport = new WebinarsExport($webinars);

    //     return Excel::download($webinarExport, 'webinars.xlsx');
    // }

    // public function studentsLists(Request $request, $id)
    // {
    //     $this->authorize('admin_webinar_students_lists');

    //     $webinar = Resources::where('id', $id)
    //         ->with([
    //             'teacher' => function ($qu) {
    //                 $qu->select('id', 'full_name');
    //             },
    //             'chapters' => function ($query) {
    //                 $query->where('status', 'active');
    //             },
    //             'sessions' => function ($query) {
    //                 $query->where('status', 'active');
    //             },
    //             'assignments' => function ($query) {
    //                 $query->where('status', 'active');
    //             },
    //             'quizzes' => function ($query) {
    //                 $query->where('status', 'active');
    //             },
    //             'files' => function ($query) {
    //                 $query->where('status', 'active');
    //             },
    //         ])
    //         ->first();

    //     if (! empty($webinar)) {
    //         $giftsIds = Gift::query()->where('webinar_id', $webinar->id)
    //             ->where('status', 'active')
    //             ->where(function ($query) {
    //                 $query->whereNull('date');
    //                 $query->orWhere('date', '<', time());
    //             })
    //             ->whereHas('sale')
    //             ->pluck('id')
    //             ->toArray();

    //         $query = User::join('sales', 'sales.buyer_id', 'users.id')
    //             ->leftJoin('webinar_reviews', function ($query) use ($webinar) {
    //                 $query->on('webinar_reviews.creator_id', 'users.id')
    //                     ->where('webinar_reviews.webinar_id', $webinar->id);
    //             })
    //             ->select('users.*', 'webinar_reviews.rates', 'sales.access_to_purchased_item', 'sales.id as sale_id', 'sales.gift_id', DB::raw('sales.created_at as purchase_date'))
    //             ->where(function ($query) use ($webinar, $giftsIds) {
    //                 $query->where('sales.webinar_id', $webinar->id);
    //                 $query->orWhereIn('sales.gift_id', $giftsIds);
    //             })
    //             ->whereNull('sales.refund_at');

    //         $students = $this->studentsListsFilters($webinar, $query, $request)
    //             ->orderBy('sales.created_at', 'desc')
    //             ->paginate(10);

    //         $userGroups = Group::where('status', 'active')
    //             ->orderBy('created_at', 'desc')
    //             ->get();

    //         $totalExpireStudents = 0;
    //         if (! empty($webinar->access_days)) {
    //             $accessTimestamp = $webinar->access_days * 24 * 60 * 60;

    //             $totalExpireStudents = User::join('sales', 'sales.buyer_id', 'users.id')
    //                 ->select('users.*', DB::raw('sales.created_at as purchase_date'))
    //                 ->where(function ($query) use ($webinar, $giftsIds) {
    //                     $query->where('sales.webinar_id', $webinar->id);
    //                     $query->orWhereIn('sales.gift_id', $giftsIds);
    //                 })
    //                 ->whereRaw('sales.created_at + ? < ?', [$accessTimestamp, time()])
    //                 ->whereNull('sales.refund_at')
    //                 ->count();
    //         }

    //         $webinarStatisticController = new WebinarStatisticController();

    //         $allStudentsIds = User::join('sales', 'sales.buyer_id', 'users.id')
    //             ->select('users.*', DB::raw('sales.created_at as purchase_date'))
    //             ->where(function ($query) use ($webinar, $giftsIds) {
    //                 $query->where('sales.webinar_id', $webinar->id);
    //                 $query->orWhereIn('sales.gift_id', $giftsIds);
    //             })
    //             ->whereNull('sales.refund_at')
    //             ->pluck('id')
    //             ->toArray();

    //         $learningPercents = [];
    //         foreach ($allStudentsIds as $studentsId) {
    //             $learningPercents[$studentsId] = $webinarStatisticController->getCourseProgressForStudent($webinar, $studentsId);
    //         }

    //         foreach ($students as $key => $student) {
    //             if (! empty($student->gift_id)) {
    //                 $gift = Gift::query()->where('id', $student->gift_id)->first();

    //                 if (! empty($gift)) {
    //                     $receipt = $gift->receipt;

    //                     if (! empty($receipt)) {
    //                         $receipt->rates = $student->rates;
    //                         $receipt->access_to_purchased_item = $student->access_to_purchased_item;
    //                         $receipt->sale_id = $student->sale_id;
    //                         $receipt->purchase_date = $student->purchase_date;
    //                         $receipt->learning = $webinarStatisticController->getCourseProgressForStudent($webinar, $receipt->id);

    //                         $learningPercents[$student->id] = $receipt->learning;

    //                         $students[$key] = $receipt;
    //                     } else { /* Gift recipient who has not registered yet */
    //                         $newUser = new User();
    //                         $newUser->full_name = $gift->name;
    //                         $newUser->email = $gift->email;
    //                         $newUser->rates = 0;
    //                         $newUser->access_to_purchased_item = $student->access_to_purchased_item;
    //                         $newUser->sale_id = $student->sale_id;
    //                         $newUser->purchase_date = $student->purchase_date;
    //                         $newUser->learning = 0;

    //                         $students[$key] = $newUser;
    //                     }
    //                 }
    //             } else {
    //                 $student->learning = ! empty($learningPercents[$student->id]) ? $learningPercents[$student->id] : 0;
    //             }
    //         }

    //         $roles = Role::all();

    //         $data = [
    //             'pageTitle' => trans('admin/main.students'),
    //             'webinar' => $webinar,
    //             'students' => $students,
    //             'userGroups' => $userGroups,
    //             'roles' => $roles,
    //             'totalStudents' => $students->total(),
    //             'totalActiveStudents' => $students->total() - $totalExpireStudents,
    //             'totalExpireStudents' => $totalExpireStudents,
    //             'averageLearning' => count($learningPercents) ? round(array_sum($learningPercents) / count($learningPercents), 2) : 0,
    //         ];

    //         return view('admin.webinars.students', $data);
    //     }

    //     abort(404);
    // }

    // private function studentsListsFilters($webinar, $query, $request)
    // {
    //     $from = $request->input('from');
    //     $to = $request->input('to');
    //     $full_name = $request->get('full_name');
    //     $sort = $request->get('sort');
    //     $group_id = $request->get('group_id');
    //     $role_id = $request->get('role_id');
    //     $status = $request->get('status');

    //     $query = fromAndToDateFilter($from, $to, $query, 'sales.created_at');

    //     if (! empty($full_name)) {
    //         $query->where('users.full_name', 'like', "%$full_name%");
    //     }

    //     if (! empty($sort)) {
    //         if ($sort == 'rate_asc') {
    //             $query->orderBy('webinar_reviews.rates', 'asc');
    //         }

    //         if ($sort == 'rate_desc') {
    //             $query->orderBy('webinar_reviews.rates', 'desc');
    //         }
    //     }

    //     if (! empty($group_id)) {
    //         $userIds = GroupUser::where('group_id', $group_id)->pluck('user_id')->toArray();

    //         $query->whereIn('users.id', $userIds);
    //     }

    //     if (! empty($role_id)) {
    //         $query->where('users.role_id', $role_id);
    //     }

    //     if (! empty($status)) {
    //         if ($status == 'expire' and ! empty($webinar->access_days)) {
    //             $accessTimestamp = $webinar->access_days * 24 * 60 * 60;

    //             $query->whereRaw('sales.created_at + ? < ?', [$accessTimestamp, time()]);
    //         }
    //     }

    //     return $query;
    // }

    // public function notificationToStudents($id)
    // {
    //     $this->authorize('admin_webinar_notification_to_students');

    //     $webinar = Resources::findOrFail($id);

    //     $data = [
    //         'pageTitle' => trans('notification.send_notification'),
    //         'webinar' => $webinar,
    //     ];

    //     return view('admin.webinars.send-notification-to-course-students', $data);
    // }
}
