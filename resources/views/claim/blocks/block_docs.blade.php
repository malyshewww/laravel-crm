<div class="group-data__item item-group" id="groupDataStatusDocs">
	<div class="item-group__top"> 
		<div class="item-group__title">ДОКУМЕНТЫ ТУРИСТУ</div>
		<button class="item-group__button btn-blue btn-redact" type="button" 
			data-bs-toggle="modal" data-bs-target="#docModal"
			data-id="{{$claim->id}}" 
			data-type="update" 
			data-claim-id="{{$claim->id}}" 
			data-url="{{route('statusDoc.store')}}" data-path="{{route('statusDoc.loadModal', [$claim->id, 'update'])}}" data-title="Статус отправки докумнтов">
		[изменить]
		</button>
		@if ($claim->doc)
			@switch($claim->doc->status)
					@case('no_send')
						<div class="item-group__status status-not-sent">
							<i class="fa-solid fa-circle-xmark"></i>
							Не отправлены
						</div>
						@break
					@case('send_part')
						<div class="item-group__status status-part">
							<i class="fa-solid fa-rotate"></i>
							Отправлены частично
						</div>
						@break
					@case('send_full')
						<div class="item-group__status status-full">
							<i class="fa-solid fa-circle-check"></i>
							Отправлены
						</div>
						@break
					@default
			@endswitch
		@endif
	</div>
</div>