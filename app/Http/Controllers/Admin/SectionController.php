<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function sections(){
        $sections = Section::get()->toArray();
        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function updateSectionStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            
            if($data['status']=="Active"){
                $status = 0;
            } else{
                $status = 1;
            }
            Section::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        };
    }

    public function deleteSection($id){
        Section::where('id',$id)->delete();
        $message = 'Section has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }

}
