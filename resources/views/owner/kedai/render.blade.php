<div class="card">
    <div class="card-header">
        <div class="card-title">Data Kedai</div>
        @can('owner')
        <div class="card-options">
            <button class="btn btn-primary btn-add" style="margin-left: 2px">
                <i class="fa fa-plus"></i> Tambah
            </button>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped" id="tableData">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat Lengkap</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Foto</th>
                <th>Suasana Kedai</th>
                <th>Status</th>
                @can('owner')
                <th>Aksi</th>
                @endcan
            </thead>
            <tbody>
                @foreach ($kedai as $kedai)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$kedai->nama_kedai}}</td>
                    <td>{{$kedai->alamat_kedai}}</td>
                    <td>{{$kedai->latitude}}</td>
                    <td>{{$kedai->longitude}}</td>
                    <td>
                        <img src="{{asset($kedai->foto)}}" class="img-rounded" width="100px">
                    </td>
                    <td>
                        <button type="button" class="btn {{$kedai->suasana_kedai == null ? 'btn-primary btn-add-suasana' : 'btn-info btn-edit-suasana'}}" data-id="{{$kedai->id_kedai}}">
                            {!!$kedai->suasana_kedai == null ? '<span class="fa fa-plus"></span> Tambah' : 'Lihat'!!}
                        </button>
                    </td>
                    <td>
                        <select name="status" id="status" class="form-control" data-id="{{$kedai->id_kedai}}" data-status="{{$kedai->status}}">
                            <option value="1" {{$kedai->status == '1' ? 'selected' : ''}}>Aktif</option>
                            <option value="0" {{$kedai->status == '0' ? 'selected' : ''}}>Tidak Aktif</option>
                        </select>
                    </td>
                    @can('owner')   
                    <td>
                        <button type="button" class="btn btn-success btn-sm btn-edit" data-id="{{$kedai->id_kedai}}">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSuasana" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suasana Kedai</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fa fa-times"></span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="formUpload" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id_kedai" id="id_kedai">
                        <label for="">Suasana Kedai</label>
                        <input type="file" name="photos[]" id="photos" multiple class="form-control">
                    </div>
                </form>
                <div class="row photos">
                    {{-- <div class="photos"></div> --}}
                </div>
                <span class="noted"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-upload">Save</button>
            </div>
        </div>
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