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

      <form role="form" action="{{ route('question.store')}}" method="post">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="judul" placeholder="Masukkan Judul" required>
          </div>
          <div class="form-group">
            <label for="isi">Isi</label>
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="isi" placeholder="Isi Pertanyaan"  required>
          </div>
          <div class="form-group">
            <label for="tags">Tag</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="tags" placeholder="Pisahkan dengan tanda koma (,) contoh: postingan,news,hoax, dll." required>
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