<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyCollection;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PropertyCollection(Property::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $request->validated($request->all());
        $property = Property::create($request->all());
        return new PropertyResource($property);
     }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $request->validated($request->all());
        $property = Property::findOrFail($property->id);
        $property->update($request->all());
        return response()->json(['message' => "Property updated successfully!"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property = Property::findOrFail($property->id);
        $property->delete();
        return response()->json(["message"=> "Property Deleted successfully!"],200);
    }
}