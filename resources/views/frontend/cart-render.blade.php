<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-title">
                Shop cây cảnh
            </div>
            <div class="card-body">
                <h3>Xin chào quý khách!</h3>
                <p>Quý khách đã đặt hàng tại Shop. Vui lòng nhấn nút xác nhận để mua hàng!</p>
                <div class="col-md-12">
                    <table class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Chiết khấu</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->order_details as $order_detail)
                                <tr>
                                    <th>{{ $order_detail->attribute->product->id }}</th>
                                    <th>
                                        <img src="{{ asset($order_detail->image) }}" alt="" style="with:100px; height:80px;">
                                        {{ $order_detail->attribute->product->name }}
                                    </th>
                                    <th>{{ $order_detail->attribute->size->name }}</th>
                                    <th>{{ $order_detail->attribute->color->name }}</th>
                                    <th>{{ $order_detail->qty }}</th>
                                    <th>{{ number_format($order_detail->attribute->product->price) }} {{ 'VNĐ' }}</th>
                                    <th>{{ $order_detail->attribute->product->discount }} %</th>
                                    <th>{{ number_format($order_detail->attribute->product->price - $order_detail->attribute->product->price * $order_detail->qty * $order_detail->attribute->product->discount / 100)}} {{ 'VNĐ' }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    
                        <tfoot>
                            <tr>
                                <th scope="row">Tổng tiền đơn hàng</th>
                                <th colspan="7">{{ number_format($order->total_price) }} {{ 'VNĐ' }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <a class="btn btn-primary" href="{{ route('verify', ['order' => $order->id]) }}">Xác nhận!</a>
            </div>

            <div class="card-footer">Cảm ơn quý khách đã mua hàng tại Shop!</div>
        </div>
    </div>
</div>