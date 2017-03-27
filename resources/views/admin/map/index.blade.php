@extends('admin.master')
@section('admin.content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>BusStops</h2>
<form method="POST" action="{{ route('admin.map.regist.busstops') }}" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 form-group">
            <div class="col-md-2">
               <label>kml file</label>
            </div>
            <div class="col-md-3">
                <input type="file" class="form-input" name="kml">
            </div>
        </div>
        <div class="col-md-12 form-group">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success pull-left">Make SQL</button>
            </div>
        </div>
 
    </div>
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="_token" />
</form>
<h2>BusCourses</h2>
<form method="POST" action="{{ route('admin.map.regist.buscourses') }}" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 form-group">
            <div class="col-md-2">
               <label>bus_id</label>
            </div>
            <div class="col-md-3">
                <select name="bus_id">
                    <option value="1">TUMON SHUTTLE NORTH BOUND</option>
                    <option value="2">TUMON SHUTTLE SOUTH BOUND</option>
                    <option value="3">SHOPPING MALL SHUTTLE</option>
                    <option value="4">T Galleria K-Mart Shuttle</option>
                    <option value="5">GPO Leo Palace Shuttle</option>
                    <option value="6">Two Lovers Point Shuttle</option>
                    <option value="7">Hagatna Shuttle Bus</option>
                    <option value="8">Chamorro Village Night Shuttle</option>
                    <option value="9">Flea Market Shuttle</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 form-group">
            <div class="col-md-2">
               <label>kml file</label>
            </div>
            <div class="col-md-3">
                <input type="file" class="form-input" name="kml">
            </div>
        </div>
        <div class="col-md-12 form-group">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success pull-left">Make SQL</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="_token" />
    <input type="hidden" name="id" value="1"/>
</form>

@if(isset($sqls))
<pre style="text-align: left;">
@foreach($sqls as $sql)
{{$sql}}
@endforeach
</pre>
@endif

@endsection
