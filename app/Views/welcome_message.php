<!doctype html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="pt-5 px-5">
    <form class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
            <label for="nama-sekolah" class="form-label">Nama Sekolah</label>
            <input type="text" class="form-control" id="nama-sekolah" name="nama_sekolah" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="nama-guru" class="form-label">Nama Guru</label>
            <input type="text" class="form-control" id="nama-guru" name="nama_guru" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
            <input type="text" class="form-control" id="mata-pelajaran" name="mata_pelajaran" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="status-guru" class="form-label">Status Guru</label>
            <input type="text" class="form-control" id="status-guru" name="status_guru" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-md-6">
            <label for="jjp" class="form-label">JJP KBM Per Minggu</label>
            <input type="text" class="form-control" id="jjp" name="jjp" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Looks not good!
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= site_url('assets/js/main.js') ?>"></script>
</body>

</html>