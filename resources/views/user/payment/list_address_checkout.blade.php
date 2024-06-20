 @foreach ($address as $ad)
     <div class="row mt-2">
         <div class="col-lg-12">
             <div class="card-body">
                 <h4 class="card-title">{{ $ad->name }}</h4>
                 <a class="float-right btn_edit_address" href="#edit-address" data-toggle="modal" data-id="{{ $ad->id }}">Cập nhật</a>
                 <p>Liên hệ: {{ $ad->phone }}</p>
                 <p> Địa chỉ:
                     {{ $ad->city }} - {{ $ad->district }} -
                     {{ $ad->ward }} 
                 </p>
                 <p>Địa chỉ cụ thể: {{ $ad->home_address }}</p>

                 @if ($ad->type == 1)
                     <button type="button" data-id="{{ $ad->id }}" class="btn btn-warning btn_address_default">Mặc
                         định</button>
                 @else
                     <button type="button" data-id="{{ $ad->id }}"
                         class="btn btn-outline-warning btn_address_default">Mặc định</button>
                 @endif
             </div>
         </div>
     </div>
 @endforeach
