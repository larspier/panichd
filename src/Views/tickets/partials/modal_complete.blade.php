<!-- Modal Dialog -->
<div class="modal fade" id="ticket-complete-modal" role="dialog" aria-hidden="true">
  <div class="modal-dialog {{ $u->currentLevel() == 1 ? 'modal-lg' : ''}}">
    <div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">{{ trans('ticketit::lang.flash-x') }}</button>
		<h4 class="modal-title">{{ trans('ticketit::lang.btn-mark-complete') }}</h4>
		</div>
		<div class="modal-body">

		{!! CollectiveForm::open([
			'method' => 'PATCH',
			'route' => [
						$setting->grab('main_route').'.complete',
						$ticket->id
						],
			'id' => 'complete-ticket-form',
			'class' => 'form-horizontal'			
			])
		!!}
		
		@if ($u->currentLevel() > 1 && $u->canManageTicket($ticket->id))
			<div class="form-group">
				{!! CollectiveForm::label('status_id', trans('ticketit::lang.status') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
				<div class="col-lg-10">
					{!! CollectiveForm::select('status_id', $status_lists, $setting->grab('default_close_status_id'), [
						'class' => 'form-control'
					]) !!}
				</div>
			</div>
			
			@if (!$ticket->intervention_html)
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<label><input type="checkbox" id="blank_intervention_check" name="blank_intervention" value="yes"> {{ trans('ticketit::lang.show-ticket-modal-complete-blank-intervention-check') }}</label>
					</div>
				</div>
			@endif
		@else
			@if ($a_reasons)
				<div class="form-group">
				{!! CollectiveForm::label(null, trans('ticketit::lang.closing-reason') . trans('ticketit::lang.colon'), ['class' => 'col-md-3 control-label']) !!}
				
				<div class="col-md-9">
				@foreach ($a_reasons as $id => $reason)
					<label>{!! CollectiveForm::radio('reason_id',$id) !!} {{ $reason }}</label><br />
				@endforeach
				</div>
				</div>
			@else
				{!! CollectiveForm::hidden('reason_id','none') !!}
			@endif
			
			
			<div class="form-group">
                {!! CollectiveForm::label('clarification', trans('ticketit::lang.closing-clarifications') . trans('ticketit::lang.colon'), ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-9">
                    {!! CollectiveForm::textarea('clarification', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                </div>
            </div>
		@endif
		
		{!! CollectiveForm::close() !!}	 
		</div>
		<div class="modal-footer">
		<button type="button" id="complete_form_submit" class="btn btn-danger">{{ trans('ticketit::lang.btn-submit') }}</button>
		</div>
		
    </div>
  </div>
</div>