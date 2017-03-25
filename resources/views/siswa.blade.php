@extends(\Request::ajax() ? 'layouts.ajax-skeleton' : 'layouts.skeleton')
@section('content')

<div class="col-sm-12">
  <div class="input-group input-group-sm" style="width: 45%;">
    <input id="search" type="text" class="form-control pull-right" placeholder="Cari nama siswa">
    <div class="input-group-btn">
      <div class="btn btn-default">
        <i class="fa fa-search"></i>
      </div>
    </div>
  </div>
  <h6>Real-time search dengan ajax dan <a href="http://underscorejs.org/">underscore.js</a></h6>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="tbody">@php $i=1; @endphp
      @foreach($data as $key => $value)
      <tr>
        <td>{{ $i++ }}</td>
        <td id="nama-{{ $value->id }}">{{ $value->nama }}</td>
        <td>{{ $value->kelas }}</td>
        <td>
          <a href="javascript:void(0)" class="btn btn-primary" onclick="ubahSiswa({{ $value->id }})">Ubah</a>
          <a href="javascript:void(0)" class="btn btn-danger" onclick="hapusSiswa({{ $value->id }})">Hapus</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script type="text/javascript">
  $(function() {
    $("#search").keyup(_.debounce(function() {
      var check = $(this).val();
      if (check.length==0) {
        ajaxRoute('');
      }
      else {
        $.ajax({
          url: '{{ url('cari') }}',
          type: 'GET',
          data: { nama: check },
          success: function(data) {
            $("#tbody").html('');
            if (data.success == 0) {
              $("#tbody").append('<tr><td>-</td><td>'+data.message+'</td><td>-</td><td>-</td></tr>');
            }
            else {
              var i=1;
              $.each(data.siswa, function(key, value) {
                $("#tbody").append('<tr><td>'+i+'</td><td id="nama-'+value.id+'">'+value.nama+'</td><td>'+value.kelas+'</td><td><a href="javascript:void(0)" class="btn btn-primary" onclick="ubahSiswa('+value.id+')">Ubah</a><a href="javascript:void(0)" class="btn btn-danger" onclick="hapusSiswa('+value.id+')">Hapus</a></td></tr>');
                i++;
              });
            }
          }
        });
      }
    }, 300));
  });

  function hapusSiswa(id) {
    var nama = $("#nama-"+id).html();
    if (confirm('Hapus Siswa - '+nama+' ?')) {
      $.ajax({
        url: '{{ url('') }}',
        type: 'DELETE',
        data: { id: id },
        success: function(data) {
          alert(data.message);
        }
      });
      ajaxRoute('');
    }
  }

  function ubahSiswa(id) {
    var siswa = {id: id};
    $.ajax({
      url: '{{ url('ubah') }}',
      type: 'GET',
      data: siswa,
      success: function(data) {
        if (data.success == 0) {
          alert(data.message);
        }
        else {
          ajaxRoute('ubah', siswa);
        }
      }
    });
  }
</script>
@endsection
