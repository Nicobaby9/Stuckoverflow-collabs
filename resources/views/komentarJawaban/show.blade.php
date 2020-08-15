<?php 

use App\Jawaban;

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
            <label for="exampleInputEmail1">Jawaban : </label>
            <p>{!! $jawaban->isi !!}</p>
          </div>
        @forelse($komentar_jawaban as $kj)
          <div class="form-group">
            <input type="textarea" class="form-control" id="exampleInputEmail1" name="isi" value="{{ $kj->isi }}" disabled>
          </div>
          @empty
          <p>Tidak ada Komentar</p>
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