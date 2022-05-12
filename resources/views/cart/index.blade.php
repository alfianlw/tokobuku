<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>List Keranjang Buku</title>

    {{-- font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if ($message = Session::get('salah'))
            <div class="alert alert-danger alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="d-flex justify-content-between mt-3">
            <h1>Keranjang</h1>
            <div class="dua">
                @guest
                    <a href="{{ route('listbuku') }}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i>
                        Kembali</a>
                @else
                    @foreach ($cart as $item)
                        <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> ({{ $loop->count }})
                            Cart</a>
                    @break
                @endforeach
                <a href="{{ route('listbuku') }}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i>
                    Kembali</a>
            @endguest
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-md-10">
            <div class="card rounded shadow-sm p-3">
                @if (empty($data[0]))
                    <h2 class="text-center text-danger">Keranjang Kosong !</h2>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pembeli</th>
                                <th scope="col">Product</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sum_tot_Price = 0; ?>
                            @foreach ($data as $cart)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $cart->name }}</td>
                                    <td>{{ $cart->judul_buku }}</td>
                                    <td>Rp {{ number_format($cart->harga) }}</td>
                                    <td><a href="{{ route('hapuscart', $cart->idcart) }}"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php $sum_tot_Price += $cart->harga; ?>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                @if (!empty($sum_tot_Price))
                    <p class="float-right">Total Harga : Rp {{ number_format($sum_tot_Price) }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>
