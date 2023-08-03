<div class="row align-items-end">
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Наименование банка</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_bank"
				value="{{$company->company_bank ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Бик</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_bik"
				value="{{$company->company_bik ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Р/с</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_rs"
				value="{{$company->company_rs ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">К/с</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_ks"
				value="{{$company->company_ks ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="field-group__item">
			<label class="field-group__label">Полное наименование юр.лица</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_fullname"
				value="{{$company->company_fullname ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="field-group__item">
			<label class="field-group__label">Сокращенное наименование юр.лица</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_shortname"
				value="{{$company->company_shortname ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="field-group__item">
			<label class="field-group__label">Юридический адрес</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_address"
				value="{{$company->company_address ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="field-group__item">
			<label class="field-group__label">Фактический адрес</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_actual_address"
				value="{{$company->company_actual_address ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row"> 
	<div class="col-lg-4">
		<div class="field-group__item">
			<label class="field-group__label">КПП</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_kpp"
				value="{{$company->company_kpp ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="field-group__item">
			<label class="field-group__label">ИНН</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_inn"
				value="{{$company->company_inn ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="field-group__item">
			<label class="field-group__label">ОГРН</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_ogrn"
				value="{{$company->company_ogrn ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="field-group__item">
			<label class="field-group__label">Фио директора</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="company_director"
				value="{{$company->company_director ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="field-group__item">
			<label class="field-group__label">Телефон</label>
			<div class="field-group__box">
				<input class="field-group__input" type="tel" name="company_phone"
				value="{{$company->company_phone ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="field-group__item">
			<label class="field-group__label">E-mail</label>
			<div class="field-group__box">
				<input class="field-group__input" type="email" name="company_email"
				value="{{$company->company_email ?: ''}}" autocomplete="off">
			</div>
		</div>
	</div>
</div>