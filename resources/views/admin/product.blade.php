<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin/css')
    <style>
        .center_div {
            text-align: center;
            padding-top: 15px;
        }

        .h2_font {
            font-size: 30px;
            padding-bottom: 15px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 15px;
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            x
                        </button>
                        {{session()->get('msg')}}
                    </div>
                @endif
                <div class="center_div">
                    <h2 class="h2_font">Add Product</h2>

                    <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div_design">
                        <label>Product title</label>
                        <input class="input_color" type="text" name="title" placeholder="Write a title" required>
                    </div>

                    <div class="div_design">
                        <label>Product Description</label>
                        <input class="input_color" type="text" name="desc" placeholder="Write a description" required>
                    </div>

                    <div class="div_design">
                        <label>Product Price</label>
                        <input class="input_color" type="number" name="price" placeholder="Write a price" required>
                    </div>

                    <div class="div_design">
                        <label>Discount Price</label>
                        <input class="input_color" type="number" name="dis_price" placeholder="Write a discount">
                    </div>

                    <div class="div_design">
                        <label>Product Quantity</label>
                        <input class="input_color" type="number" name="Quantity" min="0" placeholder="Write a quantity" required>
                    </div>

                    <div class="div_design">
                        <label>Product category</label>
                        <select class="input_color" name="category" required>
                        <option value="" selected>Choose a Category</option>
                        @foreach($category as $catag)
                            <option value="{{$catag->Category_name}}">{{$catag->Category_name}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="div_design">
                        <label>Product Image</label>
                        <input type="file" name="image" required>
                    </div>

                    <div class="div_design">
                        <input class="btn btn-primary" type="submit" value="Add Product">
                    </div>
                    </form>
                </div>


            </div>
        </div>
        <!-- container-scroller -->
        @include('admin.js')
        <!-- End custom js for this page -->
</body>
</html>