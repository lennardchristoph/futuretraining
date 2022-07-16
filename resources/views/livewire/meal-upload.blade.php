<div class="card">
    <div class="card-body">
        <h1 class="card-title">Neues Gericht hinzufügen</h1>
        <form wire:submit.prevent="submit" method="POST">
            @if($step == 0)
                <div class="form-group">
                    <label for="mealName" class="col-form-label">Name</label>
                    <input wire:model="mealName" name="mealName" id="mealName" type="text"
                           placeholder="Spaghetti Promodore"
                           class="form-control">
                    @error('mealName') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="mealDescription" class="col-form-label">Rezept/Beschreibung</label>
                    <input wire:model="mealDescription" name="mealDescription" id="mealDescription" type="text"
                           placeholder="Here a description or tutorial is helpful." class="form-control">
                    @error('mealDescription') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="mealDescription" class="col-form-label">Rezept/Beschreibung</label>
                    <div class="custom-file mb-3">
                        <input wire:model="mealImage" type="file" name="mealImage" class="custom-file-input"
                               id="customFile" required>
                        <label class="custom-file-label" for="customFile">File</label>
                        @error('mealImage') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            @endif

            @if($step == 1)
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="navbar-search navbar-search-light form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input wire:model.debounce.300ms="search" class="form-control" placeholder="Search" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select wire:model="sortField" class="" id="">
                                <option value="id">ID</option>
                                <option value="name">Name</option>
                            </select>
                            <select wire:model="sortAsc" class="">
                                <option value="1">Ascending</option>
                                <option value="0">Descending</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    @if($ingredients->isNotEmpty())
                        <table class="table table-auto">
                            <thead class="dark">
                            <tr>
                                <th class="">ID</th>
                                <th class="">Name</th>
                                <th class="">Kcal</th>
                                <th class="">Carbs</th>
                                <th class="">Protein</th>
                                <th class="">Fat</th>
                                <th class="">Amount</th>
                                <th class="">Unity</th>
                                <th class="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ingredients as $ing)
                                <tr>
                                    <td class="">{{ $ing->id }}</td>
                                    <td class="">{{ $ing->de_name }}</td>
                                    <td class="">{{ $ing->kcal }}</td>
                                    <td class="">{{ $ing->carbs }}</td>
                                    <td class="">{{ $ing->protein }}</td>
                                    <td class="">{{ $ing->fat }}</td>
                                    <td class="">{{ $ing->amount }}</td>
                                    <td class="">{{ $ing->unity }}</td>
                                    <td class="">
                                        <button wire:click.lazy="openIngModal('{{$ing->id}}')" data-toggle="modal" data-target="#viewModal" type="button" class="btn btn-success mx-1">
                                            Add
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $ingredients->links() !!}
                    @else
                        <p class="text-center">No ingredients inserted so far.</p>
                    @endif
                </div>
            @endif
            @if($step == 2)
                <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="mealNamePreview" class="col-form-label">Name</label>
                                <input name="mealNamePreview" type="text" value="{{$mealName}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mealNamePreview" class="col-form-label">Description</label>
                                <input name="mealNamePreview" type="text" value="{{$mealDescription}}" class="form-control">
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="mealName" class="col-form-label">Image Preview</label>
                            @if ($mealImage)
                                <img src="{{ $mealImage->temporaryUrl() }}" class="img-fluid">
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-group">
            @if($step > 0 && $step <= 2)
                <!-- Backwards Button -->
                    <button type="button" wire:click="decreaseStep" class="btn btn-primary">Zurück</button>
            @endif
            @if($step < 1)
                <!-- Next Button -->
                    <button type="button" wire:click="increaseStep" class="btn btn-primary">Weiter</button>

                @endif
            @if($step < 2 && $submitGo == true)
                <!-- Next Button -->
                    <button type="button" wire:click="increaseStep" class="btn btn-primary">Weiter</button>
            @endif
                @if($step == 2)
                    <button type="submit" class="btn btn-primary">Submit</button>

                    @if (session()->has('message'))
                        <div class="alert alert-success float-right">
                            {{ session('message') }}
                        </div>
                    @endif

                @endif
            </div>
            <div wire:ignore.self class="modal fade" id="viewModal" tabindex="-1" role="dialog"
                 aria-labelledby="editeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">{{$name}} - hinzufügen</h2>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ingAmount" class="col-form-label">Menge</label>
                                <input wire:model="ingAmount" name="ingAmount" id="ingAmount" type="number"
                                       class="form-control">
                                @error('ingAmount') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="massUnit" class="col-form-label">Einheit</label>
                                <select wire:model="massUnit" name="massUnit" id="massUnit" class="form-control">
                                    @foreach($units as $u)
                                        <option value="{{$u->id}}">{{$u->unit}}</option>
                                    @endforeach
                                </select>
                                @error('mealDescription') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="addIngredient('{{$ingId}}')" class="btn btn-success" data-dismiss="modal">Add
                            </button>
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
