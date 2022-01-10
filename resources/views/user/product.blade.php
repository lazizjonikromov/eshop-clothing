<div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>

              <form action="{{url('search')}}" method="get" class="form-inline" style="float:right; padding:10px;">
                @csrf
                <input class="form-control" type="search" name="search" placeholder="search">
                <input style="margin-left: 10px;" type="submit" value="Search" class="btn btn-success">
              </form> 

            </div>
          </div>
          @foreach ($data as $product)
            
          <div class="col-md-4">
            <div class="product-item">
              <a href="{{url('product_detail',['product'=>$product->id])}}"><img height="300" width="150" src="/productimage/{{$product->image}}" alt=""></a>
              <div class="down-content">
                <a href="{{url('product_detail',['product'=>$product->id])}}"><h4>{{$product->title}}</h4></a>
                <h6>${{$product->price}}</h6>
                <p>{{$product->description}}</p>
                
                
                <form action="{{url('addcart',$product->id)}}" method="post">
                  @csrf

                  <input type="number" name="quantity" class="form-control" style="width:100px;" value="1" min="1">
                  
                  <br>
                  
                  <input type="submit" style="float: right;" value="Add Cart" class="btn btn-primary">
                </form>

                <button class="btn btn-success" ><a href="{{url('product_detail',['product'=>$product->id])}}" style="text-decoration:none; color:white;">View</a></button>
                  
              </div>
            </div>
          </div>

          @endforeach

          @if(method_exists($data,'links'))
            <div class="d-flex justify-content-center">
              
              {!! $data->links() !!}

            </div>
          @endif
        </div>
      </div>
    </div>
