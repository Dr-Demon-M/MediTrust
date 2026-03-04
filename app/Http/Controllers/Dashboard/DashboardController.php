<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. تحديد نطاق الأسبوع
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek   = Carbon::now()->endOfWeek(Carbon::FRIDAY);

        // 2. جلب الإحصائيات (تعديل اسم العمود داخل DATE)
        $appointments = Appointment::select(
            DB::raw('DATE(appointment_datetime) as date'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('appointment_datetime', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->pluck('total', 'date');

        $weekData = [];
        $labels = [];
        $period = CarbonPeriod::create($startOfWeek, $endOfWeek);

        foreach ($period as $date) {
            $labels[] = $date->format('D');
            // البحث في المصفوفة باستخدام التاريخ فقط Y-m-d
            $weekData[] = $appointments[$date->format('Y-m-d')] ?? 0;
        }

        // 3. مواعيد الطبيب لليوم (تعديل لفلترة التاريخ فقط من عمود الـ datetime)
        $appointments = auth()->user()->doctor->appointments()
            ->whereDate('appointment_datetime', today())
            ->latest()
            ->get();

        // 4. عدد المواعيد في آخر 7 أيام
        $count = Appointment::where('appointment_datetime', '>=', now()->subDays(7))->count();

        // 5. حساب إجمالي أسعار الخدمات لليوم
        $services = auth()->user()->doctor->appointments()
            ->whereDate('appointment_datetime', today())
            ->get()
            ->toArray();

        $price = 0;
        foreach ($services as $service) {
            $price += $service['service_price'];
        }

        // 6. قائمة المهام
        $todos = auth()->user()->todos()->latest()->get();

        // 7. المواعيد القادمة (Pending) لليوم في العيادة
        $upcomingAppointments = Appointment::whereDate('appointment_datetime', today())
            ->where('status', 'pending')
            ->with('specialty', 'service')
            ->get();
        return view('Dashboard.index', compact('appointments', 'count', 'price', 'todos', 'weekData', 'labels', 'upcomingAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
