<?php

namespace App\Http\Controllers\Organisation;

use Exception;
use App\Helpers\CheckImage;
use App\Helpers\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\OrganisationDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OrganisationDetailsController extends Controller
{
    //get all organisation, activities details from db
    public function index()
    {
        $organisations = OrganisationDetail::all();

        foreach ($organisations as $organisation) {
            $organisation = CheckImage::checkImageExists($organisation['logo'], 'profile', $organisation, 'logo');
        }

        return $organisations;
    }

    //update organisation profile
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|min:5',
            'bank_name' => 'required',
            'account_no' => 'required',
            'swift_code' => 'required|min:5',
            'country' => 'required',
            'email' => 'required',
            'address' => 'required',
            'telephone' => 'required|min:9|max:11',
        ]);

        $id = $request->id;
        $logo = $request->logo;

        try {

            if ($logo != null) {
                $data = substr($logo, strpos($logo, ',') + 1);
                $data = base64_decode($data);
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($logo, 0, strpos($logo, ';')))[1])[1];
                Storage::disk('public')->put("/profile/" . $fileName, $data);
                $organisation['logo'] = $fileName;
            }

            $organisation['name'] = $request->name;
            $organisation['email'] = $request->email;
            $organisation['bank_name'] = $request->bank_name;
            $organisation['account_no'] = $request->account_no;
            $organisation['swift_code'] = $request->swift_code;
            $organisation['country'] = $request->country;
            $organisation['address'] = $request->address;
            $organisation['telephone'] = $request->telephone;


            $save_result = OrganisationDetail::where('id', $id)
                ->update($organisation);

            if ($save_result) {
                ActivityLog::createActivity(Auth::user()->id, 'Organisation profile updated');
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}
