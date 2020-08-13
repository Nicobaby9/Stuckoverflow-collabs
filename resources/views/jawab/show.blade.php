<?php 

use App\Pertanyaan;

 ?>

@extends('adminLTE.master')

@section('content')
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Forums</h3>
      </div>
      <!-- /.card-header -->
        @if (session('success'))
          <div class="alert alert-success">
           {{ session('success') }}
          </div>
        @endif

        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Judul : {{ $pertanyaan->judul}}</label>
          </div>
        @forelse($jawaban as $jawab)
          <div class="form-group">
            <input type="textarea" class="form-control" id="exampleInputEmail1" name="isi" placeholder="Masukkan Judul" value="{{ $jawab->isi }}" disabled>
          </div>
          @empty
          <p>Tidak ada Jawaban</p>
        @endforelse
        </div>
    </div>
  </div>
@endsection

@push('scripts')

  <script>
    $(function () {
      $("#example1").DataTable();
    });
  </script>

@endpush