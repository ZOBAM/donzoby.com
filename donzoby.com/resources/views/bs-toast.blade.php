{{-- bootstrap toast --}}
<button type="button" class="btn btn-primary tw-hidden" id="liveToastBtn">Show live toast</button>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="{{ asset('images/donzoby-logo-wtbg.png') }}" width="35" class="rounded me-2" alt="...">
            <strong class="me-auto">Donzoby</strong>
            <small>Action Success</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" x-text="toastMessage">
        </div>
    </div>
</div>
