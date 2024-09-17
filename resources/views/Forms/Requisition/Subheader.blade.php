<div class="d-flex align-items-center flex-wrap mr-1">
      <a href="/list-requisition" class="btn btn-light text-primary font-weight-bolder btn-sm font-size-lg mr-5">
        <i class="flaticon-list icon-xl text-primary"></i>
        <span class="font-size-h4">
            Requisition List
        </span>
    </a>

    <a href="/list-requisition-orders" class="btn btn-light text-primary font-weight-bolder btn-sm font-size-lg mr-5">
        <i class="flaticon-list icon-xl text-primary"></i>
        <span class="font-size-h4">
            Requisition Orders
        </span>
    </a>

    <a href="/create-requisition" class="btn btn-light text-primary font-weight-bolder btn-sm mr-5">
        <i class="flaticon-add-circular-button icon-xl text-primary"></i>
        <span class="font-size-h4">Create Request</span>
    </a>

    @if(session()->get('user')->regional_manager==1 || session()->get('user')->branch_manager==1)
      <a href="/request-requisition" class="btn btn-light text-primary font-weight-bolder btn-sm mr-5">
        <i class="flaticon-add-circular-button icon-xl text-primary"></i>
        <span class="font-size-h4">Approvals</span>
    </a>
    @endif
</div>
