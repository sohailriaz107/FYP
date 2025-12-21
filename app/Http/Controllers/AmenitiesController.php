<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Amenities;


class AmenitiesController extends Controller
{
    public function index()
    {
        $amenities = Amenities::latest()->get();
        return view('admin.amenity', compact('amenities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amenity_name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('amenities', 'public');
        }

        $amenity = Amenities::create([
            'name' => $request->amenity_name,
            'icon' => $iconPath,
            'is_active' => 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Amenity created successfully!',
            'amenity' => $amenity
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amenity_name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $amenity = Amenities::findOrFail($id);
        
        $data = [
            'name' => $request->amenity_name,
            'is_active' => !$amenity->is_active
        ];

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('amenities', 'public');
        }

        $amenity->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Amenity updated successfully!',
            'amenity' => $amenity
        ]);
    }

    public function destroy($id)
    {
        $amenity = Amenities::findOrFail($id);
        $amenity->delete();

        return response()->json([
            'success' => true,
            'message' => 'Amenity deleted successfully!'
        ]);
    }
    public function toggleStatus(Request $request)
{
    $amenity = Amenities::findOrFail($request->id);

    $amenity->is_active = !$amenity->is_active;
    $amenity->save();

    return response()->json([
        'message' => 'Amenity status updated successfully'
    ]);
}

}
