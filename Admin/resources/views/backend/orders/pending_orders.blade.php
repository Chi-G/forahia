@extends('admin.admin_master')
@section('admin')
 

<div class="page-wrapper">
	<div class="page-content">
		<div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-0">All Pending Order </h5>
					</div>
					<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i></div>
				</div>
				<hr>
				<div class="table-responsive">
					<table class="table align-middle mb-0">
						<thead class="table-light">
							<tr>
								<th>S/N</th>
								<th>Product Name </th>
								<th> Invoice No</th>	
								<th> Quantity </th>
								<th> Total Price</th>
								<th> Order Date</th>
								<th> Order Status</th>			 
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php($i = 1)
							@foreach($orders as $item)
							<tr>
								<td>{{ $orders->firstItem() + $loop->index }}</td>

								<td>{{ $item->product_name }}</td>
								<td>{{ $item->invoice_no }}</td>
								<td>{{ $item->quantity }}</td>
								<td>{{ $item->total_price }}</td>
								<td>{{ $item->order_date }}</td>

								<td>
									<div class="badge rounded-pill bg-light-danger text-danger w-100">{{ $item->order_status }}</div>
								</td>
								
								<td>
									<a href="{{ route('order-details', $item->id) }}" class="btn btn-info" ><i class="fadeIn animated bx bx-message-detail"></i></a>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		{{ $orders->links('vendor.pagination.custom') }}

	</div>
</div>
 
@endsection