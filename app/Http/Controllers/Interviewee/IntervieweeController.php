<?php

namespace App\Http\Controllers\Interviewee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Technology;
use App\Models\Interview\Interviewee;


class IntervieweeController extends Controller
{
        // Display a listing of the vendors
        public function index()
        {
            $technologys = Interviewee::with('technologyName')->get();
            
            return view('interviewee.index', compact('technologys'));
        }
    
        // Show the form for creating a new interviewee
        public function create()
        {
            
            $technologies = Technology::where('technology_status', 1)->get();
            return view('interviewee.createInterviewee', compact('technologies'));
        }
    
        // Store a newly created vendor in the database
        public function store(Request $request)
        {
            
            $request->validate([
                'name' => 'required',
                'email' => 'required'
            ]);
         
    
            if ($request->hasFile('user_image')) {
                // Validate the image file
                if ($request->file('user_image')) {
                   
                    $imagePath = $request->file('user_image')->store('interviewee_images', 'public');
                  
                } else {
                    throw new \Exception('Invalid image file.');
                }
            }
            $interview = new Interviewee();
          
            $interview->name = $request->input('name');
            $interview->email = $request->input('email');
            $interview->status = $request->input('status');
            $interview->image = $imagePath ?? null;
            $interview->phone_number = $request->input('phone_number');
            $interview->technology = $request->input('technology_id');
            $interview->comment = $request->input('comment');
            
            $interview->save();
            
            return redirect()->route('interviewee.createInterviewee')->with('success', 'Interviewee added successfully.');
        }
        
    
        // // Show the form for editing the specified vendor
        public function edit($interviewee)
        {
          
            $vendor = Interviewee::findOrFail($interviewee); 
            $technologies = Technology::all();
            return view('interviewee.editInterviewee', compact('vendor','technologies'));
        }
    
        public function update(Request $request)
        {
            // Validate request data
            $validatedData = $request->validate([
                'id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'technology' => 'required',
                'phone_number' => 'required',
                'status' => 'required',
                'comment' => 'nullable',
            ]);
    
            // Find the vendor by vendor_id
            $vendor = Interviewee::findOrFail($request->input('id'));
    
          
            // Update the vendor
            $vendor->update($validatedData);
    
            return redirect()->route('interviewee.index')->with('success', 'Interviewee updated successfully.');
        }
    
        // Remove the specified vendor from the database
        public function destroy($delete)
        {
            
            $interview = Interviewee::find($delete);
            
            if ($interview) {
                // Delete the lead status
                $interview->delete();
                return redirect()->back()->with('success', 'Interview status deleted successfully');
            }
            }
           
            
}
