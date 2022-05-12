<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>List Product Buku</title>

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
            <h1>List Buku</h1>
            <div class="dua">
                @guest
                    <a href="{{ route('buatbuku') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                        Buku</a>
                @else
                    @foreach ($cart as $item)
                        <a href="{{ route('lihatcart') }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> ({{ $loop->count }})
                            Cart</a>
                        @break
                    @endforeach
                    <a href="{{ route('buatbuku') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                        Buku</a>
                @endguest
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($data as $buku)
                <div class="col-md-3">
                    <div class="card rounded shadow-sm p-3">
                        <img src="{{ asset('image/' . $buku->gambar) }}" alt="" class="img-fluid">
                        <h3 class="font-weight-bold">{{ $buku->judul_buku }}</h3>
                        <p class="text-muted mb-0">Penulis: {{ $buku->penulis }}</p>
                        <p class="text-muted mb-0">Penerbit: {{ $buku->penerbit }}</p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="harga">
                                <p style="margin-bottom: -5px">Harga Buku</p>
                                <small class="font-weight-bold text-primary">Rp. {{ number_format($buku->harga) }}
                                </small>
                            </div>
                            <form action="{{ route('simpancart') }}" method="POST">
                                @csrf
                                <input type="number" hidden name="product_id" value="{{ $buku->id }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>
                                    Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>
