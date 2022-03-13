<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete ?",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel", "Yes!"],
            confirmButtonColor: '#8CD4F5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel plz!",
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    form.submit();
                } catch ($e) {
                    swal("Not deleted");
                }
            } else {
                swal("Cancelled", "Your Data is safe :)", "info");
            }
        });
    });
    @if (session('errorMessage'))
        $(document).ready(function() {
        swal({
        title: "You can't delete this package",
        text: "you have user bought this package",
        icon: "error",
        type: "error",
        confirmButtonColor: '#8CD4F5',
        confirmButtonText: 'Ok',

        });

        });
    @endif
</script>
