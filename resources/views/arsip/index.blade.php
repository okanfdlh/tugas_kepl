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

            <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="nama_dokumen">Nama Dokumen</label>
                  <input type="text" class="form-control" name="nama_dokumen" placeholder="Input Nama Dokumen">
                </div>

                <div class="form-group">
                    <label for="id_lokasi">Lokasi</label>
                    <select name="id_lokasi" id="" class="form-control" required>
                        @foreach ($lokasi as $item)
                            <option value="{{$item->id}}">{{$item->nama_lokasi}}</option>
                        @endforeach
                    </select>
                  </div>

                <div class="form-group"></div>
                  <label for="file_arsip">File Arsip</label>
                  <input type="file" class="form-control" name="file_arsip" accept=".pdf" required>
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
                    <th>Nama Dokumen</th>
                    <th>Lokasi</th>
                    <th>User</th>
                    <th>File</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($arsip as $item)
                  <tr>
                    <td>{{$item->nama_dokumen}}</td>
                    <td>{{$item->lokasi->nama_lokasi}}</td>
                    <td>{{$item->data_user->nama}}</td>
                    <td>
                        <a href="{{ Storage::url($item->file_arsip) }}" target="_blank">Lihat File</a>
                    </td>
                    <td>
                        @if ($item->id_user == Session::get('ambilUser')->id)
                            <a href="{{ route('arsip.edit', $item->id) }}">Edit</a> |
                            <form action="{{ route('arsip.destroy', $item->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</button>
                            </form>
                        @endif
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