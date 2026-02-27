<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Helpers\ActivityLog;
use App\Helpers\CheckImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Mail\UserRegistrationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    //Get all the admin users
    public function index()
    {
        $users = User::where('deleted', 0)
            ->whereIn('type', ['Admin', 'Super Admin'])
            ->orderBy('type')  // You can add additional ordering if needed
            ->get();

        foreach ($users as $user) {
            $user = CheckImage::checkImageExists($user['image_path'], 'admins', $user, 'image_path');

            $createdDate = strtotime($user['created_at']);
            $user['created_date'] = date('Y-m-d', $createdDate);
        }

        return $users;
    }



    //Create new admin user
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'type' => 'required',
            'address' => $request->type === 'Student' || $request->type === 'Parent' ? 'required_if:type,Student,Parent' : '',
            'telephone' => $request->type === 'Student' || $request->type === 'Parent' ? 'required_if:type,Student,Parent' : '',
            'dob' => $request->type === 'Student' || $request->type === 'Parent' ? 'required_if:type,Student,Parent|date' : '',
            'age' => $request->type === 'Student' || $request->type === 'Parent' ? 'required_if:type,Student,Parent|numeric' : '',
            'country_code' => $request->type === 'Student' || $request->type === 'Parent' ? 'required_if:type,Student,Parent' : '',
            'active' => $request->type === 'Student' || $request->type === 'Parent' ? 'required_if:type,Student,Parent|in:0,1' : '',
        ]);


        $image = $request->image;

        try {
            // Generate a random password for students and parents
            if ($request->type === 'Student' || $request->type === 'Parent') {
                $password = Str::random(8);
            } else {
                // For other user types, use the provided password
                $password = $request->password;
            }

            // Storing image in storage/app/public/admins folder
            if ($image != null) {
                $data = substr($image, strpos($image, ',') + 1);
                $data = base64_decode($data);
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                Storage::disk('public')->put("/admins/" . $fileName, $data);
                $admin['image_path'] = $fileName;
            }

            $admin['name'] = $request->full_name;
            $admin['email'] = $request->email;
            $admin['password'] = Hash::make($password);
            $admin['type'] = $request->type;

            // Additional fields for Student and Parent
            if ($request->type === 'Student' || $request->type === 'Parent') {
                $admin['address'] = $request->address;
                $admin['telephone'] = $request->telephone;
                $admin['dob'] = $request->dob;
                $admin['age'] = $request->age;
                $admin['country_code'] = $request->country_code;
                $admin['active'] = $request->active;
            }

            $result = User::create($admin);

            if ($result) {
                // Send the emai
                ActivityLog::createActivity(Auth::user()->id, 'New admin created');
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

   

    //Edit an admin user
    // Edit an admin user
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'full_name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'active' => 'required',
            'type' => 'required'
        ]);

        $image = $request->image;
        $id = $request->id;

        try {
            // Storing image in storage/app/public/admins folder
            if ($image != null) {
                $data = substr($image, strpos($image, ',') + 1);
                $data = base64_decode($data);
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                Storage::disk('public')->put("/admins/" . $fileName, $data);
                $admin['image_path'] = $fileName;
            }

            $admin['name'] = $request->full_name;
            $admin['email'] = $request->email;
            $admin['active'] = $request->active;
            $admin['type'] = $request->type;

            // Additional fields for Student and Parent
            if ($request->type === 'Student' || $request->type === 'Parent') {
                $admin['address'] = $request->address;
                $admin['telephone'] = $request->telephone;
                $admin['dob'] = $request->dob;
                $admin['age'] = $request->age;
                $admin['country_code'] = $request->country_code;
                $admin['active'] = $request->active;
            }

            $admin_save = User::where('id', $id)->update($admin);

            if ($admin_save) {
                ActivityLog::createActivity(Auth::user()->id, 'Admin updated');
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return $e;
        }
    }



    //Delete an admin user
    public function destroy(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);

        try {

            $deleted = User::where('id', $request->id)->update([
                'deleted' => 1
            ]);

            if ($deleted) {
                return 1;
                ActivityLog::createActivity(Auth::user()->id, 'Admin deleted');
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return $e;
        }
    }


    //Search for paticular admin
    public function searchAdmins(Request $request)
    {
        $search = $request->search;

        if ($search != null) {
            return $students = User::where('name', 'like', $search . '%')->orWhere('id', 'like', $search . '%')->orderBy('id', 'ASC')->get();
        } else {
            return $students = User::orderBy('id', 'ASC')->get();
        }
    }

    public function getUserCounts()
    {
        try {
            $adminCount = User::where('type', 'Admin')->count();
            $studentCount = User::where('type', 'Student')->count();
            $parentCount = User::where('type', 'Parent')->count();
    
            return response()->json([
                'adminCount' => $adminCount,
                'studentCount' => $studentCount,
                'parentCount' => $parentCount,
            ]);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('getUserCounts Exception: ' . $e->getMessage());
    
            // Return a response with an error message
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
