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
              <h3 class="card-title">FORM REGISTER</h3>
            </div>

            @if($errors->any())
            <ul style="color:red;">
              @foreach($errors->all() as $error)
              <li> {{ $error }}</li>
              @endforeach
            </ul>
            @endif

            <form action="{{ route('prosesregister') }}" method="POST">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" placeholder="Input Nama">
                </div>
                <div class="form-group">
                  <label>No HP</label>
                  <input type="text" class="form-control" name="no_hp" placeholder="Input No HP">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Input Email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Input Password" required>
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
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
              <h3 class="card-title">Data User</h3>
            </div>

            @if(session('success'))
            <p style="color:green"> {{ session('success') }}</p>
            @endif

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->nama}}</td>
                    <td>{{$user->no_hp}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                      <a href="{{ route('useredit', $user->id) }}">Edit</a> |
                      <form action="{{ route('userdelete', $user->id) }}" method="post" style="display: inline;">
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