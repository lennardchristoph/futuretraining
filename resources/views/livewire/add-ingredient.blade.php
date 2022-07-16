<div class="card">
    <div class="card-body">
        <h1 class="card-title">{{ __('messages.IngTitle') }}</h1>

        <form wire:submit.prevent="submit" method="POST">

            <div class="form-group">
                <label for="ingName" class="col-form-label">{{ __('messages.Name') }}</label>
                <input wire:model="ingName" name="ingName" id="ingName" type="text" placeholder="Pasta" class="form-control">
                @error('ingName') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="ingKcal" class="col-form-label">Kcal</label>
                        <input wire:model="ingKcal" name="ingKcal" id="ingKcal" type="number" placeholder="Example: 500Kcal" class="form-control" step="0.01">
                        @error('ingKcal') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="ingCarbs" class="col-form-label">Carbs</label>
                        <input wire:model="ingCarbs" name="ingCarbs" id="ingCarbs" type="number" placeholder="Example: 120g" class="form-control" step="0.01">
                        @error('ingCarbs') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="ingProtein" class="col-form-label">Protein</label>
                        <input wire:model="ingProtein" name="ingProtein" id="ingProtein" type="number" placeholder="Example: 36g" class="form-control" step="0.01">
                        @error('ingProtein') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="ingFat" class="col-form-label">Fett</label>
                        <input wire:model="ingFat" name="ingFat" id="ingFat" type="number" placeholder="Example: 20g" class="form-control" step="0.01">
                        @error('ingFat') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="ingUnity" class="col-form-label">Einheit auf 100: </label>
                        <select wire:model="ingUnity" name="ingUnity" id="ingUnity" class="form-control">
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->unit}}</option>
                            @endforeach
                        </select>
                        @error('ingUnity') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input wire:model="lactose" type="checkbox" name="checkbox-inline" class="custom-control-input" value="true"><span class="custom-control-label">Lactose intolerance?</span>
                        </label>
                        @error('lactose') <span class="text-danger error">{{ $message }}</span>@enderror
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input wire:model="gluten" type="checkbox" name="radio-inline" class="custom-control-input" value="true"><span class="custom-control-label">Gluten intolerance?</span>
                        </label>
                        @error('gluten') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>

            <div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
