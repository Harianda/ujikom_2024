@extends('master.layout')

@section('title', 'Bukti Pendaftaran')

@section('custom-css')
<style>
    /* Styles for the page */
    body,
    h1 {
        font-family: 'Montserrat', sans-serif;
    }

    .card-body p {
        font-family: "Bookman Old Style", Georgia, serif;
        font-size: 14px;
    }

    /* Style for print button */
    .toolbar {
        text-align: right;
        margin-bottom: 20px;
    }

    /* CSS for printing */
    @media print {
        body * {
            visibility: hidden;
        }

        .card,
        .card * {
            visibility: visible;
        }

        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }

        .toolbar {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<h1 class="mb-4">Bukti Pendaftaran</h1>

<div class="toolbar hidden-print">
    <button type="button" class="btn btn-primary" id="print-btn">
        Export as PDF
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama User:</label>
                <p>{{ $dataSiswa->nama_user }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat KTP:</label>
                <p>{{ $dataSiswa->alamat_ktp }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat Sekarang:</label>
                <p>{{ $dataSiswa->alamat_sekarang }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Kecamatan:</label>
                <p>{{ $dataSiswa->kecamatan }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Kabupaten:</label>
                <p>{{ $kabupatenOptions[$dataSiswa->kabupaten] }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Provinsi:</label>
                <p>{{ $provinsiOptions[$dataSiswa->propinsi] }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">No HP:</label>
                <p>{{ $dataSiswa->nohp }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email:</label>
                <p>{{ $dataSiswa->email }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Kewarganegaraan:</label>
                <p>{{ $dataSiswa->kewarganegaraan }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Lahir:</label>
                <p>{{ $dataSiswa->tempat_lahir }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir:</label>
                <p>{{ date('d-m-Y', strtotime($dataSiswa->tgl_lahir)) }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin:</label>
                <p>{{ $dataSiswa->jenis_kelamin }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status Menikah:</label>
                <p>{{ $dataSiswa->status_menikah }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Agama:</label>
                <p>{{ $dataSiswa->agama }}</p>
            </div>
        </div>

        <a href="{{ route('camaba.pendaftar.listpendaftar') }}" class="btn btn-secondary mt-4">Kembali</a>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    document.getElementById('print-btn').addEventListener('click', function () {
        const element = document.querySelector('.card');
        console.log(element); // Check if the selector works correctly
        const opt = {
            filename: `BuktiPendaftaran-{{ $dataSiswa->nama_user }}.pdf`,
        };
        html2pdf().from(element).set(opt).save();
    });
</script>
@endsection