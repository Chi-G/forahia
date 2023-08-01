@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">All SubCategory </h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i></div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>S/N</th>
                                <th>Category Name </th>
                                <th>SubCategory Name </th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Updated Date </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($subcategory as $item)
                            <tr>
                                <td>{{ $subcategory->firstItem() + $loop->index }}</td>
                                 <td>{{ $item->category_name }}</td>
                                 <td>{{ $item->subcategory_name }}</td>

                                 @if($item->created_at === Null)
                                 <span class="text-danger"> No Date Set</span>
                                 @else
                                 <td>{{ $item->created_at->diffForHumans() }}</td>
                                 @endif

                                 <td>
                                     <div class="badge rounded-pill bg-light-success text-success w-100">Queued</div>
                                 </td>

                                 @if($item->created_at == Null)
                                 <span class="text-danger"> No Date Set</span>
                                 @else
                                 <td>{{ $item->created_at->diffForHumans() }}</td>
                                 @endif

                                <td>
                                    <a href="{{ route('subcategory-edit', $item->id) }}" class="btn btn-primary" ><i class="lni lni-pencil-alt"></i></a>

                                    <a href="{{ route('subcategory-delete', $item->id) }}" id="delete" class="btn btn-danger" ><i class="lni lni-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
		</div>

		{{ $subcategory->links('vendor.pagination.custom') }}

	</div>
</div>

@endsection
