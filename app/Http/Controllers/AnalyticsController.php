<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $performanceData = [
            'labels' => ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            'data' => [10, 15, 20, 25, 30, 35, 20, 25, 30, 35, 40, 45]
        ];

        $customerSatisfactionData = [
            'labels' => ['Quality of Service', 'Communication', 'Professionalism', 'Tidiness', 'Value for Money', 'Overall'],
            'data' => [80, 75, 90, 85, 70, 78]
        ];

        return view('analytics', compact('performanceData', 'customerSatisfactionData'));
    }
}
