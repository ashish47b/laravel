@include('include/other/header')
@include('include/other/sidebar')
@include('include/other/topbar')
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Menue</h6>
                            <button class="addbutton" company_id="{{$userdata->created_by_cid}}">Add More</button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Parent</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($categories)
                                        {{-- {{p($categories)}}; --}}
                                        @foreach ($categories as $name)
                                        <tr>
                                            <th scope="row">{{ $name->id}}</th>
                                            <td>{{ $name->name}}</td>
                                            <td>{{ ($name->parents==0)?'Parent':'Child'}}</td>
                                            <td>{{ ($name->status==1)?'Active':'In-Active'}}</td>
                                        </tr>

                                        @endforeach
                                        @endif

                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- The Modal Add to menus-->
            <div class="modal fade disapproveReasonModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg  ">
                   <div class="modal-content">
                      <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                         </button>
                         <h4 class="modal-title" id="myModalLabel">Reason</h4>
                      </div>
                      <div class="modal-body">
             <form method="post" class="form-horizontal"
              enctype="multipart/form-data" id="contactForm" novalidate="novalidate">
             <!-- Form Start -->
             <div class="container-fluid pt-4 px-4">
                 <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Floating Label</h6>
                            <div class="form-floating mb-3">
                                <input type="taxt" class="form-control" id="mName"
                                    placeholder="menu">
                                    <input type="hidden" value="" id="companyId">
                                <label for="Menu Name">Menu Name</label>
                            </div>
                           <div class="form-floating mb-3">
                                <select class="form-select" id="parentMenu"
                                    aria-label="Floating label select example">
                                </select>
                                <label for="Select Parent Menu">Select Parent Menu</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->
                 <div class="modal-footer">
                    <button type="button" class="btn edit-end-btn" data-dismiss="modal">Close</button>
                    <input type="button" class="btn btn edit-end-btn menusubmit" value="Submit">
                 </div>
                </form>
            </div>
          </div>
        </div>
      </div>

@include('include/other/footer');
<script>
    $(document).on('click','.addbutton',function(){
        $(".disapproveReasonModal").modal("show");
        var company_id=$(this).attr('company_id');
        $('#companyId').val(company_id);
   $.ajax({
      url: '{{ route('get-all-menu-list') }}',
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        company_id: company_id,
      },
      cache:false,
      beforeSend: function () {
          $(".loading").css("display", "block");
      },
      success: function (data) {
        console.log('datadatadata',data)
          //$(".loading").css("disp1lay", "none");
          $('#parentMenu').html(data);
      },
   });
 })
 ///// before click submit buttion
 //// after click submit buttion
  $(document).on('click','.menusubmit',function(){
        var company_id= $('#companyId').val();
        var menuName = $('#mName').val();
        var parentmenu =$('#parentMenu').val();
   $.ajax({
      url: "/createMenu",
      type: "POST",
      data: {
        _token: '{{ csrf_token() }}',
        company_id: company_id,menuName:menuName,parentmenu:parentmenu
      },
      beforeSend: function () {
          $(".loading").css("display", "block");
      },
      success: function (data) {
       // alert(data)
         if(data=="Menu Add Successfully"){
            location.reload();
         }

      },
   });

  })
    </script>

