<div class="field-group">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="field-group__item">
				<label class="field-group__label">Статус отправки документов</label>
				<select data-select name="status">
					<option value=""></option>
					@php
						$arrStatus = DocsHelper::status();
					@endphp
					@foreach ($arrStatus as $statusItem)
						<option
							{{$claim->doc && $claim->doc->status === $statusItem['value'] ? ' selected' : ''}}
							value="{{$statusItem['value']}}">{{$statusItem['title']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>
