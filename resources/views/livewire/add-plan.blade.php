<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="card-title">Neuen Ernährungsplan erstellen @if($step > 0 && $step <= 7)-
                    Tag {{$step}}@elseif($step <= 8)- Abschluss @endif</h1>
                @if (session()->has('successMessage'))
                    <div class="alert alert-success">
                        {{ session('successMessage') }}
                    </div>
                @endif
            </div>
            @if($step > 0 && $step <= 7)
                <div class="col-lg-4 justify-content-end">
                    <div class="navbar-search navbar-search-light form-inline mr-3 d-none d-md-flex ml-lg-auto">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input wire:model.debounce.300ms="search" class="form-control" placeholder="Search"
                                   type="text">
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <hr>
        <form wire:submit.prevent="submit" method="POST">
            @if($step == 0)
                <div class="form-group">
                    <label for="planName" class="label-control">Plan Name</label>
                    <input wire:model="planName" id="ing" name="ing" type="text" value="" class="form-control"
                           placeholder="Enter optional name">
                </div>
                <div class="form-group">
                    <label for="athleteSelection" class="label-control">Select your Athlete:</label>
                    <select wire:model.defer="athlete" class="custom-select" id="athleteSelection">
                        <option>-- Select Athlete --</option>
                        @foreach($athletes as $ath)
                            <option value="{{$ath->id}}">{{$ath->surname}} {{$ath->lastname}}</option>
                        @endforeach
                    </select>
                    @error('athlete') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="aimSelection" class="label-control">Select your aim:</label>
                    <select wire:model.defer="aimSelection" class="custom-select" id="athleteSelection">
                        <option>-- Select Aim --</option>
                        <option value="Abnehmen">Abnehmen</option>
                        <option value="Halten">Halten</option>
                        <option value="Aufbauen">Aufbauen</option>
                    </select>
                    @error('aimSelection') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="planStartDate" class="label-control">Start Date</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input wire:model="start_date" name="daterange" class="form-control datepicker"
                                       id="planStartDate" type="text">
                            </div>
                            @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="planEndDate" class="label-control">End Date</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input wire:model="end_date" name="daterange" class="form-control datepicker"
                                       type="text" id="planEndDate">
                            </div>
                            @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="aimKcal" class="label-control">Ziel: Kcal</label>
                            <input wire:model="aimKcal" id="aimKcal" name="aimKcal" type="number" step="0.01" value=""
                                   class="form-control"
                                   placeholder="Enter aim Kcal">
                            @error('aimKcal') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="aimCarbs" class="label-control">Ziel: Carbs</label>
                            <input wire:model="aimCarbs" id="aimCarbs" name="aimCarbs" type="number" step="0.01"
                                   value="" class="form-control"
                                   placeholder="Enter aim Carbs">
                            @error('aimCarbs') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="aimProteine" class="label-control">Ziel: Proteine</label>
                            <input wire:model="aimProteine" id="aimProteine" name="aimProteine" type="number"
                                   step="0.01" value="" class="form-control"
                                   placeholder="Enter aim Proteine">
                            @error('aimProteine') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="aimFat" class="label-control">Ziel: Fat</label>
                            <input wire:model="aimFat" id="aimFat" name="aimFat" type="number" step="0.01" value=""
                                   class="form-control"
                                   placeholder="Enter aim Fat">
                            @error('aimFat') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            @endif
            @if($step >= 1 && $step <= 7)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <h3>Liste mit allen Gerichten:</h3>
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th class="">ID</th>
                                    <th class="">Image</th>
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
                                        <th class=""><img src="{{asset($meal->image)}}" alt="{{$meal->title}} Image"
                                                          style="max-height: 7.5%;"></th>
                                        <th class="">{{$meal->title}}</th>
                                        <td class="">{{$meal->description}}</td>
                                        <td class="">{{$this->calculateKcal($meal->id)}}</td>
                                        <td class="">{{$this->calculateCarbs($meal->id)}}</td>
                                        <td class="">{{$this->calculateProtein($meal->id)}}</td>
                                        <td class="">{{$this->calculateFat($meal->id)}}</td>
                                        <td class="text-right">
                                            <button wire:click.lazy="openMealModal('{{$meal->id}}')" data-toggle="modal"
                                                    data-target="#viewModal" type="button" class="btn btn-success mx-1">
                                                Add
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @error('dayTime') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="row">
                            @if($step > 0 && $step <= 7)
                                <span class="badge badge-primary m-md-3">KCAL: {{$finalKcal}} / {{$aimKcal}}</span>
                                <span class="badge badge-primary m-md-3">Carbs: {{$finalCarbs}} / {{$aimCarbs}}</span>
                                <span class="badge badge-primary m-md-3">Protein: {{$finalProtein}} / {{$aimProteine}}</span>
                                <span class="badge badge-primary m-md-3">Fat: {{$finalFat}} / {{$aimFat}}</span>
                            @endif
                            <!--
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <select wire:model="perPage" class="custom-select-sm">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                    <select wire:model="sortField" class="custom-select-sm">
                                        <option value="id">ID</option>
                                        <option value="title">Name</option>
                                    </select>
                                    <select wire:model="sortAsc" class="custom-select-sm">
                                        <option value="1">Ascending</option>
                                        <option value="0">Descending</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-lg-3">
                                {{$meals->links()}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                            <div class="form-group">
                                <h3>Liste Essen:</h3>
                                @if(!empty($dayArray[$day]))
                                    <table class="table">
                                        <tbody>
                                        @foreach($dayArray[$day] as $key => $m)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td class="col-sm-3">{{$m['title']}}</td>
                                                <td class="col-sm-3">
                                                    <button type="button" wire:click="openEditModal({{$key}})"
                                                            data-toggle="modal"
                                                            data-target="#editModal" class="btn btn-light btn-sm">Edit
                                                    </button>
                                                    <button type="button" wire:click="removeMeal({{$key}})"
                                                            class="btn btn-danger btn-sm">Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            </div>
                            @error('editedIngs.*') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            @endif
            @if($step >= 8)
                @if(!empty($dayArray))
                    @foreach($dayArray as $key => $day)
                        <h2>Tag - {{$key+1}}</h2>
                        <ul>
                            @foreach($day as $meal)
                                <li>{{$meal['title']}}</li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
                <label for="planComment" class="label-control">Add Comments:</label>
                <textarea wire:model="planComment" class="form-control" id="planComment"
                          placeholder="Add any comment you want to add..."></textarea>

            @endif
            <hr>
            <div class="row">
                <div class="col-lg-9">
                @if($step > 0 && $step <= 8)
                    <!-- Backwards Button -->
                        <span class="badge m-md-3"><button type="button" wire:click="decreaseStep"
                                                           class="btn btn-primary">Zurück</button></span>
                @endif
                @if($step < 8)
                    <!-- Next Button -->
                        <span class="badge m-md-3"><button type="button" wire:click="increaseStep"
                                                           class="btn btn-primary">Weiter</button></span>
                    @endif
                    @if($step == 8)
                        <span class="badge m-md-3"><button type="button" wire:click="savePlan" class="btn btn-primary">Submit</button></span>
                    @endif
                </div>
            </div>
            @error('dayArray') <span class="text-danger error">{{ $message }}</span>@enderror

            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog"
                 aria-labelledby="editeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">{{$modalTitle}} - hinzufügen</h2>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ingredients" class="col-form-label">Zutaten</label>
                                <ul>
                                    @foreach($ingredients as $ing)
                                        <li>{{$ing->de_name.'_'.app()->getLocale()}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="form-group">
                                <select wire:model.defer="dayTime" class="form-control" id="dayTimeSelection">
                                    <option selected>-- Please Select Daytime --</option>
                                    <option value="am">Morgen</option>
                                    <option value="an">Mittag</option>
                                    <option value="ev">Abend</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="addMeal('{{$mealID}}')" class="btn btn-success"
                                    data-dismiss="modal">Add
                            </button>
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                 aria-labelledby="editeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Zutaten - bearbeiten</h2>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    @foreach($editIngs as $key => $eIng)
                                        <label for="ing{{$key}}" class="col-form-label">{{$eIng['name']}}</label>
                                        <input wire:model.defer="editedIngs.{{$key}}" id="ing{{$key}}"
                                               name="ing{{$key}}" type="number"
                                               value="{{$eIng['amount']}}" class="form-control"
                                               placeholder="{{$eIng['amount']}}" step="0.01">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="editMeal('{{$addedMealsKey}}')" class="btn btn-success"
                                    data-dismiss="modal">Save
                            </button>
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
