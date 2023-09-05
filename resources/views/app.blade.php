<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tes Php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="card" style="width: 18rem; margin-left: 70px;
    margin-top: 30px;">
        <div class="card-body">
            <div class="mb-3">
                <label for="bilangan" class="form-label">Masukan Bilangan Kelipatan 3</label>
                <input type="number" class="form-control" id="bilangan3" placeholder="3****">
            </div>
            <div class="mb-3">
                <label for="bilangan" class="form-label">Masukan Bilangan Kelipatan 5</label>
                <input type="number" class="form-control" id="bilangan5" placeholder="5****">
            </div>
            <button type="button" onclick="hitung()" class="btn btn-primary">Hitung</button>
            <a href="/rajaOngkir" type="button" class="btn btn-success">Raja Ongkir</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function hitung() {
            var kelipatan3 = $("#bilangan3").val();
            var kelipatan5 = $("#bilangan5").val();
            var i;
            for (i = 1; i <= 100; i++) {
                if (i > 75) {
                    document.write("end" + i + "<br>");
                    break;
                } else if (i > 30) {
                    if (i % kelipatan3 == 0) {
                        document.write("Concat" + i + "<br>");
                    } else if (i % kelipatan5 == 0) {
                        document.write("Bage" + i + "<br>");
                    }
                } else if (i % kelipatan3 == 0 && i % kelipatan5 == 0) {
                    document.write("Bage Concat " + i + "<br>");
                } else if (i % kelipatan3 == 0) {
                    document.write("Bage " + i + "<br>");
                } else if (i % kelipatan5 == 0) {
                    document.write("Concat " + i + "<br>");
                } else if (i > 30) {
                    if (i % kelipatan3 == 0) {
                        document.write("Concat" + i + "<br>");
                    } else if (i % kelipatan5 == 0) {
                        document.write("Bage" + i + "<br>");
                    }
                }
            }
        }
    </script>
</body>

</html>
