@extends('adminLTE.master')

@section('content')
	<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Input Data Pertanyaan</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <form role="form" action="{{ route('jawab.store')}}" method="post">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="judul">Jawaban</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="isi" placeholder="Masukkan Jawaban" required>
          </div>
          <div class="form-group">
            <label>Pertanyaan</label>
            <select class="form-control" name="pertanyaan_id" >
              @forelse($pertanyaan as $t)
              <option value="{{ $t->id }}">Id : {{ $t->id }} &nbsp; - &nbsp; Isi : {{ $t->isi }}</option>
              @empty
              <h5 value="0">Belum ada jawaban</h5>
              @endforelse
            </select>
          </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" value="save" name="submit" onclick="return confirm('Apakah jawaban sudah valid?')">Submit</button>
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