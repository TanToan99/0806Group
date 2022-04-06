<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report</title>
</head>
<body>
@extends('layouts.QACo')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Report Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form class="container-fluid" action="/Report" method ="post" >
      @csrf
        <!-- Small boxes (Stat box) -->
        <div class="dropdown">
            <select name="department" id="" class="dropdown">
                @foreach($departments as $department) 
                <option value="{{$department -> name}}">{{$department -> name}}</option>
                @endforeach
            </select>  
            <select name="user" id="" class="dropdown">
                @foreach($users as $User)
                <option value="{{$User -> name}}">{{$User -> name}}</option>
                @endforeach
            </select>  
        </div>
        <!-- /.row (main row) -->
         <!-- TO DO List -->
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Report table
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <ul class="todo-list">
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fa fa-ellipsis-v"></i>
                      <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <input type="checkbox" value="Inappropriate content." name="checkbox"> Inappropriate content
                    <!-- todo text -->
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fa fa-ellipsis-v"></i>
                      <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <input type="checkbox" value="Idea using words incorrectly." name="checkbox"> Idea using words incorrectly.
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fa fa-ellipsis-v"></i>
                      <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <input type="checkbox" value="" name="checkbox">Spam comments and abuse.
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fa fa-ellipsis-v"></i>
                      <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <input type="checkbox" value="" name="checkbox">Plagiarize ideas, use other people's ideas.
                   
                  </li>
                </ul>
                <div class="text-others">
                <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">
                  <i class="fa fa-pie-chart mr-1"></i>
                  Others reason
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <textarea class="chart tab-pane active" id="revenue-chart " name="reason"
                       style="position: relative; height: 300px; width: 920px"></textarea>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
              </div><!-- /.card-body -->
            </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <button type="submit" value ="submit" class="btn btn-info float-right">Send</button>
              </div>
          </div>
            <!-- /.card -->
      </form><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
    

@endsection
</body>
</html>