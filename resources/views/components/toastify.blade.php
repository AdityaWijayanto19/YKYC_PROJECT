<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<script>
    (function () {
        const toastData = {
            errors: @json($errors->all()),
            success: "{{ session('success') ?? '' }}",
            error: "{{ session('error') ?? '' }}",
            warning: "{{ session('warning') ?? '' }}"
        };

        toastData.errors.forEach(msg => {
            Toastify({
                text: msg,
                duration: 4000,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
                close: true,
                style: {
                    fontSize: "14px",
                    fontWeight: "600",
                    color: "white",
                    borderRadius: "8px",
                    padding: "12px 24px",
                    boxShadow: "0 4px 6px rgba(0,0,0,0.1)"
                }
            }).showToast();
        });

        if (toastData.warning) {
            Toastify({
                text: toastData.warning,
                duration: 7000, 
                gravity: "top",
                position: "right",
                backgroundColor: "#F97316", 
                close: true,
                style: {
                    fontSize: "14px",
                    fontWeight: "600",
                    color: "white",
                    borderRadius: "8px",
                    padding: "12px 24px",
                    boxShadow: "0 4px 6px rgba(0,0,0,0.1)"
                }
            }).showToast();
        }

        if (toastData.success) {
            Toastify({
                text: toastData.success,
                duration: 4000,
                gravity: "top",
                position: "right",
                backgroundColor: "green",
                close: true,
                style: {
                    fontSize: "14px",
                    fontWeight: "600",
                    color: "white",
                    borderRadius: "8px",
                    padding: "12px 24px",
                    boxShadow: "0 4px 6px rgba(0,0,0,0.1)"
                }
            }).showToast();
        }

        if (toastData.error) {
            Toastify({
                text: toastData.error,
                duration: 4000,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
                close: true,
                style: {
                    fontSize: "14px",
                    fontWeight: "600",
                    color: "white",
                    borderRadius: "8px",
                    padding: "12px 24px",
                    boxShadow: "0 4px 6px rgba(0,0,0,0.1)"
                }
            }).showToast();
        }
    })();
</script>