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

            @if(session('success'))
            <p style="color:green"> {{ session('success') }}</p>
            @endif
            
              @if($errors->any())
               <ul style="color:red;" >
                @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
                @endforeach
               </ul>
               @endif

              <form action="{{ route('prosesregister') }}" method="POST">
                <div class="card-body">
                @csrf
                  <div class="form-group">
                    <label >Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Input Nama">
                  </div>
                  <div class="form-group">
                    <label >No HP</label>
                    <input type="number" class="form-control" name="no_hp" placeholder="Input Nomor Handphone">
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Input Email">
                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Input Password" required>
                  </div>
                  <div class="form-group">
                    <label >Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
              </form>

        </div>
        </div>
      </div>
      
    </section>
    <section class="content">
      <div class="content-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>

            <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row"><div class="col-sm-12 col-md-6"><div class="dt-buttons btn-group flex-wrap">         
                 <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button">
                  <span>Copy</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button">
                    <span>CSV</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button">
                      <span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button">
                        <span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button">
                          <span>Print</span></button> <div class="btn-group">
                            <button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true">
                              <span>Column visibility</span><span class="dt-down-arrow"></span></button></div> </div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                <thead>
                <tr>
                <th ">
                  ID
                  </th>
                  <th">
                  Nama
                  </th>
                  <th ">
                  NO HP
                  </th>
                  <th ">
                  Email
                  </th>
                  <th ">
                      Aksi
                  </th>
                  
              </tr>
                </thead>
                @if(isset($users) && $users->count() > 0)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->no_hp }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route ('useredit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                          <form action="{{ route('userdelete', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm ('Yakin ingin menghapus data ini?')">Hapus</button>
                          </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="5">Tidak ada data pengguna.</td></tr>
            @endif
            

              </table>
            </div>
          </div>
      </div>
  </section>
@endsection