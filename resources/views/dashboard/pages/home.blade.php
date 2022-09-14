@extends('dashboard.layouts.default')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Overview</h1>

        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Welcome, {{ Auth::user()->name }}!</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-9">

                            @if (Auth::user()->type == 3)
                                <div>
                                    Hello, to report a violence case, go to the report violence menu and fill in the forms
                                    to report the violence case!
                                </div>
                            @elseif (Auth::user()->type == 2)
                                <div>
                                    Hello, to view the violence cases reported by users, click the violence cases menu item!
                                </div>
                            @elseif (Auth::user()->type == 1)
                                <div>
                                    Hello Admin, to manage GBVRT, use the features on the menu.
                                </div>
                            @endif
                        </div>
                        <!--//col-->
                        <div class="col-12 col-lg-3">

                            @if (Auth::user()->type == 3)
                                <a class="btn app-btn-primary" href="{{ route('report.case') }}"><svg width="1em"
                                        height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down me-2"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z" />
                                        <path fill-rule="evenodd"
                                            d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z" />
                                    </svg>Report Case</a>
                            @elseif (Auth::user()->type == 2)
                                <a class="btn app-btn-primary"
                                    href="{{ url('/activists-cases' . '/' . auth()->user()->id) }}"><svg width="1em"
                                        height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down me-2"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z" />
                                        <path fill-rule="evenodd"
                                            d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z" />
                                    </svg>View Cases</a>
                            @endif

                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!--//app-card-body-->

            </div>
            <!--//inner-->
        </div>
        <!--//app-card-->

        @if (Auth::user()->type == 3)
            <div class="row g-4 mb-4" style="margin: auto !important;">
                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total Cases</h4>
                            <div class="stats-figure" id="my_total_cases">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>


                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Complaints</h4>
                            <div class="stats-figure" id="my_total_complaints">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total Chats</h4>
                            <div class="stats-figure" id="my_total_chats">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>

            </div>
        @endif

        @if (Auth::user()->type == 2)
            <div class="row g-4 mb-4" style="margin: auto !important;">
                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total Cases</h4>
                            <div class="stats-figure" id="activists_cases">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>


                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Complaints</h4>
                            <div class="stats-figure" id="my_total_complaints">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total Chats</h4>
                            <div class="stats-figure" id="my_total_chats">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>

            </div>
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Reported Cases</h4>
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <div class="card-header-action">
                                        <!-- <a href="charts.html">More charts</a> -->
                                    </div>
                                    <!--//card-header-actions-->
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="mb-3 d-flex">
                                <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                    <option value="1" selected>This week</option>
                                    <option value="2">Today</option>
                                    <option value="3">This Month</option>
                                    <option value="3">This Year</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="canvas-linechart"></canvas>
                            </div>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Active Users</h4>
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <div class="card-header-action">
                                        <!-- <a href="charts.html">More charts</a> -->
                                    </div>
                                    <!--//card-header-actions-->
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="mb-3 d-flex">
                                <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                    <option value="1" selected>This week</option>
                                    <option value="2">Today</option>
                                    <option value="3">This Month</option>
                                    <option value="3">This Year</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="canvas-barchart"></canvas>
                            </div>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->

            </div>
        @endif

        @if (Auth::user()->type == 1)
            <div class="row g-4 mb-4" style="margin: auto !important;">
                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total Cases</h4>
                            <div class="stats-figure" id="total_cases">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>


                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Complaints</h4>
                            <div class="stats-figure" id="total_complaints">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">SMS Credit Balance</h4>
                            <div class="stats-figure sms_balance"></div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Total Users</h4>
                            <div class="stats-figure" id="total_users">0</div>

                        </div>

                        <a class="app-card-link-mask" href="#"></a>
                    </div>

                </div>


            </div>
            <br>
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Reported Cases</h4>
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <div class="card-header-action">
                                        <!-- <a href="charts.html">More charts</a> -->
                                    </div>
                                    <!--//card-header-actions-->
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="mb-3 d-flex">
                                <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                    <option value="1" selected>This week</option>
                                    <option value="2">Today</option>
                                    <option value="3">This Month</option>
                                    <option value="3">This Year</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="canvas-linechart"></canvas>
                            </div>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Active Users</h4>
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <div class="card-header-action">
                                        <!-- <a href="charts.html">More charts</a> -->
                                    </div>
                                    <!--//card-header-actions-->
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="mb-3 d-flex">
                                <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                    <option value="1" selected>This week</option>
                                    <option value="2">Today</option>
                                    <option value="3">This Month</option>
                                    <option value="3">This Year</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="canvas-barchart"></canvas>
                            </div>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->

            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-progress-list h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Reported Cases by Category</h4>
                                </div>
                             
                                {{-- <div class="col-auto">
                                    <div class="card-header-action">
                                        <a href="#">All Cases</a>
                                    </div>
                                </div> --}}
                             
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body">
                            <div class="item p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="title mb-1 ">Physical Abuse</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--//col-->
                                    <div class="col-auto">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                            class="bi bi-chevron-right" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                    <!--//col-->
                                </div>
                                <!--//row-->
                                <a class="item-link-mask" href="#"></a>
                            </div>
                            <!--//item-->


                            <div class="item p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="title mb-1 ">Female Genital Mutilation</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 34%;"
                                                aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--//col-->
                                    <div class="col-auto">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                            class="bi bi-chevron-right" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                    <!--//col-->
                                </div>
                                <!--//row-->
                                <a class="item-link-mask" href="#"></a>
                            </div>
                            <!--//item-->

                            <div class="item p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="title mb-1 ">Psychological Torture
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 68%;"
                                                aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--//col-->
                                    <div class="col-auto">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                            class="bi bi-chevron-right" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                    <!--//col-->
                                </div>
                                <!--//row-->
                                <a class="item-link-mask" href="#"></a>
                            </div>
                            <!--//item-->

                            <div class="item p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="title mb-1 ">Sexual Abuse
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 52%;"
                                                aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--//col-->
                                    <div class="col-auto">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                            class="bi bi-chevron-right" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </div>
                                    <!--//col-->
                                </div>
                                <!--//row-->
                                <a class="item-link-mask" href="#"></a>
                            </div>
                            <!--//item-->

                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-stats-table h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Stats List</h4>
                                </div>

                                {{-- <div class="col-auto">
                                    <div class="card-header-action">
                                        <a href="#">View report</a>
                                    </div>
                                </div> --}}

                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th class="meta">Source</th>
                                            <th class="meta stat-cell">Number</th>
                                            {{-- <th class="meta stat-cell">Today</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">Total users</a></td>
                                            <td class="stat-cell">
                                                <span class="total_users">0</span>
                                            </td>
                                            {{-- <td class="stat-cell">30%</td> --}}
                                        </tr>
                                        <tr>
                                            <td><a href="#">Total activists</a></td>
                                            <td class="stat-cell">
                                                <span class="total_activists">0</span>
                                            </td>
                                            {{-- <td class="stat-cell">23%</td> --}}
                                        </tr>
                                        <tr>
                                            <td><a href="#">Total chats</a></td>
                                            <td class="stat-cell">
                                                <span class="total_chats">0</span>
                                            </td>
                                            {{-- <td class="stat-cell">20%</td> --}}
                                        </tr>
                                        <tr>
                                            <td><a href="#">Total cases</a></td>
                                            <td class="stat-cell">
                                                <span class="total_cases">0</span>
                                            </td>
                                            {{-- <td class="stat-cell">-</td> --}}
                                        </tr>
                                        <tr>
                                            <td><a href="#">Total complaints </a></td>
                                            <td class="stat-cell">
                                                <span class="total_complaints">0</span>
                                            </td>
                                            {{-- <td class="stat-cell">15%</td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--//table-responsive-->
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
            </div>


            {{-- <div class="row g-4 mb-4">
                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                            <path fill-rule="evenodd"
                                                d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                    </div>
                                    <!--//icon-holder-->

                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">Manage Users</h4>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body px-4">

                            <div class="intro">Manage users by creating user accounts, editing user details and deleting
                                accounts.</div>
                        </div>
                        <!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ route('user.account') }}">Manage Users</a>
                        </div>
                        <!--//app-card-footer-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-code-square"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                            <path fill-rule="evenodd"
                                                d="M6.854 4.646a.5.5 0 0 1 0 .708L4.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0zm2.292 0a.5.5 0 0 0 0 .708L11.793 8l-2.647 2.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708 0z" />
                                        </svg>
                                    </div>
                                    <!--//icon-holder-->

                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">Manage Chats</h4>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body px-4">

                            <div class="intro">Manage chats by deleting some chats and disabling chats.</div>
                        </div>
                        <!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="#">Manage Chats</a>
                        </div>
                        <!--//app-card-footer-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->

                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tools"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z" />
                                            <path fill-rule="evenodd"
                                                d="M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z" />
                                        </svg>
                                    </div>
                                    <!--//icon-holder-->

                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">Settings</h4>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body px-4">

                            <div class="intro">Manage GBVRTs system settings.</div>
                        </div>
                        <!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="#">Manage</a>
                        </div>
                        <!--//app-card-footer-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
            </div> --}}
        @endif
    </div>



    @csrf



    @if (auth()->user()->type == 1)
        <script>
            $(document).ready(function() {

                var _token = $("input[name='_token']").val();

                loadDashboardStatistics(_token);

            });

            function loadDashboardStatistics(_token) {
                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('dashboard-stats') }}",
                    data: JSON.stringify({
                        _token
                    }),
                    contentType: "application/json",
                    processData: true,
                    success: function(response) {
                        console.log(response);


                        const total_chats = response.total_chats;
                        const total_complaints = response.total_complaints;
                        const total_cases = response.total_cases;
                        const total_users = response.total_users;
                        const total_activists = response.total_activists;
                        const total_victims = response.total_victims;
                        const sms_balance = response.sms_balance;
                        const total_reported_users = response.total_reported_users;

                        const my_total_cases = response.my_total_cases;
                        const my_total_complaints = response.my_total_complaints;
                        const my_total_chats = response.my_total_chats;

                        const activists_cases = response.activists_cases;



                        document.getElementById('total_cases').innerHTML = total_cases;
                        document.getElementById('total_complaints').innerHTML = total_complaints;
                        // document.getElementById('total_chats').innerHTML = total_chats;
                        document.getElementById('total_users').innerHTML = total_users;

                        document.querySelector('.total_users').innerHTML = total_users;
                        document.querySelector('.total_cases').innerHTML = total_cases;
                        document.querySelector('.total_activists').innerHTML = total_activists;
                        document.querySelector('.total_complaints').innerHTML = total_complaints;
                        document.querySelector('.total_chats').innerHTML = total_chats;
                        document.querySelector('.sms_balance').innerHTML = sms_balance;






                        // document.getElementById('total_chats').innerHTML = total_chats;
                        // document.getElementById('total_complaints').innerHTML = total_complaints;
                        // document.getElementById('total_cases').innerHTML = total_cases;

                        // document.getElementById('total_activists').innerHTML = total_activists;
                        // document.getElementById('total_victims').innerHTML = total_victims;
                        // document.getElementById('total_users').innerHTML = total_users;
                        // document.getElementById('total_reported_users').innerHTML = total_reported_users;




                        // alert(response);
                        //  window.location.reload();
                    },
                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                        // alert(data);


                    },
                });
            }
        </script>
    @elseif(auth()->user()->type == 2)
        <script>
            $(document).ready(function() {

                var _token = $("input[name='_token']").val();

                loadDashboardStatistics(_token);

            });

            function loadDashboardStatistics(_token) {
                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('dashboard-stats') }}",
                    data: JSON.stringify({
                        _token
                    }),
                    contentType: "application/json",
                    processData: true,
                    success: function(response) {
                        console.log(response);


                        const my_total_cases = response.my_total_cases;
                        const my_total_complaints = response.my_total_complaints;
                        const my_total_chats = response.my_total_chats;
                        const activists_cases = response.activists_cases;



                        document.getElementById('activists_cases').innerHTML = activists_cases;
                        document.getElementById('my_total_complaints').innerHTML = my_total_complaints;
                        document.getElementById('my_total_chats').innerHTML = my_total_chats;

                    },
                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                        // alert(data);


                    },
                });
            }
        </script>
    @else
        <script>
            $(document).ready(function() {

                var _token = $("input[name='_token']").val();

                loadDashboardStatistics(_token);

            });

            function loadDashboardStatistics(_token) {
                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('dashboard-stats') }}",
                    data: JSON.stringify({
                        _token
                    }),
                    contentType: "application/json",
                    processData: true,
                    success: function(response) {
                        console.log(response);


                        const total_chats = response.total_chats;
                        const total_complaints = response.total_complaints;
                        const total_cases = response.total_cases;
                        const total_users = response.total_users;
                        const total_activists = response.total_activists;
                        const total_victims = response.total_victims;
                        const sms_balance = response.sms_balance;
                        const total_reported_users = response.total_reported_users;

                        const my_total_cases = response.my_total_cases;
                        const my_total_complaints = response.my_total_complaints;
                        const my_total_chats = response.my_total_chats;

                        const activists_cases = response.activists_cases;

                        document.getElementById('my_total_cases').innerHTML = my_total_cases;
                        document.getElementById('my_total_complaints').innerHTML = my_total_complaints;
                        document.getElementById('my_total_chats').innerHTML = my_total_chats;

                        // document.getElementById('total_chats').innerHTML = total_chats;
                        // document.getElementById('total_complaints').innerHTML = total_complaints;
                        // document.getElementById('total_cases').innerHTML = total_cases;

                        // document.getElementById('total_activists').innerHTML = total_activists;
                        // document.getElementById('total_victims').innerHTML = total_victims;
                        // document.getElementById('total_users').innerHTML = total_users;
                        // document.getElementById('total_reported_users').innerHTML = total_reported_users;




                        // alert(response);
                        //  window.location.reload();
                    },
                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                        // alert(data);


                    },
                });
            }
        </script>
    @endif
@endsection
