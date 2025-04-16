@extends('admin.layout')

@section('content')

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">EDIT LOKASI</h3>
            </div>

            @if($errors->any())
            <ul style="color:red;">
              @foreach($errors->all() as $error)
              <li> {{ $error }}</li>
              @endforeach
            </ul>
            @endif

            <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
              <div class="card-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Nama Lokasi</label>
                  <input type="text" class="form-control" name="nama_lokasi" placeholder="Input Nama Lokasi" value="{{$lokasi->nama_lokasi}}">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </section>
</div>

@endsection