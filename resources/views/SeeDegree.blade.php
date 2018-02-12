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
            <div class="panel panel-default">
               <div class="panel-heading">Degrees</div>
                <div class="panel-body">           
				  <table class="table table-striped">
					<thead>
					  <tr>
						<th>#</th>
						<th>Title</th>
						<th>Max Student</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@foreach($degrees as $degree)
						<tr>
							<td><?php $i++; echo $i; ?></td>
							<td>{{ $degree->title }}</td>
							<td><span>{{ $degree->max_student }}</span></td>
							<td><a href="{{ route('EditDegree', ['id' => $degree->id ]) }}">
								<button type="submit" class="btn btn-info">
										Edit
								</button>
							</a></td>
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

