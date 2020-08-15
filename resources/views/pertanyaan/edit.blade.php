@extends('adminLTE.master')
@push('script-head')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
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
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="isi_pertanyaan" placeholder="isi" value="{!! $pertanyaan->isi !!}">
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
              <option value="{{ $j->id }}">Isi Jawaban : {!! $j->isi !!}</option>
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
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

@endpush