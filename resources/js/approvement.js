const formApprove = document.querySelector('.form-approve');
formApprove.addEventListener(
    "submit",
    (event) => {
        if (!formApprove.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        formApprove.classList.add("was-validated");

        if (formApprove.checkValidity()) {
            event.preventDefault();
            Swal.fire({
                title: "Approved ?",
                text: "Your sure to approve this quotation ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#696cff",
                cancelButtonColor: "#8592a3",
                confirmButtonText: "Approved",
                focusCancel: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Successfully",
                        text: "Quotation has been approved 🚀",
                        icon: "success",
                        timer: 800,
                        didOpen: () => {
                            Swal.showLoading()
                          },
                          willClose: () => {
                            formApprove.submit();
                          }
                    });
                }
            });
        }
    }, false
);

const formReject = document.querySelector('.form-reject');
formReject.addEventListener(
    "submit",
    (event) => {
        if (!formReject.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        formReject.classList.add("was-validated");

        if (formReject.checkValidity()) {
            event.preventDefault();
            Swal.fire({
                title: "Reject ?",
                text: "Your sure to reject this quotation ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3e1d",
                cancelButtonColor: "#8592a3",
                confirmButtonText: "Reject",
                focusCancel: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Successfully",
                        text: "Quotation has been approved 🚀",
                        icon: "success",
                        timer: 800,
                        didOpen: () => {
                            Swal.showLoading()
                          },
                          willClose: () => {
                            formReject.submit();
                          }
                    });
                }
            });
        }
    }, false
);