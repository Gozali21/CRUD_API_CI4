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
        <?php 
        // print_r($mahasiswa);
        // die();
        ?>
        <h1>Testing API</h1>
        <br>
        <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-info" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
            <br>
        <?php } ?>
        <a class="btn btn-primary" href="/MyApp/add">Add</a>
        <br>
        <br>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jurusan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $key => $value) { ?>
                    <tr>
                        <th scope="row"><?php echo $key+1; ?></th>
                        <td><?php echo $value['nim']; ?></td>
                        <td><?php echo $value['nama_mahasiswa']; ?></td>
                        <td><?php echo $value['jurusan']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
