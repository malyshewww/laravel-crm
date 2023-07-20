@extends('layouts.app')
@section('title')
	Страница заявки № {{$claim->id}}
@endsection
@section('content')
	<section class="claim">
		<div class="container">
			<div class="claim__body">
				<div class="claim__header">
					<div class="claim__top"> 
						<h1 class="claim__title">
							Заявка № <span class="claim-number">{{$claim->id}}-{{date('Y')}}</span>
						</h1>
						<button type="button" class="claim__copy btn-copy" id="btn-copy"><i class="fa-regular fa-paste"></i></button>
						<div class="claim__subtitle">
							<strong>{{Auth::user()->name}}</strong> создана: {{$claim->created_at->format('d.m.Y H:i:s')}} МСК.
						</div>
					</div>
					<div class="claim__comment comment-claim">
						<div class="comment-claim__box">
							<button class="claim__button btn-blue btn-redact" 
								type="button" data-bs-toggle="modal" data-bs-target="#commentModal"
								data-id="{{$claim->id}}" 
								data-type="update"
								data-claim-id="{{$claim->id}}"
								data-url="{{route('claim.store')}}"
								data-path="{{route('claim.loadModal', [$claim->id, 'update', request()->get('status')])}}"
								data-title="{{$claim->comment ? 'Комментарий (редактирование)' : 'Комментарий'}}">
								<span>{{$claim->comment ? 'редактировать комментарий' : 'добавить комментарий'}}</span>
							</button>
							@if ($claim->comment)
								<div class="comment-claim__text">{{$claim->comment}}</div>
							@endif
						</div>
					</div>
				</div>
				<div class="claim__tabs tabs-claim">
					<nav class="tabs-claim__navigation"> 
						<ul class="tabs-claim__list"> 
							<li class="tabs-claim__item tabs-item" data-tab="info">Информация по заявке</li>
							<li class="tabs-claim__item tabs-item" data-tab="finance">Финансы</li>
							<li class="tabs-claim__item tabs-item" data-tab="contract">Договоры</li>
						</ul>
					</nav>
					<div class="tabs-claim__content"> 
						<div class="tabs-claim__data data-claim tabs-content" data-tab-content="info">
							<div class="data-claim__groups">
								<div class="data-claim__group group-data">
									<div class="row g-20">
										<div class="col col-xl-6 col-12">
											@include('claim.blocks.block_docs')
											@include('claim.blocks.block_tourpackage')
											@include('claim.blocks.block_touroperator')
											@include('claim.blocks.block_contract')
										</div>
									</div>
								</div>
								{{-- Блок с данными о заказчике --}}
								@include('claim.blocks.block_customers')
								{{-- Блок с данными о туристах --}}
								@include('claim.blocks.block_tourists')
								{{-- Блок с данными об услугах --}}
								@include('claim.blocks.block_services')
								{{-- Блок с данными о добавленных файлах --}}
								@include('claim.blocks.block_file')
							</div>
						</div>
						<div class="tabs-claim__data data-claim tabs-content" data-tab-content="finance">
							<div class="data-claim-groups"> 
								<div class="data-claim__group">
									<div class="row">
										<div class="col col-xl-6 col-12">
											{{-- Блок с финансовыми данными --}}
											@include('claim.blocks.block_finance')
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tabs-claim__data data-claim tabs-content" data-tab-content="contract">
							<div class="data-claim-groups"> 
								<div class="data-claim__group">
									<div class="row"> 
										<div class="col col-lg-4 col-12">
											<form action="{{route('docExport')}}" method="post" id="formGenerateDocs">
												@csrf
												<input type="hidden" name="id" value="{{$claim->id}}">
												<div class="field-group__item">
													<label class="field-group__label">Выберите тип договора</label>
													<select class="choices" name="doc_type" id="choiceTypeDoc">
														<option value="doc_avia">Авиатуры</option>
														<option value="doc_bus">Автобусные туры</option>
													</select>
												</div>
												<div class="geneator-button-wrapper mt-3">
													<button class="btn btn-blue btn-primary btn-sm" type="submit">
														<i class="btn-generator-doc"></i>
														Сформировать договор
													</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('page-modal')
	@include('claim.showmodals.file')

	@include('claim.customer.modal_customer')
	
	@include('claim.comment.modals.modal_comment')
	@include('claim.doc.modal_doc')
	@include('claim.contract.modals.contract')
	@include('claim.touroperator.modals.touroperator')
	@include('claim.tourpackage.modals.tourpackage')

	@include('claim.tourists.modals.create_tourist')
	@include('claim.tourists.modals.update_tourist')

	@include('claim.services.modals.flights')
	@include('claim.services.modals.insurance')
	@include('claim.services.modals.transfer')
	@include('claim.services.modals.visa')
	@include('claim.services.modals.habitation')
	@include('claim.services.modals.fuelsurchange')
	@include('claim.services.modals.excursion')
	@include('claim.services.modals.other')
	@include('claim.services.modals.service_update_modal')

	@include('claim.finance.modals.prepayment')
	@include('claim.finance.modals.payment')
	@include('claim.finance.modals.payment_invoice')
	@include('claim.finance.modals.update_payment_invoice')

	@include('claim.showmodals.record_action')
@endsection