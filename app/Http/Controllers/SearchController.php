<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderDetail;
use App\Models\User;
use App\Models\Rating;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $category = $request->input('category');

        $providers = ProviderDetail::with(['user' => function ($query) {
            $query->whereHas('philID', function ($query) {
                $query->where('status', 'Accepted');
            })
            ->withCount(['completedServiceRequests'])
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

            // Fetch ratings for each provider
    $providerRatings = [];
    foreach ($providers as $provider) {
        // $user = User::findOrFail($providerId);
        $ratings = Rating::where('rated_for_id', $provider->user->id)->get();
        $providerRatings[$provider->user->id] = $ratings;
    }

        return view('home', compact('providers', 'ratings'));
    }

    // public function profile($providerId)
    // {
    //     $provider = User::with('providerDetails')->findOrFail($id);
    //     $ratings = Rating::where('rated_for_id', $providerId)->with('user')->get();
            
        
    //     return response()->json([
    //         'name' => $provider->name,
    //         'serviceCategory' => $provider->providerDetails->serviceCategory,
    //         'email' => $provider->email,
    //         'contact_number' => $provider->providerDetails->contact_number,
    //         'description' => $provider->providerDetails->description,
    //         $ratings
    //     ]);
    // }
}
