<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AppSupportTicketsModel;

class SupportTicketsController extends Controller
{
    public function showForm(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $supportTickets = AppSupportTicketsModel::where('customer_id', $customer->id)
                                    ->where('app_id', $customer->app_id)
                                    ->get();
        
        $customer->supportTickets = $supportTickets;
        
        return view('customer.tickets', compact('customer'));
    }

    public function saveTickets(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // ✅ Validate input
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'file'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB
        ]);

        // ✅ Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')
                                ->store('support_tickets', 'public');
        }

        // ✅ Create ticket
        AppSupportTicketsModel::create([
            'app_id'        => $customer->app_id,
            'customer_id'   => $customer->id,
            'subject'       => $validated['subject'],
            'message'       => $validated['message'],
            'file'          => $filePath,
            'status'        => 0, // open 1 Replied 2 Closed
            'created_on'    => now(),
        ]);

        // ✅ Redirect with toast success
        return redirect()
            ->route('tickets')
            ->with([
                'status_code' => 'success',
                'message'     => 'Support ticket created successfully.',
            ]);
    }
}
