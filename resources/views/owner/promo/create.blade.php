<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tambah Promo</div>
            <div class="card-options">
                <button class="btn btn-info btn-data">
                    <i class="fa fa-eye"></i> Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="formAdd">
                <div class="form-group">
                    <label for="id_kedai">Kedai</label>
                    <select name="id_kedai" id="id_kedai" class="form-control select2-show-search id_kedai">
                        @foreach ($data as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-id_kedai"></div>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Promo</label>
                    <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama promo">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group">
                    <label for="potongan">Potongan</label>
                    <input type="text" class="form-control potongan" name="potongan" id="potongan" placeholder="masukkan potongan promo">
                    <span>*cukup angka (potongan dalam persentase)</span>
                    <div class="invalid-feedback error-potongan"></div>
                </div>
                <div class="form-group">
                    <label for="foto">Foto Promo</label>
                    <input type="file" class="form-control foto" name="foto" id="foto" placeholder="masukkan foto">
                    <div class="invalid-feedback error-foto"></div>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Promo</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control deskripsi" rows="5" placeholder="deskripsi Promo"></textarea>
                    <div class="invalid-feedback error-deskripsi"></div>
                </div>
                <div class="form-group pull-right">
                    <button class="btn btn-success btn-save" type="button">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        // width: '100%'
    });

    $('#deskripsi').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        popatmouseup: true,
    });
</script>
