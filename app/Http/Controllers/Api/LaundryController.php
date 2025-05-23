<?php

namespace App\Http\Controllers\Api;

//import model Laundry
use App\Models\Laundry;

//import resource LaudryResource
use App\Http\Resources\LaundryResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaundryController extends BaseController
{
    //list Laundry
    public function index(Request $request)
    {
        $query = Laundry::query();


        // Search by name or phone
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        $sortField = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);


        $laundries = $query->get();

        return response()->json([
            'success' => true,
            'data' => LaundryResource::collection($laundries),
        ], 200);
    }


    public function store(Request $request)
    {
        try {
            $phone = $this->formatPhoneNumber($request->phone);

            if (!str_starts_with($phone, '0')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid phone number format. Phone number must start with 0',
                ], 422);
            }

            $rules = [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:15|unique:laundries,phone,' . $request->id,
            ];

            $validated = $request->validate($rules);

            $laundry = Laundry::Create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $phone,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Laundry created successfully',
                'data' => new LaundryResource($laundry),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create laundry',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show(Laundry $laundry)
    {
        return response()->json([
            'success' => true,
            'data' => new LaundryResource($laundry),
        ], 200);
    }


    public function destroy(Laundry $laundry)
    {
        try {
            $laundry->delete();

            return response()->json([
                'success' => true,
                'message' => 'Laundry deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete laundry',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
