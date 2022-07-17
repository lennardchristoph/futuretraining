<div>
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-lg-6 justify-content-start">
                        <h2 class="mb-0">All Plans</h2>
                    </div>
                    <div class="col-lg-6 justify-content-end">
                        <div class="navbar-search navbar-search-light form-inline mr-3 d-none d-md-flex ml-lg-auto">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input wire:model.debounce.300ms="search" class="form-control" placeholder="Search" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Light table -->
            <div class="form-group">
                @if($plans->isNotEmpty())
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th class="">ID</th>
                            <th class="">Name</th>
                            <th class="">Athlet</th>
                            <th class="">Comment</th>
                            <th class="">Startdatum</th>
                            <th class="">Enddatum</th>
                            <th class="">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($plans as $plan)
                            <tr>
                                <th class="">{{$plan->id}}</th>
                                <th class="">@if($plan->name != null){{$plan->name}}@else / @endif</th>
                                <td class="">{{$plan->athlete->surname}} {{$plan->athlete->lastname}}</td>
                                <td class="">{{$plan->comment}}</td>
                                <td class="">{{$plan->start_date}}</td>
                                <td class="">{{$plan->end_date}}</td>
                                <td class="">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" target="_blank" href="{{ route('planPDF', ['planID' => $plan->id]) }}">Open as PDF</a>
                                            <a class="dropdown-item" href="{{ route('planPDF', ['download' => 'pdf', 'planID' => $plan->id]) }}">Download as PDF</a>
                                            <a class="dropdown-item" href="#">Send via Mail</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
                <nav aria-label="...">
                    <div class="row">
                        <div class="col-lg-6">
                            <select class="" wire:model="perPage">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <select wire:model="sortField" class="" id="">
                                    <option value="id">ID</option>
                                    <option value="title">Name</option>
                                </select>
                                <select wire:model="sortAsc" class="">
                                    <option value="1">Ascending</option>
                                    <option value="0">Descending</option>
                                </select>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="" id="example_paginate">
                                {!! $plans->links() !!}
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
