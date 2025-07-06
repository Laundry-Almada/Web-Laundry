<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;

class CustomerController extends BaseController
{
    public function check($identifier)
    {
        $customer = Customer::where('phone', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        if (!$customer) {
            return $this->sendError('Customer not found', [], 404);
        }

        return $this->sendResponse(new CustomerResource($customer), 'Customer found successfully');
    }

    public function getOrders($identifier)
    {
        $customer = Customer::where('phone', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        if (!$customer) {
            return $this->sendError('Customer not found', [], 404);
        }

        $orders = Order::with(['service', 'laundry'])
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->sendResponse(
            OrderResource::collection($orders),
            'Customer orders retrieved successfully'
        );
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        if (!$query) {
            return $this->sendError('Search query is required', [], 400);
        }

        $customers = Customer::where('name', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return $this->sendResponse(
            CustomerResource::collection($customers),
            'Customers retrieved successfully'
        );
    }
}
