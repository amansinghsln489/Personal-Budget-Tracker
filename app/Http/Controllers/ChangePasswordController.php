<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User\User;


class ChangePasswordController extends Controller
{

   

    public function update(Request $request)
    {
       
        // $request->validate([
        //     'old_password' => 'required',
        //     'new_password' => 'required|string|min:8|confirmed',
        // ]);
        $user = Auth::user();
     
        
        if (!Hash::check($request->old_password, auth()->user()->password)) {

            return response()->json(['error' => 'The provided password does not match your current password.'], 400);
        }

      

        $user->password = Hash::make($request->new_password);

        // Save the updated user information
        $user->save();
        return response()->json(['success' => 'Password changed successfully']);
    }
}

