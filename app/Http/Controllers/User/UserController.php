<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function showUser()
    {
        try {
            $users = User::select('users.*', 'roles.role_name')
                ->leftJoin('roles', 'users.role', '=', 'roles.role_id')
                ->orderBy('users.user_id', 'ASC')
                ->get();
        
                $roles = Role::where('role_status', 1)->get();
         
            return view('user.user', compact('roles', 'users'));
        } catch (\Exception $e) {
            return $e->getMessage(); // Handle or log the error
        }
    }

    public function showUserForm()
    {
        try {
            $users = User::select('users.*', 'roles.role_name')
                ->leftJoin('roles', 'users.role', '=', 'roles.role_id')
                ->orderBy('users.user_id', 'ASC')
                ->get();
        
                $roles = Role::where('role_status', 1)->get();
                $technologys = Technology::all();
         
            return view('user.userCreate', compact('roles', 'users','technologys'));
        } catch (\Exception $e) {
            return $e->getMessage(); // Handle or log the error
        }
    }
    
    /**
     * Store a newly created user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:1',
                'phone' => 'required|string',
                'role' => 'required',
                // 'technologies' => 'required',
                'user_image' => 'nullable|image', 
            ]);
    
            // Generate a numeric suffix based on existing user IDs
            $numericSuffix = User::count() + 1;
    
            // Generate a unique user ID based on the first name, last name, and numeric suffix
            $employeeId = strtolower(substr($validatedData['firstname'], 0, 1) . $validatedData['lastname'] . $numericSuffix);
    
            // Handle file uploads
            $imagePath = null;
    
            if ($request->hasFile('user_image')) {
                // Validate the image file
                if ($request->file('user_image')->isValid()) {
                    $imagePath = $request->file('user_image')->store('user_images', 'public');
                } else {
                    throw new \Exception('Invalid image file.');
                }
            }
    
            // Create a new user instance and set its attributes
            $user = new User();
            $user->employee_id = $employeeId;
            $user->firstname = $validatedData['firstname'];
            $user->lastname = $validatedData['lastname'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']); // Hash the password
            $user->phone = $validatedData['phone'];
            $user->role = $request->input('role');
            $user->technologies = $request->input('technologies');
            $user->user_image = $imagePath;
            $user->user_status = $request->input('user_status', true);
    
            // Save the user instance
            $user->save();
    
            return redirect()->route('add.user')->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            // If an exception occurs, return back with error message and old input
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        $edituser = User::findOrFail($id);
        $roles = Role::all(); // Assuming Role is your model for user roles
        $technologys = Technology::all();
        return view('user.userEdit', compact('edituser', 'roles','technologys'));
  
    }
    public function update(Request $request, $id)
    {
        // Find the user by the provided ID
        $user = User::findOrFail($id);
        
        // Update user data based on the form input
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->technologies = $request->input('technologies');

        if ($request->hasFile('user_image')) {
            // Validate the image file
            if ($request->file('user_image')->isValid()) {
                // Store the new image file and get the path
                $imagePath = $request->file('user_image')->store('user_images', 'public');
                
                // Optionally, delete the old image file if it exists
                if ($user->user_image) {
                    Storage::disk('public')->delete($user->user_image);
                }
    
                // Update the user's image path
                $user->user_image = $imagePath;
            } else {
                throw new \Exception('Invalid image file.');
            }
        }
    
        // Check if a new password is provided and update it
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
    
        return redirect()->route('view.user')->with('success', 'User updated successfully.');

    }

}
