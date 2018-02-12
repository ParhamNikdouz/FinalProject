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
				    <a href="/AddMaster">Add Masters</a>
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
               <div class="panel-heading">Masters List</div>
                <div class="panel-body">           
				  <table class="table table-striped">
					<thead>
					  <tr>
						<th>#</th>
						<th>FullName</th>
						<th>Email</th>
						<th>Degree</th>
						<th></th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@foreach($masters as $master)
						<tr>
							<td><?php $i++; echo $i; ?></td>
							<td>{{ $master->name }}</td>
							<td><span>{{ $master->email }}</span></td>
							<td><span>{{ $master->title }}</span></td>
							<td><a href="{{ route('SeeStuMaster', ['id' => $master->id ]) }}">
								<button type="submit" class="btn btn-info">
										See Students
								</button>
							</a></td>
							<td><a href="{{ route('EditMaster', ['id' => $master->id ]) }}">
								<button type="submit" class="btn btn-info">
										Edit
								</button>
							</a></td>
							<td>
								<form class="form-horizontal" method="POST" action="{{ route('DeleteMaster', ['id' => $master->id ]) }}">
			                        {{ csrf_field() }}								
									<a href="{{ route('DeleteMaster', ['id' => $master->id ]) }}">
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

