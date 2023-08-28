<!DOCTYPE html>
<html>
    <head>
        <title>Bukti Pembayaran</title>
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        />
    </head>
    <body>
        <div class="container">
            <div class="card my-5" >
                <div class="card-body">
                    <h3 class="mb-0 text-center mb-4">BUKTI PEMBAYARAN</h3>
                    <hr>
                    <div class="row justify-content-start">
                         <style>
                                .col-md-6 td {
                                    width: 300px;
                                }
                            </style>
                        <div class="col-md-6">
                           
                            <table>
                                
                                <tr>
                                    <td><strong>Tanggal Pembayaran</strong></td>
                                    <td> : {{date('d F Y', strtotime($head->tanggal))}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Siswa</strong></td>
                                    <td class="text-capitalize">: {{$head->nama}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kelas</strong></td>
                                    <td class="text-capitalize">: {{$head->kelas}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Metode Pembayaran</strong></td>
                                    <td class="text-uppercase">: {{$head->akun}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <img src="" alt="">
                        </div>
                    </div>
                    <hr>

                    <table class="table table-striped mt-5">
                        <thead>
                            <tr>
                                <th>Pembayaran</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $i)
                            <tr>
                                <td>{{$i->nama}}</td>
                                <td>Rp. {{$i->nominal}},-</td>
                            </tr>
                            @endforeach
                            <tr style="background-color: yellow">
                                <td><strong>Total Pembayaran:</strong></td>
                                <td><strong>{{$head->masuk}},-</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr />


                    <div class="row justify-content-end">
                         <style>
                                .col-md-6 td {
                                    width: 300px;
                                }
                            </style>
                        <div class="col-md-5 my-5">
                             <p>Terima kasih atas pembayaran Anda.</p>
                             <p>Tanda tangan</p>
                             <br>
                             <br><p>Tata Usaha</p>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
