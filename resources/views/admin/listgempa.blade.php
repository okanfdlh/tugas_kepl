@extends('admin.layout')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Gempa</h3>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Koordinat</th>
                    <th>Lintang</th>
                    <th>Bujur</th>
                    <th>Magnitude</th>
                    <th>Kedalaman</th>
                    <th>Wilayah</th>
                    <th>Potensi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  @foreach($gempaData as $item)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['Tanggal'] }}</td>
                    <td>{{ $item['Jam'] }}</td>
                    <td>{{ $item['Coordinates'] }}</td> <!-- Perbaikan: Hapus "DateTime" -->
                    <td>{{ $item['Lintang'] }}</td>
                    <td>{{ $item['Bujur'] }}</td>
                    <td>{{ $item['Magnitude'] }}</td>
                    <td>{{ $item['Kedalaman'] }}</td>
                    <td>{{ $item['Wilayah'] }}</td>
                    <td>{{ $item['Potensi'] }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.col -->
      </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
  </section> <!-- /.content -->
</div>

@endsection