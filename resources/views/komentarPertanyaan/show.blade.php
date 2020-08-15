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
            <label for="exampleInputEmail1">Pertanyaan : {{ $pertanyaan->judul}}</label>
          </div>
        @forelse($komentar_pertanyaan as $kp)
          <div class="form-group">
            <input type="textarea" class="form-control" id="exampleInputEmail1" name="isi" placeholder="Masukkan Judul" value="{{ $kp->isi }}" disabled>
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