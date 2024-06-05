<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Ticket;
use App\Models\Webinar;
use App\Models\PetaProvinsi;
use Illuminate\Http\Request;
use App\Models\FeatureWebinar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\traits\DashboardTrait;
use App\Models\PetaKabKota;

class DashboardController extends Controller
{
    use DashboardTrait;

    protected $PetaProvinsi;

    public function __construct()
    {
        $this->PetaProvinsi = new PetaProvinsi();
    }

    public function index()
    {
        $this->authorize('admin_general_dashboard_show');

        if (Gate::allows('admin_general_dashboard_daily_sales_statistics')) {
            $dailySalesTypeStatistics = $this->dailySalesTypeStatistics();
        }

        if (Gate::allows('admin_general_dashboard_income_statistics')) {
            $getIncomeStatistics = $this->getIncomeStatistics();
        }

        if (Gate::allows('admin_general_dashboard_total_sales_statistics')) {
            $getTotalSalesStatistics = $this->getTotalSalesStatistics();
        }

        if (Gate::allows('admin_general_dashboard_new_sales')) {
            $getNewSalesCount = $this->getNewSalesCount();
        }

        if (Gate::allows('admin_general_dashboard_new_comments')) {
            $getNewCommentsCount = $this->getNewCommentsCount();
        }

        if (Gate::allows('admin_general_dashboard_new_tickets')) {
            $getNewTicketsCount = $this->getNewTicketsCount();
        }

        if (Gate::allows('admin_general_dashboard_new_reviews')) {
            $getPendingReviewCount = $this->getPendingReviewCount();
        }

        if (Gate::allows('admin_general_dashboard_sales_statistics_chart')) {
            $getMonthAndYearSalesChart = $this->getMonthAndYearSalesChart('month_of_year');
            $getMonthAndYearSalesChartStatistics = $this->getMonthAndYearSalesChartStatistics();
        }

        if (Gate::allows('admin_general_dashboard_recent_comments')) {
            $recentComments = $this->getRecentComments();
        }

        if (Gate::allows('admin_general_dashboard_recent_tickets')) {
            $recentTickets = $this->getRecentTickets();
        }

        if (Gate::allows('admin_general_dashboard_recent_webinars')) {
            $recentWebinars = $this->getRecentWebinars();
        }

        if (Gate::allows('admin_general_dashboard_recent_courses')) {
            $recentCourses = $this->getRecentCourses();
        }

        if (Gate::allows('admin_general_dashboard_users_statistics_chart')) {
            $usersStatisticsChart = $this->usersStatisticsChart();
        }

        if (Auth::user()) {
            $user = $this->getUserData();
        }

        $data = [
            'pageTitle' => trans('admin/main.general_dashboard_title'),
            'dailySalesTypeStatistics' => $dailySalesTypeStatistics ?? null,
            'getIncomeStatistics' => $getIncomeStatistics ?? null,
            'getTotalSalesStatistics' => $getTotalSalesStatistics ?? null,
            'getNewSalesCount' => $getNewSalesCount ?? 0,
            'getNewCommentsCount' => $getNewCommentsCount ?? 0,
            'getNewTicketsCount' => $getNewTicketsCount ?? 0,
            'getPendingReviewCount' => $getPendingReviewCount ?? 0,
            'getMonthAndYearSalesChart' => $getMonthAndYearSalesChart ?? null,
            'getMonthAndYearSalesChartStatistics' => $getMonthAndYearSalesChartStatistics ?? null,
            'recentComments' => $recentComments ?? null,
            'recentTickets' => $recentTickets ?? null,
            'recentWebinars' => $recentWebinars ?? null,
            'recentCourses' => $recentCourses ?? null,
            'usersStatisticsChart' => $usersStatisticsChart ?? null,
            'user' => $user,
        ];

        return view('admin.dashboard', $data);
    }

    public function marketing()
    {
        $this->authorize('admin_marketing_dashboard_show');

        $buyerIds = Sale::whereNull('refund_at')
            ->pluck('buyer_id')
            ->toArray();
        $teacherIdsHasClass = Webinar::where('status', Webinar::$active)
            ->pluck('creator_id', 'teacher_id')
            ->toArray();
        $teacherIdsHasClass = array_merge(array_keys($teacherIdsHasClass), $teacherIdsHasClass);

        $usersWithoutPurchases = User::whereNotIn('id', array_unique($buyerIds))->count();
        $teachersWithoutClass = User::where('role_name', Role::$teacher)
            ->whereNotIn('id', array_unique($teacherIdsHasClass))
            ->count();
        $featuredClasses = FeatureWebinar::where('status', 'publish')
            ->count();

        $now = time();
        $activeDiscounts = Ticket::where('start_date', '<', $now)
            ->where('end_date', '>', $now)
            ->count();

        $getClassesStatistics = $this->getClassesStatistics();

        $getNetProfitChart = $this->getNetProfitChart();

        $getNetProfitStatistics = $this->getNetProfitStatistics();

        $getTopSellingClasses = $this->getTopSellingClasses();

        $getTopSellingAppointments = $this->getTopSellingAppointments();

        $getTopSellingTeachers = $this->getTopSellingTeachersAndOrganizations('teachers');

        $getTopSellingOrganizations = $this->getTopSellingTeachersAndOrganizations('organizations');

        $getMostActiveStudents = $this->getMostActiveStudents();

        $data = [
            'pageTitle' => trans('admin/main.marketing_dashboard_title'),
            'usersWithoutPurchases' => $usersWithoutPurchases,
            'teachersWithoutClass' => $teachersWithoutClass,
            'featuredClasses' => $featuredClasses,
            'activeDiscounts' => $activeDiscounts,
            'getClassesStatistics' => $getClassesStatistics,
            'getNetProfitChart' => $getNetProfitChart,
            'getNetProfitStatistics' => $getNetProfitStatistics,
            'getTopSellingClasses' => $getTopSellingClasses,
            'getTopSellingAppointments' => $getTopSellingAppointments,
            'getTopSellingTeachers' => $getTopSellingTeachers,
            'getTopSellingOrganizations' => $getTopSellingOrganizations,
            'getMostActiveStudents' => $getMostActiveStudents,
        ];

        return view('admin.marketing_dashboard', $data);
    }

