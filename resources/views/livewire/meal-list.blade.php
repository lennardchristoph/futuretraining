<div>
    <!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Gerichte</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Tables</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tables</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-lg-6 justify-content-start">
                        <h2 class="mb-0">Alle Gerichte</h2>
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
                @if($meals->isNotEmpty())
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th class="">ID</th>
                        <th class="">Name</th>
                        <th class="">Beschreibung</th>
                        <th class="">KCAL</th>
                        <th class="">Kohlenhydrate</th>
                        <th class="">Protein</th>
                        <th class="">Fett</th>
                        <th class="">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($meals as $meal)
                    <tr>
                        <th class="">{{$meal->id}}</th>
                        <th class="">{{$meal->de_title}}</th>
                        <td class="">{{$meal->de_description}}</td>
                        <td class="">{{$this->calculateKcal($meal->id)}}</td>
                        <td class="">{{$this->calculateCarbs($meal->id)}}</td>
                        <td class="">{{$this->calculateProtein($meal->id)}}</td>
                        <td class="">{{$this->calculateFat($meal->id)}}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
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
                            <select class="pagination justify-content-start" wire:model="perPage">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            {!! $meals->links() !!}
                            <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select wire:model="sortField" class="" id="">
                                <option value="id">ID</option>
                                <option value="title">Name</option>
                            </select>
                            <select wire:model="sortAsc" class="">
                                <option value="1">Ascending</option>
                                <option value="0">Descending</option>
                            </select>
                        </div>
                        <!--<div class="col-lg-6">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                </nav>
            </div>
        </div>
</div>
</div>