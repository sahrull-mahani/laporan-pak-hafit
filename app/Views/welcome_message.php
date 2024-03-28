<!doctype html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.css" />

</head>

<body class="pt-5 px-5 pb-5">
    <form class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="nama-sekolah" class="form-label">Nama Sekolah</label>
            <input type="text" class="form-control" id="nama-sekolah" name="nama_sekolah" value="<?= session()->has('nama_sekolah') ? session('nama_sekolah') : '' ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="nama-guru" class="form-label">Nama Guru</label>
            <input type="text" class="form-control" id="nama-guru" name="nama_guru" value="<?= session()->has('nama_guru') ? session('nama_guru') : '' ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
            <input type="text" class="form-control" id="mata-pelajaran" name="mata_pelajaran" value="<?= session()->has('mata_pelajaran') ? session('mata_pelajaran') : '' ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="status-guru" class="form-label">Status Guru</label>
            <input type="text" class="form-control" id="status-guru" name="status_guru" value="<?= session()->has('status_guru') ? session('status_guru') : '' ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="jjp" class="form-label">JJP KBM Per Minggu</label>
            <input type="text" class="form-control" id="jjp" name="jjp" value="<?= session()->has('jjp') ? session('jjp') : '' ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>


        <div class="col-md-6">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= date('d-m-Y') ?>" data-field="date" data-format="dd-MM-yyyy" readonly required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
            <div id="dtBox"></div>
        </div>
        <div class="col-md-6">
            <label for="materi" class="form-label">Materi</label>
            <input type="text" class="form-control" id="materi" name="materi" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="kelas" name="kelas">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="mapel" class="form-label">Mapel / JP</label>
            <input type="text" class="form-control" id="mapel" name="mapel">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="jumlah" class="form-label">Jumlah Siswa</label>
            <input type="number" min="0" class="form-control" id="jumlah" name="jumlah">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="hadir" class="form-label">Siswa yang Hadir</label>
            <input type="number" min="0" class="form-control" id="hadir" name="hadir">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="tidak_hadir" class="form-label">Siswa yang Tidak Hadir</label>
            <input type="number" min="0" class="form-control" id="tidak_hadir" name="tidak_hadir">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="alasan" class="form-label">Masalah / Alasan</label>
            <input type="text" class="form-control" id="alasan" name="alasan" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="dokumentasi" class="form-label">Dokumentasi</label>
            <input type="file" class="form-control" id="dokumentasi" name="dokumentasi">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="keterangan" class="form-label">Keterangan / Tempat Kegiatan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary" type="submit">Generate</button>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.js"></script>
    <script src="<?= site_url('assets/js/main.js') ?>"></script>
</body>

</html>