<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <div class="row">
            <div class="col-lg-6 justify-content-start">
                <h3 class="mb-0">Alle Athleten</h3>
            </div>
            <div class="col-lg-6 justify-content-end">
                <div id="example_filter" class="dataTables_filter justify-content-end">
                    <label>Search:<input wire:model.debounce.300ms="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
                </div>
            </div>
        </div>
    </div>
    <!-- Light table -->
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Name</th>
                <th scope="col" class="sort" data-sort="budget">Kcal</th>
                <th scope="col" class="sort" data-sort="status">Carbs</th>
                <th scope="col">Protein</th>
                <th scope="col" class="sort" data-sort="completion">Fat</th>
                <th scope="col" class="sort" data-sort="completion">Amount</th>
                <th scope="col" class="sort" data-sort="completion">Unity</th>
                <th scope="col" class="sort" data-sort="completion">Lactose_Intolerance</th>
                <th scope="col" class="sort" data-sort="completion">Gluten_Intolerance</th>
                <th scope="col" class="sort" data-sort="completion">Actions</th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach($ingredients as $ing)
                <tr>
                    <th scope="row">{{$ing->de_name}}</th>
                    <td class="budget">{{$ing->kcal}}</td>
                    <td>{{$ing->carbs}}</td>
                    <td>{{$ing->protein}}</td>
                    <td>{{$ing->fat}}</td>
                    <td>{{$ing->amount}}</td>
                    <td>{{$ing->unity}}</td>
                    <td>{{$ing->lactose_intolerance}}</td>
                    <td>{{$ing->gluten_intolerance}}</td>
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
                    {{$ingredients->links()}}
                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                    </div>
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
