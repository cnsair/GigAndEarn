<?php

namespace App\Http\Controllers;

use App\Models\Upload;

class ShowController extends Controller
{
    //Controller that renders posted items
    public function showInAdmin(){
        
        $prof_vid_section = Upload::where('type', 1)
                                    ->orderBy('id', 'desc')
                                    ->limit(5)->get();
        $course_vid_section = Upload::where('type', 2)
                                    ->orderBy('id', 'asc')
                                    ->limit(5)->get();        

        return view('admin.show')
            ->with('prof_vid_section', $prof_vid_section)
            ->with('course_vid_section', $course_vid_section);

    }
}
