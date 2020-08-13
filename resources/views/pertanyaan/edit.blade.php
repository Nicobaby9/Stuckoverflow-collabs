@extends('adminLTE.master')

@section('content')
	<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Pertanyaan - {{ $pertanyaan->id }} </h3>
      </div>
      <!-- /.card-header -->
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <!-- form start -->
      <form role="form" action="{{ route('question.update', [$pertanyaan->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Judul</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="judul_pertanyaan" placeholder="Masukkan Judul" value="{{ $pertanyaan->judul }}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Isi</label>
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="isi_pertanyaan" placeholder="Judul" value="{{ $pertanyaan->isi }}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Dibuat</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="created_at" placeholder="Tanggal Dibuat" value="{{ $pertanyaan->created_at }}" disabled="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Diperbarui</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="updated_at" placeholder="Tanggal Diperbarui" value="{{ $pertanyaan->updated_at }}" disabled=""> 
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jawaban Tepat ID</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="jawaban_tepat_id" placeholder="Jawaban Tepat ID" value="{{ $pertanyaan->jawaban_tepat_id }}" disabled="">
          </div>
          <div class="form-group">
            <label>Jawaban Tepat ID Select</label>
            <select class="form-control" name="jawaban_tepat_id">
              @forelse($jawaban as $j)
              <option value="{{ $j->id }}">Id : {{ $j->id }} &nbsp; - &nbsp; Isi : {{ $j->isi }}</option>
              @empty
              <h5 value="0">Belum ada jawaban</h5>
              @endforelse
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Profil Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="profil_id" placeholder="Profil ID" value="{{ Auth::user()->name }}" disabled="">
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" value="save" name="submit" onclick="return confirm('Apakah data sudah valid?')">Submit</button>
        </div>
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