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
              <h3 class="card-title">INPUT LOKASI</h3>
            </div>

            @if($errors->any())
            <ul style="color:red;">
              @foreach($errors->all() as $error)
              <li> {{ $error }}</li>
              @endforeach
            </ul>
            @endif

            <form action="{{ route('lokasi.store') }}" method="POST">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label>Nama Lokasi</label>
                  <input type="text" class="form-control" name="nama_lokasi" placeholder="Input Nama Lokasi">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Lokasi</h3>
            </div>

            @if(session('success'))
            <p style="color:green"> {{ session('success') }}</p>
            @endif

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Lokasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                  @foreach ($lokasi as $dt)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$dt->nama_lokasi}}</td>
                    <td>
                      <a href="{{ route('lokasi.edit', $dt->id) }}">Edit</a> |
                      <form action="{{ route('lokasi.destroy', $dt->id) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.col -->
      </div>
  </section>
</div>

@endsection