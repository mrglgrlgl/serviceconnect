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

        $providers = ProviderDetail::with('user')
            ->whereHas('user', function($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhere('serviceCategory', 'LIKE', "%{$searchTerm}%")
            ->get();

        return view('home', compact('providers'));
    }

    public function profile($id)
    {
        $provider = User::with('providerDetail')->findOrFail($id);

        return response()->json([
            'name' => $provider->name,
            'serviceCategory' => $provider->providerDetail->serviceCategory,
            'email' => $provider->email,
            'contact_number' => $provider->providerDetail->contact_number,
            'description' => $provider->providerDetail->description,
        ]);
    }
}
