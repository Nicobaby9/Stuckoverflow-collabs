@extends('adminLTE.master')
@push('script-head')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
	<div class="card">
    @method('delete')
      <div class="card-header">
        <h3 class="card-title">CRUD Laravel with Query Builder</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        @if (session('success'))
          <div class="alert alert-success">
           {{ session('success') }}
          </div>
        @endif
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No.</th>
            <th>Pertanyaan ID </th>
            <th>Jawaban</th>
            <th>Tanggal Dibuat</th>
            <th>Tanggal Diperbarui</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>

          <!-- {{$no = 1}} -->

          @forelse($jawaban as $key => $jawab)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $jawab->pertanyaan_id }}</td>
            <td>{!! $jawab->isi !!}</td>
            <td>{{ $jawab->created_at }}</td>
            <td>{{ $jawab->updated_at }}</td>
            <td align="center" style="display: flex; ">
              <a href="{{ route('jawab.show', [$jawab->id]) }}" class="btn btn-primary btn-sm">Show</a>
              <a href="{{ route('jawab.edit', [$jawab->id]) }}" class="btn btn-info btn-sm">Edit</a>
              <form action="{{ route('jawab.destroy', [$jawab->id]) }}" method="post" accept-charset="utf-8">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
              </form>
            </td>
          </tr>
          <tr>
            @empty
            <td colspan="6" align="center">Tidak Ada Data Pertanyaan</td>
          </tr>

          @endforelse
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
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