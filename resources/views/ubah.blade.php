@extends(\Request::ajax() ? 'layouts.ajax-skeleton' : 'layouts.skeleton')
@section('content')

<div class="row">
  <div class="col-sm-12 col-md-6">
    <form id="form_siswa">
      <input type="hidden" name="id" value="{{ $data->id }}">
      <div class="form-group">
        <label for="nama">Nama Siswa</label>
        <input id="nama" type="text" name="nama" class="form-control" value="{{ $data->nama }}">
      </div>
      <div class="form-group">
        <label for="kelas">Kelas</label>
        <input id="kelas" type="text" name="kelas" class="form-control" value="{{ $data->kelas }}">
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>

<script type="text/javascript">
  $(function() {
    $("#form_siswa").submit(function(e) {
      $.ajax({
        url: '{{ url('ubah') }}',
        type: 'POST',
        data: $("#form_siswa").serializeArray(),
        success: function(data) {
          alert(data.message);
          if (data.success == 1) {
            ajaxRoute('');
          }
        }
      });

      e.preventDefault();
    });
  });
</script>
@endsection
