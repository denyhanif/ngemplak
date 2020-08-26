@extends('layouts.master')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Riwayat</h1>
</div>
<div class="row">
    <div class="col-md-12 card shadow mb-4">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Tanggal Verifikasi</th>
                <th scope="col">Tanggal Jadi</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
             
            <tbody>
                @php
                    $no = 1;
                @endphp
                @forelse ($pengajuan as $row)
                <tr>
                  <th scope="row">{{ $no++ }}</th>
                  <td>{{ $row->nama_pemesan }}</td>
                  <td>{{ $row->kategori->nama }}</td>
                  <td>{{ $row->pesanan->tanggal_pesan }}</td>
                  <td>
                    @if ($row->pesanan->tanggal_verifikasi == null)
                    {{ 'belum diverifikasi' }}
                    @else
                    {{ $row->pesanan->tanggal_verifikasi }}
                    @endif
                  </td>
                  <td>{{ $row->tanggal_jadi() }}</td>
                  <td>{!! $row->status_label !!}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
          </table>

          <div class="text-center">
              {{ $pengajuan->links() }}
          </div>
    </div>
</div>
@endsection