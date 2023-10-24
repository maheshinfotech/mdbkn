<span>
    <div class="d-flex justify-content-start">
        {{-- @click="$notification({text:'This is a simple notification',variant:'success'})" --}}

        @can('update', $module)

            <a href="{{ url(config('app.admin_prefix') . "$module/$id") }}" class="btn text-primary edit-record" data-bs-toggle="tooltip"
                title="Edit Record">
                <i class="fa-solid fa-pen"></i>
            </a>

            @if ($module == 'user')
                <button class="btn text-success update-user-credentials" data-id="{{ $id }}"
                    data-name="{{ $name }}" data-bs-toggle="tooltip" title="Update Password">
                    <i class="nav-main-link-icon si si-lock" data-bs-toggle="modal"
                        data-bs-target="#forgot-password-modal"></i>
                </button>
            @endif

        @endcan

        @can('delete', $module)
            <button data-id="{{ $id }}" data-module="{{ $module }}" data-name="{{ $name }}"
                class="delete-record btn text-danger js-swal-confirm " data-bs-toggle="tooltip" data-bs-placement="top"
                title="Delete Record">
                <i class="fa-solid fa-trash"></i>
            </button>
        @endcan

    </div>
</span>
