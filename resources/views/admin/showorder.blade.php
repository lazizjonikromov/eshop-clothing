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
        <div class="container-fluid page-body-wrapper">
            <div class="container" align="center">
                <br>
                <table>
                    <tr style="background-color: grey;">
                        <td style="padding: 20px;">Customer name</td>
                        <td style="padding: 20px;">Phone</td>
                        <td style="padding: 20px;">Address</td>
                        <td style="padding: 20px;">Product title</td>
                        <td style="padding: 20px;">Price</td>
                        <td style="padding: 20px;">Quantity</td>
                        <td style="padding: 20px;">Totals Price</td>
                        <td style="padding: 20px;">Status</td>
                        <td style="padding: 20px;">Action</td>
                    </tr>

                    @foreach ($order as $orders)
                        <tr align="center" style="background-color: black;">
                            <td style="padding: 20px;">{{$orders->name}}</td>
                            <td style="padding: 20px;">{{$orders->phone}}</td>
                            <td style="padding: 20px;">{{$orders->address}}</td>
                            <td style="padding: 20px;">{{$orders->product_name}}</td>
                            <td style="padding: 20px;">{{$orders->price}}</td>
                            <td style="padding: 20px;">{{$orders->quantity}}</td>
                            <td style="padding: 20px;">{{$orders->totalprice}}</td>
                            <td style="padding: 20px;">{{$orders->status}}</td>
                            <td style="padding: 20px;">
                                <a href="{{url('updatestatus', $orders->id)}}" class="btn btn-success">
                                    Delivered
                                </a>
                            </td>
                        </tr> 
                    @endforeach
                    
                </table>
                <br>
                    @if(method_exists($order,'links'))
                        <div class="d-flex justify-content-center">
                        
                        {!! $order->links() !!}

                        </div>
                    @endif    
                <br>
            </div>
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
        @include('admin.script')
  </body>
</html>