<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raja Ongkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="card" style="width: 30rem; margin-left: 70px;
    margin-top: 30px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="paymentSelectProvinces">Provinsi</label>
                        <select name="paymentSelectProvinces" id="paymentSelectProvinces" class="form-control" required>
                            <option></option>
                            <option value="5">Di Yogyakarta</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="paymentSelectRegencies">Kabupaten/Kota</label>
                        <select name="paymentSelectRegencies" id="paymentSelectRegencies" class="form-control"
                            onchange="getKurir(this.value)" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="send">
                    <h2 class="title">Metode Pengiriman</h2>
                    <small class="text-danger" id="paymentTextNotSupportDelivery" style="display: none;">Metode antar
                        belum
                        tersedia untuk tempat Anda.</small>
                    <div class="form-group mt-3" id="groupPaymentSelectKurir">
                        <select name="paymentSelectKurir" id="paymentSelectKurir" class="form-control" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="col-lg-12">
                    <br>
                    <div class="row">
                        <div class="col-lg-4"></div><br>
                        <div class="col-lg-4"><a href="/" type="button" class="btn btn-success">Kembali</a></div>
                        <div class="col-lg-4"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#paymentSelectRegencies").change({
            placeholder: 'Pilih Kabupaten/Kota',
            language: 'id'
        })

        $("#paymentSelectKurir").change({
            placeholder: 'Pilih Salah Satu',
            language: 'id'
        })

        $("#paymentSelectService").change({
            placeholder: 'Pilih Service',
            language: 'id'
        })



        $("#paymentSelectProvinces").change(function() {
            $("#paymentSelectRegencies").change({
                placeholder: 'Loading..',
                language: 'id'
            })
            const id = $(this).val();
            $.ajax({
                url: '{{ route('rajaOngkir.getLocation') }}',
                type: "post",
                dataType: "json",
                async: true,
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $("#paymentSelectRegencies").change({
                        placeholder: 'Pilih Kabupaten/Kota',
                        language: 'id'
                    })
                    $("#paymentSelectRegencies").html(data);
                }
            });
        })


        function getKurir(param) {

            $("#paymentSelectKurir").change({
                placeholder: 'Loading..',
                language: 'id'
            })
            var destination = param
            if (destination === "") {
                console.log("kosong provinsi");
            } else {
                $.ajax({
                    url: '{{ route('rajaOngkir.getService') }}',
                    type: "post",
                    dataType: "json",
                    async: true,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        destination: destination
                    },
                    success: function(data) {
                        $("#paymentSelectKurir").change({
                            placeholder: 'Pilih Salah Satu',
                            language: 'id'
                        })
                        $("#paymentSelectKurir").html(data);
                    }
                });
            }

        }

        $("#paymentSelectKurir").change(paymentSelectService);

        function paymentSelectService() {
            let id = $("#paymentSelectKurir").val();
            id = id.split('-');
            id = id[0];
            if (id === "") {
                id = 0;
            }
            $("#paymentSendingPrice").text("Rp" + number_format(id).split(",").join("."));
            const price = $("#paymentPriceTotalAll").val();
            const total = parseInt(price) + parseInt(id);
            $("#paymentTotalAll").text("Rp" + number_format(total).split(",").join("."));
        }

        function number_format(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec)
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || ''
                s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }
    </script>
</body>

</html>
