<?php 

use App\Pertanyaan;

 ?>

@extends('adminLTE.master')

@section('content')
	<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Show Detail Data Pertanyaan - ID {{ $pertanyaan->id }}</h3>
      </div>
      <!-- /.card-header -->

      <!-- form start -->
      <form role="form" action="" method="get">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Judul</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="judul_pertanyaan" placeholder="Masukkan Judul" value="{{ $pertanyaan->judul }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Isi</label>
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="isi_pertanyaan" placeholder="Judul" value="{{ $pertanyaan->isi }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Dibuat</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="created_at" placeholder="Tanggal Dibuat" value="{{ $pertanyaan->created_at }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Diperbarui</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="updated_at" placeholder="Tanggal Diperbarui" value="{{ $pertanyaan->updated_at }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Profil ID</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="profil_id" placeholder="Profil ID" value="{{ $pertanyaan->profil_id }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Author</label>
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="profil_name" placeholder="Profil Name" value="{{ $pertanyaan->author->name }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jawaban</label>
          @forelse($jawaban as $jawab )
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="jawaban_isi" placeholder="Jawaban" value="{{ $jawab->isi }}" disabled>
            @empty
            <h5>Belum ada jawaban </h5>
          @endforelse
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jawaban Tepat</label>
            @forelse($jawaban as $j)
            <input type="text" class="form-control" id="exampleInputPassword1" name="profil_id" placeholder="Profil ID" value="{{ $j->isi }}" disabled>
            @empty
            <p>Belum ada jawaban tepat</p>
            @endforelse
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tags</label>
            <br>
          @forelse($pertanyaan->tags as $tag)
            <button class="btn btn-primary btn-sm"> {{ $tag->tag_name }} </button>
            @empty
            <h5>Belum ada </h5>
          @endforelse
          </div>
        <!-- /.card-body -->
      </form>
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