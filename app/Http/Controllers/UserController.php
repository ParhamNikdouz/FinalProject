<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Student;
use App\Degree;
use App\Term;
use App\User;
use Auth;

class UserController extends Controller
{
	public function AddMaster(){
		$degrees = Degree::all();
                return view('AddMaster', compact('degrees'));
        }

	public function SeeMaster(){
		$masters = User::where('group_manager', '=', '0')
			        ->join('degrees', 'users.degree_id', '=', 'degrees.id')
				->select('users.id', 'users.name', 'users.email', 'degrees.title')
				->get();
                return view('SeeMaster', compact('masters'));
        }

	public function SeeStuMaster(User $user){
		session()->put('key', $user->id);
		$terms = Term::all();
		$students = Student::where('master_id', '=', $user->id)
			->leftjoin('terms', 'students.term_id', '=', 'terms.id')
			->leftjoin('users', 'students.refree_id', '=', 'users.id')
			->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'users.name', 'terms.title')
			->get();
                return view('SeeStuMaster', compact('students', 'terms'));
	}

        public function ReportStuMaster(){
                $terms = Term::all();
                $id = session()->get('key');
                $students = Student::where('master_id', '=', $id)
                    ->leftjoin('terms', 'students.term_id', '=', 'terms.id')
                    ->join('users as u1', 'students.refree_id', '=', 'u1.id')
                    ->join('users as u2', 'students.master_id', '=', 'u2.id')
                    ->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'u1.name as refree_id', 'u2.name as master_id', 'terms.title')
                    ->get();
                return view('ReportStuMaster', compact('students', 'terms'));
        }



	public function TermFilter(Term $term){

		$this->validate(request(), [
			'term_id' => 'Numeric'
		]);

		$term = request('term_id');

		$terms = Term::all();
		$id = session()->get('key');
		$matchThese = ['master_id' => $id, 'term_id' => $term];
		$students = Student::where($matchThese)
			->leftjoin('terms', 'students.term_id', '=', 'terms.id')
			->leftjoin('users', 'students.refree_id', '=', 'users.id')
			->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'users.name', 'terms.title')
			->get();
		return view('SeeStuMaster', compact('students', 'terms', 'term'));
	}

        public function ReportTermFilter(Term $term){

                $this->validate(request(), [
                        'term_id' => 'Numeric'
                ]);

                $term = request('term_id');
                $terms = Term::all();
                $id = session()->get('key');
                $matchThese = ['master_id' => $id, 'term_id' => $term];
                $students = Student::where($matchThese)
                    ->leftjoin('terms', 'students.term_id', '=', 'terms.id')
                    ->join('users as u1', 'students.refree_id', '=', 'u1.id')
                    ->join('users as u2', 'students.master_id', '=', 'u2.id')
                    ->select('students.id', 'students.full_name', 'students.title_project', 'students.stu_number', 'students.deadline', 'students.defence_situation', 'students.complementary', 'u1.name as refree_id', 'u2.name as master_id', 'terms.title')
                    ->get();
                return view('ReportStuMaster', compact('students', 'terms', 'term'));
        }

        public function AddMasterProcess(){

                $this->validate(request(), [
                        'name' => 'Required|String|max:255',
                        'email' => 'Required|String|email|max:255|unique:users',
			'password' => 'Required|String',
			'degree_id' => 'Required|Numeric'
                ], [
                        'name.required' => 'The fullname field is required.',
                        'email.required' => 'The username field is required.',
			'password.required' => 'The password field is required.',
			'degree_id.required' => 'The degree field is required.'
                ]);
                User::create([
                        'name' => request('name'),
                        'email' => request('email'),
			'password' => Hash::make(request('password')),
			'degree_id' => request('degree_id'),
			'group_manager' => 0
                ]);
                session()->flash('added', 'This master was successfully saved.');
                return redirect('/AddMaster');
        }

	public function EditMaster(User $user){
		$degrees = Degree::all();
		$user = User::where('users.id', '=', $user->id)
			->join('degrees', 'users.degree_id', '=', 'degrees.id')
			->select('users.id', 'users.name', 'users.email', 'degrees.title')
			->get();
                return view('EditMaster', compact('user', 'degrees'));
        }

        public function UpdateMaster(User $user){
		$this->validate(request(), [
                        'name' => 'Required|String',
                        'email' => 'Required|String|email',
			'degree_id' => 'Required|Numeric'
                ], [
                        'email.required' => 'The fullname field is required.',
                        'email.required' => 'The email field is required.',
			'degree_id.required' => 'The degree field is required.'
                ]);
                User::where('id', $user->id)->update([
                        'name' => request('name'),
                        'email' => request('email'),
			'degree_id' => request('degree_id')
                ]);
                session()->flash('updated', 'This master was successfully updated.');
                return redirect('/SeeMaster');
        }

        public function DeleteMaster(User $user){
                User::where('id', $user->id)->delete();
                session()->flash('removed', 'This master was successfully removed.');
                return redirect('/SeeMaster');
        }
}
