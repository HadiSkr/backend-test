<?php

namespace App\Http\Controllers;
use App\Models\customers;
use Illuminate\Http\Request;

class adminController extends Controller
{
    
    public function showPendingCustomers()
    {
        $pendingCustomers = customers::where('status', 'pending')->get();

        return response()->json([
            'message' => 'Pending customers retrieved successfully',
            'customers' => $pendingCustomers,
        ]);
    }

    public function approveCustomer(Request $request, $customerId)
    {
        // Find the customer by ID
        $customer = customers::find($customerId);

        // Check if the customer exists
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Check if the current status is "pending"
        if ($customer->status !== 'pending') {
            return response()->json(['message' => 'Customer status is not pending'], 400);
        }

        // Update the customer status to "approved"
        $customer->status = 'approved';
        $customer->save();

        return response()->json([
            'message' => 'Customer status updated successfully',
            'customer' => $customer,
        ]);
    }

}
