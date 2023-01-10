<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Webinar;
use Illuminate\Support\Facades\Crypt;

class WebinarController extends Controller {

    public function getList() {
        $data = Webinar::getWebinars();
        return view('admin.webinars.webinar-listing', compact('data'));
    }

    public function getWebinarView() {
        return view('admin.webinars.add-webinar');
    }

    public function saveWebinar(Request $request) {
        $data = self::prepareData($request);
        $save = Webinar::saveData($data);
        if ($save) {
            return redirect()->route('webinar.list')->with('Saved Successfully!');
        } else {
            return redirect()->back()->with('Error occurred! please try again');
        }
    }

    public function updateWebinar(Request $request) {
        $data = self::prepareData($request);
        $data['id'] = $request->id;
        $save = Webinar::updateData($data);
        if ($save) {
            return redirect()->route('webinar.list')->with('Saved Successfully!');
        } else {
            return redirect()->back()->with('Error occurred! please try again');
        }
    }

    public function editWebinar($id) {
        $data = Webinar::getWebinar($id);
        return view('admin.webinars.edit-webinar', compact('data'));
    }

    public static function prepareData($request) {
        $inputs['title'] = $request['title'];
        $inputs['video_url'] = $request['url'];
        $inputs['date'] = $request['date'];
        $inputs['instructor'] = $request['instructor_name'];
        $inputs['type'] = $request['type'];

        return $inputs;
    }

    public function deleteWebinar($id) {
        $id = Crypt::decrypt($id);
        $data = ['is_active' => 0];
        $update = Webinar::where('id', $id)->update($data);
        
        if ($update) {
            return redirect()->route('webinar.list')->with('Deleted Successfully!');
        } else {
            return redirect()->back()->with('Error occurred! please try again');
        }
    }

}
