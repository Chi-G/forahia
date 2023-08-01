@extends('admin.admin_master')
@section('admin')


<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">All Product </h5>
                    </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i></div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>S/N</th>
                                <th>Product Image </th>
                                <th>Product Name </th>
                                <th>Product Code </th>
                                <th>Status</th>
                                <th>Product Category </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($products as $item)
                            <tr>
                                <td>{{ $products->firstItem() + $loop->index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src=" {{ $item->image }} " alt="">
                                        </div>
                                    </div>
                               </td>

                               <td>{{ $item->title }}</td>
                               <td>{{ $item->product_code }}</td>

                               <td>
                                  <div class="badge rounded-pill bg-light-success text-success w-100">Submitted</div></td>
                               <td>{{ $item->category }}</td>

                               <td>                                
                                    <a href="{{ route('product-edit', $item->id) }}" class="btn btn-primary" ><i class="lni lni-pencil-alt"></i></a>

                                    <a href="{{ route('product-delete', $item->id) }}" id="delete" class="btn btn-danger" ><i class="lni lni-trash"></i></a>
                               </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $products->links('vendor.pagination.custom') }}

	</div>
</div>

@endsection
