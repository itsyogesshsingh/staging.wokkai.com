<x-auth::layouts.master>
    <div class="main-wrapper">
       <div class="overflow-hidden p-3 acc-vh">
            <!-- start row -->
            <div class="row vh-100 w-100 g-0">
                <div class="col-lg-3 vh-100 overflow-y-auto overflow-x-hidden">
                    <!-- start row -->
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <form action="{{ route('doLogin') }}" id="loginForm" method="post" class=" vh-100 d-flex justify-content-between flex-column p-4 pb-0">
                                @csrf
                                <div class="text-center mb-4 auth-logo">
                                    <img src="{{ asset('admin_assets/assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <h3 class="mb-2">Sign In</h3>
                                        <p class="mb-0">Access the CRMS panel using your email and passcode.</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <div class="input-group input-group-flat">
                                            <input type="text" class="form-control" name="username" id="username" value="username">
                                            <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group input-group-flat pass-group">
                                            <input type="password" class="form-control pass-input" name="password" id="password" value="password">
                                            <span class="input-group-text toggle-password "><i class="ti ti-eye-off"></i></span>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="form-check form-check-md d-flex align-items-center">
                                            <input class="form-check-input mt-0" type="checkbox" value="" id="checkebox-md" checked="">
                                            <label class="form-check-label text-dark ms-1" for="checkebox-md">
                                                Remember Me
                                            </label>
                                        </div>
                                        <div class="text-end">
                                            <a href="#" class="link-danger fw-medium link-hover">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100" id="loginBtn">Sign In</button>
                                    </div>
                                    <div id="loginMsg"></div>
                                </div>
                                <div class="text-center pb-4">
                                    <p class="text-dark mb-0">Copyright &copy; <script>document.write(new Date().getFullYear())</script> - CRMS</p>
                                </div>
                            </form>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <div class="col-lg-9 account-bg-01"></div>
            </div>
            <!-- end row -->
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            });

            $("#username, #password").on("input", function () {
                $(this).removeClass("is-invalid");
                $(this).siblings(".invalid-feedback").text("");
            });

            $("#loginForm").submit(function (e) {
                e.preventDefault();

                $(".invalid-feedback").text("");
                $(".is-invalid").removeClass("is-invalid");
                let $btn = $("#loginBtn");
                $btn.prop("disabled", true).text("Logging in...");

                let form = this;
                let formData = new FormData(form);

                $.ajax({
                    url: $(form).attr("action"),
                    method: $(form).attr("method"),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        form.reset();
                        if (response.token) {
                            $('meta[name="csrf-token"]').attr('content', response.token);

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': response.token,
                                    'Accept': 'application/json'
                                }
                            });
                        }
                        showToast("success", "Success", response.message || "Login successful");
                        setTimeout(() => {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        }, 1500);
                    },
                    error: function (xhr) {
                        let message = "Something went wrong";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message || message;
                        }
                        // ===================== 422 Validation Error =====================
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (field, messages) {
                                $("#" + field).addClass("is-invalid").siblings(".invalid-feedback").text(messages[0]);
                            });
                            showToast("danger", "Validation Error", message);
                        }
                        else if (xhr.status === 401) {
                            showToast("danger", "Login Failed", message);
                        }
                        else if (xhr.status === 500) {
                            showToast("danger", "Server Error", message);
                        }
                        else {
                            showToast("danger", "Error", message);
                        }
                    },
                    complete: function () {
                        $btn.prop("disabled", false).text("Sign In");
                    }
                });
            });
        });
    </script>
    @endpush
</x-auth::layouts.master>
