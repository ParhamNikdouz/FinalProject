@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
		<div class="panel-body">
					<?php $group_manager = $master->group_manager ?>
					<?php if($group_manager == 1) : ?>
					<a href="/AddStu">Add Student</a>
					<br/>
					<a href="/SeeStu">See Students List</a>
					<br/>
					<a href="/AddMaster">Add Master</a>
					<br/>
					<a href="/SeeMaster">See Masters List</a>
					<br/>
					<a href="/SeeDegree">See Degrees</a>
					<br/>
					
					<?php else: ?>
					<a href="/AddStu">Add Students</a>
					<br/>
					<a href="/SeeStu">See Students List</a>
					<?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
