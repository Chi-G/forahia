@extends('admin.admin_master')
@section('admin')
 

<div class="page-wrapper">
	<div class="page-content">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <h5 class="mb-0">All Review  </h5>
          </div>
          <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i></div>
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>S/N</th>
                <th>Product Name  </th>
                <th>Reviewer Name  </th>	
                <th>Rating  </th>
                <th>Comments  </th>			              
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach($review as $item)
              <tr>
                <td>{{ $review->firstItem() + $loop->index }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->reviewer_name }}</td>
                <td>{{ $item->reviewer_rating }}</td>
                <td>{{ $item->reviewer_comments }}</td>
                
                <td>         
                  <a href="{{ route('review-delete', $item->id) }}" id="delete" class="btn btn-danger" ><i class="lni lni-trash"></i></a>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
			</div>
		</div>

    {{ $review->links('vendor.pagination.custom') }}

	</div>
</div>
 
@endsection