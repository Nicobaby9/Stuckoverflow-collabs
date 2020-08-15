<?php 

use App\Pertanyaan;

 ?>

@extends('adminLTE.master')

@push('script-head')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
//   function likeIt(jawabId,elem){
//     var csrfToken='{{csrf_token()}}';
//     var likesCount=parseInt($('#'+jawabId+"-count").text());
//     $.post('{{route('thread.update', [$pertanyaan->id])}}', {jawabId: jawabId,_token:csrfToken}, function (data) {
//         console.log(data);
//        if(data.message==='liked'){
//            $(elem).addClass('liked');
//            $('#'+"angka--"+jawabId+"-count").text(likesCount+1);
// //                   $(elem).css({color:'red'});
//        }else if(data.message==='unliked'){
// //                   $(elem).css({color:'black'});
//            $(elem).addClass('liked');
//            $('#'+jawabId+"-count").text(likesCount-1);
//           //  $(elem).removeClass('liked');
//        }
//     });
//}
// function voteUpJawab() {
//   if (str == "") {
//     document.getElementById("txtHint").innerHTML = "";
//     return;
//   } else {
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         document.getElementById("txtHint").innerHTML = this.responseText;
//       }
//     };
//     xmlhttp.open("GET","getuser.php?q="+str,true);
//     xmlhttp.send();
//   }
// }
</script>
@endpush

