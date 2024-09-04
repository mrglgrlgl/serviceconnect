<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function seekeranalytics()
    {
        $userId = Auth::id();

        // Fetch services completed
        $completedServices = DB::table('service_requests')
            ->where('status', 'completed')
            ->where('user_id', $userId)
            ->count();

        // Fetch performance data
        $performanceData = [
            'labels' => ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            'data' => DB::table('service_requests')
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->where('status', 'completed')
                ->where('user_id', $userId)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray()
        ];

        // Fill in missing months with 0
        $performanceData['data'] = array_replace(array_fill(1, 12, 0), $performanceData['data']);

        // Fetch customer satisfaction data for the current user
        $customerSatisfactionData = DB::table('ratings')
            ->selectRaw('
                AVG(communication) * 10 AS communication,
                AVG(fairness) * 10 AS fairness,
                AVG(respectfulness) * 10 AS respectfulness,
                AVG(preparation) * 10 AS preparation,
                AVG(responsiveness) * 10 AS responsiveness
            ')
            ->where('rated_for_id', $userId)
            ->first();

        // Fetch cancellation rate
        $cancellationData = DB::table('service_requests')
            ->selectRaw('
                COUNT(*) AS total_requests,
                SUM(CASE WHEN status = "cancelled" THEN 1 ELSE 0 END) AS cancelled_requests
            ')
            ->first();
        $cancellationRate = $cancellationData->cancelled_requests / $cancellationData->total_requests * 100;

        // Fetch completion rate
        $completionData = DB::table('service_requests')
            ->selectRaw('
                COUNT(*) AS total_requests,
                SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) AS completed_requests
            ')
            ->where('user_id', $userId)
            ->first();
        $completionRate = $completionData->completed_requests / $completionData->total_requests * 100;

        // Fetch most availed service
        $mostAvailedService = DB::table('service_requests')
            ->select('category', DB::raw('COUNT(*) AS completed_services'))
            ->where('status', 'completed')
            ->where('user_id', $userId)
            ->groupBy('category')
            ->orderBy('completed_services', 'DESC')
            ->first();

        // Fetch most loyal provider
        $mostLoyalProvider = DB::table('service_requests')
            ->join('users', 'service_requests.provider_id', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(service_requests.id) AS completed_services'))
            ->where('service_requests.status', 'completed')
            ->groupBy('users.id', 'users.name')
            ->orderBy('completed_services', 'DESC')
            ->first();

        return view('analytics', compact(
            'completedServices',
            'performanceData',
            'customerSatisfactionData',
            'cancellationRate',
            'completionRate',
            'mostAvailedService',
            'mostLoyalProvider'
        ));
    }

    public function providerAnalytics()
    {
        $userId = Auth::id();
        if (!$userId) {
            // Handle the case where user is not authenticated
            return redirect()->route('login');
        }

        // Fetch services completed
        $completedServices = DB::table('service_requests')
            ->where('status', 'completed')
            ->where('provider_id', $userId)
            ->count();

        // Fetch performance data
        $performanceData = [
            'labels' => ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            'data' => DB::table('service_requests')
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->where('provider_id', $userId)
                ->where('status', 'completed')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray()
        ];

        // Fill in missing months with 0
        $performanceData['data'] = array_replace(array_fill(1, 12, 0), $performanceData['data']);

        // Fetch customer satisfaction data for the current user
        $customerSatisfactionData = DB::table('ratings')
            ->selectRaw('
                AVG(communication) *10 AS communication,
                AVG(fairness) *10 AS fairness,
                AVG(quality_of_service) *10 AS quality_of_service,
                AVG(professionalism) *10 AS professionalism,
                AVG(cleanliness_tidiness) *10 AS cleanliness_tidiness,
                AVG(value_for_money) *10 AS value_for_money
            ')
            ->where('rated_for_id', $userId)
            ->first();

        // Fetch cancellation rate
        $cancellationData = DB::table('service_requests')
            ->selectRaw('
                COUNT(*) AS total_requests,
                SUM(CASE WHEN status = "cancelled" THEN 1 ELSE 0 END) AS cancelled_requests
            ')
            ->first();
        $cancellationRate = $cancellationData->cancelled_requests / $cancellationData->total_requests * 100;

        // Fetch completion rate
        $completionData = DB::table('service_requests')
            ->selectRaw('
                COUNT(*) AS total_requests,
                SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) AS completed_requests
            ')
            ->where('provider_id', $userId)
            ->first();
        $completionRate = $completionData->completed_requests / $completionData->total_requests * 100;

        // Fetch most availed service by the provider
        $mostAvailedService = DB::table('service_requests')
            ->select('category', DB::raw('COUNT(*) AS completed_services'))
            ->where('status', 'completed')
            ->where('provider_id', $userId)
            ->groupBy('category')
            ->orderBy('completed_services', 'DESC')
            ->first();

        // Fetch most loyal seeker (customer) for the provider
        $mostLoyalSeeker = DB::table('service_requests')
            ->join('users', 'service_requests.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(service_requests.id) AS completed_services'))
            ->where('service_requests.status', 'completed')
            ->where('service_requests.provider_id', $userId)
            ->groupBy('users.id', 'users.name')
            ->orderBy('completed_services', 'DESC')
            ->first();
            
        return view('agencyuser.analytics', compact(
            'completedServices',
            'performanceData',
            'customerSatisfactionData',
            'cancellationRate',
            'completionRate',
            'mostAvailedService',
            'mostLoyalSeeker'
        ));
    }
}