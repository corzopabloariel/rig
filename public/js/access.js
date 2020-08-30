const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
function enviar(evt) {
    evt.preventDefault();
    let url = this.action;
    let method = this.method;
    let idForm = this.id;
    let formElement = document.getElementById(idForm);
    let formData = new FormData(this);
    grecaptcha.ready(function() {
        $( ".form-control" ).prop( "readonly" , true );
        Toast.fire({
            icon: 'warning',
            title: 'Espere, enviando'
        });
        grecaptcha.execute(document.querySelector('meta[name="public-key"]').content, {action: 'contact'}).then( function( token ) {
            formData.append( "token", token );
            axios({
                method: method,
                url: url,
                data: formData,
                responseType: 'json',
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then((res) => {
                $(".form-control").prop("readonly", false);
                if (!parseInt(res.data.error)) {
                    document.querySelector("#card-access").innerHTML = res.data.txt;
                } else
                    Toast.fire({
                        icon: 'error',
                        title: res.data.mssg
                    });
            })
            .catch((err) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrió un error'
                });
            })
            .then(() => {});
        });
    });
};

document.addEventListener("DOMContentLoaded", function(event) {
    const form = document.querySelector("#form");

    form.addEventListener("submit", enviar);
});