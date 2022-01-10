<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
        <!-- partial -->
        <div style="padding-bottom:30px;" class="container-fluid page-body-wrapper">
            <div class="container" align="center">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{session()->get('message')}}
                    </div>
                @endif
                <table>
                    <tr style="background-color: grey;">
                        <td style="padding: 20px;">Title</td>
                        <td style="padding: 20px;">Description</td>
                        <td style="padding: 20px;">Quantity</td>
                        <td style="padding: 20px;">Price</td>
                        <td style="padding: 20px;">Image</td>
                        <td style="padding: 20px;">Update</td>
                        <td style="padding: 20px;">Delete</td>
                    </tr>
                    @foreach ($data as $product)
                        <tr style="background-color: black;" align="center">
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <img height="100" width="100" src="/productimage/{{$product->image}}" alt="">
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{url('updateview', $product->id)}}">Update</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Are You Sure')" href="{{url('deleteproduct', $product->id)}}">Delete</a>
                            </td>
                        </tr>    
                    @endforeach
                </table>
                    @if(method_exists($data,'links'))
                    <br>
                        <div class="d-flex justify-content-center">
                        
                        {!! $data->links() !!}

                        </div>
                    @endif
                    
            </div>
            
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
        @include('admin.script')
  </body>
</html>