<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TESTING API</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-lg">
        <h1>ADD</h1>
        <br>
        <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-info" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
            <br>
        <?php } ?>
        <!-- <form action="/MyApp/add" method="post"> -->
        <form action="/MyApp/prosesAdd" method="post">
            <?php echo csrf_field(); ?>
            <div class="row mb-3">
                <label for="inputNIM" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nim" name="nim" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNama" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required>
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Jurusan</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jurusan" id="jurusanSI" value="Sistem Informasi" checked>
                        <label class="form-check-label" for="jurusanSI">
                            Sistem Informasi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jurusan" id="jurusanTI" value="Teknik Informatika">
                        <label class="form-check-label" for="jurusanTI">
                            Teknik Informatika
                        </label>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
        </form>
    </div>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
