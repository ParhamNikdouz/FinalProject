@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
					<a href="/home">Home</a>
					<br/>
					<!--<a href="/SeeStu">See Students List</a>
					<br/>-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
                        @if($message = session('updated'))
                                <div class="alert alert-success">
                                        {{ $message }}
                                </div>
                        @endif
                </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
			@if(count($errors))
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Student</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('UpdateStu', ['id' => $student[0]->id ]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">FullName</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $student[0]->full_name }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Title Project</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $student[0]->title_project }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Student Number</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" value="{{ $student[0]->stu_number }}" >
                            </div>
                        </div>

						<div class="form-group">
                            <label for="deadline" class="col-md-4 control-label">Deadline</label>

                            <div class="col-md-6">
                                <input id="deadline" type="text" class="form-control" name="deadline" value="{{ $student[0]->deadline }}">
                            </div>
                        </div>

						<div class="form-group">

							<label for="term_id" class="col-md-4 control-label">Term</label>

		                        <div class="col-md-4">
									<select class="form-control" id="term_id" name="term_id">
										@foreach($terms as $term)
									  	<option value="{{ $term->id }}" {{ $student[0]->title == $term->title ? 'selected' : '' }}>{{ $term->title }}</option>
									  	@endforeach
									</select>
								</div>
                    	</div>

						@if($gp_manager == "1")
						<div class="form-group">

							<label for="refree_id" class="col-md-4 control-label">Refree</label>

		                        <div class="col-md-4">
									<select class="form-control" id="refree_id" name="refree_id">
										@foreach($refrees as $refree)
									  	<option value="{{ $refree->id }}" {{ $student[0]->name == $refree->name ? 'selected' : '' }}>{{ $refree->name }}</option>
									  	@endforeach
									</select>
								</div>
                    	</div>
						@else
						<div class="form-group">

							<label for="refree_id" class="col-md-4 control-label">Refree</label>

		                        <div class="col-md-4">
									<select class="form-control" id="refree_id" name="refree_id" disabled>
										@foreach($refrees as $refree)
									  	<option value="{{ $refree->id }}" {{ $student[0]->name == $refree->name ? 'selected' : '' }}>{{ $refree->name }}</option>
									  	@endforeach
									</select>
								</div>
                    	</div>
						@endif

						<div class="form-group">
                            <label for="defence" class="col-md-4 control-label">Defenced</label>

                            <div class="col-md-1">
                                <input id="defence" type="checkbox" class="form-control" name="defence"  {{ ($student[0]->defence_situation) == "on" ? 'checked' : '' }}>
                            </div>
                        </div>

						<div class="form-group">
                            <label for="complementary" class="col-md-4 control-label">Extended</label>

                            <div class="col-md-1">
                                <input id="complementary" type="checkbox" class="form-control" name="complementary"  {{ ($student[0]->complementary) == "on" ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
