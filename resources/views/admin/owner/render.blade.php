<div class="card">
    <div class="card-header">
        <div class="card-title">Data Owner</div>
        {{-- <div class="card-options">
            <button class="btn btn-success btn-print">
                <i class="fa fa-print"></i> Cetak
            </button>
        </div> --}}
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped" id="tableData">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Foto</th>
                <td>Status</td>
                {{-- <th>Aksi</th> --}}
            </thead>
            <tbody>
                @foreach ($owner as $owner)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$owner->nama}}</td>
                    <td>{{$owner->tempat_lahir}}</td>
                    <td>{{$owner->tanggal_lahir}}</td>
                    <td>{{$owner->jenis_kelamin == '1' ? 'Laki - Laki' : 'Perempuan'}}</td>
                    <td>{{$owner->alamat}}</td>
                    <td>
                        <img src="{{asset($owner->foto)}}" class="img-rounded" width="100px">
                    </td>
                    <td>
                        <select name="status" id="status" class="form-control" data-id="{{$owner->id_user}}" data-status="{{$owner->is_active}}">
                            <option value="1" {{$owner->is_active == '1' ? 'selected' : ''}}>Aktif</option>
                            <option value="0" {{$owner->is_active == '0' ? 'selected' : ''}}>Tidak Aktif</option>
                        </select>
                    </td>
                    {{-- <td>
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$owner->id_user}}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>