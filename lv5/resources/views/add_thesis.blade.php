@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>{{ trans('translations.dodaj_rad') }}</h1>
    <div>
    <a href="{{ route('locale.switch', 'en') }}" class="btn btn-info">EN</a>
    <a href="{{ route('locale.switch', 'hr') }}" class="btn btn-info">HR</a>
    <a href="/home" class="btn btn-primary">{{ trans('translations.back') }}</a>
    <div>
</div>
    </div>
    <form method="POST" action="{{ route('tasks.save') }}" class="w-25 mt-2">
        @csrf
        <div class="form-group">
            <label for="naziv_rada">{{ trans('translations.naziv_rada') }}:</label>
            <input type="text" class="form-control" id="naziv_rada" name="naziv_rada" required>
        </div>
        <div class="form-group">
            <label for="naziv_rada">{{ trans('translations.naziv_rada_en') }}:</label>
            <input type="text" class="form-control" id="naziv_rada_en" name="naziv_rada_en" required>
        </div>
        <div class="form-group">
            <label for="zadatak_rada">{{ trans('translations.zadatak_rada') }}:</label>
            <textarea class="form-control" id="zadatak_rada" name="zadatak_rada" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="tip_studija">{{ trans('translations.tip_studija') }}:</label>
            <select class="form-control" id="tip_studija" name="tip_studija" required>
                <option value="preddiplomski">{{ trans('translations.preddiplomski') }}:</option>
                <option value="diplomski">{{ trans('translations.diplomski') }}:</option>
                <option value="strucni">{{ trans('translations.strucni') }}:</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">{{ trans('translations.save') }}</button>
        
    </form>
    @if(session('success'))
        <div class="alert alert-success w-25 d-flex justify-content-center mt-2">
            {{ trans('translations.success') }}
        </div>
     @endif
</div>
@endsection