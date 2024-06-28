<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Technology;

class TechnologyController extends Controller
{
    public function technologyList()
    {
        $technologys = Technology::all();

        return view('company.technology', compact('technologys'));
    }

    public function addTechnology(Request $request)
    {
        // Validate the request data
        $request->validate([
            'technology_name' => 'required|string|max:255',
        ]);

        // Check if technology_id is provided in the request
        if ($request->has('technology_id')) {
            // Update existing technology record
            $technology = Technology::find($request->input('technology_id'));
            if (!$technology) {
                return redirect()->route('add.technology')->with('error', 'Technology not found!');
            }

            $technology->technology_name = $request->input('technology_name');
            $technology->technology_status = $request->input('technology_status');;
            $technology->save();

            return redirect()->route('add.technology')->with('success', 'Technology updated successfully!');
        } else {
            // Create a new technology instance and fill it with the form data
            $technology = new Technology();
            $technology->technology_name = $request->input('technology_name');
            $technology->technology_status = true;

            $technology->save();

            return redirect()->back()->with('success', 'Technology added successfully!');
        }
    }

    public function editTechnology($id)
    {
        $technologys = Technology::all();

        $editTechnology = Technology::find($id);
        return view('company.technology', compact('editTechnology','technologys'));
    }
    public function destroy($id)
    {

        $Technology = Technology::find($id);
        $Technology->delete();

        return redirect()->route('add.technology')->with('success', 'Technology deleted successfully.');
    }
}
