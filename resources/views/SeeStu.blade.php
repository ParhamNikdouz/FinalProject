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
				    <a href="/AddStu">Add Student</a>
				    <br/>
				    <a href="/ReportStu">Report Student</a>
				    <br/>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
			@if($message = session('updated'))
				<div class="alert alert-info">
					{{ $message }}
				</div>
			@endif
		</div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
			@if($message = session('removed'))
				<div class="alert alert-warning">
					{{ $message }}
				</div>
			@endif
		</div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
				<div class="panel-heading">Filter Term</div>
                <div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ route('SeeStu', ['id' => $terms[0]->id ]) }}">
                        {{ csrf_field() }}
						<div class="form-group">

                            <div class="col-xs-4">
								<select class="form-control" id="term_id" name="term_id">
									@foreach($terms as $term)
								  	<option value="{{ $term->id }}">{{ $term->title }}</option>
								  	@endforeach
								</select>
							</div>
							<a href="{{ route('SeeStu', ['id' => $terms[0]->id ]) }}">
								<button type="submit" class="btn btn-success">
									Filter
								</button>
							</a>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
				<div class="panel-heading">Students List</div>
                <div class="panel-body">           
				  <table class="table table-striped">
					<thead>
					  <tr>
						<th>#</th>
						<th>FullName</th>
						<th>Title Project</th>
						<th>Student Number</th>
						<th>Term</th>
						<th>Deadline</th>
						<th>Refree</th>
						<th>Defenced</th>
						<th>Extended</th>
						<th></th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@foreach($students as $student)
						<tr>
							<td><?php $i++; echo $i; ?></td>
							<td>{{ $student->full_name }}</td>
							<td><span>{{ $student->title_project }}</span></td>
							<td><span>{{ $student->stu_number }}</span></td>
							<td><span>{{ $student->title }}</span></td>
							<td><span>{{ $student->deadline }}</span></td>
							<td><span>{{ $student->name }}</span></td>
							@if($student->defence_situation=="on")
							<td><img src="{{ url('/tik.png') }}" style="margin-left: 20px;width: 30px; height: 30px;"/></td>
							@else
							<td></td>
							@endif
							@if($student->complementary=="on")
							<td><img src="{{ url('/tik.png') }}" style="margin-left: 20px;width: 30px; height: 30px;"/></td>
							@else
							<td></td>
							@endif
							<td><a href="{{ route('EditStu', ['id' => $student->id ]) }}">
								<button type="submit" class="btn btn-info">
										Edit
								</button>
							</a></td>
							<td>
								<form class="form-horizontal" method="POST" action="{{ route('DeleteStu', ['id' => $student->id ]) }}">
			                        {{ csrf_field() }}								
									<a href="{{ route('DeleteStu', ['id' => $student->id ]) }}">
										<button type="submit" class="btn btn-danger">
											Remove
										</button>
									</a>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				  </table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

