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
                <h3 class="card-title">FORM HITUNG PENJUMLAHAN</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               @if($errors->any())
               <ul style="color:red;" >
                @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
                @endforeach
               </ul>
               @endif

              <form action="{{ route('proseshitung') }}" method="POST">
                <div class="card-body">
                @csrf
                  <div class="form-group">
                    <label >Input Angka 1</label>
                    <input type="text" class="form-control" name="angka1" placeholder="Input Angka 1" value="{{ old('angka1', $number1 ?? '') }}">
                  </div>
                  <div class="form-group">
                    <label >Input Angka 2</label>
                    <input type="text" class="form-control" name="angka2" placeholder="Input Angka 2" value="{{ old('angka2', $number2 ?? '') }}">
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

              @isset($result)
              <h2>Hasil Penjumlahan : </h2>
              <p>{{ $number1 }} + {{ $number2 }} = {{ $result }}</p>
              @endisset
            </div>
        </div>
        </div>
        </div>
        
</section>
</div>

@endsection