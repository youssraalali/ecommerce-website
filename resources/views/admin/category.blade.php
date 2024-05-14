<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin/css')

    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color {
            color: black;
        }

        .cat_tab {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 2px solid;
        }

        .cat_td {
            color: white;
        }

        .th_color {
            background-color: #36454F;
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
                    <div class="div_center">
                        <h2 class="h2_font">Category Add</h2>
                        <form action="{{url('/add_category')}}" method="POST">
                        @csrf
                            <input class="input_color" type="text" name="category" placeholder="Category name">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </form>
                    </div>

                    <table class="cat_tab">
                        <tr class="th_color">
                            <td>Category Name</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($data as $Data)

                        </tr>
                            <td class="cat_td">{{$Data->Category_name}}</td>
                            <td>
                                <a onclick="return confirm('Are you sure To delete this category?')" class="btn btn-danger" href="{{url('/delete_category' ,$Data->id)}}">
                                    Delete
                                </a>
                            </td>
                        <tr>

                        @endforeach
                    </table>
            </div>

        </div>
        <!-- container-scroller -->
        <!-- plugin-js -->
        @include('admin.js')
        <!-- End custom js for this page -->
</body>
</html>
