@extends('frontend.app')
@section('content')
    <div class="container">
        <div class="contentbar">
            <!-- Start row -->
            <div class="row">
                <!-- Start col -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title">Sepetim</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="cart-container">
                                        @if($cart)
                                        <div class="cart-head">
                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <tbody>

                                                    @php($product_price_sum = 0)
                                                    @foreach($cart->items as $item)
                                                        @php($product_price_sum = $product_price_sum + $item->price * $item->quantity)
                                                    <tr>
                                                        <td><img src="{{$item->product->image}}" class="img-fluid" width="100" alt="product"></td>
                                                        <td>{{$item->product->title}}</td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input onchange="updateCart({{$item->product->id}},$(this).val())" type="number" class="form-control cart-qty" name="" id="" value="{{$item->quantity}}">
                                                            </div>
                                                        </td>
                                                        <td>{{number_format($item->price, 2, ",", ".") }} TL</td>
                                                        <td class="text-right">{{number_format($item->price * $item->quantity, 2, ",", ".")}} TL</td>
                                                        <td><button onclick="removeFromCart({{$item->product->id}})" class="btn btn-danger">Sil</button> </td>
                                                    </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="cart-body">
                                            <div class="row">
                                                <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                    <div class="order-note">
                                                        <form>

                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                                    <div class="order-total table-responsive ">
                                                        <table class="table table-borderless text-right">
                                                            <tbody>
                                                            <tr>
                                                                <td>Ürün Toplam :</td>
                                                                <td>{{number_format($product_price_sum, 2, ",", ".")}} TL</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kargo :</td>
                                                                <td>Ücretsiz</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="f-w-7 font-18"><h4>Toplam :</h4></td>
                                                                <td class="f-w-7 font-18"><h4>{{number_format($product_price_sum, 2, ",", ".")}} TL</h4></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <h4>Sepetinizde ürün bulunmamaktadır</h4>
                                        @endif
                                        <div class="cart-footer text-right">
                                            <a href="#" class="btn btn-success my-1">Sepeti Onayla<i class="ri-arrow-right-line ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
    </div>
@endsection
@section('scripts')
@parent

@endsection
