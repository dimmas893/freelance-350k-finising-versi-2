@extends('layouts.template.template')
@section('content')
    <div class="main-content">

        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="nama">Nama WhereHouse</label>
                                <select class="form-control" name="wharehouse_id">
                                    <option value="0">----Pilih WhareHouse----</option>
                                    @foreach ($wharehouse as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" name="nama" class="form-control" placeholder="Masukan Nama"> --}}
                            </div>
                            <div class="my-2">
                                <label for="tanggal">tanggal</label>
                                <input type="date" name="tanggal" class="form-control" placeholder="Masukan Alamat">
                            </div>
                            <div class="my-2">
                                <label for="jenis_barang">Jenis Barang</label>
                                <select class="form-control" name="jenis_barang">
                                    <option value="0">----Pilih Jenis Barang----</option>
                                    <option value="mentah">Mentah</option>
                                    <option value="matang">Matang</option>
                                </select>
                                {{-- <input type="integer" id="jenis_barang" name="jenis_barang" class="form-control" placeholder="Masukan No Telfon"> --}}
                            </div>
                            <div class="my-2">
                                <label for="volume">Volume</label>
                                <input type="number" name="volume" class="form-control" placeholder="Masukan Volume">
                            </div>
                            <div class="my-2">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" placeholder="Masukan Keterangan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="add_TU_btn" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- add new employee modal end --}}

        {{-- edit employee modal start --}}
        <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukan Nama">
                            </div>
                            <div class="my-2">
                                <label for="tanggal">tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control"
                                    placeholder="Masukan Alamat">
                            </div>
                            <div class="my-2">
                                <label for="volume">Volume</label>
                                {{-- <select class="form-control" name="jenis_barang" id="jenis_barang">
                    <option value="0">----Pilih Jenis Barang----</option>
                    <option value="mentah">Mentah</option>
                    <option value="matang">Matang</option>
                </select> --}}
                                <input type="number" disable id="volume" name="volume" class="form-control">
                            </div>
                            <div class="my-2">
                                <label for="jenis_barang">Jenis Barang</label>
                                <input type="text" id="jenis_barang" name="jenis_barang" class="form-control">
                            </div>
                            <div class="my-2">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="edit_TU_btn" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- edit employee modal end --}}

        <section class="section">
            <div class="section-header">
                <h1>Halaman Inbound</h1>
            </div>


            <div class="section-body">
                <div class="row my-5">
                    <div class="col-12 mt-3">
                        <form action="{{ route('outbound-wharehouse_cari') }}" method="get">
                            @csrf
                            <div class="">
                                <label for="">Tanggal Awal</label>
                                <input type="date" class="form-control" name="awal" placeholder="year">
                            </div>
                            <div class="">
                                <label for="">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="akhir" placeholder="bulan">
                            </div>
                            <div class="mt-2">
                                <input type="submit" class="btn btn-primary" value="Cari">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-9 mt-3">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Inbound</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Inbound</button>
                            </div>
                            <div class="table-responsive">
                                <div class="card-body" id="TU_all">
                                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mt-3">
                        <div class="card">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Total</h3>
                            </div>
                            <div class="card-body">
                                <h3 id="total"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            // add new employee ajax request
            $("#add_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_TU_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('inbound-store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Added Successfully!',
                                'success'
                            )
                            TU_all();
                            total();
                        }
                        $("#add_TU_btn").text('Save');
                        $("#add_TU_form")[0].reset();
                        $("#add_TU_modal").modal('hide');
                    }
                });
            });
            // edit employee ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('inbound-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#nama").val(response.nama);
                        $("#tanggal").val(response.tanggal);
                        // $("#password").val(response.password);
                        $("#volume").val(response.volume);
                        $("#jenis_barang").val(response.jenis_barang);
                        $("#keterangan").val(response.keterangan);
                        $("#id").val(response.id);
                    }
                });
            });
            // update employee ajax request
            $("#edit_TU_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_TU_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('inbound-update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Updated!',
                                'Updated Successfully!',
                                'success'
                            )
                            TU_all();
                            total();
                        }
                        $("#edit_TU_btn").text('Update');
                        $("#edit_TU_form")[0].reset();
                        $("#editTUModal").modal('hide');
                    }
                });
            });
            // delete employee ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('inbound-delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                TU_all();
                                total();
                            }
                        });
                    }
                })
            });
            // fetch all employees ajax request
            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('inbound-all') }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                        $("table").DataTable({
                            destroy: true,
                            responsive: true,
                            dom: "Blfrtip",
                            buttons: [{
                                    text: 'csv',
                                    extend: 'csvHtml5',
                                },
                                {
                                    text: 'excel',
                                    extend: 'excelHtml5',
                                },
                                {
                                    text: 'pdf',
                                    extend: 'pdfHtml5',
                                },
                                {
                                    text: 'print',
                                    extend: 'print',
                                },
                            ],
                            columnDefs: [{
                                orderable: false,
                                targets: -1
                            }]
                        });
                    }
                });
            }

            total();

            function total() {
                $.ajax({
                    url: '{{ route('inbound-total') }}',
                    method: 'get',
                    success: function(response) {
                        $("#total").html(response + ' Kg');
                    }
                });
            }
        });
    </script>
@endsection
