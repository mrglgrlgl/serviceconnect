<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderDetail;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $category = $request->input('category');
        $providers = ProviderDetail::with(['user' => function ($query) {
            // Removed the philID condition
            $query->withCount(['completedServiceRequests'])
                  ->withAvg('ratings', 'quality_of_service');
        }])
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhere('serviceCategory', 'LIKE', "%{$searchTerm}%");
        })
        ->when($category, function ($query, $category) {
            $query->where('serviceCategory', $category);
        })
        ->get()
        ->filter(function($provider) {
            return $provider->user != null;
        })
        ->sortByDesc(function($provider) {
            return $provider->user->ratings_avg_quality_of_service ?? 0;
        });

        return view('home', compact('providers'));
    }

    public function profile($id)
    {
        $provider = User::with('providerDetails')->findOrFail($id);

        return response()->json([
            'name' => $provider->name,
            'serviceCategory' => $provider->providerDetails->serviceCategory,
            'email' => $provider->email,
            'contact_number' => $provider->providerDetails->contact_number,
            'description' => $provider->providerDetails->description,
        ]);
    }
}
