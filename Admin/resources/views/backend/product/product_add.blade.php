@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-wrapper">
    <div class="page-content">
		<!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('all-product') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
           <div class="card-body p-4">
              <h5 class="card-title">Add New Product</h5>
              <hr>
              <div class="form-body mt-4">

                 <form method="post" action="{{ route('product-store') }}" enctype="multipart/form-data">
                    @csrf 
                       <div class="row">
                          <div class="col-lg-8">
                             <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Title</label>
                                    <input required type="text" name="title" class="form-control" id="inputProductTitle" placeholder="Enter product title">                                    
                                </div>

                                <div class="mb-3">
                                   <label for="inputProductTitle" class="form-label">Product Code</label>
                                   <input required type="text" name="product_code" class="form-control" id="inputProductTitle" placeholder="Enter product Code">
                                </div>

                                <div class="mb-3">
                                   <label for="formFile" class="form-label">Product Thumbnail </label>
                                   <input required class="form-control" name="image" type="file" id="image">
                                </div>

                                <div class="mb-3">
                                  <img id="showImage" src="{{ url('upload/user.png')   }}" style="width:100px; height: 100px;" >
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image One</label>
                                    <input class="form-control" name="image_one" type="file"  >
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image Two</label>
                                    <input class="form-control" name="image_two" type="file"  >
                                </div>

                                <div class="mb-3">
                                   <label for="formFile" class="form-label">Image Three</label>
                                   <input class="form-control" name="image_three" type="file"  >
                                </div>

                                <div class="mb-3">
                                   <label for="formFile" class="form-label">Image Four</label>
                                   <input class="form-control" name="image_four" type="file"  >
                                </div>

                                <div class="mb-3">
                                   <label for="inputProductDescription" class="form-label">Short Description</label>
                                   <textarea name="short_description" class="form-control" id="inputProductDescription" rows="3"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Long Description</label>
                                    <textarea name="long_description" id="mytextarea" rows="3"></textarea>
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-4">
                             <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                   <div class="col-md-6">
                                      <label for="inputPrice" class="form-label">Price</label>
                                      <input required type="text" name="price" class="form-control" id="inputPrice" placeholder="00.00">
                                   </div>

                                   <div class="col-md-6">
                                     <label for="inputCompareatprice" class="form-label">Special Price</label>
                                     <input required type="text" name="special_price" class="form-control" id="inputCompareatprice" placeholder="00.00">
                                   </div>

                                   <div class="col-12">
                                     <label for="inputProductType" class="form-label">Product Category</label>
                                     <select required name="category" class="form-select" id="category">
                                       <option selected="">Select Category</option>
                                          @foreach($category as $item)
                                            <option value="{{ $item->id }}"> {{ ucfirst($item->category_name) }}</option>
                                          @endforeach
                                     </select>
                                   </div>

                                    <div class="col-12">
                                       <label for="inputProductType" class="form-label">Product SubCategory</label>
                                       <select required name="subcategory" class="form-select" id="subcategory">
                                          <option value="" id="subcategory">Select SubCategory</option>
                                             {{-- @foreach($subcategory as $item)
                                                <option value="{{ $item->subcategory_name }}"> {{ $item->subcategory_name }}</option>
                                             @endforeach --}}
                                       </select>
                                    </div>

                                    <div class="col-12">
                                       <label for="inputCollection" class="form-label">Brand </label>
                                      <input type="text" name="brand" value="" class="form-control" id="inputBrand" placeholder="Your Product Brand Name">                                      
                                    </div>

                                   <div class="mb-3">
                                     <label class="form-label">Product Size</label>                                    
                                     <input required type="text" name="size" class="form-control visually-hidden" data-role="tagsinput" value="S, M, L, XL, XXL">
                                   </div>

                                   <div class="mb-3">
                                     <label class="form-label">Product Color</label>
                                     <input required type="text" name="color" class="form-control visually-hidden" data-role="tagsinput" value="Red, White, Black">
                                   </div>

                                   <div class="form-check">
                                      <input class="form-check-input" name="remark" type="checkbox" value="FEATURED" id="flexCheckDefault">
                                      <label class="form-check-label" for="flexCheckDefault">FEATURED</label>
                                   </div>

                                   <div class="form-check">
                                     <input class="form-check-input" name="remark" type="checkbox" value="NEW" id="flexCheckDefault">
                                     <label class="form-check-label" for="flexCheckDefault">NEW</label>
                                   </div>

                                   <div class="form-check">
                                     <input class="form-check-input" name="remark" type="checkbox" value="COLLECTION" id="flexCheckDefault">
                                     <label class="form-check-label" for="flexCheckDefault">COLLECTION</label>
                                   </div>

                                   <div class="col-12">
                                      <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Save Product</button>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div><!--end row-->
                    </form><!--end form-->
			     </div>
		      </div>
		   </div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);

		});
	});
</script>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
	</script>
	<script>
		tinymce.init({
		  selector: '#mytextarea'
		});
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        $('#categorySelect').on('change', function() {
            var category = $(this).val();

            if (category) {
                $.ajax({
                    url: "{{ route('getSubcategories', ['category' => '']) }}/" + category,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var subcategorySelect = $('#subcategorySelect');
                        subcategorySelect.empty();
                        
                        $.each(data, function(key, value) {
                            subcategorySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#subcategorySelect').empty();
            }
        });
    });
</script> --}}

@endsection
