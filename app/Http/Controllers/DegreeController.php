<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Degree;

class DegreeController extends Controller
{
        public function SeeDegree(){
		    $degrees = Degree::all();
		    return view('SeeDegree', compact('degrees'));
	    }

	    public function EditDegree(Degree $degree){
		    $info = Degree::where('id', '=', $degree->id)->get();
		    return view('EditDegree', compact('info'));
	    }

		public function UpdateDegree(Degree $degree){
	        $this->validate(request(), [
	                'title' => 'String',
	                'max_stu' => 'Required|Numeric',
	        ]);
	        Degree::where('id', $degree->id)->update([
	                'title' => request('title'),
	                'max_student' => request('max_stu')
	        ]);
	        session()->flash('updated', 'This Degree was successfully updated.');
	        return redirect('/SeeDegree');
	}


}
