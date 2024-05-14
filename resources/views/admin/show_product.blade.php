<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin/css')
    <style type="text/css">
        .tab_center {
            margin: auto;
            width: 50%;
            border: 2px solid;
            text-align: center;
            margin-top: 40px;
        }

        .h2_font {
            text-align: center;
            font-size: 30px;
            padding-top: 20px;
        }

        .img_design{
            width: 100px;
            height: 100px;
        }

        .th_col {
            background-color: #36454F;
        }

        .th_design {
            padding: 15px;
        }


    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"">
                            x
                        </button>
                        {{session()->get('msg')}}
                    </div>
                @endif

                <h2 class="h2_font">All Product</h2>
                <div class="tab_div">
                <table class="tab_center">
                    <tr class="th_col">
                        <th class="th_design">Product Title</th>
                        <th class="th_design">Description</th>
                        <th class="th_design">Quantity</th>
                        <th class="th_design">Category</th>
                        <th class="th_design">Price</th>
                        <th class="th_design">Discount Price</th>
                        <th class="th_design">Product Image</th>
                        <th class="th_design">Delete</th>
                        <th class="th_design">Edit</th>
                    </tr>

                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->category}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount_price}}</td>
                        <td>
                            <img class="img_design" src="/product/{{$product->image}}">
                        </td>
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this product?')" href="{{url('/delete_product', $product->id)}}">Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{url('update_product', $product->id)}}">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        @include('admin.js')
        <!-- End custom js for this page -->

</body>
</html>
