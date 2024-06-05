<?php

namespace App\Http\Controllers\Panel;

use App\Exports\ResourcesStudents;
use App\Models\ResourcesDownload;
use App\User;
use App\Models\Category;
use App\Models\CrossCompetency;
use App\Models\ResourceFilterOption;
use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use MacsiDigital\API\Support\Resource;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
    
        if (! $user->isTeacher() && ! $user->isOrganization()) {
            abort(404);
        }
    
        $resources = Resources::where('user_id', $user->id)->paginate(10);
    
        $data = [
            'pageTitle' => trans('admin/main.resources'),
            'resources' => $resources,
        ];
    
        // return view('admin.resources.index', $data);
        return view(getTemplate().'.panel.resources.index', $data);
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $user = auth()->user();

        if (! $user->isTeacher() and ! $user->isOrganization()) {
            abort(404);
        }

        removeContentLocale();

        $categories = Category::where('parent_id', null)->get();
        $otherCategories = CrossCompetency::all();
        $types = CrossCompetency::where('types', 'type')->get();
        $crosscomsAndThematics = CrossCompetency::where('types', '!=', 'type')->get();

        $isOrganization = $user->isOrganization();

        $data = [
            'pageTitle' => trans('admin/main.resources_new_page_title'),
            'categories' => $categories,
            'otherCategories' => $otherCategories,
            'isOrganization' => $isOrganization,
            'types' => $types,
            'crosscomsAndThematics' => $crosscomsAndThematics,
        ];

        // return view('admin.resources.create', $data);
        return view(getTemplate().'.panel.resources.create', $data);
    }

    /**
     * Menyimpan resource baru yang dibuat.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (! $user->isTeacher() and ! $user->isOrganization()) {
            abort(404);
        }

        // dd($request->all());
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
                    'required',
                    'file',
                    'mimes:pdf',
                ],
            ]);

            $resource = new Resources();
            $resource->type_other_category_id = $request->type_other_category_id;
            $resource->crosscom_tematik_other_category_id = $request->crosscom_tematik_other_category_id;

            $userId = Auth::id();

            $data = $request->all();

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

            // Membuat sumber daya baru
            $resource = Resources::create([
                'user_id' => $userId,
                'teacher_id' => $user->isTeacher() ? $user->id : (! empty($data['teacher_id']) ? $data['teacher_id'] : $user->id),
                'creator_id' => $user->id,
                'title' => $data['title'],
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
                // 'status' => (isset($data['draft']) && $data['draft'] == 1) ? 'is_draft' : 'pending',
                // 'status' => ($request->has('draft') && $request->input('draft') == 1) ? 'is_draft' : 'pending',
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
            $url = '/panel/resources';

            return redirect($url);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat memproses: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $resource = Resources::findOrFail($id);
        $categories = Category::where('parent_id', null)->get();
        $otherCategories = CrossCompetency::all();
        $types = CrossCompetency::where('types', 'type')->get();
        $crosscomsAndThematics = CrossCompetency::where('types', '!=', 'type')->get();

        $ResourceCategoryFilters = ! empty($resource->category) ? $resource->category->filters : null;

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

        // return view('panel.resources.create', $data);
        return view(getTemplate().'.panel.resources.create', $data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        // dd($request->all());
    
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
    
            if ($request->input('forDraft') == 1) {
                $data['status'] = 'is_draft';
            } else {
                $data['status'] = 'pending';
            }
    
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
    
            unset($data['draft']);

            $data['category_id'] = $request->input('category_id');
            $data['type_other_category_id'] = $request->input('type_other_category_id');
            $data['crosscom_tematik_other_category_id'] = $request->input('crosscom_tematik_other_category_id');
    
            $resource->update($data);
    
            $filters = $request->get('filters', null);
            if (!empty($filters) && is_array($filters)) {
                ResourceFilterOption::where('resource_id', $resource->id)->delete();
                foreach ($filters as $filter) {
                    ResourceFilterOption::create([
                        'resource_id' => $resource->id,
                        'filter_option_id' => $filter,
                    ]);
                }
            }
    
            DB::commit();
    
            return redirect('/panel/resources/' . $resource->id . '/edit')
                ->with('success', 'Resource has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
    
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    } 

    public function destroy(Request $request, $id)
    {
        $user = auth()->user();

        if (! $user->isTeacher() and ! $user->isOrganization()) {
            abort(404);
        }

        $resource = Resources::where('id', $id)
            ->where('creator_id', $user->id)
            ->first();

        if (! $resource) {
            abort(404);
        }

        $resource->delete();

        return response()->json([
            'code' => 200,
            'redirect_to' => $request->get('redirect_to'),
        ], 200);
    }


    public function daftar()
    {
        $userId = auth()->id();
        $userDownloads = ResourcesDownload::where('user_id', $userId)->get();
    
        $userDownloads->transform(function ($download) {
            $download->date = Carbon::parse($download->date);
            return $download;
        });
    
        $data = [
            'userDownloads' => $userDownloads,
        ];
    
        return view(getTemplate().'.panel.resources.daftar', $data);
    }

    public function exportStudentsList($id): BinaryFileResponse
    {
        $user = auth()->user();

        if (!$user->isTeacher() && !$user->isOrganization()) {
            abort(404);
        }

        $resource = Resources::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('creator_id', $user->id)
                    ->orWhere('teacher_id', $user->id);
            })
            ->first();

        if (empty($resource)) {
            abort(404);
        }

        $export = new ResourcesStudents($resource);

        return Excel::download($export, 'resource_students.xlsx');
    }

    public function duplicate($id)
    {
        $user = auth()->user();
    
        if (!$user->isTeacher() && !$user->isOrganization()) {
            abort(404);
        }
    
        $resource = Resources::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('creator_id', $user->id)
                    ->orWhere('teacher_id', $user->id);
            })
            ->first();

        $userId = Auth::id();
    
        if (!empty($resource)) {
            // Duplicate resource data
            $newResourceData = [
                'user_id' => $userId,
                'title' => $resource->title . ' ' . trans('public.copy'),
                'seotitle' => $resource->seotitle,
                'description' => $resource->description,
                'cover' => $resource->cover,
                'category_id' => $resource->category_id,
                'type_other_category_id' => $resource->type_other_category_id,
                'crosscom_tematik_other_category_id' => $resource->crosscom_tematik_other_category_id,
                // Copy other fields as needed
                'creator_id' => $user->id, // Set creator_id for the new resource
                'teacher_id' => $user->id, // Set teacher_id for the new resource
                'status' => Resources::$pending,
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            // Create new resource
            $newResource = Resources::create($newResourceData);
    
            // Redirect to edit page of the new resource
            return redirect('/panel/resources/' . $newResource->id . '/edit');
        }
    
        abort(404);
    }
    
}
