@extends('adminLTE.master')

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
            <th>Judul </th>
            <th>Isi Pertanyaan</th>
            <th>Tanggal Dibuat</th>
            <th>Tanggal Diperbarui</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>

          <!-- {{$no = 1}} -->

          @forelse($pertanyaan as $key => $tanya)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $tanya->judul }}</td>
            <td>{{ $tanya->isi }}</td>
            <td>{{ $tanya->created_at }}</td>
            <td>{{ $tanya->updated_at }}</td>
            <td align="center" style="display: flex; ">
              <a href="{{ route('question.show', [$tanya->id]) }}" class="btn btn-primary btn-sm">Show</a>
              <a href="{{ route('question.edit', [$tanya->id]) }}" class="btn btn-info btn-sm">Edit</a>
              <form action="{{ route('question.destroy', [$tanya->id]) }}" method="post" accept-charset="utf-8">
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
	  $(function () {
	    $("#example1").DataTable();
	  });
	</script>

@endpush