@section('content')
  <div class="col-md-4" style="float: right;">
    <!-- general form elements -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Komentar Pertanyaan</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          @forelse($komentar as $komen)
          <p id="exampleInputEmail1">{{ $no++ }} .  {{ $komen->isi }}</p>
          <br>
          @empty
          <p>Belum ada Komentar</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>  
  <div class="col-md-8">
    <!-- general form elements -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Detail Pertanyaan</h3>
      </div>
      <!-- /.card-header -->
        @if (session('success'))
          <div class="alert alert-success">
           {{ session('success') }}
          </div>
        @endif

        <div class="card-body">
          <div class="form-group">
            <h4>
              <p style="font-size: 16px;">{{ $user->name }}</p> 
              <label for="exampleInputEmail1">Pertanyaan : {{ $pertanyaan->judul}}</label>
              <button id="voteUpTanya" class="btn btn-xs fa fa-chevron-up" style="float: right;"></button>
            <input type="number" id="vote" style="float: right; width:40px;" readonly value="{{$pertanyaan->point_vote}}" min="0" name="point_vote_pertanyaan"/>
              {{-- <input type="number" id="angka" style="float: right; width:30px;" placeholder="0" min="0" max="100" readonly/> --}}
              <button id="voteDownTanya" class="btn btn-xs fa fa-chevron-down" style="float: right;"></button>
              <p style="color: grey; font-size: 11px;">Created at : {{ $pertanyaan->created_at }}&nbsp;&nbsp; - &nbsp;&nbsp; Updated at : {{ $pertanyaan->updated_at }}</p>
            </h4>
          </div>
          <div class="form-group">
            <p for="exampleInputEmail1"> {!! $pertanyaan->isi !!} </p>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Tags</label>
            <br>
          @forelse($pertanyaan->tags as $tag)
            <button class="btn btn-light btn-xs"> {{ $tag->tag_name }} </button>
            @empty
            <h5>Belum ada </h5>
          @endforelse
          </div>
          <div class="form-group">
            <a href="{{ route('jawab.create') }}" class="btn btn-info btn-sm">Jawab</a>
           &nbsp; &nbsp;
          <a href="{{ route('komentarPertanyaan.create') }}" class="btn btn-primary btn-sm">Berikan Komentar</a>
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-8">
    <!-- general form elements -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Jawaban</h3>
      </div>
      <div class="card-body">
        @forelse($jawaban as $jawab)
        @if($jawab->id == $pertanyaan->jawaban_tepat_id)
        <div class="form-group" style="border-bottom: 1px solid black; padding-bottom: 16px;">
          <button class="btn btn-xs fa fa-check" style="float: right;"></button>
          <p id="exampleInputEmail1">{!! $jawab->isi !!} </p>
          <button id="{{$jawab->id}}-count" class="btn btn-xs fa fa-chevron-up" style="float: right;" onclick="likeIt('{{$jawab->id}}',this)"></button>
          <input type="number" id="angka--{{$jawab->id}}-count" style="float: right; width:30px;" readonly value="{{ $jawab->point_vote}}" min="0" name="point_vote_jawaban"/>
          <a href="{{ route('thread.update', [$pertanyaan->id]) }}" id="voteDownJawab" class="btn btn-xs fa fa-chevron-down" style="float: right;"></a>
          <a href="{{ route('komentarJawaban.show', [$jawab->id]) }}" class="btn btn-dark btn-xs">Detail Jawaban</a>
          <a href="{{ route('komentarJawaban.create') }}" class="btn btn-primary btn-xs">Berikan Komentar</a>
          <br>
        </div>
        @else
        <div class="form-group" style="border-bottom: 1px solid black; padding-bottom: 16px;">
          <p id="exampleInputEmail1">{!! $jawab->isi !!} </p>
          <button id="{{$jawab->id}}-count" class="btn btn-xs fa fa-chevron-up " style="float: right;" onclick="likeIt('{{$jawab->id}}',this)"></button>
          <input type="number" id="angka--{{$jawab->id}}-count" style="float: right; width:30px;" readonly value="{{ $jawab->point_vote}}" min="0" name="point_vote_jawaban"/>
          {{-- <a href="{{ route('thread.update', [$pertanyaan->id]) }}" id="voteUpJawab" class="btn btn-xs fa fa-chevron-up" style="float: right;"></a>
          <input type="number" id="angka" style="float: right; width:30px;" readonly value="{{ $jawab->point_vote}}" min="0" name="point_vote_jawaban"/> --}}
          <a href="{{ route('thread.update', [$pertanyaan->id]) }}" id="voteDownJawab" class="btn btn-xs fa fa-chevron-down" style="float: right;"></a>
          <a href="{{ route('komentarJawaban.show', [$jawab->id]) }}" class="btn btn-dark btn-xs">Detail Jawaban</a>
          <a href="{{ route('komentarJawaban.create') }}" class="btn btn-primary btn-xs">Berikan Komentar</a>
          <br>
        </div>
        @endif
        @empty
          <p>Belum ada Jawaban</p>
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
  
  // let vote = document.getElementById('vote');
  // let voteUpTanya = document.getElementById('voteUpTanya');
  // let voteDownTanya = document.getElementById('voteDownTanya');

  // voteUpTanya.addEventListener("click", function(e){
  //   vote.value = parseInt(vote.value) + 1;
  // });

  // voteDownTanya.addEventListener("click", function(e){
  //   vote.value = parseInt(vote.value) - 1;
  // });
  // let angka = document.getElementById('angka');
  // let voteUpJawab = document.getElementById('voteUpJawab');
  // let voteDownJawab = document.getElementById('voteDownJawab');

  // voteUpJawab.addEventListener("click", function(e){
  //   angka.value = parseInt(angka.value) + 1;
  // });

  // voteDownJawab.addEventListener("click", function(e){
  //   angka.value = parseInt(angka.value) - 1;
  // });
  
  function likeIt(jawabId,elem){
            var csrfToken='{{csrf_token()}}';
            var likesCount=parseInt($('#'+jawabId+"-count").text());
            $.post('{{route('toggleLike')}}', {jawabId: jawabId,_token:csrfToken}, function (data) {
                console.log(data);
               if(data.message==='liked'){
                   $(elem).addClass('liked');
                   $('#'+"angka--"+jawabId+"-count").text(likesCount+1);
//                   $(elem).css({color:'red'});
               }else if(data.message==='unliked'){
//                   $(elem).css({color:'black'});
                   $(elem).addClass('liked');
                   $('#'+jawabId+"-count").text(likesCount-1);
                  //  $(elem).removeClass('liked');
               }
            });

        }
  // if(angka.value < 0){
  //   return 0;
  // }
</script>

@endpush