@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                User
            </span>
            <span>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Buat
                  </button>
            </span>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Buat User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formPost" method="post">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">No Hp</label>
                <input type="number" name="no_telp" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nomor Induk</label>
                <input type="number" name="nomor_induk" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Role</label>
                <select name="roles" id="" class="form-control">
                    <option value="">Pilih...</option>
                    <option value="paa">PAA</option>
                    <option value="dosen">DOSEN</option>
                    <option value="mahasiswa">MAHASISWA</option>
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
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="editName" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" id="editEmail" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">No Hp</label>
                <input type="number" name="no_telp" id="editNo" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nomor Induk</label>
                <input type="number" name="nomor_induk" id="editNi" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="editAlamat" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="editTgl" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Role</label>
                <select name="roles" id="editRole" class="form-control">
                    <option value="">Pilih...</option>
                    <option value="paa">PAA</option>
                    <option value="dosen">DOSEN</option>
                    <option value="mahasiswa">MAHASISWA</option>
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
@endsection

@push('scripts')
<script>

    function editFunc(e){
        console.log(e)
        $.ajax({
            type : 'GET',
            url : "/user/"+e+"/edit",
            cache : false,
            contentType : false,
            processData : false,
            success : (data) => {
                $('#editModal').modal('show')
                $('#editName').val(data.user.name)
                $('#editEmail').val(data.user.email)
                $('#editTgl').val(data.user.tanggal_lahir)
                $('#editNo').val(data.user.no_telp)
                $('#editNi').val(data.user.nomor_induk)
                $('#editAlamat').val(data.user.alamat)
                $('#editRole').val(data.user.roles).change()
                $('#editId').text(data.user.id)
            },
            error : (data) => {
                alert('gagal')
            }
        })
    }
    
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'roles', name: 'roles'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formPost').submit(function(e) {
        e.preventDefault()
        let formData = new FormData(this)

        $.ajax({
            type : 'POST',
            url : "{{ route('user.store') }}",
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

    $('#formUpdate').submit(function(e) {
        e.preventDefault()
        let formData = new FormData(this)

        $.ajax({
            type : 'POST',
            url : "/user/" + $('#editId').text(),
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
            url : "/user/" + e + "/delete",
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