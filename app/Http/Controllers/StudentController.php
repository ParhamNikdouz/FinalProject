<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Degree;
use App\Student;
use App\User;
use App\Term;
use Auth;
use DB;

class StudentController extends Controller
{
	public function Index(){
		return view('welcome');
	}

	public function AddStu(){
		$gp_manager = Auth::user()->group_manager;
		$terms = Term::all();
		$refrees = User::all();
		return view('AddStu', compact('terms', 'refrees', 'gp_manager'));
	}
	
	public function SeeStu(){
		$terms = Term::all();
		$id = Auth::user()->id;
		$students = Student::where('master_id', '=', $id)
			->leftjoin('terms', 'students.term_id', '=', 'terms.id')
			->leftjoin('users', 'students.refree_id', '=', 'users.id')
			->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'users.name', 'terms.title')			     ->get();
		return view('SeeStu', compact('students', 'terms'));
	}

	public function ReportStu(){
		$terms = Term::all();
		$id = Auth::user()->id;
		$students = Student::where('master_id', '=', $id)
			->leftjoin('terms', 'students.term_id', '=', 'terms.id')
			->leftjoin('users', 'students.refree_id', '=', 'users.id')
			->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'users.name', 'terms.title')			     ->get();
		return view('ReportStu', compact('students', 'terms'));
	}


	public function TermFilter(Term $term){

		$this->validate(request(), [
			'term_id' => 'Numeric'
		]);

		$term = request('term_id');
		$terms = Term::all();
		$id = Auth::user()->id;
		$matchThese = ['master_id' => $id, 'term_id' => $term];
		$students = Student::where($matchThese)
			->leftjoin('terms', 'students.term_id', '=', 'terms.id')
			->leftjoin('users', 'students.refree_id', '=', 'users.id')
			->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'users.name', 'terms.title')
			->get();
		return view('SeeStu', compact('students', 'terms', 'term'));
	}

        public function ReportTermFilter(Term $term){

                $this->validate(request(), [
                        'term_id' => 'Numeric'
                ]);

                $term = request('term_id');
                $terms = Term::all();
                $id = Auth::user()->id;
                $matchThese = ['master_id' => $id, 'term_id' => $term];
                $students = Student::where($matchThese)
                        ->leftjoin('terms', 'students.term_id', '=', 'terms.id')
                        ->leftjoin('users', 'students.refree_id', '=', 'users.id')
                        ->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'users.name', 'terms.title')                             ->get();
                return view('ReportStu', compact('students', 'terms', 'term'));
        }


	public function AddStuProcess(){

		$this->validate(request(), [
			'name' => 'Required|String|max:255',
			'email' => 'Required|String|max:255',
			'password' => 'Required|Numeric',
			'deadline' => 'String',
			'term_id' => 'Required|Numeric',
			'refree_id' => 'Numeric',
			'defence' => 'String',
			'complementary' => 'String'
		], [
			'email.required' => 'The title project field is required.',
			'password.required' => 'The student number field is required.',
			'password.numeric' => 'The student number must be a number.',
			'term_id.numeric' => 'The Term field must be a number.',
			'term_id.required' => 'The Term field is required.'
		]);

		$term_id = request('term_id');

		$degree_id = User::where('id', '=', Auth::user()->id)
				  ->select('degree_id')
				  ->get();
		$degree_id = array_column($degree_id->toArray(), 'degree_id'); //type casting Object to Array


		$maxStu = Degree::where('id', '=', $degree_id)
		       		  ->select('max_student')
				  ->get();
		$maxStu = array_column($maxStu->toArray(), 'max_student');


		$matchThese = ['term_id' => $term_id, 'master_id' => Auth::user()->id];
		$countStu = DB::table('students')
			       ->select(DB::raw('count(*) as countStu'))
			       ->where($matchThese)
			       ->groupBy('term_id')
			       ->get();
		$countStu = array_column($countStu->toArray(), 'countStu');

		if($countStu == NULL){
			//when $countStu equal NULL.
			$countStu = 0;
		}
		if($countStu[0] < $maxStu[0]){
			Student::create([
	    			'full_name' => request('name'),
        		        'title_project' => request('email'),
				'stu_number' => request('password'),
				'master_id' => Auth::user()->id,
				'deadline' => request('deadline'),
				'term_id' => request('term_id'),
				'refree_id' => request('refree_id'),
				'defence_situation' => request('defence'),
				'complementary' => request('complementary')
			]);
			session()->flash('added', 'This student was successfully saved.');
			return redirect('/AddStu');
		}
		else{
			session()->flash('warning', 'You can not add more than this student.');
			return redirect('/AddStu');
		}
	}

	public function EditStu(Student $student){
		$gp_manager = Auth::user()->group_manager;
		$terms = Term::all();
		$refrees = User::all();
		$student = Student::where('students.id', '=', $student->id)
			->leftjoin('terms', 'students.term_id', '=', 'terms.id')
			->leftjoin('users', 'students.refree_id', '=', 'users.id')
			->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'users.name', 'terms.title')			     ->get();
		return view('EditStu', compact('student', 'terms', 'refrees', 'gp_manager'));
	}

	public function UpdateStu(Student $student){
		$this->validate(request(), [
			'name' => 'Required|String|max:255',
			'email' => 'Required|String|max:255',
			'password' => 'Required|Numeric',
			'deadline' => 'String',
			'term_id' => 'Numeric',
			'refree_id' => 'Numeric',
			'defence' => 'String',
			'complementary' => 'String'
		], [
			'email.required' => 'The title project field is required.',
			'password.required' => 'The student number field is required.',
			'password.numeric' => 'The student number must be a number.'
		]);
		Student::where('id', $student->id)->update([
	    		'full_name' => request('name'),
        	        'title_project' => request('email'),
			'stu_number' => request('password'),
			//'master_id' => Auth::user()->id,
			'deadline' => request('deadline'),
			'term_id' => request('term_id'),
			'refree_id' => request('refree_id'),
			'defence_situation' => request('defence'),
			'complementary' => request('complementary')
		]);
		session()->flash('updated', 'This student was successfully updated.');
		return redirect()->back();
	}

	public function DeleteStu(Student $student){
		Student::where('id', $student->id)->delete();
		session()->flash('removed', 'This student was successfully removed.');
		return redirect()->back();
	}
}
