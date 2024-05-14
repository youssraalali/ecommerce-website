<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>ALL FOR YOU SHOP</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />

    <style>
        .h2_des {
            font-family: 'calibri';
        }

        .img_des {
            width: 120px;
            height: 120px;
        }

        .data {
            border: 2px solid gray;
        }

        td {
            padding: 15px;
        }

        .gap {
            padding-right: 250px;
        }

        .center {
            width: 100%;
        }

        .td_price {
            font-weight: bold;
        }

        th {
            color: gray;
            font-size: 15 px;
        }

        .hero_area {
            padding-right: 70px ;
            padding-left: 70px ;
        }
        .tot_price {
            text-align: end;
            font-weight: bold;
        }
        .btn_del {
            padding-top: 8px;
        }
        .payment {
            margin: auto;
            text-align: center;
            padding-bottom: 30px;
        }
    </style>
</head>



<body>
    <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        <div class="container">
        @if (session()->has('msg'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            x
                        </button>
                        {{session()->get('msg')}}
                    </div>
                @endif
            <h3 class="h2_des">MY SHOPPING BAG</h3>
            <table class="center">
                <tr>
                    <th class="th_des">PRODUCT</th>
                    <th class="th_des2"></th>
                    <th class="th_des">PRICE</th>
                </tr>
                <?php $tot_price = 0; ?>
                @foreach ($carts as $cart)
                <tr class="data">
                    <td><img class="img_des" src="/product/{{$cart->image}}" </td>
                    <td class="gap">
                        <h6>{{$cart->product_title}}</h6>
                        QTY: {{$cart->quantity}}
                        <p class="btn_del">
                        <a onclick="return confirm('Are You Sure To Delete This Item?')" class="btn btn-danger" href="{{url('delete_cart', $cart->id)}}">REMOVE</a>
                        </p>
                    </td>
                    <td class="td_price">${{$cart->price}}</td>
                </tr>
                <?php $tot_price += $cart->price ?>
                @endforeach
                <tr class="data">
                    <td colspan="4" class="tot_price">
                            Total Price: ${{$tot_price}}
                        </td>
                </tr>
            </table>
        </div>

        <div class="payment">
            <h3 style="padding-bottom: 10px;">CHECKOUT</h3>
            <a class="btn btn-danger" href="{{url('cash_order')}}">Cash on Delivery</a>
            <a class="btn btn-danger" href="{{url('stripe', $tot_price)}}">Credit Card</a>
        </div>
    </div>

    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
