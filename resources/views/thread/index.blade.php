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

        @forelse($pertanyaan as $tanya)
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Judul : {{ $tanya->judul}}</label>
          </div>
          <div class="form-group">
            <input type="textarea" class="form-control" id="exampleInputEmail1" name="isi" placeholder="Masukkan Judul" value="{{ $tanya->isi }}" disabled>
            <p style="color: grey; font-size: 11px;">Created at : {{ $tanya->created_at }}&nbsp;&nbsp; - &nbsp;&nbsp; Updated at : {{ $tanya->updated_at }}</p>
          </div>
          <a href="{{ route('jawab.create', [$tanya->id] ) }}" class="btn btn-info btn-sm">Jawab</a>
          &nbsp; &nbsp;
          <a href="{{ route('jawab.show', [$tanya->id] ) }}" class="btn btn-primary btn-sm">Jawaban</a>
        </div>
          @empty
          <p>Tidak ada pertanyaan</p>
        @endforelse
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