<?php 

use App\Pertanyaan;

 ?>

@extends('adminLTE.master')
@push('script-head')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
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
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="isi_pertanyaan" placeholder="Judul" value="{!! $pertanyaan->isi !!}" disabled>
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
            <input type="text" class="form-control" id="exampleInputPassword1" name="profil_id" placeholder="Profil ID" value="{{ $pertanyaan->user_id }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Author</label>
            <input type="textarea" class="form-control" id="exampleInputPassword1" name="profil_name" placeholder="Profil Name" value="{{ $pertanyaan->author->name }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jawaban</label>
          @forelse($jawaban as $jawab)
            <p id="exampleInputPassword1"> {!! $jawab->isi !!}</p>
            @empty
            <h5>Belum ada jawaban </h5>
          @endforelse
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jawaban Tepat</label>
            <p id="exampleInputPassword1">
              {!! $jawaban_tepat->isi !!}
            </p>
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