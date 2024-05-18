
(() => {
    "use strict";
    


    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll(".form-create");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");

                if (form.checkValidity()) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#696cff",
                        cancelButtonColor: "#8592a3",
                        confirmButtonText: "Save Data",
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Successfully",
                                text: "Your file has been added ✅",
                                icon: "success",
                                timer: 800,
                                didOpen: () => {
                                    Swal.showLoading()
                                  },
                                  willClose: () => {
                                    form.submit();
                                  }
                            });
                        }
                    });
                }
            },
            false
        );
    });

    const formsEdit = document.querySelectorAll(".form-edit");
    Array.from(formsEdit).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");

                if (form.checkValidity()) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#696cff",
                        cancelButtonColor: "#8592a3",
                        confirmButtonText: "Save Changes",
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Successfully",
                                text: "Your file has been updated ✅",
                                icon: "success",
                                timer: 800,
                                didOpen: () => {
                                    Swal.showLoading()
                                  },
                                  willClose: () => {
                                    form.submit();
                                  }
                            });
                        }
                    });
                }
            },
            false
        );
    });

    const formsDelete = document.querySelectorAll('.form-destroy');
    Array.from(formsDelete).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");

                if (form.checkValidity()) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Are you sure delete this?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#ff3e1d",
                        cancelButtonColor: "#8592a3",
                        confirmButtonText: "Yes! Delete it",
                        focusCancel: true,
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Successfully",
                                text: "Your file has been deleted ✅",
                                icon: "success",
                                timer: 800,
                                didOpen: () => {
                                    Swal.showLoading()
                                  },
                                  willClose: () => {
                                    form.submit();
                                  }
                            });
                        }
                    });
                }
            }, false
        );
    });

    const formSubmitQuotation = document.querySelectorAll('.form-submit-quotation');
    Array.from(formSubmitQuotation).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");

                if (form.checkValidity()) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Are you sure submit this quotation?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#696cff",
                        cancelButtonColor: "#8592a3",
                        confirmButtonText: "Yes!Submit",
                        focusCancel: true,
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Successfully",
                                text: "Quotation has been added ✅",
                                icon: "success",
                                timer: 800,
                                didOpen: () => {
                                    Swal.showLoading()
                                  },
                                  willClose: () => {
                                    form.submit();
                                  }
                            });
                        }
                    });
                }
            }, false
        );
    });

    const submitItemQuotation = document.querySelectorAll('.form-submit-item-quo');
    Array.from(submitItemQuotation).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");

                if (form.checkValidity()) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Anda Yakin 🤔?",
                        text: "Data tidak dapat diedit kembali",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#696cff",
                        cancelButtonColor: "#8592a3",
                        confirmButtonText: "Ya!",
                        focusCancel: true,
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Berhasil",
                                text: "Penawaran berhasil di submit 🚀",
                                icon: "success",
                                timer: 800,
                                didOpen: () => {
                                    Swal.showLoading()
                                  },
                                  willClose: () => {
                                    form.submit();
                                  }
                            });
                        }
                    });
                }
            }, false
        );
    });

    const formLogout = document.querySelector('.form-logout');
    formLogout.addEventListener(
        "submit",
        (event) => {
            if (!formLogout.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            formLogout.classList.add("was-validated");

            if (formLogout.checkValidity()) {
                event.preventDefault();
                Swal.fire({
                    title: "Logout",
                    text: "Are you sure to logout ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#696cff",
                    cancelButtonColor: "#8592a3",
                    confirmButtonText: "Yes",
                    focusCancel: true,
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Successfully",
                            text: "Logout 🚀",
                            icon: "success",
                            timer: 800,
                            didOpen: () => {
                                Swal.showLoading()
                              },
                              willClose: () => {
                                formLogout.submit();
                              }
                        });
                    }
                });
            }
        }, false
    );

    
})();
