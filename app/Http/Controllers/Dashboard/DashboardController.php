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

        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek   = Carbon::now()->endOfWeek(Carbon::SATURDAY);
        // جيب عدد المرضى لكل يوم
        $appointments = Appointment::select(
            DB::raw('DATE(appointment_date) as date'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('appointment_date', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->pluck('total', 'date');
        // نجهز array كامل 7 أيام حتى لو مفيش بيانات
        $weekData = [];
        $labels = [];
        $period = CarbonPeriod::create($startOfWeek, $endOfWeek);
        foreach ($period as $date) {
            $labels[] = $date->format('D');
            $weekData[] = $appointments[$date->format('Y-m-d')] ?? 0;
        }

        $appointments = auth()->user()->doctor->appointments()->where('appointment_date', today())->latest()->get();
        $count = Appointment::where('appointment_date', '>=', now()->subDays(7))->count();
        $services = auth()->user()->doctor->appointments->where('appointment_date', today())->toArray();
        $price = 0;
        foreach ($services as $service) {
            $price += $service['service_price'];
        }
        $todos = auth()->user()->todos()->latest()->get();
        $upcomingAppointments = Appointment::whereDate('appointment_date', today())->where('status', 'pending')->with('specialty','service')->get();
        
        return view('Dashboard.index', compact('appointments', 'count', 'price', 'todos', 'weekData', 'labels','upcomingAppointments'));
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
