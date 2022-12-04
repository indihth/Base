<div id="flash-overlay-modal" class="modal fade {{ isset($modalClass) ? $modalClass : '' }}">
    <div class="modal-dialog">
        {{-- add styling from previous flash alerts --}}
        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">{{ $title }}</h4>
            </div>

            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
