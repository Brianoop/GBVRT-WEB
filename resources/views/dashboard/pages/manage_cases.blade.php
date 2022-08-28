@extends('dashboard.layouts.default')

@section('content')
    <div class="content-navigation-section">
        <h5>Manage Cases</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="container">
        <hr>

        <div class="alert alert-info">
            All Cases ( {{ count($cases) }}  )
        </div>
        <br>
        <div class="alert alert-info">
            Closed Cases (10)
        </div>
        <hr>
        <div class="row">
            @for ($x = 1; $x <= 4; $x++)
                <div class="col-md-4">
                    <div class="card shadow-sm bg-light p-2 m-1" style="height: 16rem;">
                        <div>
                            <label for="" style="font-size: 0.9rem; font-weight: bold;"><span
                                    style="padding-right: 1rem;"><i
                                        class="fa fa-user-circle fa-sm text-warning"></i></span>Orishabe Joseline</label>
                            <a href="#" style="float: right; margin-right: 0.4rem;"><span><i
                                        class="fa fa-ellipsis-h fa-sm text-secondary"></i></span></a>
                        </div>
                        <hr>
                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-tag text-danger shawdowm-sm"></i></span>Physical Violence</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-map fa-sm text-secondary shawdowm-sm"></i></span> Laroo</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-book-open fa-sm text-info shawdowm-sm"></i></span> Status: Open</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-file fa-sm text-success shawdowm-sm"></i></span> Files (9)</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-users fa-sm text-secondary shawdowm-sm"></i></span>Receivers (3)</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-calendar-alt fa-sm text-primary shawdowm-sm"></i></span> Reported on 12th
                            Dec 2021</label>


                        <br>
                        <div class="d-flex flex-row">
                            <a href="{{ url('/view-case-detail-as-admin') }}"
                                class="btn btn-outline-info btn-sm  shadow-sm text-sm"><span style="padding-right: 1rem;"><i
                                        class="fa fa-eye fa-sm shadow-sm"></i></span><span
                                    style="font-size: 0.8rem;">View</span></a>
                            <a href="#" class="btn btn-outline-secondary btn-sm  shadow-sm text-sm"><span
                                    style="padding-right: 1rem;"><i class="fa fa-cog fa-sm shadow-sm"></i></span><span
                                    style="font-size: 0.8rem;">Manage</span></a>
                        </div>
                    </div>
                </div>
            @endfor

        </div>

    </div>
@endsection
