<div class="modal__footer">
	<div class="modal__buttons">
		<button class="btn btn-success" type="submit">
			<i class="fa-solid fa-check"></i>
			@isset($saveButton)
				{{$saveButton}}
			@endisset
			@empty($saveButton)
				Сохранить
			@endempty
		</button>
		<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
	</div>
</div>