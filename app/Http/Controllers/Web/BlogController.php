<?php

namespace App\Http\Controllers\Web;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    private $indexData;
    public $tableName = 'blog';

    public function index(Request $request, $category = null)
    {
        
        $searchsa = $request->get('search', null);
        $search = $request->get('searchkategori', null);
        $category = $request->get('categories', []);
    
        $query = Blog::where('status', 'publish')
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc');
    
        if (!empty($category)) {
            // dd($category);
            // $blogCategory = Blog::where('slug', $category)->first();
            $query->where('slug', $category);
            // dd($blogCategory);
            if (!empty($blogCategory)) {
                $query->where('category_id', $blogCategory->id);
            }
        }
    
        if (!empty($search)) {
            $query->where('category_id', $search);
        }

        $previousUrl = Session::get('previous_url');
    
        if (!empty($searchsa)) {
            $query->whereTranslationLike('title', "%$searchsa%");
        }
    
        
        $blogCount = $query->count();
    
        $blog = $query->with([
                'category',
                'author' => function ($query) {
                    $query->select('id', 'full_name', 'avatar', 'role_id', 'role_name');
                },
            ])
            ->withCount('comments')
            ->paginate(6);
    
    
        $blogCategories = BlogCategory::all();
    
        
        $popularPosts = $this->getPopularPosts();
    
        $data = [
            'pageTitle' => trans('home.blog'),
            'pageDescription' => trans('home.blog'),
            'pageRobot' => getPageRobot('blog'),
            'blog' => $blog,
            'previousUrl' => $previousUrl,
            'blogCount' => $blogCount,
            'blogCategories' => $blogCategories,
            'popularPosts' => $popularPosts,
        ];
    
        return view(getTemplate().'.blog.index', $data);
    }
    

    public function handleFilters($request, $query)
    {
        $anjing = $request->get('anjing', null);
        // dd($upcoming);

        // if ($this->tableName == 'blog') {

            if (! empty($anjing) and $anjing) {
                $types = BlogCategory::where('id', $anjing)->pluck('id')->toArray();
                // dd($types);
                $query->whereIn("{$this->tableName}.category_id", $types);
            // }
        }

        return $query;
    }

    

    public function show($slug)
    {
        if (! empty($slug)) {
            $post = Blog::where('slug', $slug)
                ->where('status', 'publish')
                ->with([
                    'category',
                    'author' => function ($query) {
                        $query->select('id', 'full_name', 'role_id', 'avatar', 'role_name');
                        $query->with('role');
                    },
                    'comments' => function ($query) {
                        $query->where('status', 'active');
                        $query->whereNull('reply_id');
                        $query->with([
                            'user' => function ($query) {
                                $query->select('id', 'full_name', 'avatar', 'avatar_settings', 'role_id', 'role_name');
                            },
                            'replies' => function ($query) {
                                $query->where('status', 'active');
                                $query->with([
                                    'user' => function ($query) {
                                        $query->select('id', 'full_name', 'avatar', 'avatar_settings', 'role_id', 'role_name');
                                    },
                                ]);
                            },
                        ]);
                    },
                ])
                ->withCount('comments')
                ->first();

            $query = Blog::where('status', 'publish')
            ->orderBy('updated_at', 'asc')
            ->orderBy('created_at', 'asc');

            $blog = $query->with([
                'category',
                'author' => function ($query) {
                    $query->select('id', 'full_name', 'avatar', 'role_id', 'role_name');
                },
            ])
                ->withCount('comments')
                ->paginate(6);

                Session::put('previous_url', url()->current());
                
            if (! empty($post)) {
                $post->visit_count += 1;
                $post->save();
                $post->update(['visit_count' => $post->visit_count + 1]);

                $similarPosts = Blog::where('category_id', $post->category_id)
                ->where('status', 'publish')
                ->where('id', '!=', $post->id) // Exclude current post
                ->with(['category', 'author'])
                ->take(3) // Ambil 3 postingan yang serupa
                ->get();

                $blogCategories = BlogCategory::all();
                $popularPosts = $this->getPopularPosts();
                $blogCategoriesFilter = $this->showCategory();

                $pageRobot = getPageRobot('blog');

                $data = [
                    'pageTitle' => $post->title,
                    'pageDescription' => $post->meta_description,
                    'blogCategories' => $blogCategories,
                    'blogCategoriesFilter' => $blogCategoriesFilter,
                    'popularPosts' => $popularPosts,
                    'pageRobot' => $pageRobot,
                    'post' => $post,
                    'blog' => $blog,
                    'similarPosts' => $similarPosts,
                ];

                return view(getTemplate().'.blog.show', $data);
            }

            if (! empty($translate)) {
                app()->setLocale($translate->locale);
            }
        }

        abort(404);
    }


    public function showCategory()
    {
        $category = BlogCategory::all();

        return  $category;


    }
    private function getPopularPosts()
    {
        return Blog::where('status', 'publish')
            ->orderBy('visit_count', 'desc')
            ->limit(5)
            ->get();
    }

    public function shareFacebook(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
    
        $blog->increment('facebook_shares');

        return redirect()->back();
    }

    public function shareTwitter(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
    
        $blog->increment('twitter_shares');

        return redirect()->back();
    }

    public function shareLinkedin(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
    
        $blog->increment('linkedin_shares');

        return redirect()->back();
    }
}
