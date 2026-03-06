<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $users = User::where('active', 1)
    //         ->where('deleted', 0)
    //         ->get();

    //     foreach ($users as $key => $user) {


    //         $users[$key]['created_date'] = $user->created_at->format('Y-m-d');
    //     }

    //     return response()->json($users);
    // }

    public function index(Request $request)
    {

        if ($request->boolean('me')) {

            if (!auth()->check()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            $user = User::where('deleted', 0)
                ->where('active', 1)
                ->findOrFail(auth()->id());

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'user_category' => $user->user_category,
                'event_interests' => $user->event_interests ?? [],
                'image_path' => $user->image_path,
                'image_url' => $user->image_path
                    ? asset('storage/users/' . $user->image_path) . '?t=' . $user->updated_at->timestamp
                    : null,
            ]);
        }


        $users = User::where('active', 1)
            ->where('deleted', 0)
            ->get();

        foreach ($users as $key => $user) {
            $users[$key]['created_date'] = $user->created_at->format('Y-m-d');
            $users[$key]['image_url'] = $user->image_path ? asset('storage/users/' . $user->image_path) : null;
        }

        return response()->json($users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {

        // console.log("sending id:", this.edit_id, this.user_id);
        $request->validate([
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=(?:.*[A-Z]){2,})(?=(?:.*\d){2,})(?=(?:.*[^A-Za-z0-9]){2,}).{8,}$/',
            ],
            'logo' => ['nullable', 'string'],
            // 'user_category' => ['required', 'in:nation,non_nation'],
            'event_interests' => ['nullable', 'array', 'min:1'],
        ], [
            'password.regex' => 'Password must contain at least 8 characters, 2 uppercase letters, 2 numbers, and 2 symbols.',
        ]);

        $id = (int) $request->id;

        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }


        if ((int) auth()->id() !== $id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }


        $user = User::where('deleted', 0)
            ->where('active', 1)
            ->findOrFail($id);

        // $user->user_category = $request->user_category;
        $user->event_interests = $request->event_interests;


        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }


        $image = $request->input('logo');
        if (!empty($image)) {
            $data = substr($image, strpos($image, ',') + 1);
            $data = base64_decode($data);

            if ($data === false) {
                return response()->json(['message' => 'Invalid image data.'], 422);
            }

            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $extension = strtolower($extension);

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                return response()->json(['message' => 'Invalid image type.'], 422);
            }

            $folder = 'users';


            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }


            if (!empty($user->image_path)) {
                Storage::disk('public')->delete($folder . '/' . $user->image_path);
            }

            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $extension;

            Storage::disk('public')->put($folder . '/' . $fileName, $data);

            $user->image_path = $fileName;
        }

        $user->save();


        return response()->json([
            'success' => true,
            'image_url' => $user->image_path
                ? asset('storage/users/' . $user->image_path) . '?t=' . $user->updated_at->timestamp
                : null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
