@extends('layouts.main')

@section('title','Home')

@section('content')
@include('_shared._header')
<div class="card text-white bg-secondary my-5 py-3 text-center">
    <div class="card-body">
        <p class="text-white m-0" style="font-family: Georgia, serif;">
            More information about University of Greenwich
        </p>
        <i class="fas fa-arrow-down"></i>
    </div>
</div>
<div class="container px-4 px-lg-5">
    <!-- Heading Row-->
    <div class="row align-items-center my-5">
        <div class="mb-5">
            <div class="card h-100 border-light">
            <img class="card-img-top" src="https://media-exp1.licdn.com/dms/image/C4D16AQFi_ge0eaXLXA/profile-displaybackgroundimage-shrink_200_800/0/1621947470738?e=1649894400&v=beta&t=_dIkTACPLTPu6qF-iA-az61KJbAAjjxJkpvnqo2vUBQ" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text h6" style="text-indent: 50px; font-family: Tahoma, sans-serif;">The University of Greenwich
            is well-known for its high teaching quality, research excellence,
            the diversity of its students, its beautiful, historic campuses in south-east
            London and Kent and its high student satisfaction.</p>
                </div>
            </div>
        </div>
        <iframe height="500px" weight="600px" src="https://www.youtube.com/embed/oOD96ZHeD9c" title="Introduction Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-4 mb-5">
            <div class="card h-100 border-info">
            <img class="card-img-top" src="https://www.gre.ac.uk/__data/assets/image/0017/6155/varieties/v800.jpg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title h4">Undergraduate study</h2>
                    <p class="card-text">Study for an undergraduate degree at the University of Greenwich.
                        Find your ideal course from a selection of over 200 and discover more about the student experience.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100 border-warning">
            <img class="card-img-top" src="https://www.gre.ac.uk/__data/assets/image/0008/120041/varieties/v800.jpg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title h4">International study</h2>
                    <p class="card-text">Most of our postgraduate courses offer flexible learning options
                        such as distance learning or part-time study.
                        Find your ideal course and discover our facilities and subject experts.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100 border-success">
            <img class="card-img-top" src="https://www.gre.ac.uk/__data/assets/image/0015/6504/varieties/v800.jpg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title h4">Undergraduate study</h2>
                    <p class="card-text">We offer a wide variety of courses and ways to study for those coming from abroad.
                        If you are an international student looking to continue your education in the UK then we can help you.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection