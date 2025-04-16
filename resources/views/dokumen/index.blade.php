@extends('admin.layout')

@section('content')

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Dokumen</h3>
            </div>

            @if(session('success'))
            <p style="color:green"> {{ session('success') }}</p>
            @endif
            <a href="{{ route ('dokumen.create') }}" class="btn btn-primary">Tambah</a>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Dokumen</th>
                    <th>File</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dokumens as $dokumen)
                  <tr>
                    <td>{{$dokumen->id}}</td>
                    <td>{{$dokumen->nama_dokumen}}</td>
                    <td><a href="{{ asset('storage/'.$dokumen->file) }}" target="_blank">Lihat PDF</a></td>
                    <td>
                      <a href="{{ route('dokumen.edit', $dokumen->id) }}">Edit</a> |
                      <form action="{{ route('dokumen.delete', $dokumen->id) }}" method="post" style="display: inline;">
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