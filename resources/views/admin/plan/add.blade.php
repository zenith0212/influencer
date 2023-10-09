<div class="modal-header">
    <h2 class="fw-bold">{{ __('plans.add_new_plan') }}</h2>
    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_customer_close" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-1">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
            </svg>
        </span>
    </button>
</div>
<div class="modal-body py-10 px-lg-17">
    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
        <form action="{{ route('plans.store') }}" method="post" class="add_plans_form" id="add_plans_form" autocomplete="off">
            @csrf
            <div class="fv-row mb-7 fv-plugins-icon-container">
                <label  class="required fs-6 fw-semibold mb-2" for="name_en">{{ __('plans.name') }} </label>
                <input class="form-control form-control-solid" id="name_en" name="name_en" type="text" placeholder="Plan Name" required />
                @error('name_en')
                <p class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
                @enderror
            </div>
            <div class="fv-row mb-7 fv-plugins-icon-container">
                <label  class="required fs-6 fw-semibold mb-2" for="description_en">{{ __('plans.description') }} </label>
                <input class="form-control form-control-solid" id="description_en" name="description_en" type="text" placeholder="Description" required />
                @error('description_en')
                <p class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
                @enderror
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="amount">{{ __('plans.amount') }} </label>
                        <input class="form-control form-control-solid" id="amount" name="amount" type="text" placeholder="Amount" required />
                        @error('amount')
                        <p class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label  class="required fs-6 fw-semibold mb-2" for="plan_duration">{{ __('plans.duration') }} </label>
                        <div class="input-group">
                            <input class="form-control form-control-solid" id="plan_duration" name="plan_duration" type="text" placeholder="Plan Duration" required />
                            <select class="select2-selection select2-selection--single form-select form-select-solid" name="plan_duration_time" id="plan">
                                <option value="" disabled selected>Choose Duration</option>
                                <option value="Days">Days</option>
                                <option value="Months">Months</option>
                                <option value="Years">Years</option>
                            </select>
                        </div>
                    </div>
                </div>
                @error('plan_duration')
                <p class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
                @enderror
                @error('plan_duration_time')
                <p class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
                @enderror
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <div class="fv-row mb-7 fv-plugins-icon-container ps-3">
                        <div class="d-block ">
                            <label class="required fs-6 fw-semibold mb-2" for="status">{{ __('plans.status') }} </label>
                        </div>
                        <div class="input-wrapper d-flex pt-3">
                            <div class="form-check form-check-solid form-check-custom form-switch">
                                <label class="switch">
                                    <input class="form-check-input" type="checkbox" name="status" id="status" checked="checked" value="1">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="container-test repeater" data-kt-ecommerce-catalog-add-product="auto-options">
                    <label class="required fs-6 fw-semibold mb-2">Add Features</label>
                    <div id="kt_ecommerce_add_product_options">
                        <div class="form-group">
                            <div data-repeater-list="features_group" class="d-flex flex-column gap-3">
                                <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                    <input type="text" class="form-control mw-100 w-700px features-en" name="features_en" data-kt-ecommerce-catalog-add-product="product_option" required>
                                    <button type="button" data-repeater-delete class="btn btn-sm btn-icon btn-light-danger">
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"></rect>
                                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary" id="btn-add-feature">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                                    </svg>
                                </span>Add Another Feature
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
                @error('features_en')
                <p class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
                @enderror
            </div>
            <div class="modal-footer flex-center">
                <button type="reset" value="submit" class="btn btn-light me-3">
                    <span class="indicator-label">{{ __('plans.reset') }}</span>
                </button>  
                <button type="submit" name="add_plan" class="btn btn-primary" id="validation-next">
                    <span class="indicator-label">{{ __('plans.submit') }}</span>
                    <span class="indicator-progress">{{ __('plans.wait') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).on('change', '.status', function() {
        $(this).val( $(this).is(':checked') ? '1' : '0' );
    });

    function delete_confirmation(message = 'Are you sure you want to delete this record?', confirmButtonText = "Yes, delete!", cancelButtonText = 'No, cancel' ) {
        return Swal.fire({
            text: message,
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText,
            customClass: {
                confirmButton: "btn fw-bold btn-danger custom-button-css",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        });
    }

    $(document).ready(function () {
        $(document).find('.repeater').repeater({
            initEmpty: false,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                delete_confirmation('Are you sure you want to delete this element?').then(function (response) {
                      if (response['isConfirmed']) {
                        $(this).slideUp(deleteElement);
                      }
                })
            },
            ready: function (setIndexes) {
            },
            isFirstItemUndeletable: false
        });
    });
</script>