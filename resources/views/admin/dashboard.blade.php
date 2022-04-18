@extends('layouts.admin')
@section('custom-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /><!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <title>Dashboard</title>
    <link rel="icon" href="https://cms.greenwich.edu.vn/pluginfile.php/1/theme_adaptable/favicon/1640228920/favicon.ico">
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $semester }}<sup style="font-size: 20px"></sup></h3>

                            <p>Total Semester</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-light fa-anchor"></i>
                        </div>
                        <a href="{{ route('admin.semester.index') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $department }}<sup style="font-size: 20px"></sup></h3>

                            <p>Total Department</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-solid fa-building"></i>
                        </div>
                        <a href="{{ route('admin.department.index') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $account }}</h3>

                            <p>Total User Account</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.account.index') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $mission }}</h3>

                            <p>Total Missions</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-light fa-bars-progress"></i>
                        </div>
                        <a href="{{ route('admin.missions.index') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>
    @if (auth()->user()->hasRole('admin'))
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div id="chartPerIdeaByDepartment" style="height: 300px; width: 100%;"></div>
                </div>
                <div class="col-md-6 mt-3">
                    <div id="chartCountIdeaByDepartment" style="height: 300px; width: 100%;"></div>
                </div>
                <div class="col-md-6 mt-3">
                    <div id="chartCountContribute" style="height: 300px; width: 100%;"></div>
                </div>
                <div class="col-md-6 mt-3">
                    <div id="chartCounIdeaBySemester" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('custom-js')

    @if (auth()->user()->hasRole('admin'))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"
                integrity="sha512-FJ2OYvUIXUqCcPf1stu+oTBlhn54W0UisZB/TNrZaVMHHhYvLBV9jMbvJYtvDe5x/WVaoXZ6KB+Uqe5hT2vlyA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
            window.onload = function() {
                var chart = new CanvasJS.Chart("chartPerIdeaByDepartment", {
                    animationEnabled: true,
                    title: {
                        text: "Percent of ideas each department",
                        fontFamily: "Arial",
                        fontSize: 20
                    },
                    data: [{
                        type: "pie",
                        startAngle: 270,
                        yValueFormatString: "##0.00\"%\"",
                        fontFamily: "Arial",
                        fontSize: 12,
                        indexLabel: "{label} - {y}",
                        dataPoints: [{
                                y: {{ $count_support_per }},
                                label: "Support"
                            },
                            {
                                y: {{ $count_academic_per }},
                                label: "Acadmic"
                            }
                        ]
                    }]
                });
                var chart2 = new CanvasJS.Chart("chartCountIdeaByDepartment", {
                    title: {
                        text: "Number of ideas each department",
                        fontFamily: "Arial",
                        fontSize: 20
                    },
                    data: [{
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        dataPoints: [{
                                label: "academic",
                                y: {{ $count_academic }}
                            },
                            {
                                label: "support",
                                y: {{ $count_support }}
                            }
                        ]
                    }]
                });
                var chart3 = new CanvasJS.Chart("chartCounIdeaBySemester", {
                    title: {
                        text: "Number of ideas each semester",
                        fontFamily: "Arial",
                        fontSize: 20
                    },
                    data: [{
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        dataPoints: [
                           
                        ]
                    }]
                });
                var chart4 = new CanvasJS.Chart("chartCountContribute", {
                    title: {
                        text: "Contribute in each department",
                        fontFamily: "Arial",
                        fontSize: 20
                    },
                    data: [{
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        dataPoints: [{
                                label: "academic",
                                y: {{ $count_academic_contribute }}
                            },
                            {
                                label: "support",
                                y: {{ $count_support_contribute }}
                            }
                        ]
                    }]
                });
                chart.render();
                chart2.render();
                chart3.render();
                chart4.render();
            }
        </script>
    @endif
@endsection
