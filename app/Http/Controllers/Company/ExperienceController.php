<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Experience;

class ExperienceController extends Controller
{
    public function experienceList()
    {
        $experiences = Experience::all();

        return view('company.experience',compact('experiences'));
    }

    public function addExperience(Request $request)
    {
        
        // Validate the request data
        $request->validate([
            'experience_name' => 'required|string|max:255',
        ]);

        // Check if experience_id is provided in the request
        if ($request->has('experience_id')) {
            // Update existing experience record
            $experience = Experience::find($request->input('experience_id'));
            if (!$experience) {
                return redirect()->route('add.experience')->with('error', 'experience not found!');
            }

            $experience->experience = $request->input('experience_name');
            $experience->save();

            return redirect()->route('add.experience')->with('success', 'experience updated successfully!');
        }
         else {
            // Create a new experience instance and fill it with the form data
            $experience = new Experience();
            $experience->experience = $request->input('experience_name');
            $experience->save();

            return redirect()->back()->with('success', 'Experience added successfully!');    
        }
    }

    public function editExperience($id)
    {
        $experiences = Experience::all();

        $editExperience = Experience::find($id);
        return view('company.experience', compact('editExperience','experiences'));
    }
    public function destroy($id)
    {

        $experience = Experience::find($id);
        $experience->delete();

        return redirect()->route('add.experience')->with('success', 'Experience deleted successfully.');
    }
}

