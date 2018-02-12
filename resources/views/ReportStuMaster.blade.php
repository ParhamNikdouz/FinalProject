@extends('layouts.app')

@section('content')
<div class="container" id="dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
            </div>
        </div>
    </div>
</div>


<div class="container" id="home">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
					<a href="/home">Home</a>
					<br/>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="term">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
				<div class="panel-heading">Filter Term</div>
                <div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ route('ReportStuMaster', ['id' => $terms[0]->id ]) }}">
                        {{ csrf_field() }}
						<div class="form-group">

                            <div class="col-xs-4">
								<select class="form-control" id="term_id" name="term_id">
									@foreach($terms as $term)
								  	<option value="{{ $term->id }}">{{ $term->title }}</option>
								  	@endforeach
								</select>
							</div>
							<button type="submit" class="btn btn-success">
								Filter
							</button>
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
            <div class="panel panel-default" style="direction:rtl;">
				<div class="panel-heading">لیست دانشجویان درس پروژه</div>
                <div class="panel-body">           
				  <table class="table table-bordered">
					<thead>
					  <tr>
						<th>#</th>
						<th>نام و نام خانوادگی</th>
						<th>عنوان پروژه</th>
						<th>شماره دانشجویی</th>
						<th>ترم</th>
						<th>زمان تحویل</th>
						<th>نام استاد</th>
						<th>نام داور</th>
						<th>دفاع شده</th>
						<th>تمدیدی</th>
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
							<td><span>{{ Auth::user()->name }}</span></td>
							<td><span>{{ $student->name }}</span></td>
							@if($student->defence_situation=="on")
							<td><img src="{{ url('/tik.png') }}" 	style="margin-left: 20px;width: 30px; height: 30px;"/></td>
							@else
							<td></td>
							@endif
							@if($student->complementary=="on")
							<td><img src="{{ url('/tik.png') }}" style="margin-left: 20px;width: 30px; height: 30px;"/></td>
							@else
							<td></td>
							@endif
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