    public function getPropinsiGeoJSON()
    {
        $result = PetaProvinsi::with('kabkota')->get();

        return response()->json($result);
    }

    public function getKabkotaGeoJSON($provinceCode)
    {
        $kabkota = PetaProvinsi::where('province_code', $provinceCode)
            ->with(['kabkota' => function ($query) {
                $query->withCount(['users as member_platform_count' => function ($query) {
                    $query->where('role_name', 'member_platform');
                }])
                    ->withCount(['users as admin_count' => function ($query) {
                        $query->where('role_name', 'admin');
                    }])
                    ->withCount(['users as organization_count' => function ($query) {
                        $query->where('role_name', 'organization');
                    }])
                    ->withCount(['users as anggota_biasa_count' => function ($query) {
                        $query->where('role_name', 'anggota_biasa');
                    }])
                    ->withCount(['users as dpw_count' => function ($query) {
                        $query->where('role_name', 'dpw');
                    }])
                    ->withCount(['users as anggota_luar_biasa_count' => function ($query) {
                        $query->where('role_name', 'anggota_luar_biasa');
                    }])
                    ->withCount(['users as angggota_kehormatan_count' => function ($query) {
                        $query->where('role_name', 'anggota_kehormatan');
                    }])
                    ->withCount(['users as dpn_count' => function ($query) {
                        $query->where('role_name', 'dpn');
                    }])
                    ->withCount(['users as total_users']);
            }])
            ->first();

        if (! $kabkota) {
            return response()->json(['error' => 'Province not found'], 404);
        }

        return response()->json($kabkota->kabkota);
    } 

    public function getRoleUsers($provinceCode = null, $userRole = null, $userProvinceCode = null){
        // Check if user is DPW and has province_code
        if ($userRole === 'dpw' && $userProvinceCode) {
            $provinceCode = $userProvinceCode;
        }
    
        $kabkota = PetaProvinsi::where('province_code', $provinceCode)
            ->with(['kabkota' => function ($query) {
                $query->with(['users' => function ($query) {
                    $query->select('role_name', 'province_code');
                }]);
            }])
            ->first();
    
        if (! $kabkota) {
            return response()->json(['error' => 'Province not found'], 404);
        }
    
        return $kabkota;
    }

    public function getUserData() {
        if (Auth::check()) {
            $user = Auth::user();
            
            $province = PetaKabKota::where('mst_propinsi_id', $user->province_code)->first();
    
            if ($province !== null) {
                $provinceName = $province->propinsi_name;
            } else {
                $provinceName = 'Unknown';
            }
    
            return [
                'province_code' => $user->province_code,
                'provinceName' => $provinceName,
                'role_name' => $user->role_name
            ];
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }    

    public function saveUserData(Request $request)
    {
        $userData = $request->all();

        session(['userData' => $userData]);
        
        return response()->json(['message' => 'Data pengguna berhasil disimpan'], 200);
    }

    public function clearUserData()
    {
        session()->forget('userData');

        return response()->json(['message' => 'Data pengguna berhasil dihapus'], 200);
    }

    public function getUserProvinceCode()
    {
        $userData = session('userData');
        $userProvinceCode = isset($userData['province_code']) ? $userData['province_code'] : null;

        return response()->json(['province_code' => $userProvinceCode], 200);
    }

    public function getSaleStatisticsData(Request $request)
    {
        $this->authorize('admin_general_dashboard_sales_statistics_chart');

        $type = $request->get('type');

        $chart = $this->getMonthAndYearSalesChart($type);

        return response()->json([
            'code' => 200,
            'chart' => $chart,
        ], 200);
    }

    public function getNetProfitChartAjax(Request $request)
    {

        $type = $request->get('type');

        $chart = $this->getNetProfitChart($type);

        return response()->json([
            'code' => 200,
            'chart' => $chart,
        ], 200);
    }

    public function cacheClear()
    {
        $this->authorize('admin_clear_cache');

        Artisan::call('clear:all');

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => 'Website cache successfully cleared.',
            'status' => 'success',
        ];

        return back()->with(['toast' => $toastData]);
    }
}
