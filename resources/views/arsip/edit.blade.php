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
              <h3 class="card-title">EDIT ARSIP</h3>
            </div>

            @if($errors->any())
            <ul style="color:red;">
              @foreach($errors->all() as $error)
              <li> {{ $error }}</li>
              @endforeach
            </ul>
            @endif

            <form action="{{ route('arsip.update', $arsip->id) }}" method="POST">
              <div class="card-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Nama Dokumen</label>
                  <input type="text" class="form-control" name="nama_dokumen" placeholder="Input Nama Dokumen" value="{{$arsip->nama_dokumen}}">
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <select name="id_lokasi" id="" class="form-control">
                        @foreach ($lokasi as $item)
                            <option value="{{$item->id}}"{{ $item->id == $arsip->id_lokasi ? 'selected' : '' }}>{{$item->nama_lokasi}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                      <label>File Arsip</label>
                      <input type="file" class="form-control" name="file_arsip">
                      <small>Biarkan Kosong Jika Tidak Ingin Mengubah File</small>
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