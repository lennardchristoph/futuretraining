@foreach($errors->all() as $error)
    <div>
        {{$error}}
    </div>
@endforeach
<div class="card">
    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <h1 class="card-title">Neuen Athlethen hinzufügen</h1>
        <form wire:submit.prevent="submit" method="POST">
            <div class="form-group">
                <label for="surname" class="col-form-label">Vorname</label>
                <input wire:model="surname" name="surname" id="surname" type="text" placeholder="Max" class="form-control">
                @error('surname') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="name" class="col-form-label">Name</label>
                <input wire:model="name" name="name" id="name" type="text" placeholder="Mustermann" class="form-control">
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="age" class="col-form-label">Alter</label>
                <input wire:model="age" name="age" id="age" type="text" placeholder="18 Jahre" class="form-control">
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="height" class="col-form-label">Größe</label>
                        <input wire:model="height" name="height" id="height" type="number" placeholder="Example: 170cm" class="form-control">
                        @error('height') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="weight" class="col-form-label">Gewicht</label>
                        <input wire:model="weight" name="weight" id="weight" type="number" placeholder="Example: 120kg" class="form-control">
                        @error('weight') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sportexperience" class="col-form-label">Sporterfahrung</label>
                        <input wire:model="sportexperience" name="sportexperience" id="sportexperience" type="number" placeholder="Experience: " class="form-control">
                        @error('sportexperience') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="level" class="col-form-label">Level</label>
                        <input wire:model="level" name="level" id="level" type="number" placeholder="Example: 1-5" class="form-control">
                        @error('level') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="frequency" class="col-form-label">Frequenz</label>
                        <input wire:model="frequency" name="frequency" id="frequency" type="number" placeholder="Example: " class="form-control">
                        @error('frequency') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sleeptime" class="col-form-label">Schlafzeit</label>
                        <input wire:model="sleeptime" name="sleeptime" id="sleeptime" type="number" placeholder="Example: 1-24h" class="form-control">
                        @error('sleeptime') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="actualkcal" class="col-form-label">Aktuelle Kalorien</label>
                        <input wire:model="actualkcal" name="actualkcal" id="actualkcal" type="number" placeholder="Example: 3000kcal" class="form-control">
                        @error('actualkcal') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="aim" class="col-form-label">Angesetztes Ziel</label>
                        <input wire:model="aim" name="aim" id="aim" type="number" placeholder="Example: Muskelaufbau" class="form-control">
                        @error('aim') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
