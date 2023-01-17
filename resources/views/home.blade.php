@extends('layouts.template')

@section('main')
    <h1>Faciliteitbeheer</h1>

    <h4>Welkom @auth{{ auth()->user()->name }}@endauth()</h4>

    <p>  Deze applicatie maakt het makkelijker om dossiers van studenten te beheren. Ook kan u faciliteiten en functiebeperkingen aan deze studenten toevoegen.
        Verder is het beheren van opleidingen, personen en rollen mogelijk.
        Vervolgens kan u de enquêtes beheren, afdrukken en uploaden.
        Als SVK Docent kan u ook de docenten afvinken </p>

    @auth
        @if(auth()->user()->education_role_people->role_id == 1)
            <div class="">
                <div class="row">
                    <div class="col-sm-12 col-md-3 mt-3">
                        <div class="card" style="height: 250px">
                            <div class="card-body">
                                <h5 class="card-title text-center">Enquête
                                    <i class="fas fa-file-alt"></i></h5>
                                    <hr>
                                <a href="{{action('admin\QuestionController@index')}}">
                                    <p>Vragen Beheren</p></a>

                                <a href="{{action('admin\GdprController@index')}}">
                                    <p>GDPR beheren</p></a>

                                <a href="{{action('admin\EvaluationController@index')}}">
                                    <p>Evaluaties
                                        beheren</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 mt-3">
                        <div class="card" style="height: 250px">
                            <div class="card-body">
                                <h5 class="card-title text-center">Dossier <i class="fas fa-archive"></i></h5>

                                <hr>
                                <a href="{{action('admin\DossierController@index')}}"><p>Dossier beheren</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 mt-3">
                        <div class="card" style="height: 250px">
                            <div class="card-body">
                                <h5 class="card-title text-center">Faciliteiten en beperkingen <i class="fas fa-folder-plus"></i></h5>
                                <hr>
                                <a href="/managefd/disability"><p>
                                        Functiebeperkingen beheren
                                    </p></a>

                                <a href="/managefd/facility"><p>
                                        Faciliteiten beheren
                                    </p></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 mt-3">
                        <div class="card" style="height: 250px">
                            <div class="card-body">
                                <h5 class="card-title text-center">Beheer <i class="fas fa-tasks"></i></h5>
                                <hr>
                                <a href="{{action('admin\EducationController@index')}}"><p>Opleidingen beheren</p></a>
                                <a href="{{action('admin\PersonController@index')}}"><p>Personen beheren</p></a>
                                <a href="{{action('admin\RoleController@index')}}"><p>Rollen beheren</p></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(auth()->user()->education_role_people->role_id == 1 || auth()->user()->education_role_people->role_id == 2)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">SVK Docent
                                        <i class="fas fa-check"></i>
                                    </h5>
                                <hr>
                                    <br>
                                    <a href="{{action('admin\StudentCheckOffController@index')}}">
                                        <p>
                                            Studenten afvinken
                                        </p>
                                        <a/>
                                        </a></div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @endauth
@endsection
