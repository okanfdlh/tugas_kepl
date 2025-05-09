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
              <h3 class="card-title">FORM DOKUMEN</h3>
            </div>

            <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label>Nama Dokumen</label>
                  <input type="text" class="form-control" name="nama_dokumen" placeholder="Input Nama Dokumen">
                </div>
                <div class="form-group">
                  <label for="file">Upload File</label>
                  <input type="file" class="form-control" name="file" accept=".pdf">
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
  </section>
</div>

@endsection