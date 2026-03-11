@extends('layouts.admin')

@section('title', 'Order Details - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Order Details <span class="text-white">অর্ডার বিবরণ</span></h2>
        <p class="text-white mb-0">Order #{{ $order->order_number }}</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.orders.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left me-2"></i> Back to Orders
        </a>
    </div>
</div>

<!-- Order Details -->
<div class="glass-card mb-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-primary border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-shopping-cart me-2"></i>Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Order Number:</label></div>
                        <div class="col-sm-8"><code class="text-warning">{{ $order->order_number }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Order Date:</label></div>
                        <div class="col-sm-8"><span class="text-white">{{ $order->created_at->format('M d, Y h:i A') }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Customer:</label></div>
                        <div class="col-sm-8">
                            <span class="text-white fw-bold">{{ $order->user->name ?? 'Guest' }}</span><br>
                            <small class="text-info">{{ $order->user->email ?? 'N/A' }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Order Status:</label></div>
                        <div class="col-sm-8">
                            @if($order->status === 'pending')
                                <span class="badge bg-warning">Pending / মুলতুম্বর</span>
                            @elseif($order->status === 'processing')
                                <span class="badge bg-info">Processing / প্রক্রিয়া</span>
                            @elseif($order->status === 'shipped')
                                <span class="badge bg-primary">Shipped / পাঠানো হয়েছে</span>
                            @elseif($order->status === 'delivered')
                                <span class="badge bg-success">Delivered / বিতরণ করা হয়েছে</span>
                            @elseif($order->status === 'cancelled')
                                <span class="badge bg-danger">Cancelled / বাতিল</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><label class="text-muted">Payment Status:</label></div>
                        <div class="col-sm-8">
                            @if($order->payment_status === 'paid')
                                <span class="badge bg-success">Paid / পরিশোধ করা হয়েছে</span>
                            @elseif($order->payment_status === 'pending')
                                <span class="badge bg-warning">Pending / মুলতুম্বর</span>
                            @elseif($order->payment_status === 'failed')
                                <span class="badge bg-danger">Failed / ব্যর্থ</span>
                            @else
                                <span class="badge bg-info">Refunded / রিফান্ড</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-success border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-calculator me-2"></i>Order Totals</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6"><label class="text-muted">Subtotal:</label></div>
                        <div class="col-sm-6"><span class="text-white">৳{{ number_format($order->total_amount, 2) }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><label class="text-muted">Discount:</label></div>
                        <div class="col-sm-6"><span class="text-danger">-৳{{ number_format($order->discount, 2) }}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><label class="text-muted">Total:</label></div>
                        <div class="col-sm-6"><span class="text-success fs-5 fw-bold">৳{{ number_format($order->final_amount, 2) }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Items -->
<div class="glass-card mb-4">
    <div class="card-header bg-info border-secondary">
        <h5 class="mb-0 text-white"><i class="fas fa-box me-2"></i>Order Items ({{ $order->orderItems->count() }})</h5>
    </div>
    <div class="card-body bg-dark">
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th class="text-white">Product</th>
                        <th class="text-white">SKU</th>
                        <th class="text-white">Price</th>
                        <th class="text-white">Quantity</th>
                      <th class="text-white">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                <div class="fw-bold text-white">{{ $item->product->name_en }}</div>
                                <small class="text-info">{{ $item->product->name_bn }}</small>
                                <br><small class="text-white-50">{{ $item->product->category->name_en ?? 'N/A' }}</small>
                            </td>
                            <td><code class="text-warning">{{ $item->product->sku }}</code></td>
                            <td><span class="text-white">৳{{ number_format($item->price, 2) }}</span></td>
                            <td><span class="badge bg-primary">{{ $item->quantity }}</span></td>
                            <td><span class="text-success fw-bold">৳{{ number_format($item->subtotal, 2) }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Update Order Status -->
<div class="glass-card">
    <div class="card-header bg-warning border-secondary">
        <h5 class="mb-0 text-white"><i class="fas fa-edit me-2"></i>Update Order Status</h5>
    </div>
    <div class="card-body bg-dark">
        <form action="{{ route('admin.ecommerce.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-white">Order Status</label>
                    <select name="status" class="form-select bg-dark text-white border-secondary">
                        <option value="pending" @if($order->status === 'pending') selected @endif>Pending / মুলতুম্বর</option>
                        <option value="processing" @if($order->status === 'processing') selected @endif>Processing / প্রক্রিয়া</option>
                        <option value="shipped" @if($order->status === 'shipped') selected @endif>Shipped / পাঠানো হয়েছে</option>
                        <option value="delivered" @if($order->status === 'delivered') selected @endif>Delivered / বিতরণ করা হয়েছে</option>
                        <option value="cancelled" @if($order->status === 'cancelled') selected @endif>Cancelled / বাতিল</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-white">Payment Status</label>
                    <select name="payment_status" class="form-select bg-dark text-white border-secondary">
                        <option value="pending" @if($order->payment_status === 'pending') selected @endif>Pending / মুলতুম্বর</option>
                        <option value="paid" @if($order->payment_status === 'paid') selected @endif>Paid / পরিশোধ করা হয়েছে</option>
                        <option value="failed" @if($order->payment_status === 'failed') selected @endif>Failed / ব্যর্থ</option>
                        <option value="refunded" @if($order->payment_status === 'refunded') selected @endif>Refunded / রিফান্ড</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-gradient w-100">
                        <i class="fas fa-save me-2"></i> Update Status / আপডেট করুন
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
