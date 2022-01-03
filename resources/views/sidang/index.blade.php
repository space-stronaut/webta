@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                Sidang
            </span>
            <span>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Buat
                  </button>
            </span>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="sidang-table">
                <thead>
                    <tr>
                        <th>Kode Sidang</th>
                        <th>Judul TA</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Pengajuan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formPost" method="post">
            @csrf
            <input type="hidden" name="status" value="proses">
            <input type="hidden" name="pengaju_id" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" name="judul_ta" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Tanggal Pengajuan</label>
                <input type="date" name="tanggal_sidang" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">File</label>
                <input type="file" name="file" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Dosen</label>
                <select name="dosen_id" id="" class="form-control">
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosens as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">PAA</label>
                <select name="paa_id" id="" class="form-control">
                    <option value="">Pilih PAA</option>
                    @foreach ($paas as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
{{-- edit modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formUpdate" method="post">
            @csrf
            <p id="editId" style="display: none"></p>
            <input type="hidden" name="status" id="editStatus">
            <input type="hidden" name="pengaju_id" id="editPengaju">
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" name="judul_ta" id="editJudul" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Tanggal Pengajuan</label>
                <input type="date" name="tanggal_sidang" id="editTanggal" class="form-control">
            </div>
            <div class="form-group">
                <label for="">File</label>
                <input type="file" name="file" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Dosen</label>
                <select name="dosen_id" id="editDosen" class="form-control">
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosens as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">PAA</label>
                <select name="paa_id" id="editPaa" class="form-control">
                    <option value="">Pilih PAA</option>
                    @foreach ($paas as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- validasi modal --}}
  <div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Validasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formValidasi" method="post">
            @csrf
            <p id="validasiId"></p>
            <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="validasiStatus" class="form-control">
                    <option value="proses">Proses</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="revisi">Revisi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Komentar <small class="text-danger">Bila Revisi</small></label>
                <textarea name="komentar" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>

    function showFunc(e){
        console.log(e)
        $.ajax({
            type : 'GET',
            url : "/sidang/"+e+"/edit",
            cache : false,
            contentType : false,
            processData : false,
            success : (data) => {
                $('#validasiModal').modal('show')
                $('#validasiStatus').val(data.sidang.status).change()
                $('#validasiId').text(data.sidang.id)
            },
            error : (data) => {
                alert('gagal')
            }
        })
    }

    function editFunc(e){
        console.log(e)
        $.ajax({
            type : 'GET',
            url : "/sidang/"+e+"/edit",
            cache : false,
            contentType : false,
            processData : false,
            success : (data) => {
                $('#editModal').modal('show')
                $('#editPengaju').val(data.sidang.pengaju_id)
                $('#editStatus').val(data.sidang.status)
                $('#editJudul').val(data.sidang.judul_ta)
                $('#editPaa').val(data.sidang.paa_id)
                $('#editTanggal').val(data.sidang.tanggal_sidang)
                $('#editDosen').val(data.sidang.dosen_id).change()
                $('#editId').text(data.sidang.id)
            },
            error : (data) => {
                alert('gagal')
            }
        })
    }
    
    var table = $('#sidang-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('sidang.index') }}",
        columns: [
            {data: 'kode_sidang', name: 'kode_sidang'},
            {data: 'judul_ta', name: 'judul_ta'},
            {data: 'tanggal_sidang', name: 'tanggal_sidang'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formPost').submit(function(e) {
        e.preventDefault()
        let formData = new FormData(this)

        $.ajax({
            type : 'POST',
            url : "{{ route('sidang.store') }}",
            data : formData,
            cache : false,
            contentType : false,
            processData : false,
            success : (data) => {
                $('#exampleModal').modal('hide')
                table.ajax.reload()
            },
            error : (data) => {
                alert('gagal')
            }
        })
    })

    $('#formValidasi').submit(function(e) {
        e.preventDefault()
        let formData = new FormData(this)

        $.ajax({
            type : 'POST',
            url : "/sidang/" + $('#validasiId').text() + "/validasi",
            data : formData,
            cache : false,
            contentType : false,
            processData : false,
            success : (data) => {
                $('#validasiModal').modal('hide')
                table.ajax.reload()
            },
            error : (data) => {
                alert('gagal')
            }
        })
    })

    $('#formUpdate').submit(function(e) {
        e.preventDefault()
        let formData = new FormData(this)

        $.ajax({
            type : 'POST',
            url : "/sidang/" + $('#editId').text(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : formData,
            cache : false,
            contentType : false,
            processData : false,
            success : (data) => {
                $('#editModal').modal('hide')
                table.ajax.reload()
            },
            error : (data) => {
                alert('gagal')
            }
        })
    })


    function deleteFunc(e){
        $.ajax({
            type : 'POST',
            url : "/sidang/" + e + "/delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache : false,
            contentType : false,
            processData : false,
            success : (data) => {
                table.ajax.reload()
            },
            error : (data) => {
                alert('gagal')
            }
        })
    }

</script>
@endpush