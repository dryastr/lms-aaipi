<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Models\Resources;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TrendCategory;
use App\Models\CrossCompetency;
use App\Http\Controllers\Controller;
use App\Models\ResourceFilterOption;

class ResourscesController extends Controller
{
    public $tableName = 'resources';

    public $columnId = 'webinar_id';

    public function index(Request $request)
    {
        $resourcesQuery = Resources::query();

        $resourcesQuery = $this->handleFilters($request, $resourcesQuery);
        $search = $request->input('search');
        
        if (!empty($search)) {
            $searchSlug = Str::slug($search);
            $resourcesQuery->where(function ($query) use ($search, $searchSlug) {
                $query->where('title', 'like', "%$search%")
                      ->orWhere('seotitle', 'like', "%$search%")
                      ->orWhere('title', 'like', "%$searchSlug%")
                      ->orWhere('seotitle', 'like', "%$searchSlug%");
            });
        }

        $category_slug = $request->get('category_slug');
        if (! empty($category_slug)) {
            $category = Category::where('slug', $category_slug)->first();
            if ($category) {
                $resourcesQuery->where('category_id', $category->id);
            }
        }

        $sort = $request->input('sort');
        if (empty($sort) || $sort == 'newest') {
            $resourcesQuery->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $resourcesQuery->orderBy('created_at', 'asc');
        }

        $resourcesQuery->where('status', 'active');
        $resources = $resourcesQuery->paginate(6);

        $noResults = $resources->isEmpty();
        $seoSettings = getSeoMetas('classes');
        $pageTitle = $seoSettings['title'] ?? '';
        $pageDescription = $seoSettings['description'] ?? '';
        $pageRobot = getPageRobot('classes');
        $crossCompetencies = CrossCompetency::all();
        $category = TrendCategory::all();

        $data = [
            'pageTitle' => $pageTitle,
            'noResults' => $noResults,
            'crossCompetencies' => $crossCompetencies,
            'category' => $category,
            'pageDescription' => $pageDescription,
            'pageRobot' => $pageRobot,
            'resources' => $resources,
            'coursesCount' => $resources->total(),
        ];

        return view(getTemplate().'.pages.resources', $data);
    }

    public function handleFilters($request, $query)
    {
        $filterOptions = $request->get('filter_option', []);
        $typeThematic = $request->get('thematic', []);
        $typeCrosscom = $request->get('crosscom', []);
        $coreKompetensi = $request->get('corekompetensi', []);

        if ($this->tableName == 'resources') {

            if (! empty($typeThematic) and is_array($typeThematic)) {
                $types = CrossCompetency::where('types', $typeThematic)->pluck('id')->toArray();
                $query->whereIn("{$this->tableName}.crosscom_tematik_other_category_id", $types);
            }
            // if (! empty($typeThematic) and is_array($typeThematic)) {
            //     $query->whereIn("{$this->tableName}.other_category_type", $typeThematic);
            // }

            if (! empty($typeCrosscom) and is_array($typeCrosscom)) {
                $types = CrossCompetency::whereIn('types', $typeCrosscom)->pluck('id')->toArray();
                // dd($types);
                $query->whereIn("{$this->tableName}.crosscom_tematik_other_category_id", $types);
            }

            if (! empty($coreKompetensi) and is_array($coreKompetensi)) {
                $query->whereIn("{$this->tableName}.category_id", $coreKompetensi);
            }

        }

        if (! empty($filterOptions) and is_array($filterOptions)) {
            $resourceIdsFilterOptions = ResourceFilterOption::whereIn('filter_option_id', $filterOptions)
                ->pluck($this->columnId)
                ->toArray();

            $query->whereIn("{$this->tableName}.id", $resourceIdsFilterOptions);
        }

        return $query;
    }
}
