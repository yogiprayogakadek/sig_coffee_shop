<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Data Ulasan</div>
            @can('admin')
            <div class="card-options">
                <select name="kedai" id="kedai" class="form-control select2-show-search">
                    @foreach ($kedai as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" role="grid"
                id="tableData">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kedai</th>
                        <th>Pengulas</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                        @can('admin')
                        <td>Status</td>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->kedai->nama_kedai}}</td>
                        <td>{{$data->user->nama}}</td>
                        <td>{{$data->ulasan}}</td>
                        <td>{{$data->rating}}</td>
                        @can('admin')
                        <td>
                            <select name="status" id="status" class="form-control" data-id="{{$data->id_ulasan}}" data-status="{{$data->status}}">
                                <option value="1" {{$data->status == '1' ? 'selected' : ''}}>Aktif</option>
                                <option value="0" {{$data->status == '0' ? 'selected' : ''}}>Tidak Aktif</option>
                            </select>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // $('.select2-show-search').select2({
    //     minimumResultsForSearch: '',
    //     // width: '100%'
    // });
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