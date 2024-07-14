<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\RequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\ProviderDetail;
use App\Models\RequestList;
use Illuminate\Support\Facades\Session;

class BecomeProviderController extends Controller
{
    private $requestController;

public function __construct(RequestController $requestController)
{
    $this->requestController = $requestController;
}
    public function index()
    {
        // Logic to show initial form
        return view('auth.multistep.become_provider');
    }

    public function saveStep1(Request $request)
    {
        $request->validate([
            'work_email' => 'required|email',
            'contact_number' => 'required|string',
        ]);

        // Store validated data in session for the next step
        $request->session()->put('work_email', $request->work_email);
        $request->session()->put('contact_number', $request->contact_number);

        return redirect()->route('bp_step2')->with('success', 'Step 1 saved successfully.');
    }
    public function showStep2Form()
    {
        // Logic to show the second step form
        return view('auth.multistep.bp_step2');
    }


    public function saveStep2(Request $request)
    {
        $request->validate([
            'service_category' => 'required|string',
            // 'sub_category' => 'required|string',
            'description' => 'required|string',
            'have_tools' => 'nullable|boolean',
        ]);
    
        // Check if the user has already sent a request
        if (RequestList::hasUserSentRequest(auth()->id())) {
            return redirect()->back()->with('error', 'You have already sent a request. You can only send one request.');
        }
    
        // Store validated data in session for the next step
        $request->session()->put('service_category', $request->service_category);
        // $request->session()->put('sub_category', $request->sub_category);
        $request->session()->put('description', $request->description);
        $request->session()->put('have_tools', $request->input('have_tools', false));
    
        // Create a new RequestList and save it
        $requestList = new RequestList();
        $requestList->user_id = auth()->id(); // assuming you have user authentication
        $requestList->status = 'pending';
        $requestList->save();
    
        // Store the request_id in the session
        $request->session()->put('request_id', $requestList->id);
    
        return redirect()->route('bp_step3')->with('success', 'Service information saved successfully.');
    }
    



    public function showStep3Form(Request $request)
    {
        $sessionData = [
            'work_email' => $request->session()->get('work_email'),
            'contact_number' => $request->session()->get('contact_number'),
            'service_category' => $request->session()->get('service_category'),
            // 'sub_category' => $request->session()->get('sub_category'),
            'description' => $request->session()->get('description'),
            'have_tools' => $request->session()->get('have_tools'),
            'request_id' => $request->session()->get('request_id'),

        ];
        // Logic to show the second step form
        return view('auth.multistep.bp_step3', compact('sessionData'));
    }

//     public function saveStep3(Request $request)
//     {
//         // Retrieve session data from steps 1, 2, and 3
//         $sessionData = [
//             'work_email' => $request->session()->get('work_email'),
//             'contact_number' => $request->session()->get('contact_number'),
//             'service_category' => $request->session()->get('service_category'),
//             // 'sub_category' => $request->session()->get('sub_category'),
//             'description' => $request->session()->get('description'),
//             'have_tools' => $request->session()->get('have_tools'),
//             'request_id' => $request->session()->get('request_id'),
//         ];
    
//         // Validate session data
//         if (!$this->validateSessionData($sessionData)) {
//             return redirect()->back()->with('error', 'Missing required session data.');
//         }
    
//         // Validate the incoming request data
//         $validatedData = $request->validate([
//             'government_id_front' => 'required|image|max:2048',
//             'government_id_back' => 'required|image|max:2048',
//             'nbi_clearance' => 'nullable|image|max:2048',
//             'tesda_certification' => 'nullable|image|max:2048',
//             'other_credentials' => 'nullable|image|max:2048',
//         ]);
    
//         // Store uploaded files
//         // $governmentIdFrontPath = $request->file('government_id_front')->store('provider/documents');
//         // $governmentIdBackPath = $request->file('government_id_back')->store('provider/documents');
//         // $nbiClearancePath = $request->file('nbi_clearance') ? $request->file('nbi_clearance')->store('provider/documents') : null;
//         // $tesdaCertificationPath = $request->file('tesda_certification') ? $request->file('tesda_certification')->store('provider/documents') : null;
//         // $otherCredentialsPath = $request->file('other_credentials') ? $request->file('other_credentials')->store('provider/documents') : null;
    

// // Store uploaded files
// $governmentIdFrontPath = $request->file('government_id_front')->store('provider/documents', 'public');
// $governmentIdBackPath = $request->file('government_id_back')->store('provider/documents', 'public');
// $nbiClearancePath = $request->file('nbi_clearance') ? $request->file('nbi_clearance')->store('provider/documents', 'public') : null;
// $tesdaCertificationPath = $request->file('tesda_certification') ? $request->file('tesda_certification')->store('provider/documents', 'public') : null;
// $otherCredentialsPath = $request->file('other_credentials') ? $request->file('other_credentials')->store('provider/documents', 'public') : null;


//         // Create ProviderDetail instance
//         $providerDetail = new ProviderDetail();
//         $providerDetail->work_email = $sessionData['work_email'];
//         $providerDetail->contact_number = $sessionData['contact_number'];
//         $providerDetail->serviceCategory = $sessionData['service_category'];
//         // $providerDetail->subcategory = $sessionData['sub_category'];
//         $providerDetail->description = $sessionData['description'];
//         $providerDetail->have_tools = $sessionData['have_tools'];
//         $providerDetail->government_id_front = $governmentIdFrontPath;
//         $providerDetail->government_id_back = $governmentIdBackPath;
//         $providerDetail->nbi_clearance = $nbiClearancePath;
//         $providerDetail->tesda_certification = $tesdaCertificationPath;
//         $providerDetail->other_credentials = $otherCredentialsPath;
//         $providerDetail->request_id = $sessionData['request_id'];
//         $providerDetail->save();
    
//         // Clear session data
//         $request->session()->forget(['work_email', 'contact_number', 'service_category', 'description', 'have_tools', 'request_id']);
    
//         return redirect()->route('home')->with('success', 'Provider details saved successfully.');
//     }
public function saveStep3(Request $request)
{
    // Retrieve session data from steps 1, 2, and 3
    $sessionData = [
        'work_email' => $request->session()->get('work_email'),
        'contact_number' => $request->session()->get('contact_number'),
        'service_category' => $request->session()->get('service_category'),
        // 'sub_category' => $request->session()->get('sub_category'),
        'description' => $request->session()->get('description'),
        'have_tools' => $request->session()->get('have_tools'),
        'request_id' => $request->session()->get('request_id'),
    ];

    // Validate session data
    if (!$this->validateSessionData($sessionData)) {
        return redirect()->back()->with('error', 'Missing required session data.');
    }

    // Validate the incoming request data
    $validatedData = $request->validate([
        'government_id_front' => 'required|image|max:2048',
        'government_id_back' => 'required|image|max:2048',
        'nbi_clearance' => 'nullable|image|max:2048',
        'tesda_certification' => 'nullable|image|max:2048',
        'other_credentials' => 'nullable|image|max:2048',
    ]);

    // Store uploaded files
    $governmentIdFrontPath = $request->file('government_id_front')->store('provider/documents', 'public');
    $governmentIdBackPath = $request->file('government_id_back')->store('provider/documents', 'public');
    $nbiClearancePath = $request->file('nbi_clearance') ? $request->file('nbi_clearance')->store('provider/documents', 'public') : null;
    $tesdaCertificationPath = $request->file('tesda_certification') ? $request->file('tesda_certification')->store('provider/documents', 'public') : null;
    $otherCredentialsPath = $request->file('other_credentials') ? $request->file('other_credentials')->store('provider/documents', 'public') : null;

    // Create ProviderDetail instance
    $providerDetail = new ProviderDetail();
    $providerDetail->work_email = $sessionData['work_email'];
    $providerDetail->contact_number = $sessionData['contact_number'];
    $providerDetail->serviceCategory = $sessionData['service_category'];
    // $providerDetail->subcategory = $sessionData['sub_category'];
    $providerDetail->description = $sessionData['description'];
    $providerDetail->have_tools = $sessionData['have_tools'];
    $providerDetail->government_id_front = $governmentIdFrontPath;
    $providerDetail->government_id_back = $governmentIdBackPath;
    $providerDetail->nbi_clearance = $nbiClearancePath;
    $providerDetail->tesda_certification = $tesdaCertificationPath;
    $providerDetail->other_credentials = $otherCredentialsPath;
    $providerDetail->request_id = $sessionData['request_id'];

    // Assign the current authenticated user's ID to the provider detail
    $providerDetail->provider_id = auth()->id();

    $providerDetail->save();

    // Clear session data
    $request->session()->forget(['work_email', 'contact_number', 'service_category', 'description', 'have_tools', 'request_id']);

    return redirect()->route('home')->with('success', 'Provider details saved successfully.');
}
    protected function validateSessionData(array $sessionData)
    {
        // Validate session data and return true if all required data is present
        return !empty($sessionData['work_email']) &&
               !empty($sessionData['contact_number']) &&
               !empty($sessionData['service_category']) &&
            //    !empty($sessionData['sub_category']) &&
               !empty($sessionData['description']) &&
               !empty($sessionData['request_id']);
    }
}
