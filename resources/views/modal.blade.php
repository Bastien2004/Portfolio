<div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            {{-- ── HEADER MEDIA ── --}}
            <div id="bs-modal-header"></div>

            {{-- ── BODY ── --}}
            <div class="modal-body">

                {{-- Title + close --}}
                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                    <h2 class="modal-title-text" id="bs-modal-title"></h2>
                    <button type="button"
                            class="btn-close btn-close-white shadow-none flex-shrink-0 mt-1"
                            data-bs-dismiss="modal"
                            aria-label="Fermer"></button>
                </div>

                {{-- Description --}}
                <p id="bs-modal-desc"
                   class="mb-4"
                   style="color: var(--muted-lt); font-size: 1.02rem; line-height: 1.7; white-space: pre-line;"></p>

                {{-- Tags + Links --}}
                <div class="row g-4">
                    <div class="col-md-6">
                        <p class="modal-section-label">Technologies</p>
                        <div id="bs-modal-tags" class="d-flex flex-wrap gap-2"></div>
                    </div>
                    <div class="col-md-6">
                        <p class="modal-section-label">Liens</p>
                        <div id="bs-modal-links" class="d-flex flex-wrap gap-2"></div>
                    </div>
                </div>

                {{-- Meta --}}
                <div class="modal-meta-row" id="bs-modal-meta"></div>

            </div>
        </div>
    </div>
</div>
