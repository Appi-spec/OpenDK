@extends('layouts.dashboard_template')


@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title ?? "Page Title" }}
        <small>{{ $page_description ?? '' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard.profil')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">{{$page_title}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    @include('partials.flash_message')

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="">
                <a href="{{ route('data.proses-kk.create') }}">
                    <button type="button" class="btn btn-primary btn-sm" title="Tambah Data"><i class="fa fa-plus"></i>
                        Proses KK Baru
                    </button>
                </a>
            </div>
        </div>
        <div class="box-body">
            @include( 'flash::message' )
            <table class="table table-bordered table-hover dataTable" id="kk-table">
                <thead>
                <tr>
                    <th style="max-width: 100px;">Aksi</th>
                    <th>Status</th>
                    <th>Nama Penduduk</th>
                    <th>Alamat</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Selesai</th>
                    <th>Catatan</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection

@include('partials.asset_datatables')

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var data = $('#kk-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route( 'data.proses-kk.getdata' ) !!}",
            columns: [
                {data: 'action', name: 'action', class: 'text-center', searchable: false, orderable: false},
                {data: 'status', name: 'status'},
                {data: 'nama_penduduk', name: 'das_penduduk.nama'},
                {data: 'alamat', name: 'alamat'},
                {data: 'tanggal_pengajuan', name: 'tanggal_pengajuan'},
                {data: 'tanggal_selesai', name: 'tanggal_selesai'},
                {data: 'catatan', name: 'catatan'},
            ],
            order: [[0, 'desc']]
        });
    });
</script>
@include('forms.datatable-vertical')
@include('forms.delete-modal')

@endpush